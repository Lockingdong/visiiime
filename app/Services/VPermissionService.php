<?php

namespace App\Services;
use App\Enum\VRolePermission;


class VPermissionService
{
    public function getPermissionsByRoleName(string $roleName)
    {
        return VRolePermission::V_ROLE_PERMISSIONS[$roleName];
    }
}
