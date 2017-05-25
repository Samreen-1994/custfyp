<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/customcss.css'); ?>" rel="stylesheet">
</head>
<body style="font-family: calibri;">
<?php include 'navbar_template.php'; ?>
<form name="form" action="<?php echo base_url('Project/getProjectStatus'); ?> " method="post">
    <div class="container">
        <div class="row">
            <ul style='font-size: 10px;font-family: calibri;list-style: none;' class="list-group">
                <?php $project = '';
                $Student = '';
                $teacher = '';
                foreach ($Projects as $row){ ?>

                <?php if ($row->project_id != $project)
                {
                ?>
                <li class="list-group-item">
                    <h6 style="font-weight:bold;color:black;" name="pid"><?php echo $row->project_id ?></h6>
                    <input type="submit" class="btn btn-default btn-sm" style="font-size:12px"
                           value="<?php echo "$row->project_title" ?>" name="title">
                    <br><br>
                    <?php $project = $row->project_id;
                    } ?>
                    <?php echo "<b style='font-weight:bolder;color:black;'>$row->student_name</b>_$row->reg_no <br>";
                    } ?>
                    <br>
                </li>

            </ul>
        </div>
    </div>
</form>

<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
</body>
</html>