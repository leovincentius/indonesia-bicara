<?php

namespace app\models;

use Yii;
use yii\db\Query;

/**
 * This is the model class for table "vote".
 *
 * @property integer $id
 * @property integer $admin_id
 * @property string $title
 * @property string $create_date
 * @property string $update_date
 *
 * @property Option[] $options
 * @property Admin $admin
 */
class Vote extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vote';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['admin_id'], 'integer'],
            [['title'], 'required'],
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

    public function getTotalVote(){
        $query = new Query;
        $query->select("count(result.id) AS total")
            ->from("result")
            ->join("INNER JOIN", "option", "option.id = result.option_id")
            ->where(["option.vote_id" => $this->id]);
        $command = $query->createCommand();
        return $command->queryAll();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOptions()
    {
        return $this->hasMany(Option::className(), ['vote_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdmin()
    {
        return $this->hasOne(Admin::className(), ['id' => 'admin_id']);
    }
}
