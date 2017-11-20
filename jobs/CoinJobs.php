<?php
/**
 * @link http://www.tintsoft.com/
 * @copyright Copyright (c) 2012 TintSoft Technology Co. Ltd.
 * @license http://www.tintsoft.com/license/
 */

namespace yuncms\coin\jobs;

use yii\base\BaseObject;
use yii\queue\RetryableJobInterface;
use yuncms\coin\models\Coin;
use yuncms\user\models\UserExtra;

/**
 * 异步更新用户金币任务类
 */
class CoinJobs extends BaseObject implements RetryableJobInterface
{
    /**
     * @var string 操作
     */
    public $action;

    /**
     * @var int 用户ID
     */
    public $user_id;

    /**
     * @var integer|float
     */
    public $coins;

    /**
     * @var int 模型ID
     */
    public $modelId;

    /**
     * @var string 模型标题
     */
    public $modelSubject;

    /**
     * @inheritdoc
     */
    public function execute($queue)
    {
        $extra = UserExtra::findOne($this->user_id);
        if ($extra) {
            $transaction = UserExtra::getDb()->beginTransaction();
            try {
                $value = $extra->coins + $this->coins;
                if ($this->coins < 0 && $value < 0) {
                    return false;
                }
                //更新用户积分
                $extra->updateAttributes(['coins' => $value]);
                /*记录详情数据*/
                Coin::create([
                    'user_id' => $this->user_id,
                    'action' => $this->action,
                    'model_id' => $this->modelId,
                    'model_subject' => $this->modelSubject,
                    'coins' => $this->coins,
                ]);
                $transaction->commit();
                return true;
            } catch (\Exception $e) {
                $transaction->rollBack();
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * @inheritdoc
     */
    public function getTtr()
    {
        return 60;
    }

    /**
     * @inheritdoc
     */
    public function canRetry($attempt, $error)
    {
        return $attempt < 3;
    }
}