<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;

/*
 * @var $this  yii\web\View
 */
$this->title = Yii::t('wallet', 'Wallet Manage');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-md-2">
        <?= $this->render('@yuncms/user/views/_profile_menu') ?>
    </div>
    <div class="col-md-10">
        <h2 class="h3 profile-title">
            <?= Yii::t('wallet', 'Wallets') ?>
            <div class="pull-right">
                <a class="btn btn-primary"
                   href="<?= Url::to(['/wallet/wallet/index']); ?>"><?= Yii::t('wallet', 'Wallet'); ?></a>
            </div>
        </h2>
        <div class="row">
            <div class="col-md-12">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'layout' => "{items}\n{pager}",
                    'columns' => [
                        [
                            'header' => Yii::t('wallet', 'Currency'),
                            'value' => function ($model) {
                                return Html::a($model->currency, ['/wallet/withdrawals/index', 'currency' => $model->currency]);
                            },
                            'format' => 'raw',
                        ],
                        'money',
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'header' => Yii::t('wallet', 'Operation'),
                            'template' => '{recharge}',
                            'buttons' => [
                                'recharge' =>
                                    function ($url, $model, $key) {
                                        return Html::a(Yii::t('wallet', 'Recharge'), ['/wallet/wallet/recharge', 'id' => $model->id]) .
                                            '   ' .
                                            Html::a(Yii::t('wallet', 'Withdrawals'), Url::to(['/wallet/withdrawals/create', 'currency' => $model->currency]));
                                    }]],
                    ],
                ]);
                ?>
            </div>
        </div>
    </div>
</div>