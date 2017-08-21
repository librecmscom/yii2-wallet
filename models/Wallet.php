<?php
/**
 * @link http://www.tintsoft.com/
 * @copyright Copyright (c) 2012 TintSoft Technology Co. Ltd.
 * @license http://www.tintsoft.com/license/
 */

namespace yuncms\wallet\models;

use Yii;
use yii\db\ActiveRecord;
use yuncms\user\models\User;

/**
 * 钱包模型
 *
 * @property integer $id
 * @property integer $user_id 用户ID
 * @property string $currency 币种
 * @property double $money 10,2
 * @property string $action 操作
 * @property string $msg 备注
 * @property integer $created_at
 * @property integer $updated_at
 */
class Wallet extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%wallet}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior'
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['amount', 'default', 'value' => 0.00],
        ];
    }

    /** @inheritdoc */
    public function attributeLabels()
    {
        return [
            'id'=>Yii::t('wallet', 'Wallet Number'),
            'user_id'=>Yii::t('wallet', 'User ID'),
            'currency' => Yii::t('wallet', 'Currency'),
            'money' => Yii::t('wallet', 'Amount'),
            'created_at' => Yii::t('wallet', 'Created At'),
            'updated_at' => Yii::t('wallet', 'Updated At'),
        ];
    }

    /**
     * 一对一关联用户
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * 关联钱包日志
     * @return \yii\db\ActiveQuery
     */
    public function getLogs()
    {
        return $this->hasMany(WalletLog::className(), ['wallet_id' => 'id']);
    }

    /**
     * 快速创建实例
     * @param array $attribute
     * @return mixed
     */
    public static function create(array $attribute)
    {
        $model = new static ($attribute);
        if ($model->save(false)) {
            return $model;
        }
        return false;
    }

    /**
     * 通过用户ID查询用户钱包
     *
     * @param int $userID 用户ID
     * @param string $currency 币种
     * @return $this
     */
    public static function findByUserID($userID, $currency)
    {
        $purse = static::findOne(['user_id' => $userID, 'currency' => $currency]);
        if (!$purse) {
            $purse = static::create(['user_id' => $userID, 'currency' => $currency, 'money' => 0.00]);
        }
        return $purse;
    }

    /**
     * @inheritdoc
     */
    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        if (!$insert) {
            $log = new WalletLog([
                'wallet_id' => $this->id,
                'currency' => $this->currency,
                'money' => $this->money,
                'action' => $this->action,
                'msg' => $this->msg,
                'type' => $this->money > 0 ? WalletLog::TYPE_INC : WalletLog::TYPE_DEC
            ]);
            $log->link('wallet', $this);
        }
    }
}