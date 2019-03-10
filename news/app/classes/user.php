<?php

class User
{
    private $db;

    function __construct($db)
    {
        $this->db = $db;
    }

    public function register($params = [])
    {
        $params = $this->db->postExtraction(REGISTER_FIELDS, $params);
        $params['password'] = password_hash($params['password'], PASSWORD_BCRYPT);
        $keys = array_keys($params);
        $values = array_values($params);
        $query = 'INSERT INTO users (' . join(',', $keys) . ', created_at) VALUES ("' . join('", "', $values) . '", NOW());';
        $result = $this->db->query($query);
        return $result;
    }

    public function login($params = [])
    {
        $query = 'SELECT * FROM users WHERE email = "' . $this->db->fixString($params['email']) . '";';
        $result = $this->db->query($query);
        $row = mysqli_fetch_assoc($result);
        if (isset($row['password'])) {
            $verify = password_verify($params['password'], $row['password']);
            if ($verify) {
                $_SESSION['user'] = $row;
                return true;
            }
        }
        return false;
    }

    public function logout(){
        if (isset($_SESSION['user'])) {
            unset($_SESSION['user']);
        }
    }

    public function redirect($path)
    {
        Header('Location: ' . $path);
    }
}