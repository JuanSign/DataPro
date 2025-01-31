<?php

class Database
{
    private $_dbHost;
    private $_dbUser;
    private $_dbPass;
    private $_dbName;
    private $_dbPort;
    private $_conn = null;

    private static $_instance = null;

    public function __construct()
    {

        $this->_dbHost = getenv('DB_HOST');
        $this->_dbUser = getenv('DB_USER');
        $this->_dbPass = getenv('DB_PASS');
        $this->_dbName = getenv('DB_NAME');
        $this->_dbPort = getenv('DB_PORT');

        $this->connect();
    }

    private function connect()
    {
        try {
            $this->_conn = new mysqli(
                $this->_dbHost,
                $this->_dbUser,
                $this->_dbPass,
                $this->_dbName,
                $this->_dbPort
            );
        } catch (mysqli_sql_exception $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public static function getConnection()
    {
        if (self::$_instance === null)        self::$_instance = new Database();
        if (!self::$_instance->_conn->ping()) self::$_instance->connect();

        return self::$_instance->_conn;
    }
}
