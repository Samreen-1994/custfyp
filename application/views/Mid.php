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
<form action="<?php echo base_url('MidController/Mid1'); ?> " method="post">
    <div class="container">
        <a href="#demo" data-toggle="collapse" class="btn btn-default btn-sm">Previous Results</a>
        <?php include "Exam_results.php" ?>


        <div class="row">
            <div class="col-md-12">
                <h3 style="font-weight:bold;color:black;"><?php echo $this->session->userdata('proID') ?>
                    | <?php echo $this->session->userdata('ptitle') ?></h3>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <?php
                $Question = $this->session->userdata('Questions');
                $Students = $this->session->userdata('Students');

                ?>
                <table class="table table-bordered table-condensed" style="font-size: 14px;color: black;">
                    <tr class="well well-sm">
                        <th>Questions</th>
                        <?php
                        foreach ($Students as $student) {
                            echo "<th>$student->reg_no<br>$student->student_name</th>";
                        }
                        ?>
                        <th>Total</th>
                    </tr>
                    <?php
                    foreach ($Question as $row) {
                        echo "<tr'>
                        <td>$row->question_text</td>";
                        foreach ($Students as $student) {
                            echo "<td><input class='form-control input-sm' required='true' type='number' min='0' max='$row->max_marks' name='$student->reg_no-$row->Question_id'/></td>";
                        }
                        echo "<td class='well well-sm'> / $row->max_marks</td>";
                        echo "</tr>";

                    }
                    ?>
                </table>
                <label for="comments">Comments : </label>
                <textarea id="comments" class="form-control" required="true" name="comment" rows="5">
                </textarea><br>
                <input type="submit" value="Submit" class="btn btn-default btn-sm"
                       onclick="return confirm('Are You Sure To Submit the Result?')">
            </div>
        </div>
    </div>
</form>
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
</body>
</html>