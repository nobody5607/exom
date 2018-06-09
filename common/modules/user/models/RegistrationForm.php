<?php
namespace common\modules\user\models;
use dektrium\user\models\RegistrationForm as BaseRegistrationForm;
use Yii;
class RegistrationForm extends BaseRegistrationForm{
    public $captcha;
    public $firstname;
    public $lastname;
    public $telephone;
    public $confirm_password;
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
         $rules[] = ['confirm_password', 'compare', 'compareAttribute'=>'password', 'message'=> Yii::t('chanpan','Passwords don\'t match')];
         
         $rules[] = ['captcha', 'required'];
         $rules[] = ['firstname', 'required'];
         $rules[] = ['lastname', 'required'];
         $rules[] = ['telephone', 'required'];         
         $rules[]=[['captcha'], \himiklab\yii2\recaptcha\ReCaptchaValidator::className(), 'secret' => '6LeaIl4UAAAAAB2xHY6p9L9lHf00NqsuapdQBhfT', 'uncheckedMessage' => 'Please confirm that you are not a bot.'];
         return $rules;
    }
    public function attributeLabels()
    {
        $labels = parent::attributeLabels(); 
        $labels['firstname'] = Yii::t('chanpan', 'First name');
        $labels['lastname'] = Yii::t('chanpan', 'Last name'); 
	$labels['telephone'] = Yii::t('chanpan', 'Telephone number'); 
        $labels['confirm_password']=Yii::t('chanpan', 'Confirm password');
       
        
        return $labels;
    }
}
