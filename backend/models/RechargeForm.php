<?php
/**
 * @link http://www.tintsoft.com/
 * @copyright Copyright (c) 2012 TintSoft Technology Co. Ltd.
 * @license http://www.tintsoft.com/license/
 */

namespace yuncms\wallet\models;

use Yii;
use yii\base\Model;

/**
 * Class RechargeForm
 * @property int $user_id
 * @property string $currency
 * @package yuncms\wallet\models
 */
class RechargeForm extends Model
{
    /**
     * @var int
     */
    public $user_id;

    /**
     * @var int 钱包ID
     */
    public $currency;

    /**
     * @var string 充值数量
     */
    public $money;

    /**
     * @var string 充值消息
     */
    public $msg;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'currency', 'money', 'msg'], 'required'],
            [['money'], 'number'],
            [['currency'], 'string', 'max' => 20],
            [['msg'], 'string', 'max' => 255],
        ];
    }

    /** @inheritdoc */
    public function attributeLabels()
    {
        return [

            'user_id' => Yii::t('wallet', 'User ID'),
            'currency' => Yii::t('wallet', 'Currency'),
            'money' => Yii::t('wallet', 'Money'),
            'msg' => Yii::t('wallet', 'Backend Recharge Msg'),

        ];
    }

    /**
     * 执行充值操作
     * @return bool
     */
    public function save()
    {
        if ($this->validate() && wallet($this->user_id, $this->currency, $this->money, 'Backend Recharge', $this->msg)) {
            return true;
        }
        return false;
    }
}