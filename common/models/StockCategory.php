<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "stock_category".
 *
 * @property int $id รหัสหมวดสินค้า
 * @property int $type หลักหรือย่อย (1 หลัก 2 ย่อย 3 ย่อยสุด)
 * @property int $category_id รหัสหมวดสินค้าหลัก
 * @property string $name ชื่อหมวดสินค้า
 * @property string $icon โลโก้
 * @property string $description รายละเอียด
 * @property int $deleted
 */
class StockCategory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'stock_category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type', 'category_id', 'deleted'], 'integer'],
            [['description'], 'string'],
            [['name'], 'string', 'max' => 100],
            [['icon'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('category', 'ID'),
            'type' => Yii::t('category', 'Category type'),
            'category_id' => Yii::t('category', 'Category'),
            'name' => Yii::t('category', 'Name'),
            'icon' => Yii::t('category', 'Icon'),
            'description' => Yii::t('category', 'Description'),
            'deleted' => Yii::t('category', 'Deleted'),
        ];
    }
}
