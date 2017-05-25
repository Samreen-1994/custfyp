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
<div class="container">
    <div class="row">
        <div class="col-lg-6">
            <h3 style="font-weight:bold;color:black;">
                <?php echo $this->session->userdata('proID') ?> | <?php echo $this->session->userdata('ptitle') ?>
            </h3>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-lg-6">
            <?php
            $Exams = array();
            $examSwitch = '';
            foreach ($Result as $data) {
                if (!in_array($data->examType, $Exams)) {

                    echo "<table class='table table-striped table-condensed '>";

                    if ($data->examType == 'P') {
                        echo "<h4 style=\"font-weight:bold;color:#0a6ebd;\">Proposal</h4>";
                    } else if ($data->examType == 'M1') {
                        echo "<h4 style=\"font-weight:bold;color:#0a6ebd;\">Mid Term - Part 1</h4>";
                    } else if ($data->examType == 'M2') {
                        echo "<h4 style=\"font-weight:bold;color:#0a6ebd;\">Mid Term - Part 2</h4>";
                    } else if ($data->examType == 'F1') {
                        echo "<h4 style=\"font-weight:bold;color:#0a6ebd;\">Final Term - Part 1</h4>";
                    } else if ($data->examType == 'F2') {
                        echo "<h4 style=\"font-weight:bold;color:#0a6ebd;\">Final Term - Part 1</h4>";
                    }
                    echo "<h6 style='font-weight:bold;color:black;'>Comments :</h6><p style='color: black;font-size: 14px;'>$data->comments</p>";
                    echo "<h6 style='font-weight:bold;color:black;' >Marks : </h6>";
                }
                echo "<tr><td>$data->reg_no</td><td>$data->student_name</td><td>$data->obtained / $data->total</td></tr>";
                array_push($Exams, $data->examType);


            }
            ?>
            </table>
        </div>
    </div>
</div>
</div>
</body>


<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
</html>