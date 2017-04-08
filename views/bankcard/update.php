<?php
use yii\helpers\Url;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model yuncms\user\models\BankCard */

$this->title = Yii::t('wallet', 'Update{modelClass}: ', [
        'modelClass' => Yii::t('wallet', 'Bankcard'),
    ]) . $model->number;
$this->params['breadcrumbs'][] = ['label' => Yii::t('wallet', 'Bankcards'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('wallet', 'Update');
?>
<div class="row">
    <div class="col-md-2">
        <?= $this->render('@yuncms/user/views/_profile_menu') ?>
    </div>
    <div class="col-md-10">
        <h2 class="h3 profile-title">
            <?= Html::encode($this->title) ?>
            <div class="pull-right">
                <a class="btn btn-primary" href="<?= Url::to(['/wallet/bankcard/index']); ?>"
                ><?= Yii::t('wallet', 'Bankcards'); ?></a>
            </div>
        </h2>
        <div class="row">
            <div class="col-md-12">
                <?= $this->render('_form', [
                    'model' => $model,
                ]) ?>

            </div>
        </div>
    </div>
</div>
