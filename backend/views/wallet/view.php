<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\DetailView;
use xutl\inspinia\Box;
use xutl\inspinia\Toolbar;
use xutl\inspinia\Alert;
use yuncms\wallet\models\WalletLog;

/* @var $this yii\web\View */
/* @var $model yuncms\wallet\models\Wallet */
/** @var $dataProvider yuncms\wallet\models\WalletLog */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('wallet', 'Manage Wallet'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12 wallet-view">
            <?= Alert::widget() ?>
            <?php Box::begin([
                'header' => Html::encode($this->title),
            ]); ?>
            <div class="row">
                <div class="col-sm-4 m-b-xs">
                    <?= Toolbar::widget(['items' => [
                        [
                            'label' => Yii::t('wallet', 'Manage Wallet'),
                            'url' => ['index'],
                        ],
                        [
                            'label' => Yii::t('wallet', 'Create Wallet'),
                            'url' => ['create'],
                        ],
                        [
                            'label' => Yii::t('wallet', 'Update Wallet'),
                            'url' => ['update', 'id' => $model->id],
                            'options' => ['class' => 'btn btn-primary btn-sm']
                        ],
                        [
                            'label' => Yii::t('wallet', 'Wallet Recharge'),
                            'url' => ['recharge', 'id' => $model->id],
                            'options' => ['class' => 'btn btn-primary btn-sm']
                        ],
                        [
                            'label' => Yii::t('wallet', 'Delete Wallet'),
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
                    'user.email',
                    'user.username',
                    'currency',
                    'money',
                    //'created_at:datetime',
                    'updated_at:datetime',
                ],
            ]) ?>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'layout' => "{items}\n{summary}\n{pager}",
                'columns' => [
                    'id',
                    'currency',
                    [
                        'header' => Yii::t('wallet', 'Income & Expense'),
                        'value' => function ($model) {
                            if ($model->type == WalletLog::TYPE_DEC) {
                                return Html::tag('span', Yii::t('wallet', 'Expenditure'), ['class' => 'label label-warning']);
                            } else if ($model->type == WalletLog::TYPE_INC) {
                                return Html::tag('span', Yii::t('wallet', 'Income'), ['class' => 'label label-success']);
                            }
                        },
                        'format' => 'raw',
                    ],
                    'money',
                    'action',
                    'msg',
                    'created_at:datetime'
                ],
            ]);
            ?>
            <?php Box::end(); ?>
        </div>
    </div>
</div>

