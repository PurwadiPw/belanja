<?php
class Database
{
    const DB_HOST = 'localhost';
    const DB_USER = 'root';
    const DB_PASS = '';
    const DB_NAME = 'belanja';

    private static $mysqli = null;
    private $db;

    private function __construct()
    {
        $this->db = new mysqli(self::DB_HOST, self::DB_USER, self::DB_PASS, self::DB_NAME) or die('Koneksi gagal');
    }

    public static function getInstance()
    {
        if (!is_object(self::$mysqli)) {
            self::$mysqli = new Database();
            if (mysqli_connect_errno()) {
                throw new Exception("Koneksi database gagal: " . mysqli_connect_error());
            }
        }
        return self::$mysqli;
    }

    public function query($sql)
    {
        return $this->db->query($sql);
    }

    public function get_one($sql)
    {
        $response = $this->query($sql);
        if (is_object($response)) {
            return $response->fetch_object();
        }
        return null;
    }

    public function get_all($sql)
    {
        $response = $this->query($sql);
        if (!is_object($response)) {
            return null;
        }

        $rows = array();
        while ($row = $response->fetch_object()) {
            $rows[] = $row;
        }
        return empty($rows) ? null : $rows;
    }

    private function __clone()
    {

    }
}
