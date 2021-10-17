<?php
defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Welcome extends RestController
{



    public function index()
    {
        $this->load->view('welcome_message');
    }
}
