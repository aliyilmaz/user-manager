<?php

if(isset($this->post['email'])){
    
    $user = $this->theodore('users', ['email'=>$this->post['email'], 'password'=>md5($this->post['password'])]);

    if(!empty($user)){
        $_SESSION['user']['id'] = $user['id'];
        $_SESSION['user']['avatar'] = $user['avatar'];
        $_SESSION['user']['group_name'] = $user['group_name'];
        $_SESSION['user']['login_time'] = $this->timestamp;
        $this->redirect('panel/users');
    } else {
        $this->errors['user']['notfound'] = 'User not found.';
    }

}