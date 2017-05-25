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
        <div class="col-lg-12">
            <form method="post" action="<?php echo base_url('AdminController/LoadMarks'); ?> ">
                <div class="row">
                    <div class="col-lg-4">
                        <select class="form-control input-sm" name="exType">
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
            <div class="col-lg-12">
                <?php
                $tp = null;
                if ($this->session->userdata('marksType') == 'P') {
                    $tp = "Proposal Exam";
                } else if ($this->session->userdata('marksType') == 'M1') {
                    $tp = "Mid - Part 1";
                } else if ($this->session->userdata('marksType') == 'M2') {
                    $tp = "Mid - Part 2";
                } else if ($this->session->userdata('marksType') == 'F1') {
                    $tp = "Final - Part 1";
                } else if ($this->session->userdata('marksType') == 'F2') {
                    $tp = "Final - Part 2";
                }

                echo "<h3><b>$tp</b></h3><br><br>";


                if ($this->session->userdata('marksType') == 'P' || $this->session->userdata('marksType') == 'M1' || $this->session->userdata('marksType') == 'M2') {
                    $reg = null;
                    $f = null;
                    $counter = 0;
                    $fac = array();

                    $faculty = $this->session->userdata('fac');
                    



                    echo "<table class='table table-condensed table-bordered'>";
                    echo "<th>Students #</th>";

                    foreach ($faculty as $fac) {
                        echo "<th>$fac->faculty_name</th>";
                    }

                    foreach ($marks as $m) {

                        if ($m->reg_no != $reg) {
                            echo "<tr>";
                            echo "<td>$m->reg_no</td>";
                            $reg = $m->reg_no;
                        }
                        foreach ($faculty as $f) {
                            if ($m->faculty_id == $f->faculty_id) {
                                echo "<td>$m->faculty_id = $f->faculty_id</td>";
                                
                            } else {
                               echo "<td></td>";
                            }
                        }
                    }
                } else if ($this->session->userdata('marksType') == 'F1' || $this->session->userdata('marksType') == 'F2') {
                    $Exams = $this->session->userdata('OtherExams');
                    $teacher = null;
                    $q = null;
                    $student = null;
                    $type = null;
                    $arr = array();
                    $r = null;
                    $t = null;
                    $counter = 0;

                    foreach ($marks as $test) {
                        if (!in_array($test->question_text, $arr)) {
                            array_push($arr, $test->question_text);
                        }
                    }

                    foreach ($marks as $m) {
                        if ($m->reg_no != $r) {
                            //$t=null;
                            $counter++;
                            echo "<table class='table table-condensed' style='font-size:13px;'>";
                            $r = $m->reg_no;

                            echo "<h5><b>$counter : $m->reg_no | $m->student_name</b></h5>";

                            echo "<th>Faculty</th>";
                            for ($i = 0; $i < sizeof($arr); $i++) {
                                echo "<th>$arr[$i]</th>";
                            }
                        }


                        if ($m->faculty_name != $t) {
                            if ($m->faculty_role == 'S') {
                                echo "<tr class='info'><td><b>$m->faculty_name</b></td>";
                            } else {
                                echo "<tr><td><b>$m->faculty_name</b></td>";
                            }
                            $t = $m->faculty_name;
                        }
                        echo "<td>$m->obtained_marks / $m->max_marks</td>";
                    }
                }
                ?>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/js/custom.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
    </body>
</html>