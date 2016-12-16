<?php defined('BASEPATH') or exit ('No direct script access allowed');

/**
 * Events controller.
 *
 * @author      Tim Joosten
 * @license     MIT License
 * @since       2016
 * @package     Activisme-BE Index Site
 */
class Events extends MY_Controller
{
    /**
     * Events Constructor
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return blade view.
     */
    public function index()
    {

    }

    /**
     * Show a specific event.
     *
     * @url    GET|HEAD:
     * @return blade view.
     */
    public function show()
    {

    }

    /**
     * Create a new event.
     *
     * 
     * @return blade view.
     */
    public function create()
    {

    }

    /**
     * @return blade view.
     */
    public function edit()
    {

    }

    /**
     * @return redirect|response
     */
     public function update()
     {

     }

    /**
     * @return redirect|response
     */
    public function store()
    {
        if ($this->form_validation->run() === false) { // Validation fails
            $class   = 'alert alert-danger';
            $message = lang('event-store-error');
        } else { // Validation passes
            $input['date']        = $this->input->post('date');
            $input['description'] = $this->input->post('description');

            if (Event::create($input)) { // The event has been created.
                $class   = 'alert alert-success';
                $message = lang('event-store-success');
            }
        }

        // Set the flash message.
        $this->session->set_flashdata('class', $class);
        $this->session->set_flashdata('message', $message);

        // Redirect
        return redirect($_SERVER['HTTP_REFERER']);
    }

    /**
     * @return redirect|response
     */
    public function destroy()
    {
        $eventId = $this->uri->segment(3);

        if (Event::destroy($eventId)) { // Event is deleted.
            $this->session->set_flashdata('class', 'alert alert-success');
            $this->session->set_flashdata('message', lang('even-delete-success'));
        }

        return redirect($_SERVER['HTTP_REFERER']);
    }
}
