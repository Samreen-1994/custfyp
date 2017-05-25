<?php

class ProposalModel extends CI_Model
{
    public function index()
    {
    }

    public function saveAnswers($examid, $questionid, $marks)
    {
        $sql = "CALL SubmitMarks('$examid',$questionid,$marks)";
        $this->db->query($sql);
    }

    public function saveExam($examid, $comments, $studentid, $examinerid, $examStatus)
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
                  '$studentid',
                   $examinerid,
                  '$comments',
                  '$date',
                  'P',
                  '$examStatus'
             )";
        $this->db->query($sql);
    }

    public function getOldProposal($pid, $tid)
    {
        $sql = "SELECT
             exam.examid,
             reg_no,
             student_name,
             project.project_title,
             max_marks,
             obtained_marks,
             comments,
             examStatus,
             question_text,
             questions.Question_id
        FROM
             faculty
        JOIN project_faculty ON faculty.faculty_id = project_faculty.faculty_id
        JOIN project ON project_faculty.project_id = project.project_id
        JOIN student ON project.project_id = student.Project_id
        JOIN exam ON student.reg_no = exam.student_id
        JOIN exam_questions ON exam.examid = exam_questions.examid
        JOIN questions ON exam_questions.question_id = questions.Question_id
        WHERE
             project.project_id = $pid
        AND exam.examiner_id = $tid
        AND exam.examType = 'P'
        AND (exam.examStatus = 'R' OR exam.examStatus='F')
        AND (
             exam.Row_Status != 'InActive'
             OR exam.Row_Status IS NULL
        )
        AND exam.examiner_id = faculty.faculty_id
        ORDER BY
             exam.examid";

        $Res = $this->db->query($sql);
        return $Res->result();
    }

    function setNextExam($new, $old, $reg)
    {
        $sql = "UPDATE exam SET nextExam='$new' WHERE examid!='$new' AND examType='P' AND student_id='$reg'";
        $this->db->query($sql);
        return true;
    }
}