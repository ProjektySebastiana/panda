<?php

class CSV
{
    private $db;

    function __construct($db)
    {
        $this->db = $db;
    }

    private function dataTypes($columns, $check)
    {
        $callback = function($x, $y, $z)
        {
            $type = $z['type'][$x];
            $length = $z['length'][$x];
            return $y . ' ' . $type . '(' . $length . ')';
        };

        return join(', ', array_map_assoc($callback, $columns, $check));
    }

    private function extractData($rows)
    {
        $check = $values = $columns = [];
        $check['length'] = $check['type'] = [];

        foreach ($rows as $row) {
            $row = str_getcsv($row);

            if (count($columns) == 0) {
                $columns = $row;
            }
            elseif (count($row) > 0 && $row[0] !== null) {
                $values[] = '("' . join('", "', $row) . '")';
                $check = $this->checkTypes($row, $check);
            }

        }
        return [
            'columns' => $columns,
            'values' => $values,
            'types' => $check
        ];
    }
    
    private function checkTypes($row, $check)
    {
        $i = 0;
        foreach ($row as $item) {

            if (!isset($check['length'][$i])) {
                $check['length'][$i] = strlen($item);
            }
            elseif ($check['length'][$i] < strlen($item)) {
                $check['length'][$i] = strlen($item);
            }

            if (is_numeric($item)) {
                $type = $item == (int) $item ? 'INT' : 'DOUBLE';
            }
            else {
                $type = 'VARCHAR';
            }

            if (!isset($check['type'][$i])) {
                $check['type'][$i] = $type;
            }
            elseif ($check['type'][$i] !== $type || in_array('VARCHAR', [$type, $check['type'][$i]])) {
                $check['type'][$i] = 'VARCHAR';
            }

            $i++;
        }
        
        return $check;
    }

    private function saveWholeTable($file, $data)
    {
        $query = 'CREATE TABLE ' . $file . ' (' . $this->dataTypes($data['columns'], $data['types']) . ');';
        $status = $this->db->query($query);
        if ($status === true) {
            $query = 'INSERT INTO ' . $file . ' (' . join(',', $data['columns']) . ') VALUES ' .join(', ', $data['values']) . ';';
            $status = $this->db->query($query);
        }

        return $status;
    }

    private function saveChartTable($file, $name)
    {
        $query = 'CREATE TABLE ' . $file . '_' . $name . ' AS (SELECT ' . $name . ', COUNT(' . $name . ') FROM ' . $file . ' GROUP BY ' . $name . ' ORDER BY COUNT(' . $name . ') DESC);';
        $status = $this->db->query($query);
        return $status === true || preg_match('/^Table.*already exists$/', $status);
    }

    public function save2db($params = [])
    {
        $file = $params['file'];
        $csv = file_get_contents(__DIR__ . '/../../assets/csv/' . $file . '.csv');
        $rows = explode(PHP_EOL, $csv);

        $data = $this->extractData($rows, $params['column']);
        return [
            'all' => $this->saveWholeTable($file, $data) === true,
            'chart' => $this->saveChartTable($file, $params['column']),
            'name' => $file . '_' . $params['column']
        ];

    }
}