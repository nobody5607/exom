<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "stock_product_group".
 *
 * @property int $id รหัสหมวดสินค้า
 * @property int $brand_id ตราสินค้า
 * @property int $category_id รหัสหมวดสินค้าย่อยสุดเท่านั้น
 * @property string $name ชื่อหมวดสินค้า
 * @property string $icon โลโก้
 * @property string $description รายละเอียด
 * @property int $deleted
 */
class StockProductGroup extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'stock_product_group';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['brand_id', 'category_id', 'deleted'], 'integer'],
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
            'id' => Yii::t('product', 'ID'),
            'brand_id' => Yii::t('product', 'Brands'),
            'category_id' => Yii::t('product', 'Categorys'),
            'name' => Yii::t('product', 'Name'),
            'icon' => Yii::t('product', 'Icon'),
            'description' => Yii::t('product', 'Description'),
            'deleted' => Yii::t('product', 'Deleted'),
        ];
    }
}
