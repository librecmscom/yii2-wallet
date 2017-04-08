<?php
use yii\helpers\Url;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model yuncms\wallet\models\Bankcard */

$this->title = Yii::t('wallet', 'Create Bankcard');
$this->params['breadcrumbs'][] = ['label' => Yii::t('wallet', 'Bankcards'), 'url' => ['index']];
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
                <a class="btn btn-primary" href="<?= Url::to(['/user/bankcard/index']); ?>"
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
