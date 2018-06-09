<?php
namespace common\modules\user\controllers;
use dektrium\user\controllers\AdminController as BaseAdminController;
use yii\helpers\Url;
use common\modules\user\models\UserSearch;

class AdminController extends BaseAdminController{
    public function actionIndex()
    {  
        Url::remember('', 'actions-redirect');
        $searchModel  = \Yii::createObject(UserSearch::className());
        $dataProvider = $searchModel->search(\Yii::$app->request->get());

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel'  => $searchModel,
        ]);
    }
}
