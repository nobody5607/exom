<?php
namespace common\modules\user\controllers;
use dektrium\user\controllers\SettingsController as BaseSettingsController;
use common\modules\user\models\Profile;
use common\modules\user\models\User;
    
class SettingsController extends BaseSettingsController{
    //put your code here
    public function actionProfile() {
      
        $model = $this->finder->findProfileById(\Yii::$app->user->identity->getId());

        if ($model == null) {
            $model = \Yii::createObject(Profile::className());
            $model->link('user', \Yii::$app->user->identity);
        }

        $event = $this->getProfileEvent($model);

        $this->performAjaxValidation($model);

        $this->trigger(self::EVENT_BEFORE_PROFILE_UPDATE, $event);
        if ($model->load(\Yii::$app->request->post()) && $model->save()) {
            \Yii::$app->getSession()->setFlash('success', \Yii::t('user', 'Your profile has been updated'));
            $this->trigger(self::EVENT_AFTER_PROFILE_UPDATE, $event);
            return $this->refresh();
        }

        return $this->render('profile', [
                    'model' => $model,
        ]);
    }
}
