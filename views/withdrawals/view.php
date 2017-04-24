<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model yuncms\wallet\models\Withdrawals */

$this->title = Yii::t('wallet', 'Withdrawals');
$this->params['breadcrumbs'][] = ['label' => Yii::t('wallet', 'Withdrawals'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-2">
        <?= $this->render('@yuncms/user/views/_profile_menu') ?>
    </div>
    <div class="col-md-10">
        <h2 class="h3 profile-title">
            <?= Html::encode($this->title) ?>
            <div class="pull-right">
                <a class="btn btn-primary" href="<?= Url::to(['/wallet/withdrawals/index']); ?>"
                ><?= Yii::t('wallet', 'Withdrawals'); ?></a>
            </div>
        </h2>
        <div class="row">
            <div class="col-md-12">
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        [
                            'label' => Yii::t('wallet', 'Bankcard'),
                            'value' => function ($model) {
                                return $model->bankcard->bank . '-' . substr($model->bankcard->number, -4);
                            },
                        ],
                        //'bankcard_id',
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
                                    return Html::tag('span', Yii::t('wallet', 'Rejected'), ['class' => 'label label-success']);
                                }
                            },
                            'format' => 'raw',
                        ],
                        'created_at:datetime',
                        'updated_at:datetime',
                    ],
                ]) ?>
            </div>
        </div>
    </div>
</div>
