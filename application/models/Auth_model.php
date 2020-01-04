<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth_model extends CI_Model
{
    public function register($register_data)
    {
        // User data array
        $data = array(
            'username' => $register_data['username'],
            'email' => $register_data['email'],
            'password' => $register_data['password'],
            'image' => 'default.png',
            'role_id' => 2
        );

        // Insert user
        return $this->db->insert('users', $data);
    }

    public function getUserId($email)
    {
        // Validate
        $this->db->select('user_id');
        $this->db->where('email', $email);

        $result = $this->db->get('users');

        if($result->num_rows() == 1) {
            return $result->row_array();
        } else {
            return false;
        }
    }

    public function login($email)
    {
        // Validate
        $this->db->where('email', $email);

        $result = $this->db->get('users');

        if($result->num_rows() == 1) {
            return $result->row_array();
        } else {
            return false;
        }
    }
}
