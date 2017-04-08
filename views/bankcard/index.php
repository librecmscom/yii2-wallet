<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel yuncms\wallet\models\BankcardSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('wallet', 'Bankcards');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-2">
        <?= $this->render('@yuncms/user/views/_profile_menu') ?>
    </div>
    <div class="col-md-10">
        <h2 class="h3 profile-title">
            <?= Yii::t('wallet', 'Bankcards') ?>
            <div class="pull-right">
                <a class="btn btn-primary"
                   href="<?= Url::to(['/wallet/bankcard/create']); ?>"><?= Yii::t('wallet', 'Create'); ?></a>
            </div>
        </h2>
        <div class="row">
            <div class="col-md-12">
                <?php Pjax::begin(); ?>    <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'layout' => "{items}\n{pager}",
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        'bank',
                        'city',
                        'username',
                        'name',
                        'number',
                        'created_at:datetime',
                        'updated_at:datetime',
                        ['class' => 'yii\grid\ActionColumn'],
                    ],
                ]); ?>
                <?php Pjax::end(); ?>
            </div>
        </div>
    </div>
</div>
