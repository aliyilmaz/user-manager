
<?php $this->addLayer('app/middleware/login');?>
<!doctype html>
<html lang="en">
  <head>
    <base href="<?=$this->base_url;?>">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign in | User Manager</title>
    <!-- bootstrap -->
    <link rel="stylesheet" href="public/assets/lib/bootstrap-5.2.0/css/bootstrap.min.css" />
    <script src="public/assets/lib/bootstrap-5.2.0/js/bootstrap.bundle.min.js"></script>
    <link rel="shortcut icon" href="data:;base64,iVBORw0KGgo=" type="image/x-icon">
  </head>
  <body style="background-color: #9A616D;">
    <section style="height:100%;margin-top: 8vw;">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col col-xl-10">
                <div class="card" style="border-radius: 1rem;">
                <div class="row g-0">
                    <div class="col-md-6 col-lg-5 d-none d-md-block">
                    <img src="public/webp/login.webp"
                        alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
                    </div>
                    <div class="col-md-6 col-lg-7 d-flex align-items-center">
                    <div class="card-body p-4 p-lg-5 text-black">

                        <form action="account/login" method="POST">

                            <div class="d-flex align-items-center mb-3 pb-1">
                                <span class="h1 fw-bold mb-0">Sign in</span>
                            </div>

                            <div class="form-outline mb-4">
                                <label class="form-label" for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control form-control-lg" value="aliyilmaz.work@gmail.com"/>
                            </div>

                            <div class="form-outline mb-4">
                                <label class="form-label" for="password">Password</label>
                                <input type="password" name="password" id="password" class="form-control form-control-lg" value="123456" />
                            </div>

                            <div class="pt-1 mb-4">
                                <?=$_SESSION['csrf']['input'];?>
                                <button class="btn btn-dark btn-lg btn-block rounded-0 btn-sm" type="submit">Login</button>
                            </div>

                            <?php 
                            $this->addLayer('app/request/account/login'); 
                            if(isset($this->post['email'])){

                                if(!empty($this->errors)) {
                                    foreach ($this->errors as $errors) {
                                        foreach ($errors as $key => $error) {
                                            echo '<strong style="font-size:10px; color:red;">* '.$error.'</strong><br>';
                                        }
                                    }
                                    $this->redirect($this->page_back, 5, '#redirect-time');
                                } 
                                
                            }
                            ?>
                            <em id="redirect-time"></em>
                        </form>

                    </div>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
        </section>
    
  </body>
</html>