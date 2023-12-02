<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Person $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'People', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="person-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'number',
            'first_name',
            'middle_name',
            'last_name',
            'birth_day',
            'birth_country',
            'birth_area',
            'birth_city',
            'location_country',
            'location_area',
            'location_city',
            'location_address',
            'comment:ntext',
            'phone',
            'email:email',
            'status',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
