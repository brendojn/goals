<?php

class recoveryController extends controller
{

    public function __construct()
    {
        $u = new User();
        $u->verifyLogin();
    }

    public function index()
    {
        $data = array();

        $r = new Recovery();

        $data['recoveries'] = $r->getRecoveries();

        $this->loadTemplate('recoveries', $data);
    }
}
