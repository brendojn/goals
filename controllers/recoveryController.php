<?php

class recoveryController extends controller
{

    public function __construct()
    {
        $u = new User();
        $u->verifyLogin();
        $u->permissionPage();
    }

    public function index()
    {
        $data = array();

        $r = new Recovery();
        $c = new Configuration();

        $data['configs'] = $c->getConfigs();
        $data['recoveries'] = $r->getRecoveries();

        $this->loadTemplate('recoveries', $data);
    }
}
