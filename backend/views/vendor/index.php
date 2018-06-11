<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\Category */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

?>
<?php if($success):?>
    <div class="alert alert-success">Success added</div>
<?php endif; ?>
<div class="row">
    <div class="col-lg-5">
        <?php $form = ActiveForm::begin(['id' => 'vendor-create-form']); ?>
        <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>
        <?= $form->field($model, 'range_min')->label('Range_min, for example: 111')->textInput() ?>
        <?= $form->field($model, 'range_max')->label('Range_max, for example: 333')->textInput() ?>
        <?= $form->field($model, 'price')->textInput() ?>
        <?= $form->field($model, 'balance')->textInput() ?>
        <div class="form-group">
            <?= Html::submitButton('Create new vendor', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
