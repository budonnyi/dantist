<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "card".
 *
 * @property int $id
 * @property int $person_id
 * @property string $date
 * @property int|null $status
 * @property int $created_at
 * @property int $updated_at
 */
class Card extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'card';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['person_id', 'date'], 'required'],
            [['person_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['date'], 'safe'],
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['created_at', 'updated_at'],
                ],
                // если вместо метки времени UNIX используется datetime:
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'person_id' => 'Person ID',
            'date' => 'Date',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function getTeeth()
    {
        return $this->hasMany(Tooth::className(), ['card_id' => 'id']);
    }
}
