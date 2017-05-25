<div class="row">
    <div class="col-lg-12">
        <?php
        $old = '';
        $onCreated = '';
        $oldTeacher = '';
        $oldStatus = '';
        $regs = array();
        $counter = 1;


        echo "<table style='font-size: 13px;' class='table table-condensed table-responsive'>";

        foreach ($Pros as $d) {


            if ($d->project_id != $old) {
                echo "<tr ><td colspan='5'><h4 style='color: #1f1d1d;'><b>$d->project_id | $d->project_title</b></h4></td></tr>";
                $old = $d->project_id;
                $counter = 1;
            }

            echo "<tr>";


            if ($d->onCreated != $onCreated || $oldTeacher != $d->faculty_name || $oldStatus != $d->examStatus) {

                if ($d->faculty_role == 'S') {
                    echo "<td class='small-number'>$counter</td>";
                    echo "<td style='width:20%'><p style='color:green;font-weight: bolder;'><b>$d->faculty_name</b></p></td>";
                    $counter++;
                } else {
                    echo "<td class='small-number'>$counter</td>";
                    echo "<td><p style='color: black;'><b>$d->faculty_name</b></p></td>";
                    $counter++;
                }
                echo "<td style='width: 10%'><p>$d->examStatus</p></td>";
                echo "<td style='width: 5%'><p>$d->ob /";
                echo "$d->max</p></td>";
                echo "<td style='width: 65%'><p>$d->comments</p></td>";
                $onCreated = $d->onCreated;
                $oldTeacher = $d->faculty_name;
                $oldStatus = $d->examStatus;
            }
            echo "</tr>";

        }

        echo "</table>";
        ?>
    </div>
</div>