<?php
namespace common\modules\user\models;
use dektrium\user\models\RegistrationForm as BaseRegistrationForm;
use Yii;
use common\modules\user\models\User;
use common\modules\user\models\Profile;
class RegistrationForm extends BaseRegistrationForm{
    public $reCaptcha;
    public $firstname;
    public $lastname;
    public $telephone;
    public $confirm_password;
    public $tel;
    public function rules()
    {
         $user = $this->module->modelMap['User'];
         $rules[] = ['username', 'required'];
         $rules[] = ['username', 'trim'];
         $rules[] = ['username', 'string', 'min' => 3, 'max' => 255];
         
         $rules[] = ['email', 'required'];
         $rules[] = ['email', 'trim'];
         $rules[] = ['email', 'email'];
         
         $rules[] = ['password', 'required', 'skipOnEmpty' => $this->module->enableGeneratingPassword];
         $rules[] = ['password', 'string', 'min' => 6, 'max' => 72];
 
         $rules[] = ['confirm_password', 'required'];
         $rules[] = ['confirm_password', 'compare', 'compareAttribute'=>'password', 'message'=> Yii::t('app','รหัสผ่านไม่ตรงกัน')];
         
         $rules[] = ['firstname', 'required'];
         $rules[] = ['lastname', 'required'];
         $rules[] = ['telephone', 'required'];         
        // $rules[]=[['reCaptcha'], \himiklab\yii2\recaptcha\ReCaptchaValidator::className(), 'secret' => '6LeaIl4UAAAAAB2xHY6p9L9lHf00NqsuapdQBhfT', 'uncheckedMessage' => 'Please confirm that you are not a bot.'];
         //$rules[]=['reCaptcha', 'safe'];
         return $rules;
    }
    public function attributeLabels()
    {
        $labels = parent::attributeLabels(); 
        $labels['firstname'] = Yii::t('chanpan', 'ชื่อ');
        $labels['lastname'] = Yii::t('chanpan', 'นามสกุล'); 
	
        $labels['confirm_password']=Yii::t('chanpan', 'ยืนยันรหัสผ่าน');
        $labels['tel']=Yii::t('chanpan', 'เบอรโทรศัพท์');
       
        
        return $labels;
    }
    
}
