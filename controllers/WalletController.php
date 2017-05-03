<?php
/**
 * @link http://www.tintsoft.com/
 * @copyright Copyright (c) 2012 TintSoft Technology Co. Ltd.
 * @license http://www.tintsoft.com/license/
 */
namespace yuncms\wallet\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;
use yuncms\wallet\models\Wallet;

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
                        'actions' => ['index'],
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
}