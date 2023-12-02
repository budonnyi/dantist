<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "tooth".
 *
 * @property int $id
 * @property int $card_id
 * @property int|null $tooth
 * @property int|null $status
 * @property int $created_at
 * @property int $updated_at
 */
class Tooth extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tooth';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['card_id'], 'required'],
            [['card_id', 'tooth', 'status', 'created_at', 'updated_at'], 'integer'],
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
            'card_id' => 'Card ID',
            'tooth' => 'Tooth',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function getCard()
    {
        return $this->hasOne(Card::className(), ['id' => 'card_id']);
    }
}
