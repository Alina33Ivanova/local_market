<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "application".
 *
 * @property int $id
 * @property string|null $username
 * @property string|null $name_shop
 * @property string|null $description
 */

class ApplicationForm extends ActiveRecord
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
            [['username', 'name_shop', 'description'], 'required'],
            [['username', 'description', 'name_shop'], 'string', 'max' => 256],

            [['resume'], 'file', 'skipOnEmpty' => false, 'extensions' => 'pdf, docx'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => 'Логин',
            'name_shop' => 'Название магазина',
            'description' => 'Описание магазина',
            'resume' => 'Файл',
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
