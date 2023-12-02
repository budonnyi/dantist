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

    <h1>step two</h1>

    <?php if (!empty($person_id)): ?>
        <?php
        $img = [];
        $json = [];
//        foreach ($invoiceModel->attachments as $attachment) {
//            $root = '/files/' . $invoiceModel->id . '/';
//            $img[] = $root . $attachment->filename;
//
//            $type = pathinfo($attachment->filename, PATHINFO_EXTENSION);
//            $json[] = [
//                'type' => $type,
//                'caption' => $attachment->filename,
//                \yii\helpers\Url::to(['/attachment/delete-upload']),
//                'key' => 'filename ' . $attachment->id,
//            ];
//        }
        ?>

        <?= $form->field(new \app\models\Image(), 'filename')->widget(\kartik\file\FileInput::className(), [
            'options' => ['accept' => '', 'multiple' => true],
            'pluginOptions' => [
//                'showRemove' => false,
                'showDownload' => true,
//                'showUpload' => false,
                'initialPreviewAsData' => true,
//            'initialCaption' => "The Moon and the Earth",
                'showCancel' => false,
                'showPreview' => true,
//            'showCaption'          => false,
                'initialPreview' => $img,
                'initialPreviewConfig' => $json,
                'previewSettings' => [
//                'pdf' => ['width' => "auto", 'height' => "auto", 'max-width' => "100%", 'max-height' => "100%"],
                    'image' => ['width' => "auto", 'height' => "auto", 'max-width' => "100%", 'max-height' => "100%"],
                ],
                'previewFileType' => 'any',
                'uploadAsync' => true,
                'deleteUrl' => \yii\helpers\Url::to(['/image/delete-upload']),
                'uploadUrl' => \yii\helpers\Url::to(['/image/files-upload']),
                'uploadExtraData' => [
                    'person_id' => $person_id
                ],
            ]
        ]) ?>
    <?php elseif (!empty($person_id)) : ?>
        <?= $form->field(new \app\models\Image(), 'filename')->widget(\kartik\file\FileInput::classname(), [
            'options' => ['accept' => '', 'multiple' => true],
            'pluginOptions' => [
                'showCancel' => false,
                'previewFileType' => 'any',
                'uploadUrl' => \yii\helpers\Url::to(['/attachment/files-upload']),
                'uploadExtraData' => [
                    'invoice_id' => $person_id
                ],
            ],
        ]); ?>
    <?php endif; ?>

    <?php ActiveForm::end(); ?>

</div>
