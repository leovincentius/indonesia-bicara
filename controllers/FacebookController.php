<?php

namespace app\controllers;

use yii\authclient\clients\Facebook;
use yii\authclient\OAuthToken;
use Yii;
use yii\web\Controller;
use app\models\Comment;
use app\models\Topic;
use app\models\User;

class FacebookController extends Controller {

    private $token, $facebook;

    public function __construct($id, $module, $config = []) {
        parent::__construct($id, $module, $config);
        // create your OAuthToken 
        $this->token = new OAuthToken([
            'token' => 'CAAWFfpGSOB0BAImLiGTZAQPj5iONQA2ZAzZBBgZCH2Pj7RJNp8pC7hw8fZAffrM501cslKDM1iDuuujSVWD5RldWXcu1mzpUFrwJLjLeBcdZCIe1sIZBGnkMoyM6KwYMV4lEOZCGjchFKeQsvKOaBNDRAUaRZAgmJQwcj7rTTztMZBFzfom6FWpfChkUdD5v86mQUoEVTnpQjFnDZBxoGYAm932'
        ]);
        // start a Facebook Client and configure your access token with your recently created token
        $this->facebook = new Facebook([
            'accessToken' => $this->token,
            'clientId' => Yii::$app->params['facebookApiId'],
            'clientSecret' => Yii::$app->params['facebookApiSecret']
        ]);
    }

    public function actionIndex() {
        $result = $this->facebook->api('v2.3/mahasiswaberbicara/statuses', 'GET', ['limit' => '1']);
        $status_id = $result['data'][0]['id'];
        $comments = $this->facebook->api("v2.3/$status_id/comments", 'GET', ['limit' => '10']);
        $filename = Yii::getAlias('@webroot') . '/fb.txt';
        $comment_id = file_get_contents($filename);
        if (isset($comments['data'][0]) && $comment_id < $comments['data'][0]['id']) {
            foreach ($comments['data'] as $value) {
                if ($value['id'] > $comment_id) {
                    $comment = new Comment();
                    $comment->user_id = User::findOne(['email' => $value['from']['id']])->id;
                    $comment->topic_id = Topic::find()->select()->orderBy('id DESC')->one()->id;
                    $comment->title = "Tes";
                    $comment->content = $value['message'];
                    $comment->create_date = date('Y-m-d H:i:s', strtotime($value['created_time']));
                    $comment->save();
                }
            }
            $comment_id = $comments['data'][0]['id'];
            file_put_contents($filename, $comment_id);
        }
    }

}
