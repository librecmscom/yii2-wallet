<?php
/**
 * @link http://www.tintsoft.com/
 * @copyright Copyright (c) 2012 TintSoft Technology Co. Ltd.
 * @license http://www.tintsoft.com/license/
 */

namespace yuncms\wallet\controllers;

use Yii;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use yuncms\wallet\models\Recharge;
use yuncms\wallet\models\Wallet;
use yuncms\payment\models\Payment;

/**
 * Class WalletController
 * @package yuncms\video\controllers
 */
class WalletController extends Controller
{
    /** @inheritdoc */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'recharge'],
                        'roles' => ['@']
                    ]
                ]
            ]
        ];
    }

    /**
     * 显示钱包首页
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Wallet::find()->where(['user_id' => Yii::$app->user->id])->orderBy(['created_at' => SORT_DESC]),
        ]);
        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * 钱包充值
     * @param int $id
     * @return array|string|Response
     */
    public function actionRecharge($id)
    {
        $wallet = $this->findModel($id);
        $model = new Recharge();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $payment = new Payment([
                'currency' => $model->currency,
                'money' => $model->money,
                'name' => Yii::t('wallet', 'Wallet Recharge'),
                'gateway' => $model->gateway,
                'trade_type' => Payment::TYPE_NATIVE,
                'model_id' => $model->id,
                'model' => get_class($model),
                'return_url' => Url::to(['/wallet/wallet/index'], true),
            ]);
            if ($payment->save()) {
                $model->link('payment', $payment);
                return $this->redirect(['/payment/default/pay', 'id' => $payment->id]);
            }
        }
        return $this->render('recharge', [
            'model' => $model,
            'wallet' => $wallet,
        ]);
    }

    /**
     * 获取钱包
     * @param int $id
     * @return Wallet the loaded model
     * @throws NotFoundHttpException
     */
    public function findModel($id)
    {
        if (($model = Wallet::findOne(['id' => $id, 'user_id' => Yii::$app->user->id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException(Yii::t('wallet', 'The requested page does not exist.'));
        }
    }
}