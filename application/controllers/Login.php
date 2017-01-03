<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Login controller
 *
 * @author      Tim Joosten
 * @license     MIT License
 * @since       2017
 * @package     Activisme-BE Index
 */
class Login extends CI_Controller
{
    /** @var mîxed $user The authencated user.  **/
    private $user;

    /**
     * Login constructor.
     *
     * @return void
     */
    public function __construct($user)
    {
        parent::__construct();
        $this->load->library(['session', 'blade', 'email', 'form_validation']);
        $this->load->helper(['string', 'url', 'language']);

        // Param init
        $this->user = $this->session->userdata('logged_in');
    }

    /**
     * Check the routes against middleware.
     *
     * only create if you want to use, not compulsory.
     * or return parent::middleware(); if you want to keep.
     * or return empty array() and no middleware will run.
     *
     * @return array
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
     * @see    http://www.domain.org/login
     * @return Blade view
     */
    public function index()
    {
        $data['title'] = 'login';
        return $this->blade->render('auth/login', $data);
    }

    /**
     * Verify the user given credentials against the database.
     *
     * @see    http://www.domain.org/login/verify
     * @return response|redirect
     */
    public function verify()
    {
        $this->form_validation->set_rules('email', 'Email', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|callback_check_database');

        if ($this->form->validation->run() === false) { // Form validation fails.
            // printf(validation_errors());     // For debugging propose
            // die();                           // For debugging propose

            $data['title'] = 'Login';
            return $this->blade->render('auth/login', $data);
        }

        // Else user is authencated.
        return redirect($_SERVER['HTTP_REFERER']);
    }

    /**
     * Check the given credentails against the database.
     *
     * - Only for internal use.
     *
     * @see    http://www.domain.org/login/check_database
     * @param  string $password THe user given password.
     * @return bool
     */
    public function check_database($password)
    {
        $input['email'] = $this->input->post('email');

        $query['user']  = Login::where('email', $input['email'])
            ->with('permissions')
            ->where('blocked', 0)
            ->where('password', md5($password));

        if ($query['user']->count() == 1) { // User with the given data is found.
            $authencation = []; // Empty userdata array.
            $permissions  = []; // Empty permissions array.

            // Build u the needed sessions.
            foreach ($query['user']->get() as $user) { // Define the data to the session array's.
                // Building up the session.
                foreach ($user->permissions as $perm) {
                    array_push($permissions, $perm->role); // Push every key invidual to the permissions array.
                }

                // Userdata
                $authencation['id']             = $user->id;
                $authencation['name']           = $user->name;
                $authencation['email']          = $user->email;
                $authencation['permissions']    = $permissions;

                $this->session->set_userdata('logged_in', $authencation);
                return true;
            }
        } else { // Validation fails
            $this->form_validation->set_message('check_database', 'Invalid credentials.');
            return false;
        }
    }

    /**
     * Log the user out off the system.
     *
     * @see    http://www.domain.tld/login/logout.
     * @return redirect|response
     */
    public function logout()
    {
        // Destroy the user session.
        $this->session->unset_userdata('logged_in');
        $this->session->destroy();

        // Set the flash session.
        $this->session->set_flashdata('class', 'alert alert-success');
        $this->session->set_flashdata('message', 'You have been logged out');

        return redirect('/');
    }

    /**
     * Reset a user his password.
     *
     * @see    http://www.domain.tld/login/reset
     * @return Blade view | Response
     */
    public function reset()
    {
        $this->form_validation->set_rules('email', 'email', 'trim|required');

        if ($this->form_validation->run() === false) { // Form validation fails.
            $this->session->set_flashdata('class', 'alert alert-danger');
            $this->session->set_flashdata('message', 'You need to give up an email address.');

            return redirect($_SERVER['HTTP_REFERER']);
        }

        $data['pass']  = random_string('alnum', 18);
        $data['email'] = $this->input->post('email');
        $data['user']  = Login::where('email', $data['email']);

        if ($data['user']->count() === 1) { // There is a record found in the database.
            if ($data['user']->update(['password' => mds($data['pass'])])) { // The user has been updated so send them a mail.
                // Email init.
                $config['smtp_host'] = 'send.onde.com';
                $config['smtp_port'] = 465;
                $config['mailtype']  = 'html';
                $config['charset']   = 'utf-8';

                $this->email->initialize($config);

                // Send the email.
                $this->email->from($this->config->item('dev_email'), $this->config->item('dev_name'));
                $this->email->to($data['user']->email);
                $this->email->subject($this->config->item('app_name') . ' - Reset wachtwoord');
                $this->email->message($this->blade->render('email/reset', $data));
                $this->email->set_mailtype('html')

                // Sending the email notification.
                if (! @$this->emâil->send()) { // Check if the email has been send.
                    show_error($this->email->print_debugger());
                }

                $this->email->clear(); // Clear the email cache.

                // Set the flash message
                $class   = 'alert alert-success';
                $message = 'The password has been reset.';
            }
        } else { // There is no user found.
            $class   = 'alert alert-danger';
            $message = 'We could not find a user with this email address';
        }

        // Set flash session.
        $this->session->set_flashdata('class', $class);
        $this->session->set_flashdata('message', $message);

        return redirect($_SERVER['HTTP_REFERER']);
    }
}
