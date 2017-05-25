<?php

class ProposalController extends CI_Controller
{


    public function index()
    {
    }

    public function TakeProposal()
    {
        $c = 0;
        $exams = $this->session->userdata('p_exams');

        $this->load->model('ProposalModel');
        $teacherid = $this->session->userdata('t_id');
        $counter = $this->session->userdata('questions');
        $comment = $this->input->post('tcomments');
        $this->load->model('Projectmodel');
        $data = $this->Projectmodel->getStudentID($this->session->userdata('ptitle'));
        $Questions = $this->session->userdata('Questions');
        $status = $this->input->post('status');

        foreach ($data as $d) {
            $examid = $this->uuid->generate_uuid();

            if ($this->session->userdata('Exam') == '1') {
                $this->ProposalModel->setNextExam($examid, $exams[$c], $d->reg_no);
                $c++;
            }


            $this->ProposalModel->saveExam($examid, $comment, $d->reg_no, $teacherid, $status);
            foreach ($Questions as $q) {
                $radio = $this->input->post('option' . $q->Question_id);
                echo $radio;
                if ($radio == 1)
                    $this->ProposalModel->saveAnswers($examid, $q->Question_id, $radio);
                else
                    $this->ProposalModel->saveAnswers($examid, $q->Question_id, 0);
            }
        }
        $this->Projectmodel->setstatus($status);
        $this->session->set_flashdata('msg', 'Exam Conducted SuccessFully');
        redirect('Project/index');
    }
}