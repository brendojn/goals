<?php

class Employee extends model
{

    public function getEmployees($filters = [])
    {
        $array = array();

        $filtrostring = array('1=1');

        if (!empty($filters['type'])) {
            $filtrostring[] = 'te.id = :type';
        }

        if ($filters['type'] == 2) {
            $sql = $this->db->prepare("SELECT e.id, e.name, SUM(p.grade / e.qtd_evaluate_chapter) as grade, qtd_recovery, e.chapter_lead, e.squad_lead, p.fk_type_evaluate_id FROM employees e
                LEFT JOIN projects p
                ON p.fk_employee_id = e.id
                LEFT JOIN type_evaluate te
                ON te.id = p.fk_type_evaluate_id
                WHERE " . implode(' AND ', $filtrostring) . " 
                GROUP BY e.id
                ORDER BY grade DESC");
        } elseif ($filters['type'] == 3) {
            $sql = $this->db->prepare("SELECT e.id, e.name, SUM(p.grade / e.qtd_evaluate_squad) as grade, qtd_recovery, e.chapter_lead, e.squad_lead, p.fk_type_evaluate_id FROM employees e
                LEFT JOIN projects p
                ON p.fk_employee_id = e.id
                LEFT JOIN type_evaluate te
                ON te.id = p.fk_type_evaluate_id
                WHERE " . implode(' AND ', $filtrostring) . " 
                GROUP BY e.id
                ORDER BY grade DESC");
        } elseif ($filters['type'] == 4) {
            $sql = $this->db->prepare("SELECT e.id, e.name, SUM(p.grade / e.qtd_evaluate_skill) as grade, qtd_recovery, e.chapter_lead, e.squad_lead, p.fk_type_evaluate_id FROM employees e
                LEFT JOIN projects p
                ON p.fk_employee_id = e.id
                LEFT JOIN type_evaluate te
                ON te.id = p.fk_type_evaluate_id
                WHERE " . implode(' AND ', $filtrostring) . " 
                GROUP BY e.id
                ORDER BY grade DESC");
        } else {
            $sql = $this->db->prepare("SELECT e.id, e.name, SUM(p.grade / (e.qtd_evaluate_skill + e.qtd_evaluate_squad + e.qtd_evaluate_chapter)) as grade, qtd_recovery, e.chapter_lead, e.squad_lead, p.fk_type_evaluate_id FROM employees e
                LEFT JOIN projects p
                ON p.fk_employee_id = e.id
                LEFT JOIN type_evaluate te
                ON te.id = p.fk_type_evaluate_id
                WHERE " . implode(' AND ', $filtrostring) . " 
                GROUP BY e.id
                ORDER BY grade DESC");
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

    public function deleteEmployee($name)
    {
        $sql = "DELETE FROM employees WHERE employees.name = '$name'";
        $sql = $this->db->query($sql);
    }

    public function createEmployees($employee)
    {
        $sql = "SELECT * FROM employees WHERE employees.name = '$employee'";
        $sql = $this->db->query($sql);

        if ($sql->rowCount() == 0) {
            $sql = "INSERT INTO employees SET employees.name = '$employee'";

            $sql = $this->db->query($sql);

            header("Location: " . BASE_URL . "employees");
        } else {
            return "QA já cadastrado";
        }
    }

    public function countEvaluate($employee, $typeEvaluate = NULL)
    {
        $array = array();

        if ($typeEvaluate === NULL) {
            $sql = "SELECT COUNT(*) AS qtd_eval FROM projects p
                JOIN employees e
                ON e.id = p.fk_employee_id
                WHERE e.id = '$employee'";
        } else {
            $sql = "SELECT COUNT(*) AS qtd_eval FROM projects p
                JOIN employees e
                ON e.id = p.fk_employee_id
                WHERE e.id = '$employee' AND p.fk_type_evaluate_id = '$typeEvaluate'";
        }
        $sql = $this->db->query($sql);

        if ($sql->rowCount() > 0) {
            $array = $sql->fetch();
        }

        return $array['qtd_eval'];
    }

    public function getEmployeeByUser() {
        $array = array();

        $user_id = $this->getUserById($_SESSION['logged']);

        $sql = "SELECT e.id FROM employees e
                JOIN users u 
                ON u.id = e.fk_user_id 
                WHERE u.id = '$user_id'";
        $sql = $this->db->query($sql);

        if ($sql->rowCount() > 0) {
            $array = $sql->fetch();
        }

        return $array['id'];
    }

}