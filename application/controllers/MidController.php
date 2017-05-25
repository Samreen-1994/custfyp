<?php

class MidController extends CI_Controller
{
    public function index()
    {
    }

    public function Mid1()
    {
        $this->load->model('Mid');
        $this->load->model('Projectmodel');
        $Question = $this->session->userdata('Questions');
        $Students = $this->session->userdata('Students');
        $comments = $this->input->post('comment');

        if ($this->session->userdata('curr_exam') == 'M1') {
            $examType = 'M1';
        } else if ($this->session->userdata('curr_exam') == 'M2') {
            $examType = 'M2';
        }


        foreach ($Students as $student) {
            $examid = $this->uuid->generate_uuid();
            $studentid = $student->reg_no;
            $examinerid = $this->session->userdata('t_id');

            $this->Mid->saveMid($examid, $studentid, $examinerid, $comments, 'A', $examType);

            foreach ($Question as $row) {
                $Marks = $this->input->post("$student->reg_no-$row->Question_id");
                $this->Mid->saveAnw($examid, $row->Question_id, $Marks);
            }
        }
        $this->Projectmodel->setstatus($examType);
        redirect('Project/index');
    }
}