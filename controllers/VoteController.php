<?php

namespace app\controllers;

use yii;
use yii\web\Controller;
use app\models\Vote;
use app\models\Option;
use app\models\VoteSearch;
use app\models\Result;

class VoteController extends SiteController {

    public function actionIndex() {
        $vote = Vote::find()->orderBy('id DESC')->one();
        $result = new Result();

        return $this->render("index", [
            'vote' => $vote,
            'result' => $result,
        ]);
    }

    public function actionAdd() {
        $result = new Result();
        $result->load(Yii::$app->request->post());
        $result->create_date = date('Y-m-d');

        if($result->save()){
            Yii::$app->session->setFlash('success', 'Save vote success!');
        }else{
            Yii::$app->session->setFlash('error', 'Save vote fail!');
        }
        $this->redirect(['vote/index']);
    }

}
