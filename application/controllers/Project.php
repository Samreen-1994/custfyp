<?php

class Project extends CI_Controller
{
    public function index()
    {

        $this->load->model('Projectmodel');
        $id = $this->session->userdata('t_id');
        $this->data ['Projects'] = $this->Projectmodel->getExaminersPros($id);
        $this->load->view('ProposalExam', $this->data);
    }

    public function SupervisedProjects()
    {
        $this->load->model("Projectmodel");
        $sid = $this->session->userdata('t_id');
        $this->data ["Projects"] = $this->Projectmodel->getSupervisorPros($sid);
        $this->load->view('TeacherHome', $this->data);
    }

    public function takeExam()
    {
        $this->load->model('ProposalModel');
        $this->load->model('Projectmodel');
        if (isset ($_POST ['title'])) {
            $title = $this->input->post("title");
            $this->session->set_userdata('ptitle', $title);
        }
        $project = $this->Projectmodel->getProDetails($this->session->userdata('ptitle'));
        $this->session->set_userdata('proID', $project->project_id);
        $this->db->reconnect();
        $data = $this->Projectmodel->CheckStatus($project->project_id);
        $Status = $data->Status;
        $Students = $this->Projectmodel->getStudents($project->project_id);
        $this->session->set_userdata('Students', $Students);
        $this->data ["Result"] = $this->Projectmodel->GET_EXAM_RES($project->project_id);

        if ($Status == NULL) {
            $Q = $this->Projectmodel->getQuestions('P');
            $this->session->set_userdata('Questions', $Q);
            $this->load->view('Proposal');
        } else if ($Status == 'R') {
            $Data = $this->ProposalModel->getOldProposal($project->project_id, $this->session->userdata('t_id'));
            $this->data["Data"] = $Data;
            $exams = array();
            foreach ($Data as $d) {
                if (!in_array($d->examid, $exams)) {
                    array_push($exams, $d->examid);
                    //echo $d->examid;echo "<br>";
                }
            }
            $this->session->set_userdata('p_exams', $exams);
            $this->load->view('ProposalReExam', $this->data);

        } else if ($Status == 'F') {
            $Data = $this->ProposalModel->getOldProposal($project->project_id, $this->session->userdata('t_id'));
            $this->data["Data"] = $Data;
            $exams = array();
            foreach ($Data as $d) {
                if (!in_array($d->examid, $exams)) {
                    array_push($exams, $d->examid);
                    //echo $d->examid;echo "<br>";
                }
            }
            $this->session->set_userdata('p_exams', $exams);
            $this->load->view('FailExam', $this->data);
        } else if ($Status == 'A') {
            //$this->data ["Result"] = $this->Projectmodel->GET_EXAM_RES($project->project_id);
            //$this->load->view('proposal_result', $this->data);
            $Q = $this->Projectmodel->getQuestions('M1');
            $this->session->set_userdata('curr_exam', 'M1');
            $this->session->set_userdata('Questions', $Q);
            $this->load->view('Mid', $this->data);
        } else if ($Status == 'M1') {
            $Q = $this->Projectmodel->getQuestions('F1');
            $this->session->set_userdata('curr_exam', 'F1');
            $this->session->set_userdata('Questions', $Q);
            $this->load->view('Final', $this->data);
        } else if ($Status == 'F1') {
            $Q = $this->Projectmodel->getQuestions('M2');
            $this->session->set_userdata('curr_exam', 'M2');
            $this->session->set_userdata('Questions', $Q);
            $this->load->view('Mid', $this->data);
        } else if ($Status == 'M2') {
            $Q = $this->Projectmodel->getQuestions('F2');
            $this->session->set_userdata('curr_exam', 'F2');
            $this->session->set_userdata('Questions', $Q);
            $this->load->view('Final', $this->data);
        } else if ($Status == 'F2') {
            $this->data ["Result"] = $this->Projectmodel->GET_EXAM_RES($project->project_id);
            $this->load->view('examsCompleted', $this->data);
        }

    }

    public function getProjectStatus()
    {
        $this->load->model('Projectmodel');
        if (isset($_POST['title'])) {
            $title = $this->input->post("title");
            $this->session->set_userdata('ptitle', $title);
        }

        $project = $this->Projectmodel->getProDetails($this->session->userdata('ptitle'));
        $this->db->reconnect();
        $this->session->set_userdata('pid', $project->project_id);
        $this->data["Data"] = $this->Projectmodel->get_Project_Status($project->project_id);
        $this->load->view("ExamStatus", $this->data);

    }
}