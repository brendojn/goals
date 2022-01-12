<?php

class Beginner extends model
{

    public function getBeginnersByUser($user)
    {
        $array = array();

        $sql = "SELECT * FROM beginners WHERE fk_user_id = '$user'";
        $sql = $this->db->query($sql);

        if ($sql->rowCount() > 0) {
            $array = $sql->fetch();
        }

        if (isset($array['fk_user_id'])) {
            return $array;
        } else {
            return NULL;
        }

    }


}