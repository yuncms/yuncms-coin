<?php

namespace yuncms\coin\models;

use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[Recharge]].
 *
 * @see Recharge
 */
class RechargeQuery extends ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Recharge[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Recharge|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
