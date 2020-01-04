<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{
    public function getUserData()
    {
        $result = $this->db->get_where('users', ['user_id' => $this->session->userdata('user_id')]);

        if ($result->num_rows() == 1) {
            return $result->row_array();
        } else {
            return false;
        }
    }

    public function updateUserProfile($data)
    {
        $this->db->set('username', $data['username']);
        $this->db->set('email', $data['email']);
        $this->db->set('image', $data['image']);
        $this->db->where('user_id', $data['user_id']);
        $this->db->update('users');
    }

    public function updateUserPassword($data)
    {
        $this->db->set('password', $data['password']);
        $this->db->where('user_id', $data['user_id']);
        $this->db->update('users');
    }

    public function getUserDataDetails()
    {
        $this->db->select('count(ld.list_id) as total_plans');
        $this->db->select('(select count(l.list_id) from list_details ld join lists l on l.list_id = ld.list_id join
        users u on u.user_id = l.user_id where l.status = \'completed\' and u.user_id = \'18\') as completed_plans', false);
        $this->db->select('(select count(l.list_id) from list_details ld join lists l on l.list_id = ld.list_id join
        users u on u.user_id = l.user_id where l.status = \'ongoing\'  and u.user_id = \'18\' group by l.list_id) as ongoing_plans', false);
        $this->db->select('(select count(l.list_id) from list_details ld join lists l on l.list_id = ld.list_id join
        users u on u.user_id = l.user_id where l.status = \'cancelled\' group by l.list_id) as cancelled_plans', false);
        $this->db->select('(select sum(ld.detail_amount) from list_details ld join lists l on l.list_id = ld.list_id join
        users u on u.user_id = l.user_id where ld.action = \'deposit\') as total_deposit', false);
        $this->db->select('(select sum(ld.detail_amount) from list_details ld join lists l on l.list_id = ld.list_id join
        users u on u.user_id = l.user_id where ld.action = \'withdraw\') as total_withdraw', false);
        $this->db->from('list_details ld');
        $this->db->join('lists l', 'l.list_id = ld.list_id', 'left');
        $this->db->join('users u', 'u.user_id = l.user_id', 'left');
        $this->db->where('u.user_id', $this->session->userdata('user_id'));

        $result = $this->db->get();

        if ($result->num_rows() == 1) {
            return $result->row_array();
        } else {
            return false;
        }
    }
}
