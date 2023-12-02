<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "person".
 *
 * @property int $id
 * @property int|null $number
 * @property string $first_name
 * @property string|null $middle_name
 * @property string $last_name
 * @property string $birth_day
 * @property string $birth_country
 * @property string|null $birth_area
 * @property string $birth_city
 * @property string|null $location_country
 * @property string|null $location_area
 * @property string|null $location_city
 * @property string|null $location_address
 * @property string|null $comment
 * @property string|null $phone
 * @property string|null $email
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $updated_at
 */
class Person extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'person';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['number', 'status', 'created_at', 'updated_at'], 'integer'],
            [['first_name', 'last_name', 'birth_day', 'birth_country', 'birth_city'], 'required'],
            [['birth_day'], 'safe'],
            [['comment'], 'string'],
            [['first_name', 'middle_name', 'last_name', 'birth_country', 'birth_area', 'birth_city', 'location_country', 'location_area', 'location_city', 'location_address', 'phone', 'email'], 'string', 'max' => 255],
//            [['email'], 'unique'],
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
            'number' => 'Individual number',
            'first_name' => 'First Name',
            'middle_name' => 'Middle Name',
            'last_name' => 'Last Name',
            'birth_day' => 'Birth Day',
            'birth_country' => 'Birth Country',
            'birth_area' => 'Birth Area',
            'birth_city' => 'Birth City',
            'location_country' => 'Location Country',
            'location_area' => 'Location Area',
            'location_city' => 'Location City',
            'location_address' => 'Location Address',
            'comment' => 'Comment',
            'phone' => 'Phone',
            'email' => 'Email',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function beforeSave($insert) {
        $this->birth_day = date('Y-m-d', strtotime($this->birth_day));
        return parent::beforeSave($insert);
    }

//    public function beforeSave()
//    {
//        parent::beforeSave();
//        $this->birth_day = date('Y-m-d', strtotime($this->birth_day));
//    }

    public function getImages()
    {
        return $this->hasMany(Image::className(), ['person_id' => 'id']);
    }

    public function getCards()
    {
        return $this->hasMany(Card::className(), ['person_id' => 'id']);
    }
}
