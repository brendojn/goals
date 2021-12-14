<?php

class tasksController extends controller
{

    public function __construct()
    {
        $u = new User();
        $u->verifyLogin();
    }

    public function index()
    {
        $data = array();

        $t = new Task();
        $p = new Payment();
        $e = new Employee();

        $filters = array(
            'employee' => '',
            'status' => ''
        );

        if (isset($_GET['filters'])) {
            $filters = $_GET['filters'];
        }

        $total_tasks = $t->getTotalTasks($filters);

        $p = 1;
        if (isset($_GET['p']) && !empty($_GET['p'])) {
            $p = addslashes($_GET['p']);
        }

        $per_page = 6;
        $total_pages = ceil($total_tasks / $per_page);

        $tasks = $t->getTasks($p, $per_page, $filters);

        $data['total_tasks'] = $total_tasks;
        $data['tasks'] = $tasks;
        $data['employees'] = $e->getEmployees();
        $data['filters'] = $filters;
        $data['total_pages'] = $total_pages;

        $this->loadTemplate('tasks', $data);
    }

    public function add()
    {
        $data = array();

        $t = new Task();
        $e = new Employee();
        $c = new Complexity();


        if (isset($_POST['task']) && !empty($_POST['task'])) {
            $task = addslashes($_POST['task']);
            $employee = addslashes($_POST['employee']);
            $complexity = addslashes($_POST['complexity']);

            $data['erro'] = $t->createTasks($employee, $complexity, $task);
        }

        $data['employees'] = $e->getEmployees();

        $data['complexities'] = $c->getComplexities();


        $this->loadTemplate('add-tasks', $data);
    }

    public function delete()
    {
        $t = new Task();

        if (isset($_GET['task']) && !empty($_GET['task'])) {
            $t->deleteTask($_GET['task']);
        }

        header("Location: " . BASE_URL . "tasks");
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

    public function evaluate($task)
    {
        $data = array(
            'user_id' => ''
        );

        $e = new Evaluate();
        $u = new User();

        $data['user_id'] = $u->getUserById($_SESSION['logged']);

        if (isset($_POST['time'])) {
            $user = addslashes($data['user_id']);
            $time = addslashes($_POST['time']);
            $automation = addslashes($_POST['automation']);
            $lighthouse = addslashes($_POST['lighthouse']);
            $trello = addslashes($_POST['trello']);
            $jira = addslashes($_POST['jira']);
            $testrail = addslashes($_POST['testrail']);
            $bugs = addslashes($_POST['bugs']);
            $impact = addslashes($_POST['impact']);

            $e->addEvaluateTask($user, $task, $time, $automation, $lighthouse, $trello, $jira, $testrail, $bugs, $impact);

            header("Location: " . BASE_URL . "tasks");

        }

        $this->loadTemplate('evaluate-tasks', $data);

    }

    public function pay($task)
    {
        $data = array(
            'user_id' => ''
        );


        $t = new Task();
        $u = new User();
        $p = new Payment();

        $data['user_id'] = $u->getUserById($_SESSION['logged']);

        if (isset($_POST['value']) && !empty($_POST['value'])) {
            $user = addslashes($data['user_id']);
            $value = addslashes($_POST['value']);


            $percent = $t->getTaskById($task);
            $p->payTask($task, $user, $value, $percent['grade']);

            header("Location: " . BASE_URL . "tasks");
        }

        $data['task'] = $t->getTaskById($task);

        $this->loadTemplate('pay-tasks', $data);

    }

    public function info($task)
    {

        $t = new Task();
        $e = new Evaluate();
        $p = new Payment();

        $data['payments'] = $p->getPayment($task);

        $data['evaluates'] = $e->getEvaluateTask($task);

        $data['final_value'] = $p->getPay($task);

        $data['task'] = $t->getTaskById($task);

        $this->loadTemplate('info-tasks', $data);
    }
}
