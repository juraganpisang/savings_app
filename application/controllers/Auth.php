<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function index()
    {
        $data['title'] = 'Login';

        $this->load->view('templates/auth_header', $data);
        $this->load->view('auth/login');
        $this->load->view('templates/auth_footer');
    }

    public function login()
    {
        $this->form_validation->set_rules('email', 'Email', 'required|trim', [
            'required' => 'email is required!'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'trim|required', [
            'required' => 'password is required!'
        ]);

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Login';

            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/login');
            $this->load->view('templates/auth_footer');
        } else {
            // Get username
            $email = $this->input->post('email');
            // Get and encrypt the password
            $password = $this->input->post('password');

            // Login user
            $user = $this->auth_model->login($email);

            if ($user) {
                if (password_verify($password, $user['password'])) {
                    // Create session
                    $user_data = array(
                        'user_id' => $user['user_id'],
                        'role_id' => $user['role_id']
                    );

                    $this->session->set_userdata($user_data);

                    redirect('user');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong password!</div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Login invalid!</div>');
                redirect('auth');
            }
        }
    }

    public function register()
    {
        $data['title'] = 'Registration';

        $this->form_validation->set_rules('fname', 'Full Name', 'required|trim', [
            'required' => 'full name is required!'
        ]);
        $this->form_validation->set_rules(
            'email',
            'Email',
            'required|trim|valid_email|is_unique[users.email]',
            [
                'is_unique' => 'this email has already been registered!',
                'required' => 'email is required!',
                'valid_email' => 'email is invalid!'
            ]
        );
        $this->form_validation->set_rules(
            'password1',
            'Password',
            'required|trim|min_length[5]|matches[password2]',
            [
                'matches' => 'passwords don\'t match!',
                'min_length' => 'password is too short!',
                'required' => 'password is required!'
            ]
        );
        $this->form_validation->set_rules('password2', 'Repeat Password', 'required|trim|matches[password1]',[
            'required' => 'repeat password is required!'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/register');
            $this->load->view('templates/auth_footer');
        } else {
            // Encrypt password
            $enc_password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
            $email = $this->input->post('email');

            $register_data = array(
                'username' => $this->input->post('fname'),
                'email' => $email,
                'password' => $enc_password
            );

            $this->auth_model->register($register_data);

            //initialize wallet
            $user_id = $this->auth_model->getUserId($email);
            
            $this->wallet_model->initUserWallet($user_id['user_id']);

            // Set message
            $this->session->set_flashdata('message', '<div class="alert alert-info" role="alert">You are now registered and can log in</div>');

            redirect('auth');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('role_id');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">You have been logged out!</div>');
        redirect('auth');
    }
}
