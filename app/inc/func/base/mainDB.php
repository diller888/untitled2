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

    public function __construct($host = null, $username = null, $password = null, $dbname = null)
    {
        $this->mysqli = new mysqli($host, $username, $password, $dbname);
        $this->mysqli->query("SET lc_time_names = 'ru_RU'");
        $this->mysqli->query("SET NAMES 'utf8'");
    }

    public function select($table, $params)
    {
        if ($table) {
            $where = '';
            if ($params) {
                $num = 0;
                foreach ($params as $key => $value) {
                    $num++;
                    $where .= ($num != 1 ? " AND" : " WHERE") . " `" . $key . "` = '" . $value . "'";
                }
                $query = "SELECT * FROM `" . $table . "` " . $where;
                $result = mysqli_fetch_array($this->mysqli->query($query));
                if (!$result) return false;
                return (object)$result;
            } else
                return false;
        } else
            return false;
    }

    public function results($table, $params)
    {
        $where = '';
        if ($params) {
            $num = 0;
            foreach ($params as $key => $value) {
                $num++;
                $where .= ($num != 1 ? " AND" : " WHERE") . " `" . $key . "` = '" . $value . "'";
            }
        }
        $query = "SELECT `id` FROM `" . $table . "` " . $where;
        $result = mysqli_num_rows($this->mysqli->query($query));
        if (!$result) return false;
        return (int)$result;
    }

    public function selectOne($table, $key, $value)
    {
        if ($key) {
            if ($value) {
                $query = "SELECT * FROM `" . $table . "` WHERE `" . $key . "` = '" . $value . "'";
                $result = mysqli_fetch_array($this->mysqli->query($query));
                if (!$result) return false;
                return (object)$result;
            } else
                return false;
        } else
            return false;
    }

    public function selectRow($table, $params)
    {
        if ($table) {
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
            } else
                return false;
        } else
            return false;
    }

    public function insert($table, $params)
    {
        if ($table) {
            if ($params) {
                $key = '';
                $value = '';
                $count = count($params);
                $num = 0;
                foreach ($params as $item => $rows) {
                    $num++;
                    $key .= "`" . $item . "`" . ($num < $count ? ', ' : null);
                    $value .= "'" . $rows . "'" . ($num < $count ? ', ' : null);
                }
                $query = "INSERT INTO `" . $table . "` (" . $key . ") VALUES (" . $value . ")";
                $result = $this->mysqli->query($query);
                if (!$result) return false;
                $ID = mysqli_insert_id($result);
                return $ID;
            } else
                return false;
        } else
            return false;
    }

    public function update($table, $params, $id)
    {
        if ($table) {
            if ($params) {
                if ($id) {
                    $value = '';
                    $count = count($params);
                    $num = 0;
                    foreach ($params as $item => $rows) {
                        $num++;
                        $value .= "`" . $item . "` = '" . $rows . "'" . ($num < $count ? ', ' : null);
                    }
                    $query = "UPDATE `" . $table . "` SET $value WHERE `id` = '" . $id . "'";
                    $result = $this->mysqli->query($query);
                    if (!$result) return false;
                    return true;
                } else
                    return false;
            } else
                return false;
        } else
            return false;
    }

    public function dbquery($table, $params, $limit = 1, $order = '', $sort = '')
    {
        if ($table) {
            if ($params) {
                if ($limit) {
                    if ($order) {
                        $query = "SELECT * FROM `" . $table . "` WHERE " . $params . " ORDER BY `" . $order . "` " . $sort . " LIMIT " . $limit;
                    } else {
                        $query = "SELECT * FROM `" . $table . "` WHERE " . $params . " LIMIT " . $limit;
                    }
                } else {
                    $query = "SELECT * FROM `" . $table . "` WHERE " . $params;
                }
                $result = $this->mysqli->query($query);
                if (!$result) return false;
                return $result;
            } else
                return false;
        } else
            return false;
    }

    public function delete($table, $key)
    {
        if ($table) {
            if ($key) {
                $query = "DELETE FROM `" . $table . "` WHERE `id` = '" . $key . "' LIMIT 1";
                $result = $this->mysqli->query($query);
                if (!$result) return false;
                return true;
            } else
                return false;
        } else
            return false;
    }
}