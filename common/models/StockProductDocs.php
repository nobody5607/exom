<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "stock_product_docs".
 *
 * @property int $id รหัสหมวดสินค้า
 * @property string $filename รายละเอียด
 */
class StockProductDocs extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'stock_product_docs';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['filename'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('product', 'ID'),
            'filename' => Yii::t('product', 'Filename'),
        ];
    }
}
