<?php

require './Mind.php';

$conf = array(
    'db'=>[
        'drive'     =>  'mysql', // mysql, sqlite, sqlsrv
        'host'      =>  'localhost', // sqlsrv için: www.example.com\\MSSQLSERVER,'.(int)1433
        'dbname'    =>  'user_manager', // user_manager, app/migration/user_manager.sqlite
        'username'  =>  'root',
        'password'  =>  '',
        'charset'   =>  'utf8mb4'
    ]
);
$Mind = new Mind($conf);

$Mind->route('/', ['app/model/user/users', 'app/views/panel/user/users'], 'app/migration/install');
$Mind->route('panel/users:p', ['app/model/user/users', 'app/views/panel/user/users']);
$Mind->route('panel/user/add', 'app/views/panel/user/add');
$Mind->route('panel/user/edit:user_id', 'app/views/panel/user/edit');
$Mind->route('panel/user/status:user_id', 'app/request/panel/user/status');
$Mind->route('panel/user/remove:user_id', 'app/request/panel/user/remove');
$Mind->route('panel/user/', 'app/views/panel/user/users');
// $Mind->route('panel/backup', 'app/request/backup');

$Mind->route('account/login', 'app/views/public/account/login');
$Mind->route('account/logout', 'app/request/account/logout');
