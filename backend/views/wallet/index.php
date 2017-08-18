<?php
use yii\web\View;
use yii\helpers\Url;
use yii\helpers\Html;
use xutl\inspinia\Box;
use xutl\inspinia\Toolbar;
use xutl\inspinia\Alert;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel yuncms\wallet\backend\models\WalletSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('wallet', 'Manage Wallet');
$this->params['breadcrumbs'][] = $this->title;
$this->registerJs("jQuery(\"#batch_deletion\").on(\"click\", function () {
    yii.confirm('" . Yii::t('app', 'Are you sure you want to delete this item?')."',function(){
        var ids = jQuery('#gridview').yiiGridView(\"getSelectedRows\");
        jQuery.post(\"/wallet/wallet/batch-delete\",{ids:ids});
    });
});", View::POS_LOAD);
?>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12 wallet-index">
            <?= Alert::widget() ?>
            <?php Pjax::begin(); ?>                
            <?php Box::begin([
                //'noPadding' => true,
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
                            'options' => ['id' => 'batch_deletion', 'class'=>'btn btn-sm btn-danger'],
                            'label' => Yii::t('wallet', 'Batch Deletion'),
                            'url' => 'javascript:void(0);',
                        ]
                    ]]); ?>
                </div>
                <div class="col-sm-8 m-b-xs">
                    <?= $this->render('_search', ['model' => $searchModel]); ?>
                </div>
            </div>
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'options' => ['id' => 'gridview'],
                'layout' => "{items}\n{summary}\n{pager}",
                //'filterModel' => $searchModel,
                'columns' => [
                    [
                        'class' => 'yii\grid\CheckboxColumn',
                        "name" => "id",
                    ],
                    //['class' => 'yii\grid\SerialColumn'],
                    'id',
                    'user_id',
                    'user.username',
                    'currency',
                    'money',
                    'created_at:datetime',
                     'updated_at:datetime',
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'header' => Yii::t('wallet', 'Operation'),
                        'template' => '{recharge} {view} {update} {delete}',
                        'buttons' => ['recharge' => function ($url, $model, $key) {
                            return Html::a('<span class="fa fa-plus"></span>',
                                Url::toRoute(['recharge', 'id' => $model->id]), [
                                    'title' => Yii::t('wallet', 'Wallet Recharge'),
                                    'aria-label' => Yii::t('wallet', 'Wallet Recharge'),
                                    'data-pjax' => '0',
                                ]);
                        }]
                    ]
                ],
            ]); ?>
            <?php Box::end(); ?>
            <?php Pjax::end(); ?>
        </div>
    </div>
</div>
