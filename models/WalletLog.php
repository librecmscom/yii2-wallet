<?php
/**
 * @link http://www.tintsoft.com/
 * @copyright Copyright (c) 2012 TintSoft Technology Co. Ltd.
 * @license http://www.tintsoft.com/license/
 */

namespace yuncms\wallet\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\BaseActiveRecord;

/**
 * 钱包交易历史
 *
 * @property integer $id
 * @property integer $purse_id
 * @property string $type
 * @property double $amount
 * @property string $action
 * @property string $msg
 * @property integer $created_at
 */
class WalletLog extends ActiveRecord
{

    /**
     * @var integer 操作类型 加钱
     */
    const TYPE_INC = 1;

    /**
     * @var integer 操作类型 减钱
     */
    const TYPE_DEC = 0;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%wallet_log}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    BaseActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],
                ]
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [['type', 'in', 'range' => [self::TYPE_INC, self::TYPE_DEC]]];
    }

    /** @inheritdoc */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('wallet', 'Serial Number'),
            'type' => Yii::t('wallet', 'Income & Expense'),
            'msg' => Yii::t('wallet', 'Msg'),
            'currency' => Yii::t('wallet', 'Currency'),
            'money' => Yii::t('wallet', 'Money'),
            'action' => Yii::t('wallet', 'Action'),
            'created_at' => Yii::t('wallet', 'Created At'),
        ];
    }

    /**
     * 获取该条日志的钱包
     */
    public function getWallet()
    {
        return $this->hasOne(Wallet::className(), ['id' => 'wallet_id']);
    }

    /**
     * 判断指定的日志是否存在
     * @param string|array $where
     * @return bool
     */
    public static function hasLog($where)
    {
        return static::find()->where($where)->exists();
    }

    /**
     * 快速创建实例
     * @param array $attribute
     * @return mixed
     */
    public static function create(array $attribute)
    {
        $model = new static ($attribute);
        if ($model->save()) {
            return $model;
        }
        return false;
    }
}