<div class="row collapse" id="demo">
    <div class="col-lg-6">
        <?php
        $Exams = array();
        $examSwitch = '';
        foreach ($Result as $data) {
            if (!in_array($data->examType, $Exams)) {

                echo "<table class='table table-striped table-condensed table-bordered ' style=\"font-size: 12px;\">";

                if ($data->examType == 'P') {
                    echo "<h4 style=\"font-weight:bold;color:#0a6ebd;\">Proposal</h4>";
                } else if ($data->examType == 'M1') {
                    echo "<h4 style=\"font-weight:bold;color:#0a6ebd;\">Mid Term - Part 1</h4>";
                } else if ($data->examType == 'M2') {
                    echo "<h4 style=\"font-weight:bold;color:#0a6ebd;\">Mid Term - Part 2</h4>";
                } else if ($data->examType == 'F1') {
                    echo "<h4 style=\"font-weight:bold;color:#0a6ebd;\">Final Term - Part 1</h4>";
                } else if ($data->examType == 'F2') {
                    echo "<h4 style=\"font-weight:bold;color:#0a6ebd;\">Final Term - Part 2</h4>";
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