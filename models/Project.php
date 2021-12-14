<?php

class Project extends model
{

    public function createProject($employee, $week, $type, $grade = 0)
    {
        $sql = "SELECT * FROM projects p WHERE fk_employee_id = '$employee' AND evaluate = '0'";
        $sql = $this->db->query($sql);

        if ($sql->rowCount() == 0) {
            $sql = "INSERT INTO projects SET fk_employee_id = '$employee', week = '$week', grade = '$grade', fk_type_evaluate_id = '$type'";
//            print_r($sql);die();
            $sql = $this->db->query($sql);

            header("Location: " . BASE_URL . "projects");
        } else {
            return "Tarefa já se encontra cadastrada";
        }
    }

    public function getTotalProjects($filters)
    {
        $array = array();

        $filtrostring = array('1=1');

        if (!empty($filters['employee'])) {
            $filtrostring[] = 'p.fk_employee_id = :id_employee';
        }

        if (!empty($filters['week'])) {
            $filtrostring[] = 'p.week = :week';
        }

        $sql = $this->db->prepare("SELECT COUNT(*) as c FROM projects p WHERE " . implode(' AND ', $filtrostring));

        if (!empty($filters['employee'])) {
            $sql->bindValue(':id_employee', $filters['employee']);
        }

        if (!empty($filters['week'])) {
            $sql->bindValue(':week', $filters['week']);
        }

        $sql->execute();
        $row = $sql->fetch();

        return $row['c'];
    }

    public function getProjects($page, $per_page, $filters)
    {
        $offset = ($page - 1) * $per_page;

        $array = array();

        $filtrostring = array('1=1');

        if (!empty($filters['employee'])) {
            $filtrostring[] = 'p.fk_employee_id = :id_employee';
        }

        if (!empty($filters['type'])) {
            $filtrostring[] = 'te.id = :type';
        }

        $sql = $this->db->prepare("SELECT p.id, p.week, e.name, p.grade, p.evaluate, p.fk_type_evaluate_id, count(eval.squad) AS squad, count(eval.chapter) AS chapter, count(eval.skill) AS skill, te.name AS name_type
                        FROM projects p
                        JOIN employees e ON (e.id = p.fk_employee_id)
                        LEFT JOIN evaluates eval ON (eval.fk_project_id = p.id)
                        JOIN type_evaluate te ON (te.id = p.fk_type_evaluate_id)
                        WHERE " . implode(' AND ', $filtrostring) . " GROUP BY id ORDER BY id DESC LIMIT $offset, $per_page");
        if (!empty($filters['employee'])) {
            $sql->bindValue(':id_employee', $filters['employee']);
        }

        if (!empty($filters['type'])) {
            $sql->bindValue(':type', $filters['type']);
        }

        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }

    public function deleteProject($id)
    {
        $sql = "DELETE FROM projects WHERE id = '$id'";
//        print_r($sql);die();

        $sql = $this->db->query($sql);
    }

    public function editTasks($id, $employee)
    {
        $array = array();

        $sql = "SELECT id FROM employees WHERE id = '$employee'";
        $sql = $this->db->query($sql);

        if ($sql->rowCount() > 0) {
            $array = $sql->fetch();
        }

        $employee_id = $array['id'];

        $sql = "UPDATE projects SET fk_employee_id = '$employee_id' WHERE id = '$id'";
        $sql = $this->db->query($sql);

        header("Location: " . BASE_URL . "projects");
    }

    public function getProject($id)
    {
        $array = array();

        $sql = "SELECT p.week, e.id, e.name, p.grade FROM projects p
                JOIN employees e 
                ON (e.id = p.fk_employee_id)
                WHERE p.id = '$id'";
        $sql = $this->db->query($sql);
        if ($sql->rowCount() > 0) {
            $array = $sql->fetch();
        }

        return $array;
    }

    public function getProjectById($id)
    {
        $array = array();

        $sql = "SELECT p.week, e.name, p.grade, p.evaluate, p.grade FROM projects p 
                JOIN employees e 
                ON (e.id = p.fk_employee_id)
                WHERE p.id = '$id'";
        $sql = $this->db->query($sql);
        if ($sql->rowCount() > 0) {
            $array = $sql->fetch();
        }

        return $array;

    }


}