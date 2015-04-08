<?php

namespace app\controllers;

use yii\authclient\clients\Twitter;
use yii\authclient\OAuthToken;
use Yii;
use yii\web\Controller;
use app\models\Comment;
use app\models\User;

// create your OAuthToken 
//$token = new OAuthToken([
//    'token' => Yii::$app->params['twitterAccessToken'],
//    'tokenSecret' => Yii::$app->params['twitterAccessTokenSecret']
//        ]);
// start a Twitter Client and configure your access token with your
// recently created token
//$twitter = new Twitter([
//    'accessToken' => $token,
//    'consumerKey' => Yii::$app->params['twitterApiKey'],
//    'consumerSecret' => Yii::$app->params['twitterApiSecret']
//        ]);
//$result = $twitter->api('statuses/mentions_timeline.json', 'GET', ['since_id' => '577503619827777537']);
//foreach ($result as $value) {
//    $name = $value['user']['name'];
//    $photo = $value['user']['profile_image_url'];
//    $content = $value['text'];
//    $create_date = $value['created_at'];
//    echo $name . ' ' . $photo . ' ' . $content . ' ' . $create_date . '<br>';
//    $id = $value['id_str'];
//}

class TwitterController extends Controller {

    private $token, $twitter;

    public function __construct($id, $module, $config = []) {
        parent::__construct($id, $module, $config);
        // create your OAuthToken 
        $this->token = new OAuthToken([
            'token' => Yii::$app->params['twitterAccessToken'],
            'tokenSecret' => Yii::$app->params['twitterAccessTokenSecret']
        ]);
        // start a Twitter Client and configure your access token with your recently created token
        $this->twitter = new Twitter([
            'accessToken' => $this->token,
            'consumerKey' => Yii::$app->params['twitterApiKey'],
            'consumerSecret' => Yii::$app->params['twitterApiSecret']
        ]);
    }

    public function actionIndex() {
        $result = $this->twitter->api('statuses/mentions_timeline.json', 'GET', ['since_id' => '577503619827777537']);
        foreach ($result as $value) {
            $comment = new Comment();
            $comment->user_id = User::findOne(['name' => $value['user']['name']]);
            $comment->content = $value['text'];
            $comment->create_date = $value['created_at'];
//            $photo = $value['user']['profile_image_url'];
//            $id = $value['id_str'];
        }
    }

}
