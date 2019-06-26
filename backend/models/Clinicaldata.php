<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "clinicaldata".
 *
 * @property int $id
 * @property string $hn
 * @property string $firstname
 * @property string $lastname
 * @property int $sex
 * @property int $age
 * @property string $birthdate
 * @property string $address
 */
class Clinicaldata extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'clinicaldata';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['hn', 'firstname', 'lastname', 'sex', 'age', 'birthdate', 'address'], 'required'],
            [['sex', 'age'], 'integer'],
            [['birthdate'], 'safe'],
            [['address'], 'string'],
            [['hn'], 'string', 'max' => 10],
            [['firstname', 'lastname'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'hn' => Yii::t('app', 'Hn'),
            'firstname' => Yii::t('app', 'Firstname'),
            'lastname' => Yii::t('app', 'Lastname'),
            'sex' => Yii::t('app', 'Sex'),
            'age' => Yii::t('app', 'Age'),
            'birthdate' => Yii::t('app', 'Birthdate'),
            'address' => Yii::t('app', 'Address'),
        ];
    }
}
