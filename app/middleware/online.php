<?php

if(isset($_SESSION['user'])){

    $user = $this->theodore('users', [
        'id'=>$_SESSION['user']['id'],
        'avatar'=>$_SESSION['user']['avatar'],
        'group_name'=>$_SESSION['user']['group_name']
    ]);

    if(empty($user)){
        $this->redirect('account/logout');
        exit();
    }
} else {
    $this->redirect('account/logout');
    exit();
}