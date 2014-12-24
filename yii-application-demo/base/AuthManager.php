<?php
namespace base;

use yii\rbac\DbManager;

/**
 * Site controller
 */
class AuthManager extends DbManager
{
    function executeRule($user, $item, $params)
    {
        return true;
    }
    
}