<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;

/**
 * This is the model class for table "application".
 *
 * @property int $id
 * @property int $user_id
 * @property string|null $shop_name
 * @property string|null $location
 * @property string|null $description
 */

class ShopCreateForm extends ActiveRecord
{
//    public $shop_name;
//    public $description;
//    public $shop_image;
//    public $is_active;
//    public $user_id;
    public $imageFile;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'shop';
    }

    /**
     * {@inheritdoc}
     */

    public function rules()
    {
        return [
            [['description', 'shop_name'], 'required'],

            [['shop_name', 'location'], 'string', 'max' => 256],

            [['shop_image'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],

            [['is_active', 'user_id'], 'integer'],
            ['user_id', 'default', 'value'=> Yii::$app->user->getId()],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'shop_name' => Yii::t('app', 'Название магазина'),
            'description' => Yii::t('app', 'Описание магазина'),
            'shop_image' => Yii::t('app', 'Логотип магазина'),
            'location' => Yii::t('app', 'Местоположение магазина'),
            'created_at' => Yii::t('app', 'Дата создания'),
            'updated_at' => Yii::t('app', 'Дата обновления'),
            'is_active' => Yii::t('app', 'Статус'),
        ];
    }

    public function upload()
    {
        $uploadedFile = UploadedFile::getInstance($this, 'shop_image');

        if ($uploadedFile && $this->validate()) {
            $filePath = 'uploads/' . $uploadedFile->baseName . '.' . $uploadedFile->extension;
            $uploadedFile->saveAs($filePath);
            $this->shop_image = $filePath;
            return true;
        } else {
            return false;
        }
    }
}
