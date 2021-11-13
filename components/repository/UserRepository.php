<?php

namespace app\components\repository;

use app\models\User;
use Yii;

class UserRepository implements RepositoryInterface
{
    public function getUserByEmail($email)
    {
        return User::findOne([
            'email' => $email,
        ]);
    }

    public function getUserByVerificationHash($hash)
    {
        return User::findOne([
            'verification_hash' => $hash
        ]);
    }

    /**
     * @throws \Throwable
     * @throws yii\db\StaleObjectException
     */
    public function deleteUser($id)
    {
        return User::findOne($id)->delete();
    }
}
