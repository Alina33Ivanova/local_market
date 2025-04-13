<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "application".
 *
 * @property int $id
 * @property string|null $username
 * @property string|null $name_shop
 * @property string|null $description
 * @property string|null $resume
 */
class Application extends \yii\db\ActiveRecord
{
    public $imageFile;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'application';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description'], 'string'],
            [['username', 'description', 'name_shop', 'resume'], 'string', 'max' => 256],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'username' => Yii::t('app', 'Логин'),
            'name_shop' => Yii::t('app', 'Название магазина'),
            'description' => Yii::t('app', 'Описание'),
            'resume' => Yii::t('app', 'Резюме'),
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            $this->resume->saveAs('uploads/' . $this->resume->baseName . '.' . $this->resume->extension);
            return true;
        } else {
            return false;
        }
    }
}
