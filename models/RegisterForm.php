<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property-read User|null $user
 *
 */
class RegisterForm extends Model
{
    public $username;
    public $first_name;
    public $last_name;
    public $patronymic;
    public $password;
    public $phone_number;
    public $email;
    public $password_repeat;

    public $rememberMe = true;

    private $_user = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['username', 'password', 'first_name', 'last_name', 'patronymic', 'phone_number', 'email'], 'required'],
            ['username', 'unique', 'targetClass' => 'app\models\User', 'message' => 'Данный логин уже занят'],
            ['email', 'unique', 'targetClass' => 'app\models\User', 'message' => 'Данный адрес электронной почты уже зарегистрирован'],
            ['phone_number', 'unique', 'targetClass' => 'app\models\User', 'message' => 'Данный номер телефона уже зарегистрирован'],

            ['rememberMe', 'boolean'],
            ['email', 'email'],

            ['password', 'string', 'min' => 7],
            ['password_repeat', 'compare', 'compareAttribute' => 'password'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => 'Имя пользователя',
            'password' => 'Пароль',
            'first_name' => 'Имя',
            'last_name' => 'Фамилия',
            'patronymic' => 'Отчество',
            'phone_number' => 'Номер телефона',
            'email' => 'Электронная почта',
            'password_repeat' => 'Повтор пароля',
            'rememberMe' => 'Запомнить меня',
        ];
    }

    public function register()
    {
        if (!$this->validate()) {
            return null;
        }
        $user = new User();
        $user->username = $this->username;
        $user->first_name = $this->first_name;
        $user->last_name = $this->last_name;
        $user->patronymic = $this->patronymic;
        $user->phone_number = $this->phone_number;
        $user->email = $this->email;
        $user->HashPassword($this->password);

        return $user->save() ? $user : null;
    }
}
