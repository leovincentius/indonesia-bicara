<?php

namespace app\controllers;

use Yii;
use app\models\Topic;
use app\models\TopicSearch;
use app\controllers\SiteController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TopicController implements the CRUD actions for Topic model.
 */
class TopicController extends SiteController
{
    /**
     * Lists all Topic models.
     * @return mixed
     */
    public function actionIndex()
    {
        $model = Topic::find()->orderBy('id DESC')->limit(1)->one();
        return $this->render('index', [
            'model' => $model,
        ]);
    }
}
