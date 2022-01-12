<?php

class StudPlan extends model
{

    private static $gradeSubtract = 0.0;

    /**
     * @return mixed
     */
    public static function getGradeSubtract()
    {
        return self::$gradeSubtract;
    }

    /**
     * @param mixed $gradeSubtract
     */
    public static function setGradeSubtract($gradeSubtract)
    {
        self::$gradeSubtract = $gradeSubtract;
    }

    public function getPlans($user)
    {
        $array = array();
        $isBeginner = $array;
        $sponsor = null;

        $u = new User();
        $isLead = $u->isLead();

        $b = new Beginner();
        $beginner = $b->getBeginnersByUser($user);

        $isSponsor = $beginner['fk_employee_id'];
        $isBeginner = $beginner['fk_user_id'];

        if (isset($isBeginner)) {
            $sponsor = $u->getUserByEmployee($isSponsor);
        }

        if ($isLead === false && !isset($isBeginner) && $_SESSION['logged'] != $sponsor) {
            $sql = "SELECT sp.id, sp.title, sp.description, sp.due_date, sp.status, r.id AS recovery, e.name, sp.created_at
                FROM studies_plan sp
                JOIN recoveries r
                ON r.id = sp.fk_recovery_id
                JOIN employees e
                ON e.id = r.fk_employee_id
                JOIN users u 
                ON u.id = e.fk_user_id
                WHERE e.fk_user_id = '$user'";
            $sql = $this->db->query($sql);
        } elseif ($isLead === true && !isset($isBeginner) && $_SESSION['logged'] != $sponsor) {
            $sql = "SELECT sp.id, sp.title, sp.description, sp.due_date, sp.status, r.id AS recovery, e.name, sp.created_at
                FROM studies_plan sp
                JOIN recoveries r
                ON r.id = sp.fk_recovery_id
                JOIN employees e
                ON e.id = r.fk_employee_id";
            $sql = $this->db->query($sql);
        } else {
            $sql = "SELECT sp.id, sp.title, sp.description, sp.due_date, sp.status, e.name, sp.created_at FROM studies_plan sp
            JOIN employees e
            ON e.id = sp.fk_employee_id
            WHERE e.fk_user_id = '$user'";
            $sql = $this->db->query($sql);
        }

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }

    public function createPlan($recovery, $title, $description, $dueDate, $skill, $status = 'A Executar', $employee = NULL)
    {
        $dueDate = explode(' ', $dueDate);
        $dueDate[0] = implode("-", array_reverse(explode("/", $dueDate[0])));
        $today = date("Y-m-d H:i:s");
        if ($recovery === NULL) {
            $recovery = 'NULL';
        }

        if ($employee === NULL) {
            $employee = 'NULL';
        }

        $sql = "INSERT INTO studies_plan SET fk_recovery_id = $recovery, fk_employee_id = $employee, title = '$title', description = '$description', due_date = '$dueDate[0] $dueDate[1]', skill = '$skill' , status = '$status', created_at = '$today'";
//        print_r($sql);die();
        $sql = $this->db->query($sql);

        header("Location: " . BASE_URL . "plans");
    }

