<?php

namespace app\models;

use Yii;
use yii\base\Model;

class ProfileForm extends Model
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
     * @var User
     */
    private $user;

    public function rules()
    {
        return [
            [['surname', 'name'], 'required'],
        ];
    }

    public function init()
    {
        $user = $this->getUser();
        $this->surname = $user->surname;
        $this->name = $user->name;
        $this->email = $user->email;
    }

    public function save()
    {
        $user = $this->getUser();
        $user->surname = $this->surname;
        $user->name = $this->name;

        return $user->save();
    }

    private function getUser()
    {
        if (!$this->user) {
            $this->user = User::findOne(Yii::$app->user->id);
        }

        return $this->user;
    }
}
