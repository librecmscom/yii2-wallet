<?php
/**
 * @link http://www.tintsoft.com/
 * @copyright Copyright (c) 2012 TintSoft Technology Co. Ltd.
 * @license http://www.tintsoft.com/license/
 */

namespace yuncms\wallet\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * 提现模型
 * @property int $id
 * @property int $user_id
 * @property int $bankcard_id
 * @property string $currency
 * @property double $money
 * @package yuncms\user\models
 */
class Withdrawals extends ActiveRecord
{
    const STATUS_PENDING = 0;
    const STATUS_REJECTED = 1;
    const STATUS_AUTHENTICATED = 2;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%withdrawals}}';
    }

    /**
     * 定义行为
     * @return array
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior'
            ],
            'blameable' => [
                'class' => 'yii\behaviors\BlameableBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'user_id',
                ],
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bankcard_id', 'money', 'currency'], 'required'],
            [['bankcard_id'], 'integer'],
            //['money', 'validateMoney'],
            ['money', 'integer',
                'min' => $this->getModule()->withdrawalsMin,
                'max' => $this->getAmount(),
                'tooBig' => Yii::t('wallet', 'Insufficient money, please recharge.'),
                'tooSmall' => Yii::t('wallet', 'The minimum extraction of withdrawals {num}.', ['num' => $this->getModule()->withdrawalsMin])],
            ['status', 'default', 'value' => self::STATUS_PENDING],
            ['status', 'in', 'range' => [self::STATUS_PENDING, self::STATUS_REJECTED, self::STATUS_AUTHENTICATED]],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => Yii::t('wallet', 'User Id'),
            'bankcard_id' => Yii::t('wallet', 'Bankcard'),
            'currency' => Yii::t('wallet', 'Currency'),
            'money' => Yii::t('wallet', 'Money'),
            'status' => Yii::t('wallet', 'Status'),
            'created_at' => Yii::t('wallet', 'Created At'),
            'updated_at' => Yii::t('wallet', 'Updated At'),
        ];
    }

    /**
     * 用户关系定义
     * @return \yii\db\ActiveQueryInterface
     */
    public function getBankcard()
    {
        return $this->hasOne(Bankcard::className(), ['id' => 'bankcard_id']);
    }

    /**
     * 获取钱包余额
     * @return float
     */
    public function getAmount()
    {
        if (($wallet = Wallet::findByUserID(Yii::$app->user->id, $this->currency)) != false) {
            return $wallet->money;
        } else {
            return 0.00;
        }
    }

    /**
     * 获取模块实例
     * @return null|\yii\base\Module|\yuncms\wallet\Module
     */
    public function getModule()
    {
        return Yii::$app->getModule('wallet');
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($insert) {//入库前先扣钱
                if (!$this->getModule()->wallet($this->user_id, $this->currency, -$this->money, Yii::t('wallet', 'Withdrawals'))) {
                    return false;
                }
            }
            return true;
        } else {
            return false;
        }
    }

    /**
     * 保存后执行
     */
    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        if ($insert) {
            $this->getModule()->sendMessage($this->user->email, Yii::t('wallet', 'Withdrawals Notice'), 'notice', [
                'user' => $this->user,
                'message' => '',
            ]);
        } else if ($this->status == self::STATUS_REJECTED) {//拒绝了提现请求
            $this->getModule()->sendMessage($this->user->email, Yii::t('wallet', 'Withdrawals Notice'), 'notice', [
                'user' => $this->user,
                'message' => '',
            ]);
        } else if ($this->status == self::STATUS_REJECTED) {//通过并打款
            $this->getModule()->sendMessage($this->user->email, Yii::t('wallet', 'Withdrawals Notice'), 'notice', [
                'user' => $this->user,
                'message' => '',
            ]);
        }
    }

    /**
     * 用户关系定义
     * @return \yii\db\ActiveQueryInterface
     */
    public function getUser()
    {
        return $this->hasOne(Yii::$app->user->identityClass, ['id' => 'user_id']);
    }
}