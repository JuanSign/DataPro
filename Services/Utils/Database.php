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
        $env = parse_ini_file('/etc/secrets/.env');

        $this->_dbHost = $env['DB_HOST'];
        $this->_dbUser = $env['DB_USER'];
        $this->_dbPass = $env['DB_PASS'];
        $this->_dbName = $env['DB_NAME'];
        $this->_dbPort = $env['DB_PORT'];

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
