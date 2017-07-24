<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;
use yuncms\wallet\models\Bankcard;
use yuncms\wallet\models\Withdrawals;

/* @var $this yii\web\View */
/* @var $model Bankcard */

$this->title = Yii::t('wallet', 'Withdrawals');
$this->params['breadcrumbs'][] = ['label' => Yii::t('wallet', 'Withdrawals'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-2">
        <?= $this->render('@yuncms/user/frontend/views/_profile_menu') ?>
    </div>
    <div class="col-md-10">
        <h2 class="h3 profile-title">
            <?= Html::encode($this->title) ?>
            <div class="pull-right">
                <a class="btn btn-primary" href="<?= Url::to(['/wallet/wallet/index']); ?>"
                ><?= Yii::t('wallet', 'Wallet'); ?></a>

                <a class="btn btn-primary" href="<?= Url::to(['/wallet/withdrawals/index']); ?>"
                ><?= Yii::t('wallet', 'Withdrawals'); ?></a>
            </div>
        </h2>
        <div class="row">
            <div class="col-md-12">
                <?php $form = ActiveForm::begin([
                    'layout' => 'horizontal',
                ]); ?>

                <div class="form-group">
                    <label class="control-label col-sm-3"
                           for="withdrawals-amount"><?= Yii::t('wallet', 'Amount') ?></label>
                    <div class="col-sm-6">
                        <?= $wallet->money ?>
                    </div>
                </div>

                <?= $form->field($model, 'currency', ['inputOptions' => ['disabled' => true]]) ?>

                <?= $form->field($model, 'bankcard_id')->dropDownList(
                    ArrayHelper::map(Bankcard::find()->select(['id', "CONCAT(bank,' - ',username,' - ',number) as name"])->where(['user_id' => Yii::$app->user->id])->asArray()->all(), 'id', 'name')
                )->hint(Html::a(Yii::t('wallet','Add a bank card'),['/wallet/bankcard/create'])); ?>


                <?= $form->field($model, 'money'); ?>

                <div class="form-group">
                    <?= Html::submitButton(Yii::t('wallet', 'Create'), ['class' => 'btn btn-success']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>