<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property int|null $shop_id
 * @property string|null $image
 * @property string|null $title
 * @property string|null $description
 * @property string|null $price
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property int|null $is_active
 *
 * @property Shop $shop
 */
class Product extends \yii\db\ActiveRecord
{
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
            [['shop_id'], 'exist', 'skipOnError' => true, 'targetClass' => Shop::class, 'targetAttribute' => ['shop_id' => 'id']],
            [['image'], 'file', 'extensions' => 'png, jpg, jpeg', 'skipOnEmpty' => true],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'shop_id' => Yii::t('app', 'ID магазина'),
            'image' => Yii::t('app', 'Изображение продукта'),
            'title' => Yii::t('app', 'Заголовок'),
            'description' => Yii::t('app', 'Описание'),
            'price' => Yii::t('app', 'Цена'),
            'created_at' => Yii::t('app', 'Дата создания'),
            'updated_at' => Yii::t('app', 'Дата редактирования'),
            'is_active' => Yii::t('app', 'Статус видимости'),
        ];
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
}
