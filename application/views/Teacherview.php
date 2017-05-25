<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet">
    </head>
    <body style="font-family: calibri;">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-sm-12">
                </div>
                <div class="col-lg-6 col-sm-12">
                    <?php echo form_open('Teacher/loginTeacher', ['class' => 'form-horizontal', 'id' => 'myform', 'name' => 'loginform']); ?>
                    <fieldset>
                        <h2 style="font-weight: bold;">Faculty Login</h2>
                        <div class="form-group">
                            <div class="col-lg-12 col-sm-12 col-md-12">
                                <?php echo form_input(['name' => 'temail', 'class' => 'form-control', 'placeholder' => 'Enter Email', 'value' => set_value('temail')]); ?>
                                <?php echo form_error('temail', '<div class="text-danger">', '</div>'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-12 col-sm-12 col-md-12">
                                <?php echo form_password(['name' => 'tpass', 'class' => 'form-control', 'placeholder' => 'Enter Password', 'value' => set_value('tpass')]); ?>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="type" value="1"> Is Coordinator
                                    </label>
                                </div>
                                <?php echo form_error('tpass', '<div class="text-danger">', '</div>'); ?>
                            </div>
                        </div>
                        <?php
                        echo "<p class='text-danger'>";
                        if (isset($error_message)) {
                            echo $error_message;
                        }
                        ?>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <?php echo form_reset(['name' => 'buttonReset', 'class' => 'btn btn-default', 'value' => 'RESET']); ?>
<?php echo form_submit(['name' => 'buttonLogin', 'class' => 'btn btn-primary', 'value' => 'LOGIN']); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <input type="submit" value="Forgot Password?" name="ForgotPass" class="btn btn-link">
                        </div>
                    </fieldset>
                    <div class="col-sm-12">
                        <p>News will Lie here</p>
                    </div>
                </div>
            </div>
        </div>
<?php echo form_close(); ?>
        <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
    </body>
</html>