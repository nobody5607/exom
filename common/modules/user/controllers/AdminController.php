<?php
namespace common\modules\user\controllers;
use dektrium\user\controllers\AdminController as BaseAdminController;
use yii\helpers\Url;
use common\modules\user\models\UserSearch;
use common\modules\user\models\Profile;
use common\modules\user\models\User;

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
    public function actionUpdateProfile($id)
    {
        
            Url::remember('', 'actions-redirect');
            $user    = $this->findModel($id);
            $profile = $user->profile;

            if ($profile == null) {
                $profile = \Yii::createObject(Profile::className());
                $profile->link('user', $user);
            }
            $event = $this->getProfileEvent($profile);

//            $this->performAjaxValidation($profile);

            $this->trigger(self::EVENT_BEFORE_PROFILE_UPDATE, $event);
            
            if ($profile->load(\Yii::$app->request->post())) { 
                $this->trigger(self::EVENT_AFTER_PROFILE_UPDATE, $event);
                return \cpn\chanpan\classes\CNMessage::getSuccess('Update Members Success');
            }

            return $this->renderAjax('_profile', [
                'user'    => $user,
                'profile' => $profile,
            ]);
         
    }
}
