<?php

namespace app\controllers;

use app\models\Card;
use app\models\Image;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use Yii;

/**
 * ImageController implements the CRUD actions for Image model.
 */
class ImageController extends Controller
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
     * Lists all Image models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Image::find(),
            /*
            'pagination' => [
                'pageSize' => 50
            ],
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ]
            ],
            */
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Image model.
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

    /**
     * Creates a new Image model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate($person_id = null) {

        $images = Image::find()->where(['person_id' => $person_id])->all();
        $cards = Card::find()->where(['person_id' => $person_id])->all();

        if (!empty($images))
            $model = new Image();

//        if ($this->request->isPost) {
//            if ($model->load($this->request->post()) && $model->save()) {
//                return $this->redirect(['view', 'id' => $model->id]);
//            }
//        } else {
//            $model->loadDefaultValues();
//        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Image model.
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
     * Deletes an existing Image model.
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
     * Finds the Image model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Image the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Image::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionFilesUpload()
    {
        $model = new Image();

        if (Yii::$app->request->isPost) {
            $postData = Yii::$app->request->post();
            $person_id = $postData['person_id'] ?? null;
            $files = UploadedFile::getInstances($model, 'filename');
            $response = true;

            if (!empty($files) && !empty($person_id)) {
                $root = Yii::getAlias('@app') . '/web/files/' . $person_id;
                if (!file_exists($root)) {
                    mkdir($root, 0777, true);
                }

                foreach ($files as $oneFile) {
                    $fileName = $oneFile->baseName . '.' . $oneFile->extension;
                    $oneFile->saveAs($root . '/' . $fileName);

                    $model->person_id = $person_id;
                    $model->filename = $fileName;
                    $model->save();
                }
            } else {
                $response = false;
            }

            return json_encode($response);
        }
    }

    public function actionDeleteUpload()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $keys = Yii::$app->request->post('key');
        $key = explode(' ', $keys);

        $model = Image::find()->where([
            'id' => $key[1],
        ])->one();

        if ($key[0] == 'filename') {
            @unlink(Yii::getAlias('@app') . '/web/files/' . $model->filename);
            $model->filename = NULL;
            $model->delete();
        }

        return [];
    }

}
