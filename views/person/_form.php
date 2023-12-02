<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Person $model */
/** @var yii\widgets\ActiveForm $form */

yii\bootstrap5\BootstrapAsset::register($this);
yii\bootstrap5\BootstrapPluginAsset::register($this);
yii\web\YiiAsset::register($this);

?>

<div class="person-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-12">
            <?= $form->field($model, 'number')->textInput() ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'middle_name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3">
<!--            --><?php //= $form->field($model, 'birth_day')->widget(
//                \kartik\date\DatePicker::class, [
//                'pluginOptions' => [
//                    'language' => 'uk',
//                    'format' => 'yyyy-mm-dd',
//                    'todayHighlight' => true,
//                ]
//            ]); ?>
            <?php $model->birth_day = date('d-m-Y', !empty($model->birth_day) ? strtotime($model->birth_day) : time()) ?>
            <?= $form->field($model, "birth_day")->widget(
                \kartik\date\DatePicker::className(), [
                'value' => date('d-m-Y', !empty($model->birth_day) ? strtotime($model->birth_day) : time()),
                'language' => 'uk',
                'options' => ['placeholder' => 'Birth day...'],
//                'saveFormat'=>'Y-m-d',
                'pluginOptions' => [
                    'format' => 'dd-mm-yyyy',
                    'type' => \kartik\date\DatePicker::TYPE_COMPONENT_APPEND,
                    'todayHighlight' => true,
                    'convertFormat'=>true
                ]
            ]); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'birth_country')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'birth_area')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'birth_city')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'location_country')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'location_area')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'location_city')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'location_address')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="row">
        <div class="com-md-4">
            <?= $form->field($model, 'comment')->textarea(['rows' => 6]) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>

    <?php if (!empty($model->id)): ?>
        <?php
        $img = [];
        $json = [];
        foreach ($model->images as $attachment) {
            $root = Yii::$app->request->baseUrl . '/web/files/' . $model->id . '/';
            $img[] = $root . $attachment->filename;

            $type = pathinfo($attachment->filename, PATHINFO_EXTENSION);
            $json[] = [
                'type' => in_array($type, ['jpg', 'jpeg']) ? 'image' : $type,
                'caption' => $attachment->filename,
                'description' => $attachment->filename,
                'width' => '120px',
                'url' => \yii\helpers\Url::to(['/image/delete-upload']),
                'key' => 'filename_' . $attachment->id,
            ];
        }
        ?>

        <?= $form->field(new \app\models\Image(), 'filename')->widget(\kartik\file\FileInput::className(), [
            'options' => ['accept' => 'image/*', 'multiple' => true],
            'pluginOptions' => [
                'allowedPreviewTypes' => 'image',
                'showDownload' => true,
                'initialPreviewAsData' => true,
                'initialPreviewFileType' => 'image',
                'showCancel' => false,
                'showPreview' => true,
                'overwriteInitial' => false,
                'initialPreview' => $img,
                'initialPreviewConfig' => $json,
                'previewSettings' => [
                    'image' => ['width' => "auto", 'height' => "auto", 'max-width' => "100%", 'max-height' => "100%", 'image-orientation' => 'from-image'],
                ],
                'uploadAsync' => true,
//                'allowedFileExtensions' => ['jpg', 'jpeg'],
                'deleteUrl' => \yii\helpers\Url::to(['/image/delete-upload']),
                'uploadUrl' => \yii\helpers\Url::to(['/image/files-upload']),
                'uploadExtraData' => [
                    'person_id' => $model->id
                ],
            ]
        ]) ?>
    <?php elseif (!empty($model->id)) : ?>
        <?= $form->field(new \app\models\Image(), 'filename')->widget(\kartik\file\FileInput::classname(), [
            'options' => ['accept' => '', 'multiple' => true],
            'pluginOptions' => [
                'showCancel' => false,
                'previewFileType' => 'image',
                'uploadUrl' => \yii\helpers\Url::to(['/image/files-upload']),
                'uploadExtraData' => [
                    'invoice_id' => $model->id
                ],
            ],
        ]); ?>
    <?php endif; ?>


</div>
