<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use xutl\inspinia\Box;
use xutl\inspinia\Toolbar;
use xutl\inspinia\Alert;

/* @var $this yii\web\View */
/* @var $model yuncms\wallet\models\Withdrawals */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('wallet', 'Manage Withdrawals'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12 withdrawals-view">
            <?= Alert::widget() ?>
            <?php Box::begin([
                'header' => Html::encode($this->title),
            ]); ?>
            <div class="row">
                <div class="col-sm-4 m-b-xs">
                    <?= Toolbar::widget(['items' => [
                        [
                            'label' => Yii::t('wallet', 'Manage Withdrawals'),
                            'url' => ['index'],
                        ],
                        [
                            'label' => Yii::t('wallet', 'Update Withdrawals'),
                            'url' => ['update', 'id' => $model->id],
                            'options' => ['class' => 'btn btn-primary btn-sm']
                        ],
                        [
                            'label' => Yii::t('wallet', 'Delete Withdrawals'),
                            'url' => ['delete', 'id' => $model->id],
                            'options' => [
                                'class' => 'btn btn-danger btn-sm',
                                'data' => [
                                    'confirm' => Yii::t('wallet', 'Are you sure you want to delete this item?'),
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
                    'user.username',
                    'bankcard.bank',
                    'bankcard.city',
                    'bankcard.name',
                    'bankcard.username',
                    'bankcard.number',
                    'currency',
                    'money',
                    [
                        'attribute' => Yii::t('wallet', 'Status'),
                        'value' => function ($model) {
                            if ($model->isPending()) {
                                return Html::tag('span', Yii::t('wallet', 'Pending'), ['class' => 'label label-warning']);
                            } elseif ($model->isRejected()) {
                                return Html::tag('span', Yii::t('wallet', 'Rejected'), ['class' => 'label label-danger']);
                            } else if ($model->isDone()) {
                                return Html::tag('span', Yii::t('wallet', 'Done'), ['class' => 'label label-success']);
                            }
                        },
                        'format' => 'raw',
                    ],
                    'created_at:datetime',
                    'updated_at:datetime',
                    [
                        'attribute' => Yii::t('wallet', 'Status'),
                        'value' => function ($model) {
                            if ($model->isPending()) {
                                $raw = Html::a(Yii::t('wallet', 'Done'), ['confirm', 'id' => $model->id], [
                                    'class' => 'btn btn-xs btn-success',
                                    'data-method' => 'post',
                                    'data-confirm' => Yii::t('wallet', 'Are you sure you want to done?'),
                                ]);
                                $raw .= '   ' . Html::a(Yii::t('wallet', 'Rejected'), ['rejected', 'id' => $model->id], [
                                        'class' => 'btn btn-xs btn-danger',
                                        'data-method' => 'post',
                                        'data-confirm' => Yii::t('wallet', 'Are you sure you want to rejected?'),
                                    ]);
                                return $raw;
                            }
                            return '';
                        },
                        'format' => 'raw',
                    ],
                ],
            ]) ?>
            <?php Box::end(); ?>
        </div>
    </div>
</div>

