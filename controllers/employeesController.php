<?php

class employeesController extends controller
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

        $e = new Employee();
        $t = new Task();
        $te = new TypeEvaluate();

        $filters = array(
            'type' => '',
        );

        if (isset($_GET['filters'])) {
            $filters = $_GET['filters'];
        }

        $employee = addslashes($_POST['employee']);

        $data['evaluates'] = $te->getTypeEvaluates();
        $data['employees'] = $e->getEmployees($filters);

        $this->loadTemplate('employees', $data);
    }

    public function add()
    {
        $data = array();

        $e = new Employee();

        if (isset($_POST['employee']) && !empty($_POST['employee'])) {
            $employee = addslashes($_POST['employee']);

            $data['erro'] = $e->createEmployees($employee);
        }


        $this->loadTemplate('add-employees', $data);
    }

    public function delete()
    {
        $e = new Employee();

        if (isset($_GET['name']) && !empty($_GET['name'])) {
            $e->deleteEmployee($_GET['name']);
        }

        header("Location: " . BASE_URL . "employees");
    }

    public function edit($task)
    {

        $data = array();

        $t = new Task();
        $e = new Employee();
        $c = new Complexity();

        if (isset($_POST['employee']) && !empty($_POST['employee'])) {

            $employee = addslashes($_POST['employee']);
            $complexity = addslashes($_POST['complexity']);

            $t->editTasks($task, $employee, $complexity);
            header("Location: " . BASE_URL . "tasks");

        }

        $data['getTask'] = $t->getTask($task);

        $data['employees'] = $e->getEmployees();

        $data['complexities'] = $c->getComplexities();


        $this->loadTemplate('edit-tasks', $data);
    }

    public function info($task)
    {

        $t = new Task();
        $e = new Evaluate();
        $p = new Payment();

        $data['payments'] = $p->getPayment($task);

        $data['evaluates'] = $e->getEvaluate($task);

        $data['final_value'] = $p->getPay($task);

        $data['task'] = $t->getTaskById($task);

        $this->loadTemplate('info-tasks', $data);
    }


}
