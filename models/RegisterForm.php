<?php

namespace app\models;

use app\components\repository\UserRepository;
use Yii;
use yii\base\Model;

class RegisterForm extends Model
{
    /**
     * @var string
     */
    public $surname;

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $email;

    /**
     * @var string
     */
    public $password;

    /**
     * @var string
     */
    public $confirmPassword;

    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct($config = [])
    {
        $this->userRepository = Yii::$container->get(UserRepository::class);

        parent::__construct($config);
    }

    public function rules()
    {
        return [
            [['surname', 'name', 'email', 'password', 'confirmPassword'], 'required'],
            ['email', 'email'],
            ['email', 'validateUniqueEmail'],
            ['confirmPassword', 'compare', 'compareAttribute' => 'password'],
        ];
    }

    public function validateUniqueEmail($attribute, $params)
    {
        if (!$this->hasErrors() && $this->userRepository->getUserByEmail($this->email)) {
            $this->addError($attribute, 'The given email already exists.');
        }
    }

    /**
     * @throws yii\base\Exception
     */
    public function createUser()
    {
        $user = new User();
        $user->surname = $this->surname;
        $user->name = $this->name;
        $user->email = $this->email;
        $user->password = Yii::$app->getSecurity()->generatePasswordHash($this->password);
        $user->verification_hash = Yii::$app->getSecurity()->generateRandomString();

        return $user->save() ? $user : null;
    }
}
