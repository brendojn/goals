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

        $sql = $this->db->prepare("SELECT e.id, e.name, SUM(p.grade) as grade, qtd_recovery, e.chapter_lead, e.squad_lead FROM employees e
                LEFT JOIN projects p
                ON p.fk_employee_id = e.id
                LEFT JOIN type_evaluate te
                ON te.id = p.fk_type_evaluate_id
                WHERE " . implode(' AND ', $filtrostring) . " 
                GROUP BY e.id
                ORDER BY grade DESC");
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
}