<?php

namespace app\controllers;

use yii\authclient\clients\Twitter;
use yii\authclient\OAuthToken;
use Yii;
use yii\web\Controller;
use app\models\Comment;
use app\models\Topic;
use app\models\User;

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
        $filename = Yii::getAlias('@webroot') . '/twitter.txt';
        $id = file_get_contents($filename);
        $result = $this->twitter->api('statuses/mentions_timeline.json', 'GET', ['since_id' => $id]);
        foreach ($result as $value) {
            $comment = new Comment();
            $comment->user_id = User::findOne(['email' => $value['user']['id']])->id;
            $comment->topic_id = Topic::find()->select()->orderBy('id DESC')->one()->id;
            $comment->title = "Tes";
            $comment->content = $value['text'];
            $comment->create_date = date('Y-m-d H:i:s', strtotime($value['created_at']));
            $comment->insert();
//            $photo = $value['user']['profile_image_url'];
        }
        if (!empty($result)) {
            file_put_contents($filename, $result[0]['id_str']);
        }
    }

}
