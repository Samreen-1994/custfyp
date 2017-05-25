<div class="row">
    <div class="col-lg-12 col-sm-12">
        <ul style='font-size: 10px;font-family: calibri;list-style: none;' class="list-group">
            <?php $project = '';
            $Student = '';
            $teacher = '';
            foreach ($Projects as $row){ ?>

            <?php if ($row->project_id != $project)
            {
            ?>
            <li class="list-group-item">
                <h6 style="font-weight:bold;color:black;"><?php echo $row->project_id ?></h6>
                <input type="submit" class="btn btn-default btn-sm"
                       value="<?php echo "$row->project_title" ?>" name="title"><br><br>

                <p class="label label-info" style="font-size: 9px;"><?php if ($row->Status == 'A') {
                        echo "Proposal Approved";
                    } else if ($row->Status == 'M1') {
                        echo "Mid 1 Taken";
                    } else if ($row->Status == 'F1') {
                        echo "Final 1 Taken";
                    } else if ($row->Status == 'M2') {
                        echo "Mid 2 Taken";
                    } else if ($row->Status == 'F2') {
                        echo "Project Completed";
                    }
                    ?></p><br><br>
                <a style="font-size: 15px" href="<?php echo "$row->Document" ?>" target="_blank">Document
                    | </a>
                <a style="font-size: 15px" href="<?php echo "$row->Presentation" ?>" target="_blank">Presentation</a>
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