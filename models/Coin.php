<?php
/**
 * @link http://www.tintsoft.com/
 * @copyright Copyright (c) 2012 TintSoft Technology Co. Ltd.
 * @license http://www.tintsoft.com/license/
 */

namespace yuncms\coin\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;

/**
 * Coin model
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $type
 * @property double $amount
 * @property integer $created_at
 * @property string $action
 */
class Coin extends ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%coins}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'created_at',
                ],
            ]
        ];
    }

    /** @inheritdoc */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'action' => Yii::t('coin', 'Action'),
            'source_subject' => Yii::t('coin', 'Source Subject'),
            'coins' => Yii::t('coin', 'Amount of the transaction'),
            'created_at' => Yii::t('coin', 'Transaction Hour'),
        ];
    }

    /**
     * 获取类型字符
     * @return mixed|null
     */
    public function getActionText()
    {
        switch ($this->action) {
            case 'ask':
                return Yii::t('coin', 'Ask questions');
                break;
            case 'answer_question':
                return Yii::t('coin', 'Answered the question');
                break;
            case 'answer_adopted':
                return Yii::t('coin', 'answer is adopted');
                break;
            default:
                return null;
                break;
        }
    }

    public static function create($attribute)
    {
        $model = new static ($attribute);
        if ($model->save()) {
            return $model;
        }
        return false;
    }
}