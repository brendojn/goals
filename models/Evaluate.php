<?php

class Evaluate extends model
{

    public function addEvaluateTask($user, $task, $time = 0, $automation = 0, $lighthouse = 0, $trello = 0, $jira = 0, $testrail = 0, $bugs = 0, $impact = 0)
    {

        $sql = "SELECT * from configuration ORDER BY id DESC LIMIT 1";
        $sql = $this->db->query($sql);

        $row = $sql->fetch();

        $config_time = $time * $row['config_time'];

        $config_process = ($automation + $lighthouse + $trello + $jira + $testrail) * $row['config_proccess'];

        $config_bugs = $bugs * $row['config_bugs'];

        $config_impact = $impact * $row['config_impact'];

        $total = $config_bugs + $config_impact + $config_process + $config_time;

        if ($total > 100) {
            $total = 100;
        }


        $sql = "SELECT * FROM tasks WHERE id = '$task' AND evaluate = '0'";
        $sql = $this->db->query($sql);

        if ($sql->rowCount() == 1) {
            $sql = "INSERT INTO evaluates SET fk_user_id = '$user', fk_task_id = '$task', time = '$time', automation = '$automation', lighthouse = '$lighthouse', trello = '$trello', jira = '$jira', testrail = '$testrail', bugs = '$bugs', impact = '$impact'";
            $sql = $this->db->query($sql);

            $sql = "UPDATE tasks SET grade = grade - '$total', evaluate = '1' WHERE id = '$task'";
            $sql = $this->db->query($sql);

            header("Location: " . BASE_URL . "tasks");
        } else {
            return "Tarefa já se encontra avaliada";
        }
    }

    public function addEvaluateSquad($user, $project, $collaboration, $qa_in_squad, $communication, $bugs, $automation, $business, $gradeSquad, $justification)
    {
        $u = new User();
        $array = array();

        $sql = "SELECT * from configuration ORDER BY id DESC LIMIT 1";

        $sql = $this->db->query($sql);

        $row = $sql->fetch();

        $total = $collaboration + $qa_in_squad + $communication + $bugs + $automation + $business;
        $grade = sprintf('%.2f', ($total + ($gradeSquad * ($row['config_squad'] / 10))) / 2);
        if ($grade > $row['config_squad']) {
            $grade = 60;
        }

        $average = $row['config_squad'] * ($row['config_average'] / 100);

        $sql = "SELECT * FROM projects WHERE id = '$project' AND evaluate = '0'";
        $sql = $this->db->query($sql);


        $array = $sql->fetch();
            
        $evaluatorEmployee = $array['evaluator_id'];

        $userEvaluator = $u->getUserByEmployee($evaluatorEmployee);

        if ($sql->rowCount() == 1) {
            $sql = "UPDATE projects SET grade = grade + '$grade' WHERE id = '$project'";
            $sql = $this->db->query($sql);


            if (!empty($userEvaluator)) {
                $sql = "INSERT INTO evaluates SET fk_user_id = '$userEvaluator', fk_project_id = '$project', squad = 1, justification = '$justification'";
            } else {
                $sql = "INSERT INTO evaluates SET fk_user_id = '$user', fk_project_id = '$project', squad = 1, justification = '$justification'";
            }
            $sql = $this->db->query($sql);

            $sql = "SELECT * FROM evaluates ORDER BY id DESC LIMIT 1";
            $sql = $this->db->query($sql);

            if ($sql->rowCount() > 0) {
                $array = $sql->fetch();
            }

            $evaluate_id = $array['id'];

            $sql = "INSERT INTO evaluate_squad SET fk_evaluate_id = '$evaluate_id', collaboration = '$collaboration', qa_in_squad = '$qa_in_squad', communication = '$communication', bugs = '$bugs', automation = '$automation', business = '$business'";
            $sql = $this->db->query($sql);

            $sql = "SELECT squad, chapter, fk_employee_id, fk_type_evaluate_id FROM projects p
                    JOIN evaluates e
                    ON e.fk_project_id = p.id
                    WHERE p.id = '$project'
                    ORDER BY p.id ASC LIMIT 1";
            $sql = $this->db->query($sql);

            if ($sql->rowCount() > 0) {
                $array = $sql->fetch();
            }

            if (isset($array['chapter']) || $array['fk_type_evaluate_id'] == 3) {
                $sql = "UPDATE projects SET evaluate = '1' WHERE id = '$project'";
                $sql = $this->db->query($sql);
            }

            $employee_id = $array['fk_employee_id'];
            $today = date("Y-m-d H:i:s");

            if ($average > $grade) {
                $sql = "INSERT INTO recoveries SET fk_employee_id = '$employee_id', fk_project_id = '$project', created_at = '$today', updated_at = '$today'";
                $sql = $this->db->query($sql);

                $sql = "UPDATE employees SET qtd_recovery = qtd_recovery + 1 WHERE id = '$employee_id'";
                $sql = $this->db->query($sql);
            }

            $sql = "UPDATE employees SET qtd_evaluate_squad = qtd_evaluate_squad + 1 WHERE id = '$employee_id'";
            $sql = $this->db->query($sql);

            header("Location: " . BASE_URL . "projects");
        } else {
            return "Plantão já se encontra avaliado";
        }
    }

