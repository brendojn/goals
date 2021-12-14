<?php

class Configuration extends model
{

    public function getConfigs()
    {
        $array = array();

        $sql = "SELECT * FROM configuration";
        $sql = $this->db->query($sql);

        if ($sql->rowCount() > 0) {
            $array = $sql->fetch();
        }
        return $array;
    }
}