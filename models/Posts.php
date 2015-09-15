<?php

namespace app\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "posts".
 *
 * @property integer $id
 * @property string $title
 * @property string $slug
 * @property string $short
 * @property string $text
 * @property string $date
 * @property integer $published
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property User $createdBy
 * @property User $updatedBy
 */
class Posts extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'posts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'slug', 'short', 'text'], 'required'],
            [['short', 'text'], 'string'],
            [['date'], 'safe'],
            [['created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            ['published', 'boolean'],
            [['published'], 'default', 'value' => '0'],
            [['title', 'slug'], 'string', 'max' => 255],
            [['slug'], 'trim'],
            ['slug', 'match', 'pattern' => '(^[\w\d-]*$)']
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
            BlameableBehavior::className()
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'slug' => Yii::t('app', 'Slug'),
            'short' => Yii::t('app', 'Short'),
            'text' => Yii::t('app', 'Text'),
            'date' => Yii::t('app', 'Date'),
            'published' => Yii::t('app', 'Published'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'createdBy.username' => Yii::t('app', 'Created By'),
            'updatedBy.username' => Yii::t('app', 'Updated By'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }
}
