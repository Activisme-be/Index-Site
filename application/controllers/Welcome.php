<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 */
class Welcome extends CI_Controller
{
    /** @var array $user The authencated user in the application. */
    public $user = [];

    /**
     * Welcome constructor.
     *
     * @param  array $user The authencated user session.
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->library(['blade', 'session']);
        $this->load->helper('url');

        // Param Init
        $this->user = $this->session->userdata('logged_in');
    }

    /**
     * Get the index view for the index page.
     *
     * @see   http://www.doamin.org
     * @return blade view
     */
    public function index()
    {
        $data['title'] = 'Index';
        return $this->blade->render('home', $data);
    }
}
