<?php
$this->addLayer('app/middleware/online'); 
$user = $this->theodore('users', ['id'=>$this->post['user_id']]);
$this->update('users', ['status'=>($user['status']) ? 0 : 1, 'updated_at'=>$this->timestamp], $this->post['user_id']);
$this->addLayer('app/middleware/lifetime/user');
$this->redirect($this->page_back);