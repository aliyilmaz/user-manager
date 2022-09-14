<!DOCTYPE html>
<html lang="en">
<head>
    <base href="<?=$this->base_url;?>">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User | User Manager</title>
    
    <!-- jquery -->
    <script src="public/assets/lib/jquery-3.6.1.min.js"></script>
    
    <!-- bootstrap -->
    <link rel="stylesheet" href="public/assets/lib/bootstrap-5.2.0/css/bootstrap.min.css" />
    <script src="public/assets/lib/bootstrap-5.2.0/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="public/assets/lib/bootstrap-icons-1.9.1/bootstrap-icons.css">
    
    <link rel="stylesheet" href="public/assets/header.css">
    
    <!-- mediainfo -->
    <script src="public/assets/lib/mediainfo.js/mediainfo.min.js"></script>
    <script src="public/assets/lib/mediainfo.js/script.js"></script>

    <!-- tagify -->
    <script src="public/assets/lib/tagify/dist/tagify.min.js"></script>
    <script src="public/assets/lib/tagify/dist/tagify.polyfills.min.js"></script>
    <link href="public/assets/lib/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />
    
    <!-- summernote -->
    <link rel="stylesheet" href="public/assets/lib/summernote-0.8.18/summernote-lite.min.css" />
    <script src="public/assets/lib/summernote-0.8.18/summernote-lite.min.js"></script>

    <link rel="shortcut icon" href="data:;base64,iVBORw0KGgo=" type="image/x-icon">
    
</head>
<body>
<?php $this->addLayer('app/views/panel/header'); ?>
<?php $this->addLayer('app/request/panel/user/edit');?>
<?php $user = $this->theodore('users', ['id'=>$this->post['user_id']]); ?>
<div class="m-4">

    <h2>Edit User</h2>
    <form action="panel/user/edit" method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="col-lg-4">
                <div class="mt-3" id="output"><?php if(!empty($user['avatar'])){ ?> <img src="<?=$user['avatar'];?>" class="img-fluid"><?php } ?></div>
                    <div class="form-group mt-3 mb-3">
                        <label for="avatar">Avatar</label>
                        <input class="form-control" type="file" name="avatar" id="fileinput" accept=".jpeg, .jpg, .png, .webp, .svg, .gif">
                    </div>                
                </div>
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group mt-3">
                                <label for="username">Username</label>
                                <input class="form-control" type="text" name="username" placeholder="Username" value="<?=$user['username'];?>">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group mt-3">
                                <label for="password">Password</label>
                                <input class="form-control" type="password" name="password" placeholder="Password">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group mt-3">
                                <label for="email">E-mail</label>
                                <input class="form-control" type="email" name="email" placeholder="E-mail" value="<?=$user['email'];?>">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group mt-3">
                                <label for="group_name">Group</label>
                                <input class="form-control" id="group_name" type="text" name="group_name" placeholder="Group name" value="<?=$user['group_name'];?>">
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group mt-3">
                        <label for="about">About</label>
                        <textarea class="form-control" id="about" name="about" placeholder="About"><?=$user['about'];?></textarea>
                    </div>
                    <input type="hidden" name="id" value="<?=$user['id'];?>">
                </div>
            <div>
                <?php 
                if(isset($this->post['username'])){

                    if(!empty($this->errors)) {
                        foreach ($this->errors as $errors) {
                            foreach ($errors as $key => $error) {
                                echo '<strong style="font-size:10px; color:red;">* '.$error.'.</strong><br>';
                            }
                        }
                    } else {
                        echo '<strong style="color:green;">User updated.</strong>';
                    }
                    $this->redirect($this->page_back, 5, '#redirect-time');
                }
                ?>
            </div>
            <input type="hidden" name="user_id" value="<?=$this->post['user_id'];?>">
            <div class="col-lg-12 pt-2">
                <button class="btn btn-primary rounded-0" type="submit">Save</button>
                <a class="btn btn-dark rounded-0" href="panel/users">Users</a>
            </div>
        </div>
    
    <?=$_SESSION['csrf']['input'];?>
    </form>

</div>

<script>
    let divOutputHtml = '',
        divOutputElement = document.body.querySelector('div#output');

    getmediainfojs('#fileinput', (response, e) => {
      divOutputElement.innerHTML = '';

      for (let index = 0; index < e.target.files.length; index++) {
        mime_type = response[index]['media']['mime_type'].split('/')[0];
        filename = truncate(basename(response[index]['media']['filename']), 60);

        // .jpeg, .jpg, .png, .webp, .svg, .gif
        if(mime_type == 'image'){
          divOutputHtml = '<img src="'+getBlobUrl(e.target.files[index])+'" title="'+filename+'" class="img-fluid">';
        }

        divOutputElement.appendChild(stringToHTML(divOutputHtml));
      }

    });

    $(document).ready(function() {
        // $('#description').summernote();
        $('#about').summernote({
        // placeholder: 'Hello Bootstrap 4',
            tabsize: 2,
            height: 300,
            toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link', 'picture', 'video']],
            ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });

        var tagify = new Tagify(document.querySelector('#group_name'), {
            originalInputValueFormat: valuesArr => valuesArr.map(item => item.value).join(',')
        });
    });
  </script>
</body>
</html>

