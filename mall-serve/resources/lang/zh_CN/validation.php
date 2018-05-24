<?php
return [
  
    'custom' => [
        'phone' => [
            'unique' => '手机号已使用',
        ],
        'qq' => [
            'unique' => 'QQ号已使用',
        ],
        'weixin' => [
            'unique' => '微信号已使用',
        ],
        'department_id' => [
            'required' => '暂不能添加，你还没被分配部门'
        ]
    ],
];