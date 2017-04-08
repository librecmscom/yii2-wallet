<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model yuncms\user\models\BankCard */

$this->title = $model->number;
$this->params['breadcrumbs'][] = ['label' => Yii::t('wallet', 'Bankcards'), 'url' => ['index']];
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
                <?= Html::a(Yii::t('wallet', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a(Yii::t('wallet', 'Delete'), ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => Yii::t('wallet', 'Are you sure you want to delete this item?'),
                        'method' => 'post',
                    ],
                ]) ?>
                <a class="btn btn-primary"
                   href="<?= Url::to(['/wallet/bankcard/index']); ?>"><?= Yii::t('wallet', 'BankCard'); ?></a>
            </div>
        </h2>
        <div class="row">
            <div class="col-md-12">
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'bank',
                        'city',
                        'username',
                        'name',
                        'number',
                        'created_at:datetime',
                        'updated_at:datetime',
                    ],
                ]) ?>
            </div>
        </div>
    </div>
</div>
