<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * @property int $id
 * @property string $surname
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $verification_hash
 * @property string $verified_at
 * @property string $auth_key
 */
class User extends ActiveRecord implements IdentityInterface
{
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->auth_key = Yii::$app->security->generateRandomString();
            }

            return true;
        }

        return false;
    }

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    public function isVerified()
    {
        return (bool) $this->verified_at;
    }

    public function verify()
    {
        $this->verified_at = date('Y-m-d H:i:s');

        return $this->save();
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
    }
}
