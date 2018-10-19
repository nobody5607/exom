<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "stock_product_items".
 *
 * @property int $id รหัสหมวดสินค้า
 * @property int $group_id
 * @property string $name ชื่อหมวดสินค้า
 * @property string $icon โลโก้
 * @property string $size ขนาด
 * @property string $weight น้ำหนัก
 * @property string $price
 * @property string $price_update
 */
class StockProductItems extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'stock_product_items';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            //[['group_id'], 'integer'],
            [['size', 'weight'], 'string'],
            [['name','price','group_id'],'required'],
            [['price'], 'number'],
            [['price_update'], 'safe'],
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
            'group_id' => Yii::t('product', 'Group ID'),
            'name' => Yii::t('product', 'Name'),
            'icon' => Yii::t('product', 'Icon'),
            'size' => Yii::t('product', 'Size'),
            'weight' => Yii::t('product', 'Weight'),
            'price' => Yii::t('product', 'Price'),
            'price_update' => Yii::t('product', 'Price Update'),
        ];
    }
}
