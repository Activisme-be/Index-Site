<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Welcome
 */
class Welcome extends CI_Controller
{
    /**
     * Welcome constructor.
     *
     * @return void.
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->library(['blade']);
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
     * Get thee index view for the website.
     *
     * @url    http://www.domain.tld
     * @return blade response.
     */
    public function index()
    {
        return $this->blade->render('home');
    }
}
