<?php

class AdminModel extends CI_Model {

    public function getFaculty() {
        $sql="SELECT faculty.faculty_id,faculty.faculty_name FROM faculty JOIN project_faculty ON faculty.faculty_id=project_faculty.faculty_id
            JOIN project on project_faculty.project_id=project.project_id 
            GROUP BY faculty.faculty_id
            ORDER BY faculty.faculty_id";
        
        $data = $this->db->query($sql);
        return $data->result();
    }
    public function LoadStudentMarks($examTYpe){
        if($examTYpe=='P' OR $examTYpe=='M1' OR $examTYpe=='M2')
        {
            $sql=  "SELECT
                    exam.examid,
                    exam.onCreated,
                    project.project_id,
                    reg_no,
                    student_name,
                    faculty.faculty_id,
                    faculty_name,
                    faculty_role,
                    SUM(obtained_marks) AS ob,
                    SUM(max_marks) AS max,
                    comments,
                    exam.examStatus
                    FROM
                         faculty
                    JOIN project_faculty ON faculty.faculty_id = project_faculty.faculty_id
                    JOIN project ON project_faculty.project_id = project.project_id
                    JOIN student ON project.project_id = student.Project_id
                    JOIN exam ON student.reg_no = exam.student_id
                    JOIN exam_questions ON exam.examid = exam_questions.examid
                    JOIN questions ON exam_questions.question_id = questions.Question_id
                    WHERE
                         faculty.faculty_id = exam.examiner_id AND exam.examType='$examTYpe' and exam.examStatus='A'
                    AND (exam.Row_Status != 'InActive' 
                    OR exam.Row_Status IS NULL)
                    GROUP BY
                         exam.examid,
                         exam.onCreated,
                         project_title,
                         reg_no,
                         faculty.faculty_id,
                         faculty_role,
                         comments,exam.examStatus
                    ORDER BY
                    reg_no,faculty.faculty_id,exam.examStatus DESC";
        }
        else
        {
             $sql=" SELECT
                    exam.examid,
                    exam.onCreated,
                    reg_no,
                    project.project_id,
                    student_name,
                    obtained_marks,
                    max_marks,
                    question_text,
                    faculty.faculty_id,
                    faculty_name,
                    faculty_role,
                    comments,
                    exam.examStatus,
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
                        faculty.faculty_id = exam.examiner_id
                    AND exam.examType = '$examTYpe'
                    AND exam.examStatus = 'A'
                    AND (
                        exam.Row_Status != 'InActive'
                        OR exam.Row_Status IS NULL
                    )
                    ORDER BY
					reg_no,faculty_id";
        }
        
		
        $data=$this->db->query($sql);
        return $data->result();
       
        
    }
    public function get_all_Projects_Status() {
        $sql = "SELECT
     exam.examid,
     exam.onCreated,
     project.project_id,
     project_title,
     reg_no,
     faculty.faculty_id,
     faculty_name,
     faculty_role,
     SUM(obtained_marks) AS ob,
     SUM(max_marks) AS max,
     comments,
     exam.examStatus
FROM
     faculty
JOIN project_faculty ON faculty.faculty_id = project_faculty.faculty_id
JOIN project ON project_faculty.project_id = project.project_id
JOIN student ON project.project_id = student.Project_id
JOIN exam ON student.reg_no = exam.student_id
JOIN exam_questions ON exam.examid = exam_questions.examid
JOIN questions ON exam_questions.question_id = questions.Question_id
WHERE
     faculty.faculty_id = exam.examiner_id AND exam.examType='P'
AND (exam.Row_Status != 'InActive' 
OR exam.Row_Status IS NULL)
GROUP BY
     exam.examid,
     exam.onCreated,
     project_title,
     reg_no,
     faculty.faculty_id,
     faculty_role,
     comments,exam.examStatus
ORDER BY
     project.project_id,faculty.faculty_id,exam.examStatus DESC ";


        $data = $this->db->query($sql);
        return $data->result();
    }

    public function LoadExamData($et) {
        $sql = "SELECT
     exam.examid,
     exam.onCreated,
     project.project_id,
     project_title,
     reg_no,
     student.student_name,
     faculty.faculty_id,
     faculty_name,
     faculty_role,
     obtained_marks AS ob,
     max_marks AS max,
     comments,
     question_text,
     exam_questions.question_id,
     exam.examStatus
FROM
     faculty
JOIN project_faculty ON faculty.faculty_id = project_faculty.faculty_id
JOIN project ON project_faculty.project_id = project.project_id
JOIN student ON project.project_id = student.Project_id
JOIN exam ON student.reg_no = exam.student_id
JOIN exam_questions ON exam.examid = exam_questions.examid
JOIN questions ON exam_questions.question_id = questions.Question_id
WHERE
     faculty.faculty_id = exam.examiner_id AND exam.examType='$et'
AND (exam.Row_Status != 'InActive' 
OR exam.Row_Status IS NULL)

ORDER BY
     project.project_id,faculty.faculty_id,exam.examStatus DESC";

        $data = $this->db->query($sql);
        return $data->result();
    }

}
