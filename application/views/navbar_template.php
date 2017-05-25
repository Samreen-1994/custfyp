<style>
    .navbar-login {
        width: 305px;
        padding: 10px;
        padding-bottom: 0px;
    }

    .navbar-login-session {
        padding: 10px;
        padding-bottom: 0px;
        padding-top: 0px;
    }

    .icon-size {
        font-size: 87px;
    }
</style>
<form method="post" action="<?php echo base_url('Teacher/LogoutTeacher'); ?> ">
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#bs-example-navbar-collapse-2">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="logo" rel="home" href="#" title="Final Year Project">
                    <img style="max-width:60px; max-height: 60px" class="img img-responsive" width="40" height="40"
                         src="http://portal.cust.pk/stdportal/assets/CUST.png">
                </a>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
                <ul class="nav navbar-nav">
                    <li><a href="<?php echo base_url(); ?>Project/SupervisedProjects">Supervised Projects<span
                                    class="sr-only">(current)</span></a>
                    </li>
                    <li><a href="<?php echo base_url(); ?>Project/index">Other Projects</a></li>
                    <?php if ($this->session->userdata('isC') == 'yes') { ?>
                        <li><a href="<?php echo base_url(); ?>AdminController/index">Projects</a></li>
                        <li><a href="<?php echo base_url(); ?>AdminController/LoadMarks">Student Marks</a></li>
                    <?php } ?>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <strong><?php echo $this->session->userdata('t_name') ?></strong>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <div class="navbar-login">
                                    <div class="row">
                                        <div class="col-lg-3 col-sm-3 col-xs-3">
                                            <p class="text-center">
                                                <img src="http://www.esek.org.gr/images/ESET/eset_user.png"
                                                     class="img img-circle"
                                                     width=60 height=60/>
                                            </p>
                                        </div>
                                        <div class="col-lg-9 col-sm-9 col-xs-9" style="color: black;font-size: 14px;">
                                            <p class="texts-left">
                                                <strong><?php echo $this->session->userdata('t_name') ?></strong></p>
                                            <p class="text-left small"><?php echo $this->session->userdata('t_email') ?></p>
                                            <p class="text-left">
                                                <a href="<?php echo base_url(); ?>Teacher/loadChangePassword"
                                                   class="btn btn-block btn-success btn-sm">Change Password</a>
                                                <input type="submit" value="Logout"
                                                       class="btn btn-sm btn-block btn-danger"/>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</form>