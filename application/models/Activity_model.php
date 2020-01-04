<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Activity_model extends CI_Model
{
    public function insertActivity($data)
    {
        $activity = array(
            'user_id' => $this->session->userdata('user_id'),
            'activity' => $data[0],
            'done_on' => $data[1]
        );

        $this->db->insert('activities', $activity);
    }

    public function getActivities()
    {
        $this->db->where('user_id', $this->session->userdata('user_id'));

        $result = $this->db->get('activities');

        if ($result->num_rows() > 0) {
            return $result->result_array();
        } else {
            return false;
        }
    }

    public function getRecentActivities()
    {
        $this->db->order_by('done_on', 'desc');
        $this->db->where('user_id', $this->session->userdata('user_id'));

        $result = $this->db->get('activities');

        if ($result->num_rows() > 0) {
            return $result->result_array();
        } else {
            return false;
        }
    }

    public function getWalletDepositActivities()
    {
        $this->db->like('activity', 'deposit', 'both');
        $this->db->order_by('done_on', 'desc');
        $this->db->where('user_id', $this->session->userdata('user_id'));

        $result = $this->db->get('activities');

        if ($result->num_rows() > 0) {
            return $result->result_array();
        } else {
            return false;
        }
    }

    public function getWalletWithdrawActivities()
    {
        $this->db->like('activity', 'withdrew', 'both');
        $this->db->order_by('done_on', 'desc');
        $this->db->where('user_id', $this->session->userdata('user_id'));

        $result = $this->db->get('activities');

        if ($result->num_rows() > 0) {
            return $result->result_array();
        } else {
            return false;
        }
    }
}
