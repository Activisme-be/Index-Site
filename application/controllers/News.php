<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 *
 */
class News extends CI_Controller
{
    /**
     * News constructor
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
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
     *
     *
     * @see
     * @return
     */
    public function index()
    {

    }

    /**
     * Delete a article out of the database.
     *
     * @see     http://www.domain.tld/news/destroy
     * @return  redirect|response
     */
    public function destroy()
    {
        $newsId = $this->uri->segment(3);

        if (News::destroy($newsId)) { // The article is destroyed.
            $this->session->set_flashdata('class', 'alert alert-success');
            $this->session->set_flashdata('message', 'The article has been deleted');
        }

        return redirect($_SERVER['HTTP_REFERER']);
    }

    /**
     * Insert view for a new blog post.
     *
     * @see
     * @return
     */
    public function insert()
    {

    }

    /**
     * Store a new news item in the database.
     *
     * @see
     * @return response | redirect
     */
    public function store()
    {
        $this->form_validation->set_rules('title', 'Title', 'trim|required');
        $this->form_validation->set_rules('heading', 'Heading', 'trim|required');

        if ($this->form_validation->run() === false) { // Validation fails.
            $data['title'] = 'Create news post.';
            return $this->blade->render('', $data);
        }

        $input['title']      = $this->input->post('title');
        $input['sub_title']  = $this->input->post('sub_title');
        $input['message']    = $this->input->post('message');
        $input['author_id']  = $this->user['id'];

        // PDO database handlings.
        $db['insert']   = News::create($input);
        $db['relation'] = News::find($db['insert']->id)->author()->sync($input['author_id']);

        if ($db['insert'] && $db['relation']) {
            $this->session->set_flashdata('class', 'alert alert-success');
            $this->session->set_flashdata('message', 'The news post has been created');

            return redirect($_SERVER['HTTP_REFERER'])
        }
    }

    /**
     * Edit view for a news item.
     *
     * @see    http://www.doamin.tld/news/edit/{id}
     * @return Blade view.
     */
    public function edit()
    {
        $newsId = $this->uri->segment(3);

        $data['title'] = 'Edit news item.';
        $data['item']  = News::find($newsId);

        return $this->blade->render('', $data);
    }

    /**
     * Update a news item in the database.
     *
     * @see
     * @return
     */
    public function update()
    {
        if ($this->form_validation->run() == false) { // Form validation fails
            $data['title'] = 'Edit news item.';
            return $this->blade->render('', $data);
        }

        return redirect($_SERVER['HTTP_REFERER']);
    }
}
