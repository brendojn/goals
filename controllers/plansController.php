<?php

class plansController extends controller
{

    public function __construct()
    {
        $u = new User();
        $u->verifyLogin();
    }

    public function index()
    {
        $data = array();

        $s = new StudPlan();
        $u = new User();

        $data['user_id'] = $u->getUserById($_SESSION['logged']);
        $user = addslashes($data['user_id']);

        $data['lead'] = $u->isLead();

        $data['plans'] = $s->getPlans($user);

        $this->loadTemplate('plans', $data);
    }

    public function add($recovery)
    {
        $s = new StudPlan();
        $e = new Evaluate();

        $data['evaluates'] = $e->getEvaluateSkill($recovery);

        if (isset($_POST['title']) && !empty($_POST['title'])) {
            $title = addslashes($_POST['title']);
            $description = addslashes($_POST['description']);
            $dueDate = addslashes($_POST['due_date']);
            $skill = addslashes($_POST['skill']);

            $s->createPlan($recovery, $title, $description, $dueDate, $skill);
        }

        $this->loadTemplate('add-plans', $data);
    }

    public function info($id)
    {
        $s = new StudPlan();
        $u = new User();

        $data['user_id'] = $u->getUserById($_SESSION['logged']);
        $user = addslashes($data['user_id']);

        $data['plans'] = $s->getPlanById($id, $user);

        $this->loadTemplate('info-plans', $data);
    }

    public function init($id)
    {
        $s = new StudPlan();

        $s->initTask($id);

        header("Location: " . BASE_URL . "plans");
    }

    public function done($id)
    {
        $s = new StudPlan();

        $s->doneTask($id);

        header("Location: " . BASE_URL . "plans");
    }
}
