<?php
namespace common\rbac\rules;

use yii\rbac\Rule;
/**
 */
class Teacher extends Rule
{
    public $name = 'teacher';
    /**
     * @param string|int $userId the user ID.
     * @param string $item the role or permission that this rule is associated with
     * @param array $params parameters passed to ManagerInterface::checkAccess().
     * @return bool a value indicating whether the rule permits the role or permission it is associated with.
     */
    public function execute($userId, $item, $params)
    {
        return isset($params['timetable']) ? $params['timetable']->teacher->user_id == $userId : false;
    }
}