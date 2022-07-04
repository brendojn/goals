<?php

class TypeSpecialty extends model
{
    public function getTypeSpecialties() {
        $array = array();

        $sql = "SELECT * FROM type_specialty";
        $sql = $this->db->query($sql);

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }

    public function getNameSpecialty($id) {
        $array = array();

        $sql = "SELECT name FROM type_specialty WHERE id = '$id'";
        $sql = $this->db->query($sql);

        if ($sql->rowCount() > 0) {
            $array = $sql->fetch();
        }

        return $array['name'];
    }
}