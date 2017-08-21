<?php
/**
 * @link http://www.tintsoft.com/
 * @copyright Copyright (c) 2012 TintSoft Technology Co. Ltd.
 * @license http://www.tintsoft.com/license/
 */

/**
 * 变更指定用户钱包 + 钱或 - 钱
 * @param int $user_id
 * @param string $currency
 * @param double $money
 * @param string $action
 * @param string $msg
 * @return bool
 */
if (!function_exists('wallet')) {
    function wallet($user_id, $currency, $money, $action = '', $msg = '')
    {
        $wallet = \yuncms\wallet\models\Wallet::findByUserID($user_id, $currency);
        $value = $wallet->money + $money;
        if ($money < 0 && $value < 0) {
            return false;
        }
        $transaction = \yuncms\wallet\models\Wallet::getDb()->beginTransaction();
        try {
            //更新用户钱包
            $wallet->updateAttributes(['money' => $value, 'updated_at' => time()]);
            //创建钱包操作日志
            \yuncms\wallet\models\WalletLog::create([
                'wallet_id' => $wallet->id,
                'currency' => $currency,
                'money' => $money,
                'action' => $action,
                'msg' => $msg,
                'type' => $money > 0 ? \yuncms\wallet\models\WalletLog::TYPE_INC : \yuncms\wallet\models\WalletLog::TYPE_DEC
            ]);
            $transaction->commit();
            return true;
        } catch (\Exception $e) {
            $transaction->rollBack();
            return false;
        }
    }
}