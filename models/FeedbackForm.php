<?php

namespace app\models;

use Yii;
use yii\base\Model;

class FeedbackForm extends Model
{
    public $feedback_text;
    public $mark;
    public $is_active;
    public $user_id;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'feedback';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'mark', 'is_active'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['feedback_text'], 'string', 'max' => 256],
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
            'feedback_text' => Yii::t('app', 'Отзыв'),
            'mark' => Yii::t('app', 'Оценка'),
            'created_at' => Yii::t('app', 'Дата создания'),
            'updated_at' => Yii::t('app', 'Дата редактирования'),
            'is_active' => Yii::t('app', 'Статус'),
        ];
    }

    public function save()
    {
        if ($this->validate()) {
            $feedback = new Feedback();
            $feedback->feedback_text = $this->feedback_text;
            $feedback->mark = $this->mark;
            $feedback->user_id = Yii::$app->user->id;
            return $feedback->save();
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
