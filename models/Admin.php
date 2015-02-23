<?php

namespace app\models;
use yii\web\IdentityInterface;

use Yii;

/**
 * This is the model class for table "admin".
 *
 * @property integer $id
 * @property string $email
 * @property string $password
 * @property string $name
 * @property string $last_login
 *
 * @property News[] $news
 * @property Topic[] $topics
 * @property Vote[] $votes
 */
class Admin extends \yii\db\ActiveRecord implements IdentityInterface
{
    public $password_repeat;
    public $auth_key;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'admin';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['email', 'name'], 'required'],
            [['password', 'password_repeat'], 'required', 'on' => 'insert'],
            ['password_repeat', 'compare', 'compareAttribute' => 'password'],
            [['last_login', 'password_repeat'], 'safe'],
            [['email', 'name'], 'string', 'max' => 50],
            [['password'], 'string', 'max' => 32],
            [['email'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'Email',
            'password' => 'Password',
            'name' => 'Name',
            'last_login' => 'Last Login',
        ];
    }

    public function beforeSave($insert){
        if(!empty($this->password)){
            $this->password = md5($this->password);
        }else{
            unset($this->password);
        }
        return parent::beforeSave($insert);
    }

    public function validatePassword($password){
        return md5($password) == $this->password;
    }

    public static function findByEmail($email){
        return self::findOne([
            'email' => $email,
        ]);
    }

    public static function findIdentity($id){
        return self::findOne(['id' => $id]);
    }

    public static function findIdentityByAccessToken($token, $type = null){
        return self::findOne(['access_token' => $token]);
    }

    public function getId(){
        return $this->id;
    }

    public function getAuthKey(){
        return $this->auth_key;
    }

    public function validateAuthKey($auth_key){
        return $this->auth_key === $auth_key;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNews()
    {
        return $this->hasMany(News::className(), ['admin_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTopics()
    {
        return $this->hasMany(Topic::className(), ['admin_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVotes()
    {
        return $this->hasMany(Vote::className(), ['admin_id' => 'id']);
    }
}
