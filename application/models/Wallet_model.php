<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Wallet_model extends CI_Model
{
    public function initUserWallet($user_id)
    {
        // User data array
        $data = array(
            'user_id' => $user_id,
            'amount' => 0
        );

        // Insert user
        $this->db->insert('wallets', $data);
    }

    public function getUserWalletValue()
    {
        //get all deposits
        $this->db->select_sum('amount');
        $this->db->where('user_id', $this->session->userdata('user_id'));

        $result = $this->db->get('wallets');

        if ($result->num_rows() == 1) {
            return $result->row_array();
        } else {
            return false;
        }
    }

    public function updateDeposit($user_id, $currentAmount, $amount)
    {
        $newAmount = $currentAmount + $amount;

        $this->db->set('amount', $newAmount);
        $this->db->where('user_id', $user_id);
        $this->db->update('wallets');
    }

    public function updateWithdraw($user_id, $currentAmount, $amount)
    {
        $newAmount = $currentAmount - $amount;

        $this->db->set('amount', $newAmount);
        $this->db->where('user_id', $user_id);
        $this->db->update('wallets');
    }

    public function getWalletValue()
    {
        //get all deposits
        $this->db->select_sum('detail_amount');
        $this->db->from('list_details');
        $this->db->join('lists', 'lists.list_id = list_details.list_id', 'left');
        $this->db->join('users', 'users.user_id = lists.user_id', 'left');
        $this->db->where('users.user_id', $this->session->userdata('user_id'));
        $this->db->where('list_details.action', 'deposit');

        $result = $this->db->get();

        if ($result->num_rows() == 1) {
            return $result->row_array();
        } else {
            return false;
        }
    }

    public function getWalletAmountDetailsW()
    {
        $this->db->select('lists.list_id');
        $this->db->select('lists.title');
        $this->db->select('lists.est_cost');
        $this->db->select('lists.status');
        $this->db->select('lists.category');
        $this->db->select_sum('list_details.detail_amount');
        $this->db->from('list_details');
        $this->db->join('lists', 'lists.list_id = list_details.list_id', 'left');
        $this->db->join('users', 'users.user_id = lists.user_id', 'left');
        $this->db->where('users.user_id', $this->session->userdata('user_id'));
        $this->db->where('list_details.action', 'withdraw');
        $this->db->group_by('lists.list_id');

        $result = $this->db->get();

        if ($result->num_rows() > 0) {
            return $result->result_array();
        } else {
            return false;
        }
    }

    public function getWalletAmountDetails()
    {
        $this->db->select('lists.list_id');
        $this->db->select('lists.title');
        $this->db->select('lists.est_cost');
        $this->db->select('lists.status');
        $this->db->select('lists.category');
        $this->db->select_sum('list_details.detail_amount');
        $this->db->from('list_details');
        $this->db->join('lists', 'lists.list_id = list_details.list_id', 'left');
        $this->db->join('users', 'users.user_id = lists.user_id', 'left');
        $this->db->where('users.user_id', $this->session->userdata('user_id'));
        $this->db->where('list_details.action', 'deposit');
        $this->db->order_by('lists.list_id', 'desc');
        $this->db->group_by('lists.list_id');

        $result = $this->db->get();

        if ($result->num_rows() > 0) {
            return $result->result_array();
        } else {
            return false;
        }
    }


    public function getWalletIdDetailsDeposit($list_id)
    {
        $this->db->select('lists.list_id');
        $this->db->select('lists.title');
        $this->db->select('lists.est_cost');
        $this->db->select('lists.status');
        $this->db->select('lists.category');
        $this->db->select_sum('list_details.detail_amount');
        $this->db->from('list_details');
        $this->db->join('lists', 'lists.list_id = list_details.list_id', 'left');
        $this->db->join('users', 'users.user_id = lists.user_id', 'left');
        $this->db->where('users.user_id', $this->session->userdata('user_id'));
        $this->db->where('list_details.action', 'deposit');
        $this->db->where('lists.list_id', $list_id);

        $result = $this->db->get();

        if ($result->num_rows() == 1) {
            return $result->row_array();
        } else {
            return false;
        }
    }

    public function getWalletIdDetailsWithdraw($list_id)
    {
        $this->db->select_sum('list_details.detail_amount');
        $this->db->from('list_details');
        $this->db->join('lists', 'lists.list_id = list_details.list_id', 'left');
        $this->db->join('users', 'users.user_id = lists.user_id', 'left');
        $this->db->where('users.user_id', $this->session->userdata('user_id'));
        $this->db->where('list_details.action', 'withdraw');
        $this->db->where('lists.list_id', $list_id);

        $result = $this->db->get();

        if ($result->num_rows() == 1) {
            return $result->row_array();
        } else {
            return false;
        }
    }

    public function getWalletAmountDetailsOnStatus($status)
    {
        $this->db->select('lists.list_id');
        $this->db->select('lists.title');
        $this->db->select('lists.est_cost');
        $this->db->select('lists.category');
        $this->db->select_sum('list_details.detail_amount');
        $this->db->from('list_details');
        $this->db->join('lists', 'lists.list_id = list_details.list_id', 'left');
        $this->db->join('users', 'users.user_id = lists.user_id', 'left');
        $this->db->where('users.user_id', $this->session->userdata('user_id'));
        $this->db->where('list_details.action', 'deposit');
        $this->db->where('lists.status', $status);
        $this->db->group_by('lists.list_id');

        $result = $this->db->get();

        if ($result->num_rows() > 0) {
            return $result->result_array();
        } else {
            return false;
        }
    }

    public function getWalletAmountDetailsOnStatusWithdraw($status)
    {
        $this->db->select_sum('list_details.detail_amount');
        $this->db->from('list_details');
        $this->db->join('lists', 'lists.list_id = list_details.list_id', 'left');
        $this->db->join('users', 'users.user_id = lists.user_id', 'left');
        $this->db->where('users.user_id', $this->session->userdata('user_id'));
        $this->db->where('list_details.action', 'withdraw');
        $this->db->where('lists.status', $status);
        $this->db->group_by('lists.list_id');

        $result = $this->db->get();

        if ($result->num_rows() > 0) {
            return $result->result_array();
        } else {
            return false;
        }
    }
}
