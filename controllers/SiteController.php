<?php

namespace app\controllers;

use app\models\Answer;
use app\models\AnswerForm;
use app\models\ApplicationForm;
use app\models\Favorites;
use app\models\Feedback;
use app\models\FeedbackForm;
use app\models\Message;
use app\models\MessageForm;
use app\models\OrderForm;
use app\models\Product;
use app\models\ProductForm;
use app\models\RegisterForm;
use app\models\Shop;
use app\models\ShopCreateForm;
use app\models\ShopSearch;
use app\models\User;
use Yii;
use yii\base\BaseObject;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use yii\web\UploadedFile;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $feedback = Feedback::find()->limit('4')->with('user')->where(['is_active' => true])->all();
        $user = User::find()->select(['first_name', 'id'])->indexBy('id')->column();
        $model = new FeedbackForm();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Отзыв отправлен на модерацию.');
            return $this->refresh();
        }

        $context = [
            'model' => $model,
            'user' => $user,
            'feedback' => $feedback,
            'isGuest' => Yii::$app->user->isGuest,
        ];
        return $this->render('index', $context);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionRegister()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new RegisterForm();
        if ($model->load(Yii::$app->request->post()) && $user = $model->register()) {
            if (Yii::$app->user->login($user))
                return $this->goBack();
        }

        return $this->render('register', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionCatalog($query = null)
    {
        $shopQuery = Shop::find()->with('user')->where(['is_active' => true]);

        if ($query) {
            $shopQuery->andWhere(['like', 'location', $query]);
        }

        $pagination = new Pagination([
            'defaultPageSize' => 8,
            'totalCount' => $shopQuery->count(),
        ]);

        $shop = $shopQuery->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        $model = new Shop();

        $context = [
            'shop' => $shop,
            'model' => $model,
            'query' => $query,
            'pagination' => $pagination,
        ];

        return $this->render('catalog', $context);
    }

    public function actionFavorites()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['site/login']);
        }

        $userId = Yii::$app->user->id;

        $favorites = Favorites::find()->where(['user_id' => $userId])->all();
        $shopIds = array_column($favorites, 'shop_id');

        $shops = Shop::find()->where(['id' => $shopIds])->all();

        return $this->render('favorites', [
            'shops' => $shops,
        ]);
    }

    public function actionAddToFavorites($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['site/login']);
        }

        $userId = Yii::$app->user->id;
        Favorites::addToFavorites($userId, $id);
        return $this->redirect(['site/favorites']);
    }

    public function actionRemoveFromFavorites($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['site/login']);
        }

        $userId = Yii::$app->user->id;
        Favorites::removeFromFavorites($userId, $id);
        return $this->redirect(['site/favorites']);
    }


    public function actionApplication()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['site/login']);
        }

        $model = new ApplicationForm();

        if ($model->load(Yii::$app->request->post())) {
            $model->resume = UploadedFile::getInstance($model, 'resume');
            if ($model->save()) {
                if ($model->upload()) {
                    Yii::$app->session->setFlash('success', 'Заявка отправлена!');
                    return $this->refresh();
                }
            }
        }

        if ($model->resume) {
            Yii::info('Файл загружен: ' . $model->resume->name);
        } else {
            Yii::info('Файл не загружен.');
        }

        return $this->render('application', ['model' => $model]);
    }


    public function actionOrder()
    {
        $model = new OrderForm();
        $product = Product::find()->select(['title', 'id'])->indexBy('id')->column();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Заказ создан!');
            return $this->refresh();
        }

        $context = [
            'model' => $model,
            'product' => $product,
        ];

        return $this->render('order', $context);
    }

    public function actionShopcreate()
    {
        $model = new ShopCreateForm();

        if ($model->load(Yii::$app->request->post())) {
            $model->shop_image = UploadedFile::getInstance($model, 'shop_image');
            if ($model->save()) {
                if ($model->upload()) {
                    Yii::$app->session->setFlash('success', 'Магазин создан! В скором времени он появится на сайте.');
                    return $this->refresh();
                }
            }
        }
        return $this->render('shopcreate', ['model' => $model]);
    }

    public function actionProductcreate()
    {
        $model = new ProductForm();

        $currentUserId = Yii::$app->user->id;

        $shop = Shop::find()
            ->select(['shop_name', 'id'])
            ->where(['user_id' => $currentUserId])
            ->indexBy('id')
            ->column();

        if ($model->load(Yii::$app->request->post())) {
            $model->image = UploadedFile::getInstance($model, 'image');
            if ($model->save()) {
                if ($model->upload()) {
                    Yii::$app->session->setFlash('success', 'Продукт создан! В скором времени он появится в магазине.');
                    return $this->refresh();
                }
            }
        }
        return $this->render('productcreate', ['model' => $model, 'shop' => $shop]);
    }


    public function actionView($id)
    {
        $shop = $this->findShop($id);

        $productQuery = Product::find()->where(['shop_id' => $shop->id]);

        $pagination = new Pagination([
            'defaultPageSize' => 8,
            'totalCount' => $productQuery->count(),
        ]);

        $product = $productQuery->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        $context = [
            'product' => $product,
            'shop' => $shop,
            'pagination' => $pagination,
        ];

        return $this->render('view', $context);
    }


    protected function findShop($id)
    {
        if (($model = Shop::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Магазин не найден.');
    }

    public function actionDeleteshop($id)
    {
        $model = Shop::findOne($id);

        if ($model) {
            $model->delete();
            Yii::$app->session->setFlash('success', 'Магазин успешно удален.');
        } else {
            Yii::$app->session->setFlash('error', 'Произошла ошибка.');
        }

        return $this->redirect(['/seller/default/index']);
    }

    public function actionUpdateshop($id)
    {
        $shop = Shop::findOne($id);

        if (!$shop) {
            throw new NotFoundHttpException('Магазин не найден.');
        }

        if ($shop->load(Yii::$app->request->post())) {
            $uploadedFile = UploadedFile::getInstance($shop, 'shop_image');

            if (!$uploadedFile) {
                $shop->shop_image = $shop->getOldAttribute('shop_image');
            }

            if ($uploadedFile) {
                $shop->shop_image = $uploadedFile->baseName . '.' . $uploadedFile->extension;
            }

            if ($shop->save()) {
                if ($uploadedFile) {
                    $uploadedFile->saveAs(Yii::getAlias('@webroot/uploads/') . $shop->shop_image);
                }
                Yii::$app->session->setFlash('success', 'Магазин успешно обновлен!');
                return $this->redirect(['/seller/default/index']);
            } else {
                Yii::$app->session->setFlash('error', 'Произошла ошибка при обновлении магазина.');
            }
        }

        return $this->render('updateshop', ['shop' => $shop]);
    }

    public function actionDeleteproduct($id)
    {
        $model = Product::findOne($id);

        if ($model) {
            $model->delete();
            Yii::$app->session->setFlash('success', 'Товар успешно удален.');
        } else {
            Yii::$app->session->setFlash('error', 'Произошла ошибка.');
        }

        return $this->redirect(['/seller/default/index']);
    }

    public function actionUpdateproduct($id)
    {
        $product = Product::findOne($id);

        if (!$product) {
            throw new NotFoundHttpException('Товар не найден.');
        }

        if ($product->load(Yii::$app->request->post())) {
            $uploadedFile = UploadedFile::getInstance($product, 'image');

            if (!$uploadedFile) {
                $product->image = $product->getOldAttribute('image');
            } else {
                $product->image = $uploadedFile->baseName . '.' . $uploadedFile->extension;
            }

            if ($product->save()) {
                if ($uploadedFile) {
                    $uploadedFile->saveAs(Yii::getAlias('@webroot/uploads/') . $product->image);
                }
                Yii::$app->session->setFlash('success', 'Товар успешно обновлен!');
                return $this->redirect(['/seller/default/index']);
            } else {
                Yii::$app->session->setFlash('error', 'Произошла ошибка при обновлении товара.');
            }
        }

        return $this->render('updateproduct', ['product' => $product]);
    }


    public function actionChat()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['site/login']);
        }

        $model = new MessageForm();

        $users = User::find()->where(['is_seller' => 1])->all();
        $userList = ArrayHelper::map($users, 'id', 'username');

        $currentUserId = Yii::$app->user->id;
        $messages = Message::find()->where(['user_id' => $currentUserId])->all();
        $answer = Answer::find()->where(['sender_id' => $currentUserId])->all();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Сообщение отправлено! Дождитесь ответа продавца.');
            return $this->refresh();
        }

        return $this->render('chat', [
            'model' => $model,
            'userList' => $userList,
            'messages' => $messages,
            'answer' => $answer,
        ]);
    }

}

