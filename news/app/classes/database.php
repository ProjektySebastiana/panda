<?php

class Database
{
    protected $conn = null;

    function __construct()
    {
        $this->connect();
        $this->setupDatabase();
        $this->setupEntities();
        $this->setupDefaults();
    }

    private function connect()
    {

        $this->conn = mysqli_connect(DB['host'], DB['user'], DB['pass']);

        if (!$this->conn) {
            if (DEBUG) { echo 'Database connection faild: ' . mysqli_connect_error(); }
            die();
        }
        else {
            if (DEBUG) { echo 'Database connection success<br/>'; }
        }

    }

    private function setupDatabase()
    {

        if (mysqli_select_db($this->conn, DB['name'])) {
            if (DEBUG) { echo 'Database ' . DB['name'] . ' is availible<br/>'; }
        }
        else {
            if (mysqli_query($this->conn, 'CREATE DATABASE ' . DB['name'] . ';')) {
                mysqli_select_db($this->conn, DB['name']);
                if (DEBUG) { echo 'Database ' . DB['name'] . ' created successfully<br/>'; }
            }
            else {
                if (DEBUG) { echo 'Got error while trying to create ' . DB['name'] . '  database: ' . mysqli_error() . '<br/>'; }
            };
        }

    }


    private function setupEntities()
    {

        foreach (DB['entities'] as $table => $columns) {

            $result = $this->query('SELECT * FROM ' . $table . ';');

            if ($this->error()) {
                $query = 'CREATE TABLE ' . $table . ' (' . join(', ', $columns) . ');';
                $result = $this->query($query);

                if ($result === false) {
                    if (DEBUG) { echo 'Got error while trying to create table ' . $table . ': ' . mysqli_error($this->conn).'<br/>'; }
                }
                else {
                    if (DEBUG) { echo 'Table ' . $table . ' created successfully<br/>'; }
                }
            }
            else {
                if (DEBUG) { echo 'Table ' . $table . ' already exists<br/>'; }
            }

        }
    }

    private function setupDefaults()
    {
        foreach (DB['defaults'] as $table => $values) {
            $result = $this->query('SELECT * FROM ' . $table . ';');

            if (mysqli_num_rows($result) == 0) {
                $query = 'INSERT INTO ' . $table . ' VALUES ';
                $i = 0;
                foreach ($values as $value) {
                    $query .= '("' . join('", "', $value) . '")';
                    if (++$i < count($values)) {
                        $query .= ', ';
                    }
                }
                $query .= ';';

                $this->query($query);
            }
        }
    }


    public function query($query)
    {

        $result = mysqli_query($this->conn, $query);

        return strlen(mysqli_error($this->conn)) ? mysqli_error($this->conn) : $result;

    }

    public function error()
    {

        return mysqli_error($this->conn);

    }

    public function insertedId()
    {

        return mysqli_insert_id($this->conn);

    }

    public function postExtraction($important, $params)
    {
        $output = [];
        foreach ($important as $key) {
            $output[$key] = $this->fixString($params[$key]);
        }
        return $output;
    }

    public function fixString($value)
    {
        return mysqli_real_escape_string($this->conn, $value);
    }

    private function disconnect()
    {
        if ($this->conn) {
            mysqli_close($this->conn);
            if (DEBUG) { echo "Disconnected from server"; }
        }
    }

    function __destruct()
    {
        $this->disconnect();
    }
}