<?php

namespace yuncms\wallet\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\BaseActiveRecord;
use yuncms\user\models\User;
use yuncms\payment\OrderInterface;
use yuncms\payment\models\Payment;

/**
 * This is the model class for table "{{%wallet_recharge}}".
 *
 * @property int $id
 * @property string $payment_id 支付号
 * @property int $user_id 用户ID
 * @property int $name
 * @property string $gateway 支付网关
 * @property string $currency 支付币种
 * @property string $money 支付金额
 * @property int $trade_state
 * @property int $trade_type 交易类型
 * @property string $note 注释
 * @property int $created_at 创建时间
 * @property int $updated_at 更新时间
 */
class Recharge extends ActiveRecord implements OrderInterface
{
    //交易状态
    const STATE_NOT_PAY = 0;//未支付
    const STATE_SUCCESS = 1;//支付成功
    const STATE_FAILED = 2;//支付失败

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'yii\behaviors\TimestampBehavior',
            [
                'class' => 'yii\behaviors\BlameableBehavior',
                'attributes' => [
                    BaseActiveRecord::EVENT_BEFORE_INSERT => ['user_id'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%wallet_recharge}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'trade_type'], 'integer'],
            [['gateway', 'money', 'currency', 'trade_type'], 'required'],
            [['money'], 'number'],
            [['currency'], 'string', 'max' => 20],
            ['trade_state', 'default', 'value' => self::STATE_NOT_PAY],
            ['trade_state', 'in', 'range' => [
                self::STATE_NOT_PAY,
                self::STATE_SUCCESS,
                self::STATE_FAILED,
            ]],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('wallet', 'ID'),
            'payment_id' => Yii::t('wallet', 'Payment Id'),
            'user_id' => Yii::t('wallet', 'User ID'),
            'name' => Yii::t('wallet', 'Name'),
            'gateway' => Yii::t('wallet', 'Gateway'),
            'currency' => Yii::t('wallet', 'Currency'),
            'money' => Yii::t('wallet', 'Money'),
            'trade_state' => Yii::t('wallet', 'Trade State'),
            'trade_type' => Yii::t('wallet', 'Trade Type'),
            'created_at' => Yii::t('wallet', 'Created At'),
            'updated_at' => Yii::t('wallet', 'Updated At'),
        ];
    }

    /**
     * User Relation
     * @return \yii\db\ActiveQueryInterface
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * Payment Relation
     * @return \yii\db\ActiveQueryInterface
     */
    public function getPayment()
    {
        return $this->hasOne(Payment::className(), ['id' => 'payment_id']);
    }

    /**
     * @inheritdoc
     * @return RechargeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RechargeQuery(get_called_class());
    }

    /**
     * 设置支付状态
     * @param string $orderId 订单ID
     * @param string $paymentId 支付号
     * @param bool $status 支付状态
     * @param array $params 附加参数
     * @return bool
     */
    public static function setPayStatus($orderId, $paymentId, $status, $params)
    {
        if (($model = static::findOne(['id' => $orderId])) != null && $status == true) {
            wallet($model->user_id, $model->currency, $model->money, 'recharge', $model->gateway . ' Recharge');
            return true;
        }
        return false;
    }
}
