<?php

class FinalModel extends CI_Model
{
    public function saveFinal($examid, $student_id, $examiner_id, $comments, $exam_status, $examType)
    {
        $date = date("Y/m/d");
        $sql = "INSERT INTO exam (
         examid,
         student_id,
         examiner_id,
         comments,
         exam_date,
         examType,
         examStatus
        )
        VALUES
             (
                  '$examid',
                  '$student_id',
                   $examiner_id,
                  '$comments',
                  '$date',
                  '$examType',
                  '$exam_status'
             )";
        $this->db->query($sql);

    }

    public function saveAnw($examid, $questionid, $obmarks)
    {
        $sql = "CALL SubmitMarks('$examid',$questionid,$obmarks)";
        $this->db->query($sql);
    }
}