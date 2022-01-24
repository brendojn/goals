<?php

class projectsController extends controller
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

        $pr = new Project();
        $p = new Payment();
        $e = new Employee();
        $te = new TypeEvaluate();

        $filters = array(
            'employee' => '',
            'type' => ''
        );

        if (isset($_GET['filters'])) {
            $filters = $_GET['filters'];
        }

        $total_projects = $pr->getTotalProjects($filters);

        $p = 1;
        if (isset($_GET['p']) && !empty($_GET['p'])) {
            $p = addslashes($_GET['p']);
        }

        $per_page = 10;
        $total_pages = ceil($total_projects / $per_page);

        $projects = $pr->getprojects($p, $per_page, $filters);

        $data['evaluates'] = $te->getTypeEvaluates();
        $data['total_projects'] = $total_projects;
        $data['projects'] = $projects;
        $data['employees'] = $e->getEmployees();
        $data['filters'] = $filters;
        $data['total_pages'] = $total_pages;

        $this->loadTemplate('projects', $data);
    }

    public function add()
    {
        $data = array();

        $p = new Project();
        $e = new Employee();
        $te = new TypeEvaluate();

        if (isset($_POST['week']) && !empty($_POST['week'])) {
            $week = addslashes($_POST['week']);
            $employee = addslashes($_POST['employee']);
            $type = addslashes($_POST['type']);

            $data['erro'] = $p->createProject($employee, $week, $type);
        }

        $data['employees'] = $e->getEmployees();
        $data['evaluates'] = $te->getTypeEvaluates();

        $this->loadTemplate('add-projects', $data);
    }

    public function delete()
    {
        $p = new Project();

        if (isset($_GET['id']) && !empty($_GET['id'])) {
            $p->deleteProject($_GET['id']);
        }

        header("Location: " . BASE_URL . "projects");
    }

    public function edit($id)
    {
        $data = array();

        $p = new Project();
        $e = new Employee();

        if (isset($_POST['employee']) && !empty($_POST['employee'])) {
            $employee = addslashes($_POST['employee']);

            $p->editTasks($id, $employee);
            header("Location: " . BASE_URL . "projects");
        }

        $data['getProject'] = $p->getProject($id);

        $data['employees'] = $e->getEmployees();

        $this->loadTemplate('edit-projects', $data);
    }

    public function evaluateSquad($project)
    {
        $data = array(
            'user_id' => ''
        );

        $e = new Evaluate();
        $u = new User();
        $c = new Configuration();

        $data['user_id'] = $u->getUserById($_SESSION['logged']);
        $data['configuration'] = $c->getConfigs();

        if (isset($_POST['collaboration'])) {
            $user = addslashes($data['user_id']);
            $collaboration = addslashes($_POST['collaboration']);
            $qa_in_squad = addslashes($_POST['qa_in_squad']);
            $communication = addslashes($_POST['communication']);
            $bugs = addslashes($_POST['bugs']);
            $automation = addslashes($_POST['automation']);
            $business = addslashes($_POST['business']);
            $gradeSquad = addslashes($_POST['gradeSquad']);
            $justification = addslashes($_POST['justification']);

            $e->addEvaluateSquad($user, $project, $collaboration, $qa_in_squad, $communication, $bugs, $automation, $business, $gradeSquad, $justification);

            header("Location: " . BASE_URL . "projects");
        }

        $this->loadTemplate('evaluate-squad', $data);
    }

    public function evaluateChapter($project)
    {
        $data = array(
            'user_id' => ''
        );

        $e = new Evaluate();
        $u = new User();
        $c = new Configuration();

        $data['user_id'] = $u->getUserById($_SESSION['logged']);
        $data['configuration'] = $c->getConfigs();

        if (isset($_POST['risks'])) {
            $user = addslashes($data['user_id']);
            $risks = addslashes($_POST['risks']);
            $documentation = addslashes($_POST['documentation']);
            $analytical = addslashes($_POST['analytical']);
            $participation = addslashes($_POST['participation']);
            $ambition = addslashes($_POST['ambition']);
            $training = addslashes($_POST['training']);
            $gradeChapter = addslashes($_POST['gradeChapter']);
            $justification = addslashes($_POST['justification']);

            $e->addEvaluateChapter($user, $project, $risks, $documentation, $analytical, $participation, $ambition, $training, $gradeChapter, $justification);

            header("Location: " . BASE_URL . "projects");
        }

        $this->loadTemplate('evaluate-chapter', $data);
    }

    public function evaluateSkills($project)
    {
        $data = array(
            'user_id' => ''
        );

        $e = new Evaluate();
        $u = new User();
        $c = new Configuration();

        $data['user_id'] = $u->getUserById($_SESSION['logged']);
        $data['configuration'] = $c->getConfigs();

        if (isset($_POST['performance'])) {
            $user = addslashes($data['user_id']);
            $performance = addslashes($_POST['performance']);
            $safety = addslashes($_POST['safety']);
            $usability = addslashes($_POST['usability']);
            $git = addslashes($_POST['git']);
            $story = addslashes($_POST['story']);
            $api = addslashes($_POST['api']);
            $justification = addslashes($_POST['justification']);

            $e->addEvaluateSkills($user, $project, $performance, $safety, $usability, $git, $story, $api, $justification);

            header("Location: " . BASE_URL . "projects");
        }

        $this->loadTemplate('evaluate-skills', $data);
    }

    public function info($id)
    {
        $p = new Project();
        $e = new Evaluate();

        $data['evaluates'] = $e->getEvaluateProject($id);

        $data['project'] = $p->getProjectById($id);

        $this->loadTemplate('info-projects', $data);
    }
}
