<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\PersonSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="person-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'number') ?>

    <?= $form->field($model, 'first_name') ?>

    <?= $form->field($model, 'middle_name') ?>

    <?= $form->field($model, 'last_name') ?>

    <?php // echo $form->field($model, 'birth_day') ?>

    <?php // echo $form->field($model, 'birth_country') ?>

    <?php // echo $form->field($model, 'birth_area') ?>

    <?php // echo $form->field($model, 'birth_city') ?>

    <?php // echo $form->field($model, 'location_country') ?>

    <?php // echo $form->field($model, 'location_area') ?>

    <?php // echo $form->field($model, 'location_city') ?>

    <?php // echo $form->field($model, 'location_address') ?>

    <?php // echo $form->field($model, 'comment') ?>

    <?php // echo $form->field($model, 'phone') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
