<?php

class dutysController extends controller
{

    public function __construct()
    {
        $u = new User();
        $u->verifyLogin();
    }

    public function index()
    {
        $data = array();

        $d = new Duty();
        $p = new Payment();
        $e = new Employee();

        $filters = array(
            'employee' => '',
            'status' => ''
        );

        if (isset($_GET['filters'])) {
            $filters = $_GET['filters'];
        }

        $total_dutys = $d->getTotalDutys($filters);

        $p = 1;
        if (isset($_GET['p']) && !empty($_GET['p'])) {
            $p = addslashes($_GET['p']);
        }

        $per_page = 6;
        $total_pages = ceil($total_dutys / $per_page);

        $dutys = $d->getDutys($p, $per_page, $filters);

        $data['total_dutys'] = $total_dutys;
        $data['dutys'] = $dutys;
        $data['employees'] = $e->getEmployees();
        $data['filters'] = $filters;
        $data['total_pages'] = $total_pages;

        $this->loadTemplate('dutys', $data);
    }

    public function add()
    {
        $data = array();

        $d = new Duty();
        $e = new Employee();

        if (isset($_POST['week']) && !empty($_POST['week'])) {
            $week = addslashes($_POST['week']);
            $employee = addslashes($_POST['employee']);

            $data['erro'] = $d->createDuty($employee, $week);
        }

        $data['employees'] = $e->getEmployees();

        $this->loadTemplate('add-dutys', $data);
    }

    public function delete()
    {
        $d = new Duty();

        if (isset($_GET['week']) && !empty($_GET['week'])) {
            $d->deleteDuty($_GET['week']);
        }

        header("Location: " . BASE_URL . "dutys");
    }

    public function edit($id)
    {
        $data = array();

        $d = new Duty();
        $e = new Employee();

        if (isset($_POST['employee']) && !empty($_POST['employee'])) {
            $employee = addslashes($_POST['employee']);

            $d->editTasks($id, $employee);
            header("Location: " . BASE_URL . "dutys");
        }

        $data['getDuty'] = $d->getDuty($id);

        $data['employees'] = $e->getEmployees();

        $this->loadTemplate('edit-dutys', $data);
    }

    public function evaluate($duty)
    {
        $data = array(
            'user_id' => ''
        );

        $e = new Evaluate();
        $u = new User();

        $data['user_id'] = $u->getUserById($_SESSION['logged']);

        if (isset($_POST['bugs'])) {
            $user = addslashes($data['user_id']);
            $tag = addslashes($_POST['tag']);
            $font = addslashes($_POST['font']);
            $bugs = addslashes($_POST['bugs']);
            $justification = addslashes($_POST['justification']);

            $e->addEvaluateDuty($user, $duty, $font, $tag, $bugs, $justification);

            header("Location: " . BASE_URL . "dutys");
        }

        $this->loadTemplate('evaluate-dutys', $data);
    }

    public function info($id)
    {
        $d = new Duty();
        $e = new Evaluate();

        $data['evaluates'] = $e->getEvaluateDuty($id);

        $data['duty'] = $d->getDutyById($id);

        $this->loadTemplate('info-dutys', $data);
    }
}
