<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 14-4-6
 * Time: 下午5:18
 */

namespace app\modules\admin\form;
use yii\base\Model;
use app\modules\admin\models\User;
use Yii;

class LoginForm extends Model
{
    public $username;
    public $password;


    private $_user = false;

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'username' => '用户名',
            'password' => '密码'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
            // rememberMe must be a boolean value
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     */
    public function validatePassword()
    {
        $user = $this->getUser();

        if (!$user || !$user->validatePassword($this->password)) {
            $this->addError('password', '帐号或者密码错误。');
        }
    }

    /**
     * Logs in a user using the provided username and password.
     * @return boolean whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser());
        } else {
            return false;
        }
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    private function getUser()
    {
        if ($this->_user === false) {
            $this->_user = User::findByUsername($this->username);
        }
        return $this->_user;
    }
} 