<?php
$this->addLayer('app/middleware/online'); 
if(isset($this->post['user_id'])){
    $user = $this->theodore('users', ['id'=>$this->post['user_id']]);
    if(!empty($user)){
        $this->rm_r($user['image']);
        $this->delete('users', $this->post['user_id'], 'id');
    }

}
$this->redirect($this->page_back);