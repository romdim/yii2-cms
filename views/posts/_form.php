<?php

use kartik\datecontrol\DateControl;
use kartik\checkbox\CheckboxX;
use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model app\models\Posts */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="posts-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'short')->widget(\yii\redactor\widgets\Redactor::className()) ?>

    <?= $form->field($model, 'text')->widget(\yii\redactor\widgets\Redactor::className()) ?>

    <?= $form->field($model, 'date')->widget(DateControl::classname());
    ?>

    <?= $form->field($model, 'published')->widget(CheckboxX::classname(), [ 'pluginOptions'=>['threeState'=>false] ]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
