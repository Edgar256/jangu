<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "message".
 *
 * @property int $id
 * @property int $from_user_id
 * @property int $to_user_id
 * @property int $trip_id
 * @property string $text
 * @property string $created
 *
 * @property User $fromUser
 * @property User $toUser
 * @property Trip $trip
 */
class Message extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'message';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['from_user_id', 'to_user_id', 'trip_id', 'text'], 'required'],
            [['from_user_id', 'to_user_id', 'trip_id'], 'integer'],
            [['text'], 'string'],
            [['created'], 'safe'],
            [['from_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['from_user_id' => 'id']],
            [['to_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['to_user_id' => 'id']],
            [['trip_id'], 'exist', 'skipOnError' => true, 'targetClass' => Trip::className(), 'targetAttribute' => ['trip_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'from_user_id' => 'From User ID',
            'to_user_id' => 'To User ID',
            'trip_id' => 'Trip ID',
            'text' => 'Text',
            'created' => 'Created',
        ];
    }

    /**
     * Gets query for [[FromUser]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFromUser()
    {
        return $this->hasOne(User::className(), ['id' => 'from_user_id']);
    }

    /**
     * Gets query for [[ToUser]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getToUser()
    {
        return $this->hasOne(User::className(), ['id' => 'to_user_id']);
    }

    /**
     * Gets query for [[Trip]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTrip()
    {
        return $this->hasOne(Trip::className(), ['id' => 'trip_id']);
    }
}
