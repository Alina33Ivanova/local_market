<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property int $id
 * @property string|null $first_name
 * @property string|null $last_name
 * @property string|null $phone_number
 * @property int|null $product_id
 * @property int|null $take
 * @property string|null $street
 * @property string|null $settlement
 * @property string|null $house
 * @property string|null $flat
 * @property int|null $pay
 * @property string|null $card_number
 * @property string|null $cvv
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id', 'take', 'pay'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['first_name', 'last_name', 'phone_number', 'street', 'settlement', 'house', 'flat', 'card_number', 'cvv'], 'string', 'max' => 256],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'first_name' => Yii::t('app', 'Имя'),
            'last_name' => Yii::t('app', 'Фамилия'),
            'phone_number' => Yii::t('app', 'Номер телефона'),
            'product_id' => Yii::t('app', 'Товар'),
            'take' => Yii::t('app', 'Take'),
            'street' => Yii::t('app', 'Улица'),
            'settlement' => Yii::t('app', 'Поселение'),
            'house' => Yii::t('app', 'Дом'),
            'flat' => Yii::t('app', 'Квартира'),
            'pay' => Yii::t('app', 'Оплата'),
            'card_number' => Yii::t('app', 'Номер карты'),
            'cvv' => Yii::t('app', 'CVV'),
            'created_at' => Yii::t('app', 'Дата создания'),
            'updated_at' => Yii::t('app', 'Дата редактирования'),
        ];
    }
}
