<?php

class AdminController extends CI_Controller
{

    public function index()
    {

        if ($this->session->userdata('isC') == 'yes') {
            $this->load->model('AdminModel');
            $this->data['Pros'] = $this->AdminModel->get_all_Projects_Status();
            $this->load->view('adminHome', $this->data);
        } else {
            redirect('Project/index');
        }
    }

    public function LoadResults()
    {
        $this->load->model('AdminModel');

        if (isset($_POST['search'])) {
            $examType = $this->input->post('exam');
            $this->session->set_userdata('type', $examType);
            if ($examType == 'P') {
                $this->data['Pros'] = $this->AdminModel->get_all_Projects_Status();
            } else {
                $this->data['Pros'] = $this->AdminModel->LoadExamData($examType);
            }

            $this->load->view('adminHome', $this->data);

        }
    }
    
    public function LoadMarks(){
        $type=$this->input->post('exType');
        if($type==null)
        {
            $type="P";
        }
        $this->load->model("AdminModel");
        $faculty= $this->AdminModel->getFaculty();
        $this->session->set_userdata('fac',$faculty);
        
        $this->data['marks']=$this->AdminModel->LoadStudentMarks($type);
    
        $this->session->set_userdata('marksType',$type);
        $this->load->view("marks",$this->data);
    }

}