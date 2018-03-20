<?php
namespace App\Department\Services;

use App\Models\Department;

class DepartmentTypeService 
{
    
    public function  get() 
    {
        return Department::getType();
    }
}