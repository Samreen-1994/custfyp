<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="">
    <link href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/customcss.css'); ?>" rel="stylesheet">

    <style>
        .small-number {
            font-size: 14px;
            color: #aa0000;
            font-weight: bolder;
        }
    </style>
</head>
<body style="font-family: calibri;">
<?php include 'navbar_template.php'; ?>
<div class="container">
    <form method="post" action="<?php echo base_url('AdminController/LoadResults'); ?> ">
        <div class="row">
            <div class="col-lg-4">
                <select class="form-control input-sm" name="exam">
                    <option value="P">Proposal</option>
                    <option value="M1">Mid-1</option>
                    <option value="F1">Final-1</option>
                    <option value="M2">Mid-2</option>
                    <option value="F2">Final-2</option>
                </select>
            </div>
            <div class="col-lg-4">
                <input type="submit" class="btn btn-sm btn-default" value="Search" name="search">
            </div>
        </div>
    </form>
    <br><br>
    <?php
    if ($this->session->userdata('type') == 'P') {
        include 'adminProposals.php';
    } else {
        foreach ($Pros as $rows) {
            echo $rows->student_name;
            echo "|";
            echo "$rows->ob / $rows->max | $rows->question_text | $rows->faculty_name";

            echo "<br>";
        }
    }
    ?>
</div>
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
</body>
</html>