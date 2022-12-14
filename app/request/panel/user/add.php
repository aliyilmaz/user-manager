<?php
$this->addLayer('app/middleware/online'); 
// $this->print_pre($this->post);

$values = [];
$values['created_at'] = $this->timestamp;
$values['status'] = 1;

$rule = [
   'username'        => 'required',
   'password'        => 'required',
   'email'           => 'email|unique:users',
   'group_name'      => 'required',
   'avatar'          => 'required',
   'about'           => 'required'
];

$message = [
   'username'=>[
      'required'=>'The username must be specified.'
   ],
   'password'=>[
      'required'=>'The password must be specified.'
   ],
   'email'=>[
      'email'=>'The email must be specified.',
      'unique'=>'An unused email must be specified.'
   ],
   'group_name'=>[
      'required'=>'The group name must be specified.'
   ],
   'avatar'=>[
      'required'=>'The avatar must be specified.'
   ],
   'about'=>[
      'required'=>'The about must be specified.'
   ]
];

if(isset($this->post['username'])){
   
   $this->post['username'] = (!empty($this->post['username'])) ? $this->post['username'] : '';
   $this->post['password'] = (!empty($this->post['password'])) ? md5($this->post['password']) : '';
   $this->post['email'] = (!empty($this->post['email'])) ? $this->post['email'] : '';
   $this->post['group_name'] = (!empty($this->post['group_name'])) ? $this->post['group_name'] : '';
   $this->post['about'] = (!empty($this->post['about'])) ? $this->post['about'] : '';
   $this->post['avatar'] = (!empty($this->post['avatar'])) ? $this->post['avatar'] : '';
   
   if($this->validate($rule, $this->post, $message)){
      $values['username'] = $this->post['username'];
      $values['password'] = $this->post['password'];
      $values['email'] = $this->post['email'];
      $values['group_name'] = $this->post['group_name'];
      $values['about'] = $this->post['about'];
   }

   if(empty($this->post['avatar']['name'])){
      $this->errors['avatar']['required'] = 'The avatar must be selected.';
   }

   if(empty($this->errors)){

      if(!$this->is_type($this->post['avatar']['name'], ['jpeg', 'jpg', 'png', 'webp', 'svg', 'gif'])){
         $this->errors['avatar']['type'] = 'The file type of the avatar must be of a permitted type.';
      } else {

         $avatar = $this->upload($this->post['avatar'], 'public/users/'.date('Y-m-d').'/');
         if(!empty($avatar)){
            $values['avatar'] = $avatar[0]; 
         } else {
            $this->errors['avatar']['required'] = 'The avatar could not be loaded.';
         }
         
      }


   }
   
   if(empty($this->errors)){
      $this->insert('users', $values);
   }   
   
}
