<?php

namespace app\controllers;

use app\models\Access;
use app\models\forms\EventForm;
use app\objects\ViewModels\EventCreateView;
use Yii;
use app\models\Event;
use app\models\search\EventSearch;
use yii\db\Expression;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\objects\ViewModels\EventView;

/**
 * EventController implements the CRUD actions for Event model.
 */
class EventController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::class,

                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionJson($id) {
        $model = $this->findModel($id);
        return $this->asJson($model->getAttributes());
    }

    public function actionCalendar() {

        $events = Event::find()
            ->andWhere('MONTH(start_at) = MONTH(NOW()) AND YEAR(start_at) = YEAR(NOW())')
            ->all();

        $currentDate = new \DateTime();
        $currentDay = $currentDate->format('j');
        $date = new \DateTime('first day of');

        $calendar = array();
        do {
            $calendar[$date->format('W')][$date->format('N')] = [
                'num' => $date->format('j'),
                'events' => [],
                'current' => $currentDay === $date->format('j'),
            ];
            $date->modify('+1 day');
        } while ($date->format('j') !== '1');

        foreach($events as $event) {
            $date = new \DateTime($event->start_at);
            $calendar[$date->format('W')][$date->format('N')]['events'][] = $event;
        }


        return $this->render('calendar', [
            'calendar' => $calendar
        ]);
    }


    /**
     * Lists all Event models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EventSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $viewModel = new EventView();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'viewModel' => $viewModel,
        ]);
    }

    /**
     * Displays a single Event model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $event = $this->findModel($id);
        if (!$this->checkAccess($event)) {
            throw new ForbiddenHttpException('У Вас нет доступа к данному событию');
        }
        return $this->render('view', [
            'model' => $event,
            'viewModel' => new EventView(),
        ]);
    }

    /**
     * Creates a new Event model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new EventForm();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'viewModel' => new EventCreateView(),
        ]);
    }

    /**
     * Updates an existing Event model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);



        if (!$this->checkWriteAccess($model) || $model->isPast()) {
            throw new ForbiddenHttpException('');
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'viewModel' => new EventCreateView(),

        ]);
    }

    /**
     * Deletes an existing Event model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $event = $this->findModel($id);
        if (!$this->checkWriteAccess($event)) {
            throw new ForbiddenHttpException();
        }
        $event->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the Event model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Event the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = EventForm::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function checkAccess(Event $event): bool
    {
        $currentUid = \Yii::$app->getUser()->getId();
        if ($event->author_id == $currentUid) {
            return true;
        } elseif (Access::find()->andWhere(['event_id' => $event->id, 'user_id' => $currentUid])->count()) {
            return true;
        }
        return false;
    }
    /**
     * @return bool
     */
    protected function checkWriteAccess(Event $event): bool
    {
        return $event->author_id == \Yii::$app->getUser()->getId();
    }
}
