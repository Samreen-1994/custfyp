<?php

class Projectmodel extends CI_Model
{
    public function getStudents($pid)
    {
        $sql = "SELECT student.reg_no,student_name FROM student JOIN project ON student.Project_id=project.project_id
              WHERE project.project_id=$pid";

        $results = $this->db->query($sql);
        return $results->result();
    }

    public function get_Project_Status($pid)
    {
        $sql = "SELECT
     exam.examid,
     project.project_id,
     project.project_title,
     student.reg_no,
     exam.onCreated,
     student_name,
     faculty_name,
     project_faculty.faculty_role,
	   SUM(obtained_marks) AS obtained,
     SUM(max_marks) AS maximum_marks,
     comments,
     exam.examStatus,
     project_faculty.`Status`
    FROM
         faculty
    JOIN project_faculty ON faculty.faculty_id = project_faculty.faculty_id
    JOIN project ON project_faculty.project_id = project.project_id
    JOIN student ON project.project_id = student.Project_id
    JOIN exam ON student.reg_no = exam.student_id
    JOIN exam_questions ON exam.examid = exam_questions.examid
    JOIN questions ON exam_questions.question_id = questions.Question_id
    WHERE
         project.Project_id =$pid AND examType='P' AND (exam.Row_Status!='InActive' OR exam.Row_Status IS NULL) AND faculty.faculty_id=exam.examiner_id
    GROUP BY exam.examid,project.project_id,faculty.faculty_id,reg_no,comments,exam.examStatus
    ORDER BY
     faculty.faculty_id,exam.examStatus DESC ";

        $results = $this->db->query($sql);
        return $results->result();
    }

    public function getExaminersPros($fid)
    {
        $results = $this->db->query("SELECT
	          project.project_id,project_title,student_name,reg_no,faculty_name as Faculty,faculty_role,Document,Presentation,project_faculty.Status
	     FROM
	          faculty
	     JOIN project_faculty ON faculty.faculty_id = project_faculty.faculty_id
	     JOIN project ON project_faculty.project_id = project.project_id
	     JOIN student ON project.project_id = student.Project_id
	     WHERE
	          faculty.faculty_id = $fid
			ORDER BY
	     project.project_id");
        return $results->result();
    }

    public function GetQuestions($TYPE)
    {
        $sql = "CALL getExamQuestions('$TYPE')";
        $questions = $this->db->query($sql);
        return $questions->result();
    }

    function getStudentID($title)
    {
        $sql = "SELECT reg_no FROM student JOIN project ON student.Project_id = project.project_id WHERE project_title = '$title' ORDER BY reg_no";
        $result = $this->db->query($sql);
        $row = $result->result();

        return $row;
    }

    public function getSupervisorPros($fid)
    {
        $results = $this->db->query("	     SELECT
	          project.project_id,project_title,student_name,reg_no,faculty_name AS Faculty,faculty_role
	     FROM
	          faculty
	     JOIN project_faculty ON faculty.faculty_id = project_faculty.faculty_id
	     JOIN project ON project_faculty.project_id = project.project_id
	     JOIN student ON project.project_id = student.Project_id
	     WHERE
	          faculty.faculty_id = $fid and faculty_role='S'
			ORDER BY
	     project.project_id");
        return $results->result();
    }

    public function setstatus($s)
    {
        $project = $this->session->userdata('proID');
        $teacherid = $this->session->userdata('t_id');
        $sql = "UPDATE project_faculty set Status='$s' WHERE project_id=$project AND faculty_id=$teacherid";
        $this->db->query($sql);
    }

    public function CheckStatus($id)
    {
        $TeacherID = $this->session->userdata('t_id');
        $sql = "SELECT project_faculty.Status FROM project JOIN project_faculty ON project.project_id = project_faculty.project_id JOIN faculty ON project_faculty.faculty_id = faculty.faculty_id WHERE faculty.faculty_id = $TeacherID AND project.project_id = $id";
        $query = $this->db->query($sql);
        $rowcount = $query->num_rows();
        if ($rowcount > 0) {
            return $query->row();
        } else {
            return null;
        }
    }

    public function getProDetails($name)
    {
        $sql = "CALL getProjectDetails('$name')";
        $res = $this->db->query($sql);
        $rowcount = $res->num_rows();
        if ($rowcount > 0) {
            $data = $res->row();
            return $data;
        } else {
            return FALSE;
        }
    }

    public function GetLatestResults($ProjectId, $teacherId)
    {

    }

    public function GET_EXAM_RES($ID)
    {
        $fid = $this->session->userdata('t_id');
        $sql = "SELECT
     faculty_name,
     project.project_id,
     reg_no,
     student_name,
     SUM(obtained_marks) AS obtained,
     SUM(max_marks) AS total,
     examStatus,
     comments,
     exam.Row_Status,
	 exam.onCreated,
	 exam.examType
    FROM
         faculty
    JOIN project_faculty ON faculty.faculty_id = project_faculty.faculty_id
    JOIN project ON project_faculty.project_id = project.project_id
    JOIN student ON project.project_id = student.Project_id
    JOIN exam ON student.reg_no = exam.student_id
    JOIN exam_questions ON exam.examid = exam_questions.examid
    JOIN questions ON exam_questions.question_id = questions.Question_id
    WHERE
     project.Project_id = $ID
	 AND exam.examiner_id = $fid AND exam.examiner_id=faculty.faculty_id
   AND (exam.Row_Status!='InActive' OR exam.Row_Status IS NULL) AND exam.examStatus='A'
	 
    GROUP BY
     reg_no,
     student_name,
     comments,
     examStatus,
		 faculty_name,
     exam.Row_Status,
     exam_date,
     exam.onCreated,
     exam.examType

ORDER BY
exam.onCreated,reg_no DESC ";
        $res = $this->db->query($sql);
        $rowcount = $res->num_rows();
        if ($rowcount > 0) {
            $data = $res->row();
            return $res->result();
        } else {
            return null;
        }
    }
}