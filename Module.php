<?php

namespace yuncms\wallet;

use Yii;
use yii\base\InvalidConfigException;
use yuncms\wallet\models\Wallet;
use yuncms\wallet\models\WalletLog;

/**
 * Class Module
 * @package yuncms\wifi
 */
class Module extends \yii\base\Module
{
    /**
     * @var int 最小提现
     */
    public $withdrawalsMin = 1000;

    /**
     * @var bool 禁止充值
     */
    public $prohibitedRecharge = false;

    /**
     * @throws InvalidConfigException
     */
    public function init()
    {
        parent::init();
        $this->registerTranslations();
    }

    /**
     * 注册语言包
     * @return void
     */
    public function registerTranslations()
    {
        if (!isset(Yii::$app->i18n->translations['wallet*'])) {
            Yii::$app->i18n->translations['wallet*'] = [
                'class' => 'yii\i18n\PhpMessageSource',
                'sourceLanguage' => 'en-US',
                'basePath' => __DIR__ . '/messages',
            ];
        }
    }

    /**
     * 变更指定用户钱包 + 钱或 - 钱
     * @param int $user_id
     * @param string $currency
     * @param double $money
     * @param string $action
     * @param string $msg
     * @return bool
     */
    public function wallet($user_id, $currency, $money, $action = '', $msg = '')
    {
        $wallet = Wallet::findByUserID($user_id, $currency);
        $value = $wallet->money + $money;
        if ($money < 0 && $value < 0) {
            return false;
        }
        $transaction = Wallet::getDb()->beginTransaction();
        try {
            //更新用户钱包
            $wallet->updateAttributes(['money' => $value, 'updated_at' => time()]);
            //创建钱包操作日志
            WalletLog::create([
                'wallet_id' => $wallet->id,
                'currency' => $currency,
                'money' => $money,
                'action' => $action,
                'msg' => $msg,
                'type' => $money > 0 ? WalletLog::TYPE_INC : WalletLog::TYPE_DEC
            ]);
            $transaction->commit();
            return true;
        } catch (\Exception $e) {
            $transaction->rollBack();
            return false;
        }
    }
}
