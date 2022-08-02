<?php

class mainDB
{

    private static $db = null;

    private $mysqli;

    public static function getDB()
    {
        if (self::$db == null) self::$db = new mainDB();
        return self::$db;
    }

    public function __construct($host = null, $username = null, $password = null, $dbname = null, $charset = 'utf8')
    {
        $this->mysqli = new mysqli($host, $username, $password, $dbname);
        $this->mysqli->query("SET lc_time_names = 'ru_RU'");
        $this->mysqli->query("SET NAMES 'utf8'");
    }

    public function select($table, $params)
    {
        $where = '';
        if ($params) {
            $num = 0;
            foreach ($params as $key => $value) {
                $num++;
                $where .= ($num != 1 ? " AND" : " WHERE") . " `" . $key . "` = '" . $value . "'";
            }
        }
        $query = "SELECT * FROM `" . $table . "` " . $where;
        $result = mysqli_fetch_array($this->mysqli->query($query));
        if (!$result) return false;
        return (object)$result;
    }

    public function selectOne($table, $key, $value)
    {
        if ($key) {
            if ($value) {
                $query = "SELECT * FROM `" . $table . "` WHERE `" . $key . "` = '" . $value . "'";
                $result = mysqli_fetch_array($this->mysqli->query($query));
                if (!$result) return false;
                return (object)$result;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function selectRow($table, $params)
    {
        if ($params) {
            $where = '';
            $num = 0;
            foreach ($params as $key => $value) {
                $num++;
                $where .= ($num != 1 ? " AND" : " WHERE") . " `" . $key . "` = '" . $value . "'";
            }
            $query = "SELECT * FROM `" . $table . "` " . $where;
            $result = $this->mysqli->query($query);
            if (!$result) return false;
            return (object)$result;
        } else {
            return false;
        }
    }

}