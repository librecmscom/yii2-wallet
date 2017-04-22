<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use xutl\inspinia\Box;
use xutl\inspinia\Toolbar;
use xutl\inspinia\Alert;

/* @var $this yii\web\View */
/* @var $model yuncms\wallet\models\Bankcard */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('wallet', 'Manage Bankcard'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12 bankcard-view">
            <?= Alert::widget() ?>
            <?php Box::begin([
                'header' => Html::encode($this->title),
            ]); ?>
            <div class="row">
                <div class="col-sm-4 m-b-xs">
                    <?= Toolbar::widget(['items' => [
                        [
                            'label' => Yii::t('wallet', 'Manage Bankcard'),
                            'url' => ['index'],
                        ],
                        [
                            'label' => Yii::t('wallet', 'Update Bankcard'),
                            'url' => ['update', 'id' => $model->id],
                            'options' => ['class' => 'btn btn-primary btn-sm']
                        ],
                        [
                            'label' => Yii::t('wallet', 'Delete Bankcard'),
                            'url' => ['delete', 'id' => $model->id],
                            'options' => [
                                'class' => 'btn btn-danger btn-sm',
                                'data' => [
                                    'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                                    'method' => 'post',
                                ],
                            ]
                        ],
                    ]]); ?>
                </div>
                <div class="col-sm-8 m-b-xs">

                </div>
            </div>

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                                'id',
                    'user_id',
                    'bank',
                    'city',
                    'username',
                    'name',
                    'number',
                    'created_at',
                    'updated_at',
                ],
            ]) ?>
            <?php Box::end(); ?>
        </div>
    </div>
</div>

