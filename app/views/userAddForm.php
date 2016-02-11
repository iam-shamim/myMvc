<?php
$sendData=[];
$sendData['title']="Add New User";
inc('inc/header',$sendData);
?>
    <div class="container">
        <br>
        <div class="row">
            <div class="col-xs-12">
                <a href="<?php  echo URL.'/user'; ?>" class="btn btn-info pull-right">
                    <span class="glyphicon glyphicon-plus"></span>
                    View All
                </a>
                <br>
                <form action="#">
                    <div class="form-group">
                        <label for="fullName">Full Name</label>
                        <input type="text" id="fullName" class="form-control" placeholder="Full Name">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" class="form-control" placeholder="E-Mail">
                    </div>
                    <div class="form-group">
                        <label for="userName">User Name</label>
                        <input type="email" id="userName" class="form-control" placeholder="User Name">
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-block btn-primary" value="Update">
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php
inc('inc/footer');