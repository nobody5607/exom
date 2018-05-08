<?php
namespace common\modules\user\controllers;
use dektrium\user\controllers\AdminController as BaseAdminController;
class AdminController extends BaseAdminController{
    public function actionTest()
    {
      echo 'ok';
    }
}
