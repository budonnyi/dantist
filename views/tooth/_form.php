<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Tooth $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="tooth-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'card_id')->textInput() ?>

    <?= $form->field($model, 'tooth')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
