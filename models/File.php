<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "file".
 *
 * @property integer $id
 * @property string $dat
 * @property string $name
 * @property integer $size
 * @property integer $status
 */
class File extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'file';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['dat'], 'safe'],
            [['name'], 'string'],
            [['size', 'status'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'dat' => 'Dat',
            'name' => 'Name',
            'size' => 'Size',
            'status' => 'Status',
        ];
    }
}
