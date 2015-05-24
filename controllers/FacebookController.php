<?php

namespace app\controllers;

use yii\authclient\clients\Facebook;
use yii\authclient\OAuthToken;
use Yii;
use yii\web\Controller;
use app\models\Comment;
use app\models\User;

class FacebookController extends Controller {

    private $token, $facebook;

    public function __construct($id, $module, $config = []) {
        parent::__construct($id, $module, $config);
        // create your OAuthToken 
        $this->token = new OAuthToken([
            'token' => '1554153538205725|5c10ecc71b18b672904e0fbe3f7c5b10'
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
        $status_id = $result['data']['id'];
        $comments = $this->facebook->api("v2.3/$status_id/comments", 'GET', ['limit' => '10']);
        $comment_id = file_get_contents('@web/fb.txt');
        if ($comment_id < $comments['data'][0]['id']) {
            foreach ($comments['data'] as $value) {
                if ($value['id'] > $comment_id) {
                    $comment = new Comment();
                    $comment->user_id = User::findOne(['name' => $value['from']['name']]);
                    $comment->content = $value['message'];
                    $comment->create_date = $value['created_time'];
                    $comment->save();
                }
            }
            $comment_id = $comments['data'][0]['id'];
            $file = fopen('@web/fb.txt', 'w');
            fwrite($file, $comment_id);
            fclose($file);
        }
    }

}
