<?php

class User extends model
{

    public function verifyLogin()
    {
        if (!isset($_SESSION['logged']) || (isset($_SESSION['logged']) && empty($_SESSION['logged']))) {
            header("Location: " . BASE_URL . "login");
            exit;
        }
    }

    public function permissionPage()
    {
        $user_id = $this->getUserById($_SESSION['logged']);

        $sql = "SELECT u.id, e.chapter_lead, e.squad_lead, u.user FROM employees e
        JOIN users u
        ON u.id = e.fk_user_id
        WHERE u.id = '$user_id'";
        $sql = $this->db->query($sql);

        if ($sql->rowCount() > 0) {
            $sql = $sql->fetch();

            if ($sql['chapter_lead'] === NULL && $sql['squad_lead'] === NULL) {
                header("Location: " . BASE_URL);
            }
        }
    }

    public function isLead()
    {
        $user_id = $this->getUserById($_SESSION['logged']);

        $sql = "SELECT u.id, e.chapter_lead, e.squad_lead, u.user FROM employees e
        JOIN users u
        ON u.id = e.fk_user_id
        WHERE u.id = '$user_id'";
        $sql = $this->db->query($sql);

        if ($sql->rowCount() > 0) {
            $sql = $sql->fetch();

            if ($sql['chapter_lead'] === NULL && $sql['squad_lead'] === NULL) {
                return false;
            } else {
                return true;
            }
        }
    }


    public function login($user, $password)
    {

        $sql = "SELECT * FROM users WHERE user = '$user' AND password = '$password'";
        $sql = $this->db->query($sql);

        if ($sql->rowCount() > 0) {
            $sql = $sql->fetch();

            $_SESSION['logged'] = $sql['id'];

            header("Location: " . BASE_URL);
            exit;
        } else {
            return "E-mail e/ou senha errados!";
        }

    }

    public function addUser($user, $password)
    {

        $sql = "SELECT * FROM users WHERE user = '$user'";
        $sql = $this->db->query($sql);

        if ($sql->rowCount() == 0) {

            $sql = "INSERT INTO users SET user = '$user', password = MD5('$password')";
            $sql = $this->db->query($sql);

            $id = $this->db->lastInsertId();
            $_SESSION['logged'] = $id;

            header("Location: " . BASE_URL);

        } else {
            return "E-mail já está cadastrado!";
        }

    }

    public function getUser($id)
    {
        $sql = "SELECT user FROM users WHERE id = '$id'";
        $sql = $this->db->query($sql);

        if ($sql->rowCount() > 0) {
            $sql = $sql->fetch();

            return $sql['user'];
        } else {
            return '';
        }
    }

    public function getUserById($id)
    {
        $sql = "SELECT id FROM users WHERE id = '$id'";
        $sql = $this->db->query($sql);

        if ($sql->rowCount() > 0) {
            $sql = $sql->fetch();

            return $sql['id'];
        } else {
            return '';
        }
    }

    public function getUsers()
    {
        $array = array();

        $sql = "SELECT * FROM users";
        $sql = $this->db->query($sql);

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }

    public function getUserByEmployee($employee)
    {
        $sql = "SELECT * FROM users u
        JOIN employees e
        ON e.fk_user_id = u.id
        WHERE e.id = '$employee'";
        $sql = $this->db->query($sql);

        if ($sql->rowCount() > 0) {
            $sql = $sql->fetch();

            return $sql['fk_user_id'];
        } else {
            return '';
        }
    }

}