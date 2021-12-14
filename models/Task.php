<?php

class Task extends model
{

    public function createTasks($employee, $complexity, $task, $points = 100)
    {

        $sql = "SELECT * FROM tasks WHERE task = '$task'";
        $sql = $this->db->query($sql);

        if ($sql->rowCount() == 0) {
            $sql = "INSERT INTO tasks SET fk_employee_id = '$employee', fk_complexity_id = '$complexity', task = '$task', points = '$points'";
            $sql = $this->db->query($sql);


            header("Location: " . BASE_URL . "tasks");
        } else {
            return "Tarefa já se encontra cadastrada";
        }
    }

    public function getTaskById($id)
    {
        $array = array();

        $sql = "SELECT t.task, e.name, c.fibonacci, t.points, t.evaluate, t.pay FROM tasks t 
                JOIN employees e 
                ON (e.id = t.fk_employee_id)
                JOIN complexities c 
                ON (c.id = t.fk_complexity_id) 
                WHERE t.id = '$id'";

        $sql = $this->db->query($sql);
        if ($sql->rowCount() > 0) {
            $array = $sql->fetch();
        }

        return $array;

    }

    public function getTask($task)
    {
        $array = array();

        $sql = "SELECT t.task, e.id, e.name, c.fibonacci, t.points, c.id as id_complexity FROM tasks t 
                JOIN employees e 
                ON (e.id = t.fk_employee_id)
                JOIN complexities c 
                ON (c.id = t.fk_complexity_id) 
                WHERE task = '$task'";

        $sql = $this->db->query($sql);
        if ($sql->rowCount() > 0) {
            $array = $sql->fetch();
        }

        return $array;

    }

    public function getTotalTasks($filters)
    {
        $array = array();

        $filtrostring = array('1=1');

        if (!empty($filters['employee'])) {
            $filtrostring[] = 't.fk_employee_id = :id_employee';
        }

        if(!empty($filters['status'])) {
            $filtrostring[] = 't.evaluate = :evaluate AND t.pay = :pay';
        }

        if(!empty($filters['task'])) {
            $filtrostring[] = 't.task = :task';
        }

        $sql = $this->db->prepare("SELECT COUNT(*) as c FROM tasks WHERE ".implode(' AND ', $filtrostring));

        if (!empty($filters['employee'])) {
            $sql->bindValue(':id_employee', $filters['employee']);
        }

        if(!empty($filters['status'])) {
            $status = explode('-', $filters['status']);
            $sql->bindValue(':evaluate', $status[0]);
            $sql->bindValue(':pay', $status[1]);
        }

        if (!empty($filters['task'])) {
            $sql->bindValue(':task', $filters['task']);
        }

        $sql->execute();
        $row = $sql->fetch();

        return $row['c'];
    }

    public function getTasks($page, $per_page, $filters)
    {
        $offset = ($page - 1) * $per_page;

        $array = array();

        $filtrostring = array('1=1');

        if (!empty($filters['employee'])) {
            $filtrostring[] = 't.fk_employee_id = :id_employee';
        }

        if(!empty($filters['status'])) {
            $filtrostring[] = 't.evaluate = :evaluate AND t.pay = :pay';
        }

        if(!empty($filters['task'])) {
            $filtrostring[] = 't.task = :task';
        }

        $sql = $this->db->prepare("SELECT t.id, t.task, e.name, c.fibonacci, t.points, t.evaluate, t.pay FROM tasks t 
                JOIN employees e 
                ON (e.id = t.fk_employee_id)
                JOIN complexities c 
                ON (c.id = t.fk_complexity_id)
                WHERE " . implode(' AND ', $filtrostring)." ORDER BY id DESC LIMIT $offset, $per_page");

        if (!empty($filters['employee'])) {
            $sql->bindValue(':id_employee', $filters['employee']);
        }

        if(!empty($filters['status'])) {
            $status = explode('-', $filters['status']);
            $sql->bindValue(':evaluate', $status[0]);
            $sql->bindValue(':pay', $status[1]);
        }

        if (!empty($filters['task'])) {
            $sql->bindValue(':task', $filters['task']);
        }

        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }

    public function getTasksByIdEmployee($employee)
    {
        $sql = "SELECT * FROM tasks WHERE fk_employee_id = '$employee' ";

        $sql = $this->db->query($sql);

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }
        return $array;
    }

    public function deleteTask($task)
    {
        $sql = "DELETE FROM tasks WHERE task = '$task'";

        $sql = $this->db->query($sql);
    }

    public function editTasks($task, $employee, $complexity)
    {

        $array = array();

        $sql = "SELECT id FROM employees WHERE id = '$employee'";
        $sql = $this->db->query($sql);

        if ($sql->rowCount() > 0) {
            $array = $sql->fetch();
        }

        $employee_id = $array['id'];

        $sql = "UPDATE tasks SET fk_employee_id = '$employee_id', fk_complexity_id = '$complexity' WHERE task = '$task'";

        $sql = $this->db->query($sql);

        header("Location: " . BASE_URL . "tasks");
    }

}





