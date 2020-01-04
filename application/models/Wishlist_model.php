<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Wishlist_model extends CI_Model
{
    public function createPlan1($plan_data)
    {
        $data = array(
            'title' => $plan_data[0],
            'description' => $plan_data[1],
            'est_cost' => $plan_data[2],
            'goal_date' => $plan_data[3],
            'created_on' => $plan_data[4],
            'save_freq' => $plan_data[5],
            'save_amount' => $plan_data[6],
            'trans_needed' => $plan_data[7],
            'category' => $plan_data[8],
            'status' => 'on_going',
            'user_id' => $this->session->userdata('user_id')
        );

        $this->db->insert('lists', $data);
    }

    public function createPlan2($plan_data)
    {
        $data = array(
            'title' => $plan_data[0],
            'description' => $plan_data[1],
            'est_cost' => $plan_data[2],
            'created_on' => $plan_data[3],
            'category' => $plan_data[4],
            'status' => 'on_going',
            'user_id' => $this->session->userdata('user_id')
        );

        $this->db->insert('lists', $data);
    }

    public function getPlans()
    {
        $this->db->where('user_id', $this->session->userdata('user_id'));

        $result = $this->db->get('lists');

        if ($result->num_rows() > 0) {
            return $result->result_array();
        } else {
            return false;
        }
    }

    public function getOngoingPlans()
    {
        $this->db->order_by('list_id', 'desc');
        $this->db->where('status', 'on_going');
        $this->db->where('user_id', $this->session->userdata('user_id'));

        $result = $this->db->get('lists');

        if ($result->num_rows() > 0) {
            return $result->result_array();
        } else {
            return false;
        }
    }

    public function getCompletedPlans()
    {
        $this->db->order_by('complete_or_cancel_date', 'desc');
        $this->db->where('status', 'completed');
        $this->db->where('user_id', $this->session->userdata('user_id'));

        $result = $this->db->get('lists');

        if ($result->num_rows() > 0) {
            return $result->result_array();
        } else {
            return false;
        }
    }

    public function getCancelledPlans()
    {
        $this->db->order_by('complete_or_cancel_date', 'desc');
        $this->db->where('status', 'cancelled');
        $this->db->where('user_id', $this->session->userdata('user_id'));

        $result = $this->db->get('lists');

        if ($result->num_rows() > 0) {
            return $result->result_array();
        } else {
            return false;
        }
    }

    public function getListDetails($list_id)
    {
        $this->db->where('list_id', $list_id);
        $this->db->where('user_id', $this->session->userdata('user_id'));

        $result = $this->db->get('lists');

        if ($result->num_rows() == 1) {
            return $result->row_array();
        } else {
            return false;
        }
    }

    public function getListIdDetails($list_id)
    {
        $this->db->where('list_id', $list_id);

        $result = $this->db->get('list_details');

        if ($result->num_rows() > 0) {
            return $result->result_array();
        } else {
            return false;
        }
    }

    public function insertListPayment($data)
    {
        $data = array(
            'tr_date' => $data['payment_date'],
            'detail_amount' => $data['detail_amount'],
            'action' => "deposit",
            'list_id' => $data['list_id']
        );

        $this->db->insert('list_details', $data);
    }

    public function withdrawListPayment($data)
    {
        $data = array(
            'tr_date' => $data['tr_date'],
            'detail_amount' => $data['withdraw_amount'],
            'action' => "withdraw",
            'list_id' => $data['list_id']
        );

        $this->db->insert('list_details', $data);
    }

    public function updateTransNeeded($data)
    {
        $newTransNeeded = $data['trans_needed'] - 1;

        $this->db->set('trans_needed', $newTransNeeded);
        $this->db->where('list_id', $data['list_id']);
        $this->db->update('lists');
    }

    public function cancelPlan($list_id, $currentDateTime)
    {
        $this->db->set('status', 'cancelled');
        $this->db->set('complete_or_cancel_date', $currentDateTime);
        $this->db->where('list_id', $list_id);
        $this->db->update('lists');
    }

    public function completedPlan($list_id, $currentDateTime)
    {
        $this->db->set('status', 'completed');
        $this->db->set('complete_or_cancel_date', $currentDateTime);
        $this->db->where('list_id', $list_id);
        $this->db->update('lists');
    }

    public function getCurrentStrictTotal($list_id)
    {
        $this->db->select_sum('detail_amount');
        $this->db->from('list_details');
        $this->db->join('lists', 'lists.list_id = list_details.list_id', 'left');
        $this->db->join('users', 'users.user_id = lists.user_id', 'left');
        $this->db->where('users.user_id', $this->session->userdata('user_id'));
        $this->db->where('lists.list_id', $list_id);
        $this->db->where('lists.category', 'strict');

        $result = $this->db->get();

        if ($result->num_rows() == 1) {
            return $result->row_array();
        } else {
            return false;
        }
    }

    public function getCurrentFlexibleTotalDeposit($list_id)
    {
        $this->db->select_sum('detail_amount');
        $this->db->from('list_details');
        $this->db->join('lists', 'lists.list_id = list_details.list_id', 'left');
        $this->db->join('users', 'users.user_id = lists.user_id', 'left');
        $this->db->where('users.user_id', $this->session->userdata('user_id'));
        $this->db->where('lists.list_id', $list_id);
        $this->db->where('list_details.action', 'deposit');

        $result = $this->db->get();

        if ($result->num_rows() == 1) {
            return $result->row_array();
        } else {
            return false;
        }
    }

    public function getCurrentFlexibleTotalWithdraw($list_id)
    {
        $this->db->select_sum('detail_amount');
        $this->db->from('list_details');
        $this->db->join('lists', 'lists.list_id = list_details.list_id', 'left');
        $this->db->join('users', 'users.user_id = lists.user_id', 'left');
        $this->db->where('users.user_id', $this->session->userdata('user_id'));
        $this->db->where('lists.list_id', $list_id);
        $this->db->where('list_details.action', 'withdraw');

        $result = $this->db->get();

        if ($result->num_rows() == 1) {
            return $result->row_array();
        } else {
            return false;
        }
    }
}
