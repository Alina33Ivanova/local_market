<?php

namespace app\models;

use Yii;
use yii\base\Model;

class OrderForm extends Model
{
    public $first_name;
    public $last_name;
    public $phone_number;
    public $product_id;
    public $take;
    public $delivery_address;
    public $street;
    public $settlement;
    public $house;
    public $flat;
    public $pay;
    public $payment;
    public $card_number;
    public $cvv;

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
            [['product_id', 'take'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['first_name', 'last_name', 'phone_number', 'street', 'settlement', 'house', 'flat', 'card_number', 'cvv'], 'string', 'max' => 256],

            [['take'], 'boolean'],
            [['take'], 'default', 'value' => 0],

            [['delivery_address'], 'boolean'],
            [['delivery_address'], 'default', 'value' => 0],

            [['pay'], 'boolean'],
            [['pay'], 'default', 'value' => 0],

            [['payment'], 'boolean'],
            [['payment'], 'default', 'value' => 0],

            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::class, 'targetAttribute' => ['product_id' => 'id']],
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
            'take' => Yii::t('app', 'Заказ (доставка/самовывоз)'),
            'street' => Yii::t('app', 'Улица'),
            'settlement' => Yii::t('app', 'Поселение'),
            'house' => Yii::t('app', 'Дом'),
            'flat' => Yii::t('app', 'Квартира'),
            'pay' => Yii::t('app', 'Оплата (при получении/на сайте)'),
            'payment' => Yii::t('app', 'Оплата на сайте'),
            'card_number' => Yii::t('app', 'Номер карты'),
            'cvv' => Yii::t('app', 'CVV'),
            'created_at' => Yii::t('app', 'Дата создания'),
            'updated_at' => Yii::t('app', 'Дата обновления'),
        ];
    }

    public function save()
    {
        if ($this->validate()) {
            $order = new Order();
            $order->first_name = $this->first_name;
            $order->last_name = $this->last_name;
            $order->phone_number = $this->phone_number;
            $order->take = $this->take;
            $order->delivery_address = $this->delivery_address;
            $order->street = $this->street;
            $order->settlement = $this->settlement;
            $order->house = $this->house;
            $order->flat = $this->flat;
            $order->pay = $this->pay;
            $order->card_number = $this->card_number;
            $order->cvv = $this->cvv;
            $order->product_id = $this->product_id;
            return $order->save();
        } else {
            return dd($this->errors);
        }
    }
}
