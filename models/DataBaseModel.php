<?php


class DataBaseModel
{

    private static $db;
    protected static $sql;
    protected static $_instance;

    private function __construct()
    {
        self::$db = new PDO("mysql:host=" . HOST . ";dbname=" . DB, USER, PASS);
        self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    private function __clone()
    {
    }

    public static function connect()
    {
        if (null === self::$_instance) {

            self::$_instance = new DataBaseModel();
        }

        return self::$_instance;
    }
    public static function select($name)
    {
        self::$sql .= "SELECT $name";
        return self::$_instance;
    }

    public static function from($name)
    {
        self::$sql .= " FROM $name";
        return self::$_instance;
    }

    public static function where($name)
    {
        //self::$sql .= "WHERE $name=?";
        self::$sql .= " WHERE $name";
        return self::$_instance;
    }

    public static function exec()
    {
        $query = self::$db->prepare(self::$sql);
        $resQ = $query->execute();

        $arrRes = array();
        while($r = $query->fetch(PDO::FETCH_ASSOC))
        {
            $arrRes[]= $r;
        }
        self::$sql = '';
        return $arrRes;
    }

    public static function insert($name)
    {
        self::$sql = '';
        self::$sql .= "INSERT INTO $name";
        return self::$_instance;

    }

    public static function fields($name)
    {
        self::$sql .= "($name)";
        return self::$_instance;
    }

    public static function values($val)
    {
        self::$sql .= " VALUES ($val)";
        return self::$_instance;
    }

    public static function execInsert()
    {
        $query = self::$db->prepare(self::$sql);
        $resQ = $query->execute();
        $resQ = $query->rowCount();
        self::$sql = '';
        return $resQ;
    }
    public static function execInsertWithLastID()
    {
        $query = self::$db->prepare(self::$sql);
        $resQ = $query->execute();
        $lastId = self::$db->lastInsertId();
        self::$sql = '';
        return $lastId;
    }
    public static function delete($name)
    {
        self::$sql = '';
        self::$sql .= "DELETE FROM $name";
        return self::$_instance;
    }

    public static function whereD($name)
    {
        self::$sql .= " WHERE $name";
        return self::$_instance;
    }

    public static function execD()
    {
        $query = self::$db->prepare(self::$sql);
        $resQ = $query->rowCount();
        return $resQ;

    }

    public static function update($name)
    {
        self::$sql = '';
        self::$sql .= "UPDATE $name ";
        return self::$_instance;
    }

    public static function set($name)
    {
        self::$sql .= "SET $name ";
        return self::$_instance;
    }

} 