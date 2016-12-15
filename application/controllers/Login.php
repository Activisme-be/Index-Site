<?php defined('BASEPATH') or exit ('No direct script access allowed');

/**
 * Login controller.
 *
 * @author      Tim Joosten
 * @license     MIT License
 * @since       2016
 * @package     Activisme-BE Index Site
 */
class Login extends MY_Controller
{
    // FIXME: Add translation files. TO get the flash session work.
    // FIXME: Add login view to the system.
    // FIXME: Add authencation create view.
    // FIXME: Add the logged in middleware.

    /**
     * Authencated user session.
     *
     * @var array
     */
    public $User = [];

    /**
     * Login constructor.
     *
     * @return void.
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->library(['session', 'blade', 'form_validation']);
        $this->load->helper(['string', 'url', 'language']);

        $this->User = $this->session->userdata('logged_in');
    }

    /**
     * only create if you want to use, not compulsory.
     * or return parent::middleware(); if you want to keep.
     * or return empty array() and no middleware will run.
     */
    protected function middleware()
    {
        /**
         * Return the list of middlewares you want to be applied,
         * Here is list of some valid options
         *
         * admin_auth                    // As used below, simplest, will be applied to all
         * someother|except:index,list   // This will be only applied to posts()
         * yet_another_one|only:index    // This will be only applied to index()
         **/
        return [];
    }

    /**
     * Get the login page.
     *
     * @url     GET|HEAD: http://www.domain.org/login
     * @return  blade view
     */
    public function index()
    {
        return $this->blade->render('auth/login');
    }

    /**
     * @return redirect|response
     */
    public function verify()
    {
        $this->form_validation->set_rules('email', 'Email', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|callback_check_database');

        if ($this->form_validation->run() === false) { // Validation fails.
            // printf(Validation_errors())  // For debugging propose
            // die();                       // For debugging propose

            $data['title'] = 'Login';
            return $this->blade->render('auth/login', $data);
        } else { // Validation Passes
            return redirect('/backend');
        }
    }

    /**
     * Check the given input against the database.
     *
     * @param  string $password The user given password
     * @return bool
     */
    public function check_database($pasword)
    {
        $input['email'] = $this->input->post('email');

        $query = Login::where('email', $input['email'])
            ->with('permissions')
            ->where('blocked', 0)
            ->where('password', md5($password));

        if ($query->count() == 1) { // Result is found and now we can build up the session.

        } else { // There are no user found with the given data.
            $this->form_validation->set_message('check_database', lang('error-wrong-credentials'));
            return false;
        }
    }

    /**
     * @return redirect|response
     */
    public function logout()
    {

    }

    /**
     * @return redirect|response
     */
    public function reset()
    {
        if ($this->form_validation->run() === false) { // Form validation fails

        } else { // Form validation passes.

        }
    }

    /**
     * Get the creation view for a new login.
     *
     * @url    GET|HEAD: http://domain.org/login/create
     * @return blade view.
     */
    public function create()
    {
        return $this->blade->render('auth/create');
    }

    /**
     * Register new user.
     *
     * @url    POST: http://www.domain.tld/login/register
     * @return redirect|response
     */
    public function register()
    {
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required');
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() === false) { // Validation fails
            $class   = 'alert alert-danger';
            $message = lang('flash-register-error');
        } else { // Validation passes
            $input['name']     = $this->input->post('name');
            $input['username'] = $this->input->post('username');
            $input['email']    = $this->input->post('email');
            $input['password'] = md5($this->input->post('password'));
            $input['blocked']  = 0;

            if (Login::create($input)) { // The user has been created.
                $class   = 'alert alert-success';
                $message = lang('flash-register-success');
            }
        }

        // Set the flash message.
        $this->session->set_flashdata('class', $class);
        $this->session->set_flashdata('message', $message);

        return redirect($_SERVER['HTTP_REFERER']);
    }

    /**
     * Delete a user out off the system.
     *
     * @url    GET|HEAD: http://www.domain.tld/login/delete/{id}
     * @return redirect|response
     */
    public function delete()
    {
        $userId = $this->uri->segment(3);

        if (Login::destroy($userId)) { // The user is deleted out off the system.
            $this->session->set_flashdata('class', 'alert alert-success');
            $this->session->set_flashdata('message', 'De login us verwijderd.');
        }
    }
}
