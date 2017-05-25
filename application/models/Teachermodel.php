<?php

class Teachermodel extends CI_Model
{
    public function login_teacher($temail, $tpass, $cod)
    {
        if ($cod == 1) {
            $this->db->from('faculty')->where([
                'faculty_email' => $temail,
                'faculty_password' => $tpass,
                'isCo' => $cod
            ]);
            $query = $this->db->get();
            $rowcount = $query->num_rows();

            if ($rowcount >= 1) {
                $data = $query->row();
                return $data;
            } else {
                return FALSE;
            }
        } else {
            $sql = "SELECT * FROM faculty WHERE faculty_email='$temail' AND BINARY faculty_password=BINARY '$tpass'";
            $query = $this->db->query($sql);
            $rowcount = $query->num_rows();

            if ($rowcount >= 1) {
                $data = $query->row();
                return $data;
            } else {
                return FALSE;
            }
        }
    }

    public function getTeacherPassword($email)
    {

        $sql = "SELECT * FROM faculty WHERE faculty_email='$email'";
        $data = $this->db->query($sql)->row();
        if (isset($data)) {
            return $data;
        } else {
            return FALSE;
        }
    }


    public function CP($id, $old, $new)
    {
        $this->db->where(['faculty_id' => $id, 'faculty_password' => $old]);
        $this->db->update('faculty', ['faculty_password' => $new]);
        $afftectedRows = $this->db->affected_rows();
        if ($afftectedRows > 0) {
            return "Success";
        } else {
            return "Failed";
        }
    }
}