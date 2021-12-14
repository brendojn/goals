<?php

class TypeEvaluate extends model
{
    public function getTypeEvaluates() {
        $array = array();

        $sql = "SELECT * FROM type_evaluate";
        $sql = $this->db->query($sql);

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }
}