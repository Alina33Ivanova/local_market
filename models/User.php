<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * @property int id
 * @property string username
 * @property string first_name
 * @property string last_name
 * @property string patronymic
 * @property string password
 * @property string phone_number
 * @property string email
 * @property string authKey
 * @property int|null $is_admin
 */

class User extends ActiveRecord implements IdentityInterface
{

    public static function tableName()
    {
        return 'user';
    }
    private static $user;

    public function rules()
    {
        return [
            [['username', 'password', 'first_name', 'last_name', 'patronymic', 'phone_number', 'email'], 'required'],
            [['is_admin'], 'integer'],
            [['is_seller'], 'integer'],
            [['username', 'password', 'first_name', 'last_name', 'patronymic', 'phone_number', 'email'], 'string', 'max' => 256],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return User::findOne($id);
    }

    public function getShop()
    {
        return $this->hasMany(Shop::class, ['user_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        foreach (self::$users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }

    public function HashPassword($password)
    {
        $this->password =Yii::$app->security->generatePasswordHash($password);
    }

    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'username' => Yii::t('app', 'Логин'),
            'first_name' => Yii::t('app', 'Имя'),
            'last_name' => Yii::t('app', 'Фамилия'),
            'patronymic' => Yii::t('app', 'Отчество'),
            'password' => Yii::t('app', 'Пароль'),
            'phone_number' => Yii::t('app', 'Номер телефона'),
            'email' => Yii::t('app', 'Электронная почта'),
            'created_at' => Yii::t('app', 'Дата создания'),
            'is_admin' => Yii::t('app', 'Статус администратора'),
            'is_seller' => Yii::t('app', 'Статус продавца'),

        ];
    }
}
