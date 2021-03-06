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
        <?php $form = ActiveForm::begin(['id' => 'category-create-form']); ?>

        <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>

        <div class="form-group">
            <?= Html::submitButton('Create new category', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
