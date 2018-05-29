<?php
namespace common\modules\user\models;
use dektrium\user\models\Profile as BaseProfile;
use trntv\filekit\behaviors\UploadBehavior;
use Yii;
class Profile extends BaseProfile{
    public $image;
    public function behaviors()
    {
        return [
            'picture' => [
                'class' => UploadBehavior::className(),
                'attribute' => 'image',
                'pathAttribute' => 'avatar_path',
                'baseUrlAttribute' => 'avatar_base_url'
            ],
 
        ];
    }
    public function rules()
    {
        $rules = [
            'bioString' => ['bio', 'string'],
            'publicEmailPattern' => ['public_email', 'email'],
            'gravatarEmailPattern' => ['gravatar_email', 'email'],
            'websiteUrl' => ['website', 'url'],
            'nameLength' => ['name', 'string', 'max' => 255],
            'publicEmailLength' => ['public_email', 'string', 'max' => 255],
            'gravatarEmailLength' => ['gravatar_email', 'string', 'max' => 255],
            'locationLength' => ['location', 'string', 'max' => 255],
            'websiteLength' => ['website', 'string', 'max' => 255],
            
            
        ];
        $addon = [
            [['firstname'],'required','message'=> \Yii::t('chanpan','Firstname cannot be blank.')],
            [['lastname'],'required','message'=> \Yii::t('chanpan','Lastname cannot be blank.')],
            [['avatar_path', 'avatar_base_url'], 'string'],
            [['image','tel'], 'safe']
        ];
        
        return \yii\helpers\ArrayHelper::merge($rules, $addon);
    }
    public function attributeLabels()
    {
	$labels = [             
            'tel'            => Yii::t('chanpan', 'Telephone number'),
            //'sitecode'       => Yii::t('chanpan','Sitecode'),
            'name'           => Yii::t('chanpan', 'Nickname'),
            'firstname'      => Yii::t('chanpan', 'First name'),
            'lastname'       => Yii::t('chanpan', 'Last name'),
            'public_email'   => Yii::t('chanpan', 'Email (public)'),
            'gravatar_email' => Yii::t('chanpan', 'Gravatar email'),
            'location'       => Yii::t('chanpan', 'Location'),
            'website'        => Yii::t('chanpan', 'Website'),
            'bio'            => Yii::t('chanpan', 'Birth date'),
            'image'          => Yii::t('chanpan', 'My Picture'),
            'public_email'   => Yii::t('chanpan', 'Email'),
            'location'      => Yii::t('chanpan', 'Location'),
            'timezone'      => Yii::t('chanpan', 'Timezone'),
            'image'         => Yii::t('chanpan', 'My Picture'),
        ];
	
	 
        return $labels;
    }
}
