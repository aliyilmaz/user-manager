<?php $this->addLayer('app/middleware/online'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <base href="<?=$this->base_url;?>">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" user="IE=edge">
    <meta name="viewport" user="width=device-width, initial-scale=1.0">
    <!-- bootstrap -->
    <link rel="stylesheet" href="public/assets/lib/bootstrap-5.2.0/css/bootstrap.min.css" />
    <script src="public/assets/lib/bootstrap-5.2.0/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="public/assets/lib/bootstrap-icons-1.9.1/bootstrap-icons.css">
    
    <link rel="stylesheet" href="public/assets/header.css">
    <link rel="stylesheet" href="public/assets/pagination.css">
    <link rel="stylesheet" href="public/assets/table.css">
 
    <title>User Manager</title>
</head>

<body>
    <?php $this->addLayer('app/views/panel/header'); ?>
    <div class="m-4">

        <h2>Users <a href="panel/user/add" class="btn btn-primary rounded-circle"><i class="bi bi-plus"></i></a> </h2>
        <br>

        <form action="<?=$this->base_url;?>" method="post">
            <div class="row">
                <div class="col-lg-2">
                    <div class="form-group">
                        <label for="limit">Limit</label>
                        <select name="limit" id="limit" class="form-control">
                            <option>5</option>
                            <option>10</option>
                            <option>50</option>
                            <option>100</option>
                            <option>250</option>
                            <option>500</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="sort">Sort by</label>
                        <select name="sort" id="sort" class="form-control">
                            <option value="ASC">First Added < </option>
                            <option value="DESC">Recently Added > </option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="keyword">Keyword</label>
                            <input id="keyword" class="form-control" name="keyword" type="text">
                    </div>
                </div>
                <div class="col-lg-3 d-flex justify-user-center">
                    <div class="form-group">
                        <button type="submit" class="btn btn-dark rounded-0 btn-sm refresh-list">
                            <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> Filter
                        </button>
                    </div>
                    &nbsp;
                    <div class="form-group">
                        <a href="<?=$this->base_url;?>" class="btn btn-light rounded-0 btn-sm refresh-list">
                            <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span> Reset
                        </a>
                    </div>
                </div>
            </div>

            <hr>
            <table class="table" role="table">
                <thead role="rowgroup">
                <tr role="row">
                    <th role="columnheader">Avatar <input type="checkbox" name="columns[]" value="image"></th>
                    <th role="columnheader">Id <input type="checkbox" name="columns[]" value="id"></th>
                    <th role="columnheader">Username <input type="checkbox" name="columns[]" value="username"></th>
                    <th role="columnheader">Email <input type="checkbox" name="columns[]" value="email"></th>
                    <th role="columnheader">About <input type="checkbox" name="columns[]" value="about"></th>
                    <th role="columnheader">Created At <input type="checkbox" name="columns[]" value="created_at"></th>
                    <th role="columnheader">Updated At <input type="checkbox" name="columns[]" value="updated_at"></th>
                    <th role="columnheader">#</th>
                </tr>
                </thead>
                <tbody role="rowgroup">
                <?php foreach ($users['data'] as $key => $row) { ?>
                    <tr role="row">
                        <td role="cell" data-label="image"><a href="<?=$row['avatar'];?>"><img src="<?=$row['avatar'];?>" class="img-thumbnail" style="width:40px; height:40px; object-fit: unset;"></a></td>
                        <td role="cell" data-label="Id"><?=$row['id'];?></td>
                        <td role="cell" data-label="Username"><?=$row['username'];?></td>
                        <td role="cell" data-label="Email"><?=$row['email'];?></td>
                        <td role="cell" data-label="About"><?=(!empty($row['about'])) ? $this->summary(strip_tags(html_entity_decode($row['about'])), 40, '...') : '';?></td>
                        <td role="cell" data-label="Created At"><?=$row['created_at'];?></td>
                        <td role="cell" data-label="Updated At"><?=$row['updated_at'];?></td>
                        <td role="cell" data-label="">
                            <?php 
                                if($row['status'] == 1){ $class = 'success'; $icon = 'pause'; $title='Deactivate';} 
                                else { $class = 'warning'; $icon = 'play'; $title='Activate'; }
                            ?>     
                            <a href="panel/user/status/<?=$row['id'];?>" title="<?=$title;?>" class="btn btn-sm btn-<?=$class;?> rounded-0">
                                <i class="bi bi-<?=$icon;?>"></i>
                            </a>

                            <a href="panel/user/edit/<?=$row['id'];?>" class="btn btn-sm btn-primary rounded-0">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            
                            <a onclick="return confirm('Are you sure you want to delete?')" href="panel/user/remove/<?=$row['id'];?>" class="btn btn-sm btn-danger rounded-0">
                                <i class="bi bi-x-circle"></i>
                            </a>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
            <?php if(empty($users['data'])){
                echo '<h4>There are no user yet.</h4>';
            } ?>
            
            <?=$users['navigation'];?>
            <?=$_SESSION['csrf']['input'];?>

            <div><?=$this->addLayer('app/views/panel/footer');?></div>
        </form>
    </div>
</body>
</html>
