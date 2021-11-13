<?php

namespace app\controllers;

use app\components\repository\UserRepository;
use app\models\ProfileForm;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;

class ProfileController extends Controller
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct($id, $module, UserRepository $userRepository, $config = [])
    {
        $this->userRepository = $userRepository;

        parent::__construct($id, $module, $config);
    }

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return Yii::$app->user->identity->isVerified();
                        },
                    ]
                ],
                'denyCallback' => function ($rule, $action) {
                    return $this->redirect(['auth/login']);
                }
            ],
        ];
    }

    public function actionIndex()
    {
        $model = new ProfileForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->save();
        }

        return $this->render('index', [
            'model' => $model,
        ]);
    }

    /**
     * @throws \Throwable
     * @throws yii\db\StaleObjectException
     */
    public function actionDeleteProfile()
    {
        Yii::$app->user->logout();
        $this->userRepository->deleteUser(Yii::$app->user->id);

        return $this->redirect(['auth/register']);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->redirect(['auth/login']);
    }
}