    public function getEvaluateTask($task)
    {
        $array = array();

        $sql = "SELECT u.user
                FROM evaluates e
                JOIN tasks t ON (t.id = e.fk_task_id)
                JOIN users u ON (u.id = e.fk_user_id)
                WHERE t.id = '$task'";

        $sql = $this->db->query($sql);

        $array = $sql->fetch();

        return $array;
    }

    public function getEvaluateProject($project)
    {
        $array = array();

        $sql = "SELECT u.user, u.name, e.justification
                FROM evaluates e
                JOIN projects p ON (p.id = e.fk_project_id)
                JOIN users u ON (u.id = e.fk_user_id)
                WHERE p.id = '$project'";
        $sql = $this->db->query($sql);

        $array = $sql->fetch();

        return $array;
    }

    public function addEvaluateChapter($user, $project, $risks, $documentation, $analytical, $participation, $ambition, $training, $gradeChapter, $justification)
    {
        $u = new User();
        $array = array();
        
        $sql = "SELECT * from configuration ORDER BY id DESC LIMIT 1";
        
        $sql = $this->db->query($sql);

        $row = $sql->fetch();

        $total = ($row['config_chapter'] / $row['config_squad']) * ($risks + $documentation + $analytical + $participation + $ambition + $training);
        $grade = sprintf('%.2f', ($total + ($gradeChapter * ($row['config_chapter'] / 10))) / 2);

        $average = $row['config_chapter'] * ($row['config_average'] / 100);

        $sql = "SELECT * FROM projects WHERE id = '$project' AND evaluate = '0'";
        $sql = $this->db->query($sql);


        $array = $sql->fetch();
            
        $evaluatorEmployee = $array['evaluator_id'];

        $userEvaluator = $u->getUserByEmployee($evaluatorEmployee);

        if ($sql->rowCount() == 1) {
            $sql = "UPDATE projects SET grade = grade + '$grade' WHERE id = '$project'";
            $sql = $this->db->query($sql);

            if (!empty($userEvaluator)) {
                $sql = "INSERT INTO evaluates SET fk_user_id = '$userEvaluator', fk_project_id = '$project', chapter = 1, justification = '$justification'";
            } else {
                $sql = "INSERT INTO evaluates SET fk_user_id = '$user', fk_project_id = '$project', squad = 1, justification = '$justification'";
            }
            $sql = $this->db->query($sql);

            $sql = "SELECT * FROM evaluates ORDER BY id DESC LIMIT 1";
            $sql = $this->db->query($sql);

            if ($sql->rowCount() > 0) {
                $array = $sql->fetch();
            }

            $evaluate_id = $array['id'];

            $sql = "INSERT INTO evaluate_chapter SET fk_evaluate_id = '$evaluate_id', risks = '$risks', documentation = '$documentation', analytical = '$analytical', participation = '$participation', ambition = '$ambition', training = '$training'";
            $sql = $this->db->query($sql);


            $sql = "SELECT squad, chapter, fk_employee_id, fk_type_evaluate_id FROM projects p
                    JOIN evaluates e
                    ON e.fk_project_id = p.id
                    WHERE p.id = '$project'
                    ORDER BY p.id ASC LIMIT 1";
            $sql = $this->db->query($sql);

            if ($sql->rowCount() > 0) {
                $array = $sql->fetch();
            }

            if (isset($array['squad']) || $array['fk_type_evaluate_id'] == 2) {
                $sql = "UPDATE projects SET evaluate = '1' WHERE id = '$project'";
                $sql = $this->db->query($sql);
            }

            $employee_id = $array['fk_employee_id'];
            $today = date("Y-m-d H:i:s");

            if ($average > $grade) {
                $sql = "INSERT INTO recoveries SET fk_employee_id = '$employee_id', fk_project_id = '$project', grade_plan = $average - $grade, subtract_plan = $average - $grade, created_at = '$today', updated_at = '$today'";
                $sql = $this->db->query($sql);

                $sql = "UPDATE employees SET qtd_recovery = qtd_recovery + 1 WHERE id = '$employee_id'";
                $sql = $this->db->query($sql);
            }

            $sql = "UPDATE employees SET qtd_evaluate_chapter = qtd_evaluate_chapter + 1 WHERE id = '$employee_id'";
            $sql = $this->db->query($sql);

            header("Location: " . BASE_URL . "projects");
        } else {
            return "Plantão já se encontra avaliado";
        }
    }

