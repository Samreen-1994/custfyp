<?php

class Teacher extends CI_Controller
{
    public function index()
    {
        $this->load->helper('form');
        $this->load->view('Teacherview');
    }

    public function LogoutTeacher()
    {
        $this->session->sess_destroy();
        $this->load->helper('form');
        $this->load->view('Teacherview');
    }

    public function loginTeacher()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            //something posted

            if (isset($_POST['buttonLogin'])) {
                $iscoordinator = 0;
                $this->load->model('Teachermodel');
                $this->load->library('form_validation');
                $this->form_validation->set_message('min_length', 'Password Length must be 8+');

                $this->form_validation->set_rules('temail', 'Email Address', 'required');
                $this->form_validation->set_rules('tpass', 'Password', 'required|min_length[1]');

                if (!$this->form_validation->run() == FALSE) {
                    $teacheremail = $this->input->post('temail');
                    $tpassword = $this->input->post('tpass');
                    if (isset ($_POST ['type'])) {

                        $iscoordinator = $this->input->post('type');
                    }
                    $data = $this->Teachermodel->login_teacher($teacheremail, $tpassword, $iscoordinator);
                    if ($data && $iscoordinator == 1) {
                        $this->session->set_userdata(array(
                            't_id' => $data->faculty_id,
                            't_email' => $data->faculty_email,
                            't_name' => $data->faculty_name,
                            't_des' => $data->faculty_designation
                        ));
                        $this->session->set_userdata('isC', "yes");
                        redirect('Project/index');
                    } else if ($data) {
                        $this->session->set_userdata(array(
                            't_id' => $data->faculty_id,
                            't_email' => $data->faculty_email,
                            't_name' => $data->faculty_name,
                            't_des' => $data->faculty_designation
                        ));
                        // redirect('/Project/SupervisedProjects');
                        redirect('Project/SupervisedProjects');
                    } else {
                        $data = array(
                            'error_message' => 'Invalid Credentials'
                        );
                        $this->load->view('Teacherview');
                    }
                } else {
                    $this->load->view('Teacherview');
                }


            } else if (isset($_POST['ForgotPass'])) {
                $this->load->library('form_validation');
                $this->load->model('Teachermodel');
                $this->form_validation->set_rules('temail', 'Email Address', 'required');
                if (!$this->form_validation->run() == FALSE) {
                    $teacheremail = $this->input->post('temail');
                    $dbres = $this->Teachermodel->getTeacherPassword($teacheremail);
                    mail($dbres->faculty_email . "@cust.edu.pk", "Password!", $dbres->faculty_password);
                    $this->load->view('Teacherview');
                } else {
                    $this->load->view('Teacherview');
                }
            }
        }
    }

    public function ChangePassword()
    {
        if (isset ($_POST ['oldPass']))
            $OLD = $this->input->post('oldPass');
        if (isset ($_POST ['newPass1']))
            $NEW1 = $this->input->post('newPass1');
        if (isset ($_POST ['newPass2']))
            $NEW2 = $this->input->post('newPass2');

        if ($NEW1 == $NEW2) {
            $teacherID = $this->session->userdata('t_id');
            $this->load->model('Teachermodel');
            $Res = $this->Teachermodel->CP($teacherID, $OLD, $NEW1);
            $this->session->set_flashdata('Pass_Success', 'Password Changed Successfully');
            $this->session->sess_destroy();
            redirect('Teacher/index');

        }


    }

    public function loadChangePassword()
    {
        $this->load->view('ChangePassword');
    }

    public function loadHome()
    {
        $this->load->view('TeacherHome');
    }

    public function loadProposal()
    {
        $this->load->view('ProposalExam');
    }

}