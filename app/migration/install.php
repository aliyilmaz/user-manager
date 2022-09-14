<?php


$files = [
    'mysql' => 'app/migration/mysql_backup_2022_09_14_10_50_23.json',
    'sqlite' => 'app/migration/sqlite_backup_2022_09_14_10_50_50.json',
    'sqlsrv' => 'app/migration/sqlsrv_backup_2022_09_14_10_51_26.json'
];

$this->restore($files[$this->db['drive']]);


?>