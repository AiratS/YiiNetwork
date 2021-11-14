<?php

namespace app\models;

use app\components\repository\UserRepository;
use Yii;
use yii\base\Model;

class LoginForm extends Model
{
    /**
     * @var string
     */
    public $email;

    /**
     * @var string
     */
    public $password;

    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var User
     */
    private $user;

    public function __construct($config = [])
    {
        $this->userRepository = Yii::$container->get(UserRepository::class);

        parent::__construct($config);
    }

    public function rules()
    {
        return [
            [['email', 'password'], 'required'],
            ['email', 'email'],
            ['password', 'validatePassword'],
            ['email', 'validateEmail'],
        ];
    }

    public function validateEmail($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !$user->isVerified()) {
                $this->addError($attribute, 'Email is not verified.');
            }
        }
    }

    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !$this->isValidPassword($user)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }

    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), Yii::$app->params['loggedInDuration']);
        }

        return false;
    }

    private function getUser()
    {
        if (!$this->user) {
            $this->user = $this->userRepository->getUserByEmail($this->email);
        }

        return $this->user;
    }

    private function isValidPassword($user)
    {
        return Yii::$app->getSecurity()->validatePassword($this->password, $user->password);
    }
}
