<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller
{
    // only create if you want to use, not compulsory.
    // or return parent::middleware(); if you want to keep.
    // or return empty array() and no middleware will run.
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

    public function index()
    {
        $this->load->view('welcome_message');
    }
}
