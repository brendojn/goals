<?php

class homeController extends controller
{

    public function __construct()
    {
        $u = new User();
        $u->verifyLogin();
    }

    public function index()
    {
        $data = array();
        $u = new User();

        $data['lead'] = $u->isLead();

        $this->loadTemplate('index', $data);
    }

}