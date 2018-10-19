<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "stock_brand".
 *
 * @property int $id รหัสตราสินค้า
 * @property int $type หลักหรือย่อย (1 หลัก 2 ย่อย)
 * @property int $brand_id รหัสแบรนด์หลัก
 * @property string $name ชื่อตราสินค้า
 * @property string $icon โลโก้
 * @property string $description รายละเอียด
 * @property int $deleted
 */
class StockBrand extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'stock_brand';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type', 'brand_id', 'deleted'], 'integer'],
            [['description'], 'string'],
            [['name'], 'string', 'max' => 100],
            [['icon'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('brand', 'ID'),
            'type' => Yii::t('brand', 'Brand Type'),
            'brand_id' => Yii::t('brand', 'Brand'),
            'name' => Yii::t('brand', 'Name'),
            'icon' => Yii::t('brand', 'Logo'),
            'description' => Yii::t('brand', 'Description'),
            'deleted' => Yii::t('brand', 'Deleted'),
        ];
    }
}
