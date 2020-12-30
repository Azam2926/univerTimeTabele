<?php

namespace common\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for all models.
 *
 */
class MyModel extends ActiveRecord
{
    public function behaviors()
    {
        return [
            TimestampBehavior::class
        ];
    }
}
