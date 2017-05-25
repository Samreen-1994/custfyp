<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet">
        <link href="<?php echo base_url('assets/css/customcss.css'); ?>" rel="stylesheet">
    </head>
    <body style="font-family: Calibri;">
        <?php include 'navbar_template.php'; ?>
        <form class="form-horizontal" method="post" action="<?php echo base_url('Teacher/ChangePassword'); ?>">
            <div class="container">
                <fieldset>
                    <legend>Enter Password Details</legend>
                    <div class="form-group">
                        <label for="inputPassword" class="col-lg-2 control-label">Old Password</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" id="inputPassword" name="oldPass"
                                   placeholder="Password">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputPassword" class="col-lg-2 control-label">New Password</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" id="inputPassword" name="newPass1"
                                   placeholder="Password">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword" class="col-lg-2 control-label">Re-Enter New Password</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" id="inputPassword" name="newPass2"
                                   placeholder="Password">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-10 col-sm-offset-2">
                            <input type="submit" value="Update" class="btn btn-primary btn-primary"/>
                        </div>
                    </div>
                </fieldset>
            </div>
        </form>
        <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
    </body>