<?php

namespace app\modules\seller\controllers;

use app\models\Answer;
use app\models\AnswerForm;
use app\models\Message;
use app\models\Product;
use app\models\Shop;
use app\models\ShopCreateForm;
use app\models\User;
use Yii;
use yii\base\BaseObject;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\UploadedFile;

/**
 * Default controller for the `seller` module
 */
class DefaultController extends Controller
{
    public $layout = 'main';

    public function behaviors(): array
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['index'],
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex() {
        $user = Yii::$app->user->identity;

        $shop = Shop::find()->where(['user_id' => $user->id])->all();

        $products = Product::find()->where(['shop_id' => array_column($shop, 'id')])->all();

        $messages = Message::find()->where(['recipient_id' => $user->id])->all();
        $answers = Answer::find()->where(['sender_id' => $user->id])->all();
        $model = new AnswerForm();
        $users = User::find()->all();
        $userList = ArrayHelper::map($users, 'id', 'username');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['/seller/default/index']);
        }

        return $this->render('index', [
            'shop' => $shop,
            'messages' => $messages,
            'answers' => $answers,
            'products' => $products,
            'model' => $model,
            'userList' => $userList,
        ]);
    }

    public function actionAnswer($sender_id)
    {
        return $this->render('site/answer', [
            'sender_id' => $sender_id,
        ]);
    }
}
