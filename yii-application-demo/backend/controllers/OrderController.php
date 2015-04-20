<?php

namespace backend\controllers;

use Yii;
use backend\models\BackendOrder;
use yii\data\ActiveDataProvider;
use yii\data\SqlDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use base\BaseCommon;

/**
 * OrderController implements the CRUD actions for BackendOrder model.
 */
class OrderController extends Controller
{
    public $layout = 'right';

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all BackendOrder models.
     * @return mixed
     */
    public function actionIndex()
    {
        if( !BaseCommon::checkAuth('backend_order_index') )
        {
            return 'no permission';
        }

        BaseCommon::checkIsGuest();
        // $sql = "SELECT * FROM `order`";
        // $dataProvider = new ActiveDataProvider([
        //     'query' => BackendOrder::find(),
        //     // 'query' => BackendOrder::findBySql($sql, $params = []),
        //     'pagination' => [
        //         'pageSize' => 2,
        //     ],
        // ]);

        // $count = Yii::$app->db->createCommand('
        //     SELECT COUNT(*) FROM `order` WHERE `status`=:status
        // ', [':status' => 9])->queryScalar();

        // $dataProvider = new SqlDataProvider([
        //     'sql' => 'SELECT * FROM `order` WHERE `status`=:status',
        //     'params' => [':status' => 9],
        //     'totalCount' => $count,
        //     'sort' => [
        //         'attributes' => [
        //             'id',
        //             'addtime' => [
        //                 'asc' => ['addtime' => SORT_ASC],
        //                 'default' => SORT_DESC,
        //                 'label' => '添加时间',
        //             ],
        //         ],
        //     ],
        //     'pagination' => [
        //         'pageSize' => 20,
        //     ],
        // ]);

        // get the user records in the current page
        // $models = $dataProvider->getModels();

        // return $this->render('index', [
        //     'dataProvider' => $dataProvider,
        // ]);


        $backendOrder = new BackendOrder();
        $dataProvider = $backendOrder->search(Yii::$app->request->get());

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'backendOrder' => $backendOrder,
        ]);
    }

    /**
     * Displays a single BackendOrder model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new BackendOrder model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new BackendOrder();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing BackendOrder model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing BackendOrder model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the BackendOrder model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return BackendOrder the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BackendOrder::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