    public function getPlanById($id, $user)
    {
        $array = array();
        $isBeginner = array();

        $u = new User();
        $isLead = $u->isLead();

        $b = new Beginner();
        $beginner = $b->getBeginnersByUser($user);

        $isSponsor = $beginner['fk_employee_id'];
        $isBeginner = $beginner['fk_user_id'];

        if (isset($isBeginner)) {
            $sponsor = $u->getUserByEmployee($isSponsor);
        }

        if ($isLead === false && !isset($isBeginner) && $_SESSION['logged'] != $sponsor) {
            $sql = "SELECT sp.id, sp.title, sp.description, sp.due_date, sp.skill, sp.`status`, r.id AS recovery, e.name 
                FROM studies_plan sp
                JOIN recoveries r
                ON r.id = sp.fk_recovery_id
                JOIN employees e
                ON e.id = r.fk_employee_id
                JOIN users u 
                ON u.id = e.fk_user_id
                WHERE sp.id = '$id' AND e.fk_user_id = '$user'";
            $sql = $this->db->query($sql);
        } elseif ($isLead === true && !isset($isBeginner) && $_SESSION['logged'] != $sponsor) {
            $sql = "SELECT sp.id, sp.title, sp.description, sp.due_date, sp.skill, sp.`status`, r.id AS recovery, e.name 
                FROM studies_plan sp
                JOIN recoveries r
                ON r.id = sp.fk_recovery_id
                JOIN employees e
                ON e.id = r.fk_employee_id
                WHERE sp.id = '$id'";
            $sql = $this->db->query($sql);
        } else {
            $sql = "SELECT sp.id, sp.title, sp.description, sp.due_date, sp.skill, sp.`status`, e.name 
            FROM studies_plan sp
            JOIN employees e
            ON e.id = sp.fk_employee_id
            WHERE sp.id = '$id'";
            $sql = $this->db->query($sql);
        }
        if ($sql->rowCount() > 0) {
            $array = $sql->fetch();
        }

        return $array;
    }

    public function initTask($id)
    {
        $sql = "UPDATE studies_plan SET status = 'Em Progresso' WHERE id = '$id'";
        $sql = $this->db->query($sql);

        header("Location: " . BASE_URL . "plans");
    }

    public function doneTask($id)
    {
        $array = array();

        $sql = "SELECT * from configuration ORDER BY id DESC LIMIT 1";

        $sql = $this->db->query($sql);

        $row = $sql->fetch();

        $sql = "UPDATE studies_plan SET status = 'Concluido' WHERE id = '$id'";
        $sql = $this->db->query($sql);

        $sql = "SELECT * FROM studies_plan WHERE id = '$id'";
        $sql = $this->db->query($sql);

        if ($sql->rowCount() > 0) {
            $array = $sql->fetch();
        }

        $recoveryId = $array['fk_recovery_id'];

        $sql = "SELECT COUNT(*) AS qtd_plan, r.grade_plan, r.subtract_plan FROM studies_plan sp
                JOIN recoveries r
                ON r.id = sp.fk_recovery_id
                WHERE r.id = '$recoveryId'";
        $sql = $this->db->query($sql);

        if ($sql->rowCount() > 0) {
            $array = $sql->fetch();
        }

        self::setGradeSubtract($array['subtract_plan']);

        $gradeActual = self::getGradeSubtract() / $array['qtd_plan'];

        if ($gradeActual < 1.0) {
            $gradeActual = $array['grade_plan'];
        }

        $sql = "UPDATE recoveries SET grade_plan = grade_plan - '$gradeActual' WHERE id = '$recoveryId'";
        $sql = $this->db->query($sql);

        $sql = "SELECT r.grade_plan, p.fk_type_evaluate_id FROM recoveries r
                JOIN projects p
                ON p.id = r.fk_project_id 
                WHERE r.id = '$recoveryId'";
        $sql = $this->db->query($sql);

        if ($sql->rowCount() > 0) {
            $array = $sql->fetch();
        }

        if ($array['fk_type_evaluate_id'] == 2) {
            $average = $row['config_chapter'] * ($row['config_average'] / 100);
        } elseif ($array['fk_type_evaluate_id'] == 3) {
            $average = $row['config_squad'] * ($row['config_average'] / 100);
        } else {
            $average = $row['config_skill'] * ($row['config_average'] / 100);
        }

        if ($array['grade_plan'] == 0.0) {
            $sql = "UPDATE projects p
                    JOIN recoveries r
                    ON p.id = r.fk_project_id
                    SET p.grade = '$average'
                    WHERE r.id =  '$recoveryId'";
            $sql = $this->db->query($sql);

        }

        header("Location: " . BASE_URL . "plans");
    }
}