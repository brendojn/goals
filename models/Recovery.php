<?php

class Recovery extends model
{
    public function getRecoveries() {
        $array = array();

        $sql = "SELECT r.id, r.fk_employee_id, r.fk_project_id, r.grade_plan, e.qtd_recovery, e.name as name, p.grade, te.name as name_type, r.created_at
                FROM recoveries r
                JOIN employees e
                ON e.id = r.fk_employee_id
                JOIN projects p
                ON p.id = r.fk_project_id
                JOIN type_evaluate te
                ON te.id = p.fk_type_evaluate_id";
        $sql = $this->db->query($sql);

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }
        return $array;
    }
}