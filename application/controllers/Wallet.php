<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Wallet extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'My Wallet';
        $data['user'] = $this->user_model->getUserData();
        $data['wallet_value'] = $this->getWallet();
        $data['deposit_activities'] = $this->activity_model->getWalletDepositActivities();
        $data['withdraw_activities'] = $this->activity_model->getWalletWithdrawActivities();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('wallet/index', $data);
        $this->load->view('templates/footer');
    }

    public function withdraw()
    {
        $data['wallet_details'] = $this->wallet_model->getWalletAmountDetails();

        $data['title'] = 'My Wallet / Withdraw';
        $data['user'] = $this->user_model->getUserData();
        $data['wallet_value'] = $this->getWallet();
        $data['choice'] = "all status";

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('wallet/withdraw', $data);
        $this->load->view('templates/footer');
    }

    public function choose_status()
    {
        $status_choice = $this->input->post('select_status');

        $data['wallet_details'] = $this->wallet_model->getWalletAmountDetailsOnStatus($status_choice);
        $data['wallet_withdrawn'] = $this->wallet_model->getWalletAmountDetailsOnStatusWithdraw($status_choice);

        //var_dump($data['wallet_details'], $data['wallet_withdrawn']);
        $data['title'] = 'My Wallet / Withdraw';
        $data['user'] = $this->user_model->getUserData();
        $data['wallet_value'] = $this->getWallet();
        $data['choice'] = $status_choice;

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('wallet/withdraw', $data);
        $this->load->view('templates/footer');
    }

    public function confirm_withdraw($list_id)
    {
        $data['wallet_id_details'] = $this->wallet_model->getWalletIdDetailsDeposit($list_id);
        $data['wallet_id_details_withdraw'] = $this->wallet_model->getWalletIdDetailsWithdraw($list_id);

        if ($data['wallet_id_details_withdraw']['detail_amount'] == null) {
            $data['wallet_id_details_withdraw']['detail_amount'] = 0;
        }

        //var_dump($data['wallet_id_details_withdraw'], $data['wallet_id_details']);
        if ($data['wallet_id_details']['status'] == 'on_going' && $data['wallet_id_details']['category'] == 'strict') {
            $this->session->set_flashdata(
                'message',
                '<div class ="alert alert-danger" style="text-align-center" role ="alert">
            Sorry! You cannot withdraw from on-going strict plans.. 
            </div>'
            );
            redirect('wallet/withdraw');
        } else {
            $data['title'] = 'My Wallet / Withdraw / Confirm';
            $data['user'] = $this->user_model->getUserData();
            $data['wallet_value'] = $this->getWallet();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('wallet/confirm_withdraw', $data);
            $this->load->view('templates/footer');
        }
    }

    public function ok_withdraw($list_id)
    {
        $data['wallet_id_details'] = $this->wallet_model->getWalletIdDetailsDeposit($list_id);
        $data['wallet_id_details_withdraw'] = $this->wallet_model->getWalletIdDetailsWithdraw($list_id);

        if ($data['wallet_id_details_withdraw']['detail_amount'] == null) {
            $data['wallet_id_details_withdraw']['detail_amount'] = 0;
        }

        $saving_goal = $data['wallet_id_details']['est_cost'];
        $saved_total = $data['wallet_id_details']['detail_amount'] - $data['wallet_id_details_withdraw']['detail_amount'];
        $withdraw_amount = $this->convToNum(substr($this->input->post('est_cost'), 4));

        if ($withdraw_amount > 0) {
            if ($withdraw_amount > $saved_total) {
                $this->session->set_flashdata(
                    'invalidamount',
                    '<div class ="alert alert-danger" style="text-align-center" role ="alert">
                    Withdraw amount cannot be greater than the saved total.
                    </div>'
                );
                redirect('wallet/confirm_withdraw/' . $list_id);
            } else {
                //update list details
                $withdraw_data = array(
                    'tr_date' => $this->getExactTodayDate(),
                    'list_id' => $list_id,
                    'withdraw_amount' => $withdraw_amount
                );
                $this->wishlist_model->withdrawListPayment($withdraw_data);

                //update activity
                $currentDateTime = $this->getExactTodayDate();
                $act = 'withdrew from ' . $data['wallet_id_details']['title'];
                $activity_data = array($act, $currentDateTime);
                $this->activity_model->insertActivity($activity_data);

                //update wallet amount
                $this->wallet_model->updateWithdraw(
                    $this->session->userdata('user_id'),
                    $this->getWallet(),
                    $withdraw_amount
                );

                //show message and redirect to wallet
                $this->session->set_flashdata(
                    'message',
                    '<div class ="alert alert-success" style="text-align-center" role ="alert">
                    Congratulations. You have successfully withdrewn some money.
                    </div>'
                );
                redirect('wallet');
            }
        } else {
            $this->session->set_flashdata(
                'invalidamount',
                '<div class ="alert alert-danger" style="text-align-center" role ="alert">
                Withdraw amount is invalid. Check it again. 
                </div>'
            );
            redirect('wallet/confirm_withdraw/' . $list_id);
        }
    }

    public function getWallet()
    {
        $wallet_value = $this->wallet_model->getUserWalletValue();
        if ($wallet_value['amount'] != null) {
            return $wallet_value['amount'];
        } else {
            return 0;
        }
    }

    public function convToNum($input)
    {
        //remove Rp.
        $sub = filter_var($input, FILTER_SANITIZE_NUMBER_INT);
        if (is_numeric($sub)) {
            $divide = $sub / 100;

            return $divide;
        } else {
            return 0;
        }
    }

    public function getExactTodayDate()
    {
        //get today's exact date
        $offset = 7 * 60 * 60; //converting 7 hours to seconds. / (GMT+7)
        $dateFormat = "Y-m-d H:i:s";
        $now = gmdate($dateFormat, time() + $offset);

        return $now;
    }
}
