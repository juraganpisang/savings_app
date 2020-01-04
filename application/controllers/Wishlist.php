<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Wishlist extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'My Wishlists';
        $data['user'] = $this->user_model->getUserData();
        $data['wallet_value'] = $this->getWallet();
        $data['lists'] = $this->wishlist_model->getPlans();
        $data['ongoing'] = $this->wishlist_model->getOngoingPlans();
        $data['completed'] = $this->wishlist_model->getCompletedPlans();
        $data['cancelled'] = $this->wishlist_model->getCancelledPlans();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('wishlist/view_plan', $data);
        $this->load->view('templates/footer');
    }


    public function view_list_details($list_id)
    {
        $data['title'] = 'My Wishlists / List Details';
        $data['user'] = $this->user_model->getUserData();
        $data['wallet_value'] = $this->getWallet();
        //list data
        $data['list_details'] = $this->wishlist_model->getListDetails($list_id);
        if ($data['list_details']['category'] == 'flexible') {
            //get current flexible plan total
            $deposit = $this->wishlist_model->getCurrentFlexibleTotalDeposit($list_id);
            $withdraw = $this->wishlist_model->getCurrentFlexibleTotalWithdraw($list_id);

            if ($withdraw['detail_amount'] == null) {
                $withdraw_amount = 0;
            } else {
                $withdraw_amount = $withdraw['detail_amount'];
            }

            $data['currentTotal'] = $deposit['detail_amount'] - $withdraw_amount;
        } else {
            $deposit = $this->wishlist_model->getCurrentStrictTotal($list_id);

            $data['currentTotal'] = $deposit['detail_amount'];
        }

        //data for history
        $data['list_id_details'] = $this->wishlist_model->getListIdDetails($list_id);

        //count days left until goal date
        $data['day_interval'] = $this->getDayInterval($data['list_details']['goal_date']);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('wishlist/view_list_details', $data);
        $this->load->view('templates/footer');
    }

    public function choose_plan()
    {
        //$ongoingTotal = count($this->wishlist_model->getOngoingPlans());

        $data['title'] = 'Choose a plan';
        $data['user'] = $this->user_model->getUserData();
        $data['wallet_value'] = $this->getWallet();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('wishlist/choose_plan');
        $this->load->view('templates/footer');
    }

    public function create_plan_1()
    {
        $category = "strict";

        $this->form_validation->set_rules('title', 'Title', 'required|trim', [
            'required' => 'title is required!'
        ]);
        $this->form_validation->set_rules('description', 'Description', 'trim');
        $this->form_validation->set_rules('est_cost', 'Estimation Cost', 'required|trim', [
            'required' => 'estimation cost is required!'
        ]);
        $this->form_validation->set_rules('goal_date', 'Goal Date', 'required|trim', [
            'required' => 'goal date is required!'
        ]);

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Create a new strict plan';
            $data['user'] = $this->user_model->getUserData();
            $data['wallet_value'] = $this->getWallet();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('wishlist/create_plan_1');
            $this->load->view('templates/footer');
        } else {
            $title = $this->input->post('title');
            $description = $this->input->post('description');
            if ($description == "") {
                $description = "No description.";
            }

            //omit Rp. from the input
            $est_cost = $this->convToNum(substr($this->input->post('est_cost'), 4));

            //check if the user input is valid
            if ($est_cost > 0) {
                $save_freq = $this->input->post('save_freq');

                //get today's exact date
                $created_on = $this->getExactTodayDate();

                //get the interval between the input and today
                $input_date = $this->input->post('goal_date');
                $goal_date = date('Y-m-d', strtotime($input_date));
                $day_interval = $this->getDayInterval($input_date);

                //var_dump($created_on, $goal_date, $day_interval);
                if ($save_freq == "option4") {
                    $freq_num = $this->input->post('freq_num');
                    $freq_period = $this->input->post('freq_period');
                    $save_freq = $freq_num * $freq_period;
                }

                //count save amount
                $total_save = $day_interval / $save_freq;
                $save_amount = round($est_cost / $total_save);

                //check if valid
                if ($day_interval < $save_freq) {
                    $this->session->set_flashdata('invalidcost', '<div class ="alert alert-danger" role ="alert">
                Saving frequency cannot be greater than the interval period. </div>');

                    $data['title'] = 'Create a new strict plan';
                    $data['user'] = $this->user_model->getUserData();
                    $data['wallet_value'] = $this->getWallet();

                    $this->load->view('templates/header', $data);
                    $this->load->view('templates/sidebar', $data);
                    $this->load->view('templates/topbar', $data);
                    $this->load->view('wishlist/create_plan_1');
                    $this->load->view('templates/footer');
                } else {
                    $plan_data = array(
                        $title, $description, $est_cost, $goal_date,
                        $created_on, $save_freq, $save_amount, $total_save, $category
                    );

                    $this->wishlist_model->createPlan1($plan_data);

                    //update activity
                    $activity_data = array('created a new strict plan', $created_on);
                    $this->activity_model->insertActivity($activity_data);

                    $this->session->set_flashdata('message', '<div class ="alert alert-success" 
                    style="text-align-center" role ="alert">
                Congratulations! You successfully created a new strict plan.</div>');
                    redirect('wishlist');
                }
            } else {
                $this->session->set_flashdata('invalidcost', '<div class ="alert alert-danger" role ="alert">
                Estimated cost is invalid. Check it again. </div>');

                $data['title'] = 'Create a new strict plan';
                $data['user'] = $this->user_model->getUserData();
                $data['wallet_value'] = $this->getWallet();

                $this->load->view('templates/header', $data);
                $this->load->view('templates/sidebar', $data);
                $this->load->view('templates/topbar', $data);
                $this->load->view('wishlist/create_plan_1');
                $this->load->view('templates/footer');
            }
        }
    }

    public function create_plan_2()
    {
        $category = "flexible";

        $this->form_validation->set_rules('title', 'Title', 'required|trim', [
            'required' => 'title is required!'
        ]);
        $this->form_validation->set_rules('description', 'Description', 'trim');
        $this->form_validation->set_rules('est_cost', 'Estimation Cost', 'required|trim');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Create a new flexible plan';
            $data['user'] = $this->user_model->getUserData();
            $data['wallet_value'] = $this->getWallet();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('wishlist/create_plan_2');
            $this->load->view('templates/footer');
        } else {
            $title = $this->input->post('title');
            $description = $this->input->post('description');
            if ($description == "") {
                $description = "No description.";
            }

            //omit Rp. from the input
            $est_cost = $this->convToNum(substr($this->input->post('est_cost'), 4));

            if ($est_cost > 0) {
                //get today's exact date
                $created_on = $this->getExactTodayDate();

                $plan_data = array(
                    $title, $description, $est_cost, $created_on, $category
                );

                $this->wishlist_model->createPlan2($plan_data);

                //update activity
                $activity_data = array('created a new flexible plan', $created_on);
                $this->activity_model->insertActivity($activity_data);

                $this->session->set_flashdata('message', '<div class ="alert alert-success" 
                style="text-align-center" role ="alert">
                Congratulations! You successfully created a new flexible plan.</div>');
                redirect('wishlist');
            } else {
                $this->session->set_flashdata('invalidcost', '<div class ="alert alert-danger" role ="alert">
                Estimated cost is invalid. Check it again. </div>');

                $data['title'] = 'Create a new flexible plan';
                $data['user'] = $this->user_model->getUserData();
                $data['wallet_value'] = $this->getWallet();

                $this->load->view('templates/header', $data);
                $this->load->view('templates/sidebar', $data);
                $this->load->view('templates/topbar', $data);
                $this->load->view('wishlist/create_plan_2');
                $this->load->view('templates/footer');
            }
        }
    }

    public function save_plan($list_id)
    {
        $data['title'] = 'Save for your plan';
        $data['user'] = $this->user_model->getUserData();
        $data['wallet_value'] = $this->getWallet();
        $data['id'] = $list_id;
        $data['list_details'] = $this->wishlist_model->getListDetails($list_id);
        $data['list_title'] = $data['list_details']['title'];

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('wishlist/save_plan', $data);
        $this->load->view('templates/footer');
    }

    public function pay_plan_1($list_id)
    {
        $list_details = $this->wishlist_model->getListDetails($list_id);

        //data needed for payment
        $data['list_id'] = $list_details['list_id'];
        $data['detail_amount'] = $list_details['save_amount'];
        $data['payment_date'] = $this->getExactTodayDate();

        $this->wishlist_model->insertListPayment($data);

        //data needed for updating transaction total
        $data['trans_needed'] = $list_details['trans_needed'];
        $this->wishlist_model->updateTransNeeded($data);

        //update wallet amount
        $this->wallet_model->updateDeposit(
            $list_details['user_id'],
            $this->getWallet(),
            $data['detail_amount']
        );

        //check if plan completed
        $list_details = $this->wishlist_model->getListDetails($list_id);
        //get the trans needed data
        $currentTransNeeded = $list_details['trans_needed'];

        if ($currentTransNeeded == 0) {
            //get current datetime
            $currentDateTime = $this->getExactTodayDate();

            //update plan status to "completed"
            $this->wishlist_model->completedPlan($list_id, $currentDateTime);

            //update activity
            $act = 'completed the plan for ' . $list_details['title'];
            $activity_data = array($act, $currentDateTime);
            $this->activity_model->insertActivity($activity_data);

            //redirect to wishlist and show message
            $this->session->set_flashdata(
                'message',
                '<div class ="alert alert-success" style="text-align-center" role ="alert">
                Congratulations. Your saving plan has been completed!
                <a href="wishlist/view_list_details/' . $list_id . '">
                See details.
                </a>
                </div>'
            );
            redirect('wishlist');
        } else {
            $currentDateTime = $this->getExactTodayDate();
            //update activity
            $act = 'made a deposit  for ' . $list_details['title'];
            $activity_data = array($act, $currentDateTime);
            $this->activity_model->insertActivity($activity_data);

            //redirect to wishlist and show message
            $this->session->set_flashdata(
                'message',
                '<div class ="alert alert-success" style="text-align-center" role ="alert">
                Payment successful!
                <a href="wishlist/view_list_details/' . $list_id . '">
                See details.
                </a>
                </div>'
            );
            redirect('wishlist');
        }
    }

    public function pay_plan_2($list_id)
    {
        $list_details = $this->wishlist_model->getListDetails($list_id);

        //data needed for payment
        $data['list_id'] = $list_details['list_id'];
        $data['detail_amount'] = $this->convToNum(substr($this->input->post('est_cost'), 4));

        if ($data['detail_amount'] > 0) {
            $data['payment_date'] = $this->getExactTodayDate();

            $this->wishlist_model->insertListPayment($data);

            //update wallet amount
            $this->wallet_model->updateDeposit(
                $list_details['user_id'],
                $this->getWallet(),
                $data['detail_amount']
            );

            //get current flexible plan total
            $deposit = $this->wishlist_model->getCurrentFlexibleTotalDeposit($list_id);
            $withdraw = $this->wishlist_model->getCurrentFlexibleTotalWithdraw($list_id);

            if ($withdraw['detail_amount'] == null) {
                $withdraw_amount = 0;
            } else {
                $withdraw_amount = $withdraw['detail_amount'];
            }

            $currentTotal = $deposit['detail_amount'] - $withdraw_amount;

            //var_dump($currentTotal);
            //get estimated cost
            $estimated_cost = $list_details['est_cost'];

            if ($currentTotal == $estimated_cost || $currentTotal >= $estimated_cost) {
                //get current datetime
                $currentDateTime = $this->getExactTodayDate();

                //update plan status to "completed"
                $this->wishlist_model->completedPlan($list_id, $currentDateTime);

                //update activity
                $act = 'completed the plan for ' . $list_details['title'];
                $activity_data = array($act, $currentDateTime);
                $this->activity_model->insertActivity($activity_data);

                //redirect to wishlist and show message
                $this->session->set_flashdata(
                    'message',
                    '<div class ="alert alert-success" style="text-align-center" role ="alert">
                    Congratulations. Your saving plan has been completed!
                    <a href="wishlist/view_list_details/' . $list_id . '">
                    See details.
                    </a>
                    </div>'
                );
                redirect('wishlist');
            } else {
                //update activity
                $currentDateTime = $this->getExactTodayDate();
                $act = 'made a deposit  for ' . $list_details['title'];
                $activity_data = array($act, $currentDateTime);
                $this->activity_model->insertActivity($activity_data);

                //redirect to wishlist and show message
                $this->session->set_flashdata(
                    'message',
                    '<div class ="alert alert-success" style="text-align-center" role ="alert">
                    Payment successful!
                    <a href="wishlist/view_list_details/' . $list_id . '">
                    See details.
                    </a>
                    </div>'
                );
                redirect('wishlist');
            }
        } else {
            $this->session->set_flashdata(
                'invalidamount',
                '<div class ="alert alert-danger" style="text-align-center" role ="alert">
                Saving amount is invalid. Check it again. 
                </div>'
            );
            redirect('wishlist/save_plan/' . $list_id);
        }
    }

    public function cancel_plan($list_id)
    {
        $currentDateTime = $this->getExactTodayDate();

        $this->wishlist_model->cancelPlan($list_id, $currentDateTime);

        //update activity
        $activity_data = array('cancelled a plan', $currentDateTime);
        $this->activity_model->insertActivity($activity_data);

        $this->session->set_flashdata(
            'message',
            '<div class ="alert alert-success" style="text-align-center" role ="alert">
            Plan successfully cancelled.
            <a href="wishlist/view_list_details/' . $list_id . '">
            See details.
            </a>
            </div>'
        );
        redirect('wishlist');
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

    public function getDayInterval($date)
    {
        $today = date('Y-m-d');

        $datetime1 = new DateTime($date);
        $datetime2 = new DateTime($today);
        $day_interval = $datetime2->diff($datetime1)->days;

        return $day_interval;
    }

    public function getExactTodayDate()
    {
        //get today's exact date
        $offset = 7 * 60 * 60; //converting 7 hours to seconds. / (GMT+7)
        $dateFormat = "Y-m-d H:i:s";
        $now = gmdate($dateFormat, time() + $offset);

        return $now;
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
}
