<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

return [
    'type'           => 'sqlite',
    'database'       => 'myNote',
    'username'       => '',
    'password'       => '',
    'dsn'            => 'sqlite:'.ROOT_PATH.'db/myNote',
    'params'         => [],
    'charset'        => 'utf8',
    'debug'          => true,
    'deploy'         => 0,
    'rw_separate'    => false,
    'master_num'     => 1,
    'slave_no'       => '',
    'fields_strict'  => true,
    'resultset_type' => 'array',
    'auto_timestamp' => false,
    'sql_explain'    => false,
];