    public function addEvaluateSkills($user, $project, $performance, $safety, $usability, $git, $story, $api, $justification)
    {
        $u = new User();
        $array = array();

        $sql = "SELECT * from configuration ORDER BY id DESC LIMIT 1";
        $sql = $this->db->query($sql);

        $row = $sql->fetch();

        $total = ($row['config_skill'] / $row['config_squad']) * ($performance + $safety + $usability + $git + $story + $api);
        $grade = sprintf('%.2f', $total);

        $average = $row['config_skill'] * ($row['config_average'] / 100);

        $sql = "SELECT * FROM projects WHERE id = '$project' AND evaluate = '0'";
        $sql = $this->db->query($sql);

        $array = $sql->fetch();
            
        $evaluatorEmployee = $array['evaluator_id'];

        $userEvaluator = $u->getUserByEmployee($evaluatorEmployee);

        if ($sql->rowCount() == 1) {
            $sql = "UPDATE projects SET grade = grade + '$grade' WHERE id = '$project'";
            $sql = $this->db->query($sql);

            if (!empty($userEvaluator)) {
                $sql = "INSERT INTO evaluates SET fk_user_id = '$userEvaluator', fk_project_id = '$project', skill = 1, justification = '$justification'";
            } else {
                $sql = "INSERT INTO evaluates SET fk_user_id = '$user', fk_project_id = '$project', squad = 1, justification = '$justification'";
            }
            $sql = $this->db->query($sql);

            $sql = "SELECT * FROM evaluates ORDER BY id DESC LIMIT 1";
            $sql = $this->db->query($sql);

            if ($sql->rowCount() > 0) {
                $array = $sql->fetch();
            }

            $evaluate_id = $array['id'];

            $sql = "INSERT INTO evaluate_skill SET fk_evaluate_id = '$evaluate_id', performance = '$performance', safety = '$safety', usability = '$usability', git = '$git', story = '$story', api = '$api'";
            $sql = $this->db->query($sql);


            $sql = "SELECT squad, chapter, skill, fk_employee_id, fk_type_evaluate_id FROM projects p
                    JOIN evaluates e
                    ON e.fk_project_id = p.id
                    WHERE p.id = '$project'
                    ORDER BY p.id ASC LIMIT 1";
            $sql = $this->db->query($sql);

            if ($sql->rowCount() > 0) {
                $array = $sql->fetch();
            }

            if (isset($array['skill']) || $array['fk_type_evaluate_id'] == 4) {
                $sql = "UPDATE projects SET evaluate = '1' WHERE id = '$project'";
                $sql = $this->db->query($sql);
            }

            $employee_id = $array['fk_employee_id'];
            $today = date("Y-m-d H:i:s");

            if ($average > $grade) {
                $sql = "INSERT INTO recoveries SET fk_employee_id = '$employee_id', fk_project_id = '$project', grade_plan = $average - $grade, subtract_plan = $average - $grade, created_at = '$today', updated_at = '$today'";

                $sql = $this->db->query($sql);

                $sql = "UPDATE employees SET qtd_recovery = qtd_recovery + 1 WHERE id = '$employee_id'";
                $sql = $this->db->query($sql);
            }

            $sql = "UPDATE employees SET qtd_evaluate_skill = qtd_evaluate_skill + 1 WHERE id = '$employee_id'";
            $sql = $this->db->query($sql);

            header("Location: " . BASE_URL . "projects");
        } else {
            return "Plantão já se encontra avaliado";
        }
    }

