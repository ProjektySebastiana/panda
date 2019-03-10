<?php

class Chart
{
    private $db;

    function __construct($db)
    {
        $this->db = $db;
    }

    private function getData($table)
    {
        $query = 'SELECT * FROM ' . $table . ';';
        $result = $this->db->query($query);
        return mysqli_fetch_all($result);
    }

    public function generate($table)
    {
        $dataPoints = [];
        foreach ($this->getData($table) as $row) {
            $dataPoints[] = ["label" => $row[0], "y" => $row[1]];
        }
        if (count($dataPoints)) {
            echo '<script> var dataPoints = ' . json_encode($dataPoints, JSON_NUMERIC_CHECK) . '</script>';
            return true;
        }
        return false;
    }
}