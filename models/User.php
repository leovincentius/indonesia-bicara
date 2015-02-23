<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $email
 * @property string $password
 * @property string $name
 * @property string $photo
 * @property integer $status
 * @property string $last_login
 *
 * @property Comment[] $comments
 * @property Result[] $results
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['email', 'name', 'status'], 'required'],
            [['password', 'password_repeat'], 'required', 'on' => 'insert'],
            [['status'], 'integer'],
            [['last_login'], 'safe'],
            [['email', 'name'], 'string', 'max' => 50],
            [['password'], 'string', 'max' => 32],
            //[['photo'], 'string', 'max' => 255],
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
            'photo' => 'Photo',
            'status' => 'Status',
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResults()
    {
        return $this->hasMany(Result::className(), ['user_id' => 'id']);
    }
}
