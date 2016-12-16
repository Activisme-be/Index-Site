<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends MY_Controller
{
    public function __constrcut()
    {
        parent::__constrcut();
        $this->load->library(['form_validation', 'session']);
    }

    public function index()
    {
        $this->form_validation->set_rules();
        $this->form_validation->set_rules();
        $this->form_validation->set_rules();

        if ($this->form_validation->run()) { // Validation fails

        } else { // Validation fails
            $class   = 'alert alert-danger';
            $message = 'Wij konden de invoer niet verwerken';
        }

        $this->session->set_flashdata('class', $class);
        $this->session->set_flashdata('message', $message);
    }
}
