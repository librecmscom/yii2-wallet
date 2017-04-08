<?php
/**
 * @link http://www.tintsoft.com/
 * @copyright Copyright (c) 2012 TintSoft Technology Co. Ltd.
 * @license http://www.tintsoft.com/license/
 */
namespace yuncms\wallet\controllers;

use Yii;
use yii\web\NotFoundHttpException;
use yuncms\video\models\Video;
use yuncms\video\models\VideoSearch;

/**
 * Class WalletController
 * @package yuncms\video\controllers
 */
class WalletController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $searchModel = new VideoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * 显示视频详情
     * @param string $uuid
     * @return string
     */
    public function actionView($uuid)
    {
        /** @var  Video $model */
        $model = $this->findModel($uuid);
        if (!Yii::$app->user->isGuest && Yii::$app->user->id != $model->user_id) {
            //更新播放计数
            $model->updateCounters(['views' => 1]);
        }
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Finds the Video model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param string $uuid
     * @return Video the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($uuid)
    {
        if (($model = Video::findOne(['uuid' => $uuid])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException(Yii::t('yii', 'The requested page does not exist.'));
        }
    }
}