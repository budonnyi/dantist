<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Tooth $model */

$this->title = 'Create Tooth';
$this->params['breadcrumbs'][] = ['label' => 'Teeth', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tooth-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
