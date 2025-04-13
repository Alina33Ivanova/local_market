<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "shop".
 *
 * @property int $id
 * @property int|null $user_id
 * @property string|null $shop_name
 * @property string|null $description
 * @property string|null $shop_image
 * @property string|null $location
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property int|null $is_active
 *
 * @property Product[] $products
 * @property User $user
 */
class Shop extends \yii\db\ActiveRecord
{
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
            [['user_id', 'is_active'], 'integer'],
            [['description', 'location'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['shop_name'], 'string', 'max' => 256],
            [['is_active', 'user_id'], 'integer'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
            [['shop_image'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
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
            'shop_name' => Yii::t('app', 'Название магазина'),
            'description' => Yii::t('app', 'Описание магазина'),
            'shop_image' => Yii::t('app', 'Логотип магазина'),
            'location' => Yii::t('app', 'Местоположение'),
            'created_at' => Yii::t('app', 'Дата создания'),
            'updated_at' => Yii::t('app', 'Дата редактрования'),
            'is_active' => Yii::t('app', 'Статус видимости'),
        ];
    }

    /**
     * Gets query for [[Products]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::class, ['shop_id' => 'id']);
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
