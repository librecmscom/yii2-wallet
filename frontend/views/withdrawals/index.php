<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel yuncms\user\models\WithdrawalsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('wallet', 'Withdrawals');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-2">
        <?= $this->render('@yuncms/user/frontend/views/_profile_menu') ?>
    </div>
    <div class="col-md-10">
        <h2 class="h3 profile-title">
            <?= Yii::t('wallet', 'Withdrawals') ?>
            <div class="pull-right">
                <a class="btn btn-primary"
                   href="<?= Url::to(['/wallet/wallet/index']); ?>"><?= Yii::t('wallet', 'Wallet'); ?></a>
                <a class="btn btn-primary"
                   href="<?= Url::to(['/wallet/bankcard/index']); ?>"><?= Yii::t('wallet', 'Bankcard'); ?></a>
            </div>
        </h2>
        <div class="row">
            <div class="col-md-12">
                <?php Pjax::begin(); ?>    <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'layout' => "{items}\n{pager}",
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],

                        [
                            'label' => Yii::t('wallet', 'Bankcard'),
                            'value' => function ($model) {
                                return $model->bankcard->bank . '-' . substr($model->bankcard->number, -4);
                            },
                        ],
                        'currency',
                        'money',
                        [
                            'header' => Yii::t('wallet', 'Status'),
                            'value' => function ($model) {
                                if ($model->isPending()) {
                                    return Html::tag('span', Yii::t('wallet', 'Pending'), ['class' => 'label label-warning']);
                                } elseif ($model->isRejected()) {
                                    return Html::tag('span', Yii::t('wallet', 'Rejected'), ['class' => 'label label-danger']);
                                } else if ($model->isDone()) {
                                    return Html::tag('span', Yii::t('wallet', 'Rejected'), ['class' => 'label label-success']);
                                }
                            },
                            'format' => 'raw',
                        ],
                        'status',
                        'created_at:datetime',
                        'updated_at:datetime',
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'template' => '{view}',
                        ],
                    ],
                ]); ?>
                <?php Pjax::end(); ?>
            </div>
        </div>
    </div>
</div>