    public function getEvaluateSkill($recovery)
    {
        $array = array();

        $sql = "SELECT r.id, es.performance, es.safety, es.usability, es.git, es.story, es.api FROM recoveries r
                JOIN projects p
                ON p.id = r.fk_project_id
                JOIN evaluates e
                ON e.fk_project_id = p.id
                JOIN evaluate_skill es 
                ON es.fk_evaluate_id = e.id
                WHERE r.id = '$recovery'";
        $sql = $this->db->query($sql);

        return $sql->fetch();

    }


    public function addEvaluateExperience($user, $project, $communication, $seniority, $feedback, $proactivity, $justification)
    {
        $u = new User();
        $array = array();

        $sql = "SELECT * from configuration ORDER BY id DESC LIMIT 1";
        $sql = $this->db->query($sql);

        $row = $sql->fetch();

        $total = $communication + $seniority + $feedback + $proactivity + $justification;
        $grade = sprintf('%.2f', $total);

        $average = $row['config_experience'] * ($row['config_average'] / 100);

        $sql = "SELECT * FROM projects WHERE id = '$project' AND evaluate = '0'";
        $sql = $this->db->query($sql);

        $array = $sql->fetch();
            
        $evaluatorEmployee = $array['evaluator_id'];

        $userEvaluator = $u->getUserByEmployee($evaluatorEmployee);

        if ($sql->rowCount() == 1) {
            $sql = "UPDATE projects SET grade = grade + '$grade' WHERE id = '$project'";
            $sql = $this->db->query($sql);

            if (!empty($userEvaluator)) {
                $sql = "INSERT INTO evaluates SET fk_user_id = '$userEvaluator', fk_project_id = '$project', experience = 1, justification = '$justification'";
            } else {
                $sql = "INSERT INTO evaluates SET fk_user_id = '$user', fk_project_id = '$project', experience = 1, justification = '$justification'";
            }
            $sql = $this->db->query($sql);

            $sql = "SELECT * FROM evaluates ORDER BY id DESC LIMIT 1";
            $sql = $this->db->query($sql);

            if ($sql->rowCount() > 0) {
                $array = $sql->fetch();
            }

            $evaluate_id = $array['id'];

            $sql = "INSERT INTO evaluate_experience SET fk_evaluate_id = '$evaluate_id', communication = '$communication', seniority = '$seniority', feedback = '$feedback', proactivity = '$proactivity'";
            $sql = $this->db->query($sql);


            $sql = "SELECT squad, chapter, skill, experience, fk_employee_id, fk_type_evaluate_id FROM projects p
                    JOIN evaluates e
                    ON e.fk_project_id = p.id
                    WHERE p.id = '$project'
                    ORDER BY p.id ASC LIMIT 1";
            $sql = $this->db->query($sql);

            if ($sql->rowCount() > 0) {
                $array = $sql->fetch();
            }

            if (isset($array['experience']) || $array['fk_type_evaluate_id'] == 5) {
                $sql = "UPDATE projects SET evaluate = '1' WHERE id = '$project'";
                $sql = $this->db->query($sql);
            }

            $employee_id = $array['fk_employee_id'];
            $today = date("Y-m-d H:i:s");

            if ($average > $grade) {
                $sql = "INSERT INTO recoveries SET fk_employee_id = '$employee_id', fk_project_id = '$project', grade_plan = $average - $grade, su0btract_plan = $average - $grade, created_at = '$today', updated_at = '$today'";

                $sql = $this->db->query($sql);

                $sql = "UPDATE employees SET qtd_recovery = qtd_recovery + 1 WHERE id = '$employee_id'";
                $sql = $this->db->query($sql);
            }

            $sql = "UPDATE employees SET qtd_evaluate_experience = qtd_evaluate_experience + 1 WHERE id = '$employee_id'";
            $sql = $this->db->query($sql);

            header("Location: " . BASE_URL . "projects");
        } else {
            return "Avaliação já realizada";
        }
    }

    public function editEvaluate() {
        
    }

}





