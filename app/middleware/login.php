<?php

if(isset($_SESSION['user'])){
    $this->redirect('panel/users');
}