<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "favorites".
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $shop_id
 *
 * @property Shop $shop
 * @property User $user
 */
class Favorites extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'favorites';
    }

    public function rules()
    {
        return [
            [['user_id', 'shop_id'], 'required'],
            [['user_id', 'shop_id'], 'integer'],
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

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    public static function addToFavorites($userId, $shopId)
    {
        $favorite = new self();
        $favorite->user_id = $userId;
        $favorite->shop_id = $shopId;
        return $favorite->save();
    }

    public static function removeFromFavorites($userId, $shopId)
    {
        $favorite = self::findOne(['user_id' => $userId, 'shop_id' => $shopId]);
        if ($favorite) {
            return $favorite->delete();
        }
        return false;
    }
}
