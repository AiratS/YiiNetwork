<?php

namespace app\controllers;

use app\components\repository\UserRepository;
use app\models\LoginForm;
use app\models\RegisterForm;
use app\models\User;
use Yii;
use yii\helpers\Url;
use yii\web\Controller;

class AuthController extends Controller
{
    private $userRepository;

    public function __construct($id, $module, UserRepository $userRepository, $config = [])
    {
        $this->userRepository = $userRepository;

        parent::__construct($id, $module, $config);
    }

    /**
     * @throws Yii\base\Exception
     */
    public function actionRegister()
    {
        $model = new RegisterForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $user = $model->createUser();
            if ($user) {
                return $this->render('verify-link', [
                    'link' => $this->getVerificationLink($user),
                ]);
            }
        }

        return $this->render('register', [
            'model' => $model,
        ]);
    }

    public function actionLogin()
    {
        $model = new LoginForm();

        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect(['profile/index']);
        }

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionVerify($hash = null)
    {
        if (!$hash) {
            return $this->redirect(['site/error']);
        }

        $user = $this->userRepository->getUserByVerificationHash($hash);
        if (!$user) {
            return $this->redirect(['site/error']);
        }

        if (!$user->verify()) {
            return $this->redirect(['site/error']);
        }

        Yii::$app->user->login($user, Yii::$app->params['loggedInDuration']);

        return $this->redirect(['profile/index']);
    }

    private function getVerificationLink(User $user)
    {
        return Url::toRoute([
            'auth/verify',
            'hash' => $user->verification_hash,
        ]);
    }
}
