<?php

namespace app\models;

use Yii;
use yii\base\Model;

class AnswerForm extends Model
{
    public $text;
    public $sender_id;
    public $is_active;
    public $user_id;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'answer';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'sender_id'], 'integer'],
            [['text'], 'string'],
            [['created_at'], 'safe'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'ID пользователя'),
            'sender_id' => Yii::t('app', 'ID отправителя'),
            'text' => Yii::t('app', 'Ответ'),
            'created_at' => Yii::t('app', 'Дата создания'),
        ];
    }

    public function save()
    {
        if ($this->validate()) {
            $answer = new Answer();
            $answer->text = $this->text;
            $answer->sender_id = $this->sender_id;
            $answer->user_id = Yii::$app->user->id;
            return $answer->save();
        } else {
            return dd($this->errors);
        }
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}
