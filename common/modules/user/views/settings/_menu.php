<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

use yii\helpers\Html;
use dektrium\user\widgets\UserMenu;

/**
 * @var dektrium\user\models\User $user
 */

$user = Yii::$app->user->identity;
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">           
            <?= $user->profile->firstname . ' ' . $user->profile->lastname ?>
        </h3>
    </div>
    <div class="panel-body">
        <?= UserMenu::widget() ?>
        
        <hr/>
        <div>
            <p><b><?= Yii::t('chanpan', 'Role')?></b></p>
            <?php 
                $user_id = isset(Yii::$app->user->id) ? Yii::$app->user->id : '';
                $roles=\cpn\chanpan\classes\CNRoles::getAuthAssign($user_id);
                foreach($roles as $k=>$v){
                    echo "<div class='label label-success'>{$v}</div> ";
                }
             ?>
        </div>
    </div>
</div>
