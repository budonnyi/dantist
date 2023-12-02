<?php

use app\models\Person;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\PersonSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'People';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="person-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Person', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'number',
            'first_name',
            'middle_name',
            'last_name',
            //'birth_day',
            //'birth_country',
            //'birth_area',
            //'birth_city',
            //'location_country',
            //'location_area',
            //'location_city',
            //'location_address',
            //'comment:ntext',
            //'phone',
            //'email:email',
            //'status',
            //'created_at',
            //'updated_at',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Person $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
