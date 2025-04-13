<?php

namespace app\models;

use Yii;
use yii\base\Model;

class MessageForm extends Model
{
    public $text;
    public $recipient_id;
    public $is_active;
    public $user_id;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'message';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'recipient_id'], 'integer'],
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
            'id' => Yii::t('app', 'ID сообщения'),
            'user_id' => Yii::t('app', 'Отправитель'),
            'recipient_id' => Yii::t('app', 'Получатель'),
            'text' => Yii::t('app', 'Сообщение'),
            'created_at' => Yii::t('app', 'Дата создания'),
        ];
    }

    public function save()
    {
        if ($this->validate()) {
            $message = new Message();
            $message->text = $this->text;
            $message->recipient_id = $this->recipient_id;
            $message->user_id = Yii::$app->user->id; // Здесь мы устанавливаем ID текущего пользователя
            return $message->save();
        } else {
            return dd($this->errors); // Это может быть заменено на более подходящий способ обработки ошибок
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
