<?php

namespace app\controllers;

use app\models\Card;
use app\models\Image;
use app\models\Person;
use app\models\PersonSearch;
use Faker\Factory;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PersonController implements the CRUD actions for Person model.
 */
class PersonController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Person models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new PersonSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Person model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionStart() {
        for($i = 0; $i<10; $i++) {
            $faker  = Factory::create('uk_UA');
            $person = new Person();

            $person->number = $faker->randomNumber();
            $person->first_name = $faker->firstName;
            $person->middle_name = '';
            $person->last_name = $faker->lastName;
            $person->birth_day = $faker->date('Y-m-d',  '1960-01-01');
            $person->birth_country = 'Україна';
//            $person->birth_area = $faker->state;
            $person->birth_city = $faker->city;
//            $person->location_country = $faker->firstName;
//            $person->location_area = $faker->firstName;
//            $person->location_city = $faker->firstName;
//            $person->location_address = $faker->firstName;
//            $person->comment = $faker->firstName;
//            $person->phone = $faker->firstName;
//            $person->email = $faker->firstName;
            echo '<pre>';var_dump($person->attributes);die;
//            '' => 'Individual number',
//            '' => 'First Name',
//            '' => 'Middle Name',
//            '' => 'Last Name',
//            '' => 'Birth Day',
//            '' => 'Birth Country',
//            '' => 'Birth Area',
//            '' => 'Birth City',
//            '' => 'Location Country',
//            '' => 'Location Area',
//            '' => 'Location City',
//            '' => 'Location Address',
//            '' => 'Comment',
//            '' => 'Phone',
//            '' => 'Email',
//            'status' => 'Status',
//            $person->
        }
    }
    /**
     * Creates a new Person model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Person();

        if ($this->request->isPost) {

            if ($model->load($this->request->post()) && $model->save(false)) {
//            echo '<pre>';
//            print_r($model->attributes);
//            print_r($model->errors);
//            die;
                return $this->redirect(['step-two', 'person_id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionStepTwo($person_id = null) {

        $images = $cards = $model = [];
//        $images = Image::find()->where(['person_id' => $person_id])->all();
//        $cards = Card::find()->where(['person_id' => $person_id])->all();

//        if (empty($images))
        $model = new Image();
//        if (empty($cards))
//            $model = new Image();

//        if ($this->request->isPost) {
//            if ($model->load($this->request->post()) && $model->save()) {
//                return $this->redirect(['view', 'id' => $model->id]);
//            }
//        } else {
//            $model->loadDefaultValues();
//        }

        return $this->render('step-two', [
            'model' => $model,
            'images' => $images,
            'cards' => $cards,
            'person_id' => $person_id
        ]);
    }

    /**
     * Updates an existing Person model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Person model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Person model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Person the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Person::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
