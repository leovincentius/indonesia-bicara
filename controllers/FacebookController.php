<?php

namespace app\controllers;

use yii\authclient\clients\Facebook;
use yii\authclient\OAuthToken;
use yii\web\Controller;
use app\models\Comment;
use app\models\User;

// create your OAuthToken 
//$token = new OAuthToken([
//    'token' => 'CAACEdEose0cBANSW6HUAlE0loBWlEcH85gs0mcq72Lmxr05UqTVK0ZCjVNVVlP5fdkr8y8FN86n9p7M4Cj7JhYmFJRz2iw4B3atuw5ovaPBS0opVxzxJGl3plCxdlhBVay6fQZBKMj83BHxzuZAqz1n6jZCBfkFd2q95o4S4acanCLiygrzvGrFfPfW9amP1qoLyDewfU2fKFX72s3It'
//        ]);
// start a Facebook Client and configure your access token with your
// recently created token
//$facebook = new Facebook([
//    'accessToken' => $token,
//    'clientId' => '1554153538205725',
//    'clientSecret' => '5c10ecc71b18b672904e0fbe3f7c5b10'
//        ]);
//$result = $facebook->api('v2.3/mahasiswaberbicara/posts', 'GET', ['limit' => '1']);
//$id = '';
//foreach ($result['data'] as $value) {
//    $name = $value['from']['name'];
//    //$photo = $value['user']['profile_image_url'];
//    $content = $value['message'];
//    $create_date = $value['created_time'];
//    echo $name . ' ' . /* $photo . ' ' . */ $content . ' ' . $create_date . '<br>';
//    $id = $value['from']['id'];
//}
//$comments = $facebook->api("v2.3/$id/comments", 'GET');
//var_dump($comments);

class FacebookController extends Controller {

    private $token, $facebook;

    public function __construct($id, $module, $config = []) {
        parent::__construct($id, $module, $config);
        // create your OAuthToken 
        $this->token = new OAuthToken([
            'token' => 'CAACEdEose0cBANSW6HUAlE0loBWlEcH85gs0mcq72Lmxr05UqTVK0ZCjVNVVlP5fdkr8y8FN86n9p7M4Cj7JhYmFJRz2iw4B3atuw5ovaPBS0opVxzxJGl3plCxdlhBVay6fQZBKMj83BHxzuZAqz1n6jZCBfkFd2q95o4S4acanCLiygrzvGrFfPfW9amP1qoLyDewfU2fKFX72s3It'
        ]);
        // start a Facebook Client and configure your access token with your recently created token
        $this->facebook = new Facebook([
            'accessToken' => $this->token,
            'clientId' => '1554153538205725',
            'clientSecret' => '5c10ecc71b18b672904e0fbe3f7c5b10'
        ]);
    }

    public function actionIndex() {
        $result = $this->facebook->api('v2.3/mahasiswaberbicara/posts', 'GET', ['limit' => '1']);
        $id = '';
        foreach ($result['data'] as $value) {
            $name = $value['from']['name'];
            //$photo = $value['user']['profile_image_url'];
            $content = $value['message'];
            $create_date = $value['created_time'];
            echo $name . ' ' . /* $photo . ' ' . */ $content . ' ' . $create_date . '<br>';
            $id = $value['from']['id'];
        }
        $comments = $this->facebook->api("v2.3/$id/comments", 'GET');
        var_dump($comments);
    }

}
