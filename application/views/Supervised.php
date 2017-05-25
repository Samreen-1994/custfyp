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

<form>
    <div class="container">
        <h3 class="page-header"><b>Supervised Projects</b></h3>
        <div class="row">
            <ul style="list-style: none;">
                <?php $project = '';
                $term = '';
                foreach ($Pros as $row){
                if ($row->projectid != $project){
                ?>
                <li style='margin-left:10px;width:200px;float:left;' class='well well-sm'>
                    <h4 style="font-weight:bold;color:black;"><?php echo $row->projectid ?></h4>
                    <h6><?php echo "<b>Semester : $row->term</b>" ?></h6>
                    <input type="submit" class="btn btn-sm btn-primary" value="<?php echo "$row->title" ?>"
                           name="title"><br><br>
                    <p>
                        <?php $project = $row->projectid;
                        } ?>
                        <?php echo "<b style='font-weight:bolder;color:black;'>$row->sname</b>|$row->sreg" ?><br>

                        <?php } ?>
                    </p>
                </li>

            </ul>
        </div>
    </div>
</form>

<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
</body>
</html>