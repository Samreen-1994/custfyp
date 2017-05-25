<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet">
<link href="<?php echo base_url('assets/css/customcss.css'); ?>" rel="stylesheet">
</head>
<body style="font-family: calibri;">
    <?php include 'navbar_template.php'; ?>
    <div class="container">

        <?php
        $old = '';
        $regs = array();
        $oldStatus = '';
        $onCreated = '';
        $oldf = '';
        foreach ($Data as $d) {

            if ($d->project_id != $old) {
                echo "<h4><b>$d->project_id | $d->project_title</b></h4>";
                $old = $d->project_id;
            }
            if (!in_array($d->reg_no, $regs)) {
                echo "<b>$d->reg_no</b>";
                echo "_";
                echo $d->student_name;
                echo "<br>";

                array_push($regs, $d->reg_no);
            }
        }
        ?>

        <br><br>
        <table class="table table-responsive table-borderless" style="font-family:calibri;font-size: 14px;">
            <tr>
                <th>Faculty</th>
                <th>Status</th>
                <th>Obtained</th>
                <th>Comments</th>
            </tr>

            <?php
            foreach ($Data as $d) {
                echo "<tr>";
                if ($d->onCreated != $onCreated || $oldf != $d->faculty_name || $oldStatus != $d->examStatus) {
                    echo "<td style=\"width:150px\">";
                    if ($d->faculty_role == 'S') {
                        echo "<p style='color:green;font-weight: bold;'><b>$d->faculty_name</b></p>";
                    } else {
                        echo "<p style='color: black;'><b>$d->faculty_name</b></p>";
                    }
                    echo "</td>";
                    echo "<td>";
                    echo $d->examStatus;
                    echo "</td>";
                    echo "<td>";
                    echo "$d->obtained / ";
                    echo $d->maximum_marks;
                    echo "</td>";
                    echo "<td>";
                    echo $d->comments;
                    echo "</td>";
                }
                $onCreated = $d->onCreated;
                $oldf = $d->faculty_name;
                $oldStatus = $d->examStatus;
            }
            echo "</tr>";
            ?>
        </table>
    </div>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
</body>
</html>


