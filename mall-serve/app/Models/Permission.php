<?php

namespace App\Models;

use Zizaco\Entrust\EntrustPermission;

/**
 * @var string name 权限的唯一名称, 如"create-post", 'edit-post"
 * @var string display_name 人类可讯的权限名称，如“发布文章“
 * @var string description 该权限的详细描述 
 * @author hyf
 *
 */
class Permission extends EntrustPermission
{
    //
}
