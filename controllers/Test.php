<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        echo "function index";
    }

    public function push($queue, $msg) {
        push($queue, $msg);
    }

    public function pull($msg) {
        pull($msg);
    }

}

/* End of file Test.php */