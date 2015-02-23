<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "news".
 *
 * @property integer $id
 * @property integer $admin_id
 * @property string $title
 * @property string $content
 * @property string $create_date
 * @property string $update_date
 *
 * @property Admin $admin
 */
class News extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'news';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['admin_id'], 'integer'],
            [['title', 'content'], 'required'],
            [['content'], 'string'],
            [['create_date', 'update_date'], 'safe'],
            [['title'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'admin_id' => 'Admin ID',
            'title' => 'Title',
            'content' => 'Content',
            'create_date' => 'Create Date',
            'update_date' => 'Update Date',
        ];
    }

    public function beforeSave(){
        //set admin yang membuat
        $this->admin_id = Yii::$app->admin->id;
        //set create_date kalau buat pertama, atau set update_date kalau sudah dibuat sebelumnya
        if($this->isNewRecord){
            $this->create_date = date('Y-m-d H:i:s');
        }else{
            $this->update_date = date('Y-m-d H:i:s');
        }

        return parent::beforeSave();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdmin()
    {
        return $this->hasOne(Admin::className(), ['id' => 'admin_id']);
    }
}
