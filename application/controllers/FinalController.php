<?php

class FinalController extends CI_Controller
{
    public function index()
    {

    }

    public function TakeFinal()
    {
        $this->load->model('FinalModel');
        $this->load->model('Projectmodel');
        $Question = $this->session->userdata('Questions');
        $Students = $this->session->userdata('Students');
        $comments = $this->input->post('comment');

        if ($this->session->userdata('curr_exam') == 'F1') {
            $examType = 'F1';
        } else if ($this->session->userdata('curr_exam') == 'F2') {
            $examType = 'F2';
        }


        foreach ($Students as $student) {
            $examid = $this->uuid->generate_uuid();
            $studentid = $student->reg_no;
            $examinerid = $this->session->userdata('t_id');

            $this->FinalModel->saveFinal($examid, $studentid, $examinerid, $comments, 'A', $examType);

            foreach ($Question as $row) {
                $Marks = $this->input->post("$student->reg_no-$row->Question_id");
                $this->FinalModel->saveAnw($examid, $row->Question_id, $Marks);
            }
        }
        $this->Projectmodel->setstatus($examType);
        redirect('Project/index');
    }
}