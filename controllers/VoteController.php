<?php

namespace app\controllers;

use yii;
use yii\web\Controller;
use app\models\Vote;
use app\models\Option;
use app\models\VoteSearch;
use app\models\Result;

class VoteController extends Controller {

    public function behaviors() {
        return \yii\helpers\BaseArrayHelper::merge(parent::behaviors(), [
                    'verbs' => [
                        'class' => VerbFilter::className(),
                        'actions' => [
                            'delete' => ['post'],
                        ],
                    ],
        ]);
    }

    public function actionIndex() {
        $searchModel = new VoteSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    public function actionVote() {
        $model = new Result();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    public function actionCountVote($id) {
        $option = Option::findOne($id);
        $results = $option->getResults();
        return count($results);
//        $model = new Option();
//        $results = $model->getResults();
//        foreach ($results as $result) {
//            $ct++;
//        }
//        return $ct;
    }

}