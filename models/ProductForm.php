<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;

/**
 * This is the model class for table "application".
 *
 * @property int $id
 * @property int $shop_id
 * @property string|null $title
 * @property string|null $description
 * @property string|null $price
 */

class ProductForm extends ActiveRecord
{
//    public $shop_id;
//    public $image;
//    public $title;
//    public $description;
//    public $price;
//    public $is_active;

    public $imageFile;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['shop_id', 'is_active'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['title', 'description', 'price'], 'string', 'max' => 256],

            [['image'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],

            [['shop_id'], 'exist', 'skipOnError' => true, 'targetClass' => Shop::class, 'targetAttribute' => ['shop_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'shop_id' => Yii::t('app', 'Магазин'),
            'image' => Yii::t('app', 'Изображение товара'),
            'title' => Yii::t('app', 'Заголовок'),
            'description' => Yii::t('app', 'Описание'),
            'price' => Yii::t('app', 'Цена'),
            'created_at' => Yii::t('app', 'Дата создания'),
            'updated_at' => Yii::t('app', 'Дата обновления'),
            'is_active' => Yii::t('app', 'Статус'),
        ];
    }

    public function upload()
    {
        $uploadedFile = UploadedFile::getInstance($this, 'image');

        if ($uploadedFile && $this->validate()) {
            $filePath = 'uploads/' . $uploadedFile->baseName . '.' . $uploadedFile->extension;
            $uploadedFile->saveAs($filePath);
            $this->image = $filePath;
            return true;
        } else {
            return false;
        }
    }

    /**
     * Gets query for [[Shop]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getShop()
    {
        return $this->hasOne(Shop::class, ['id' => 'shop_id']);
    }
}
