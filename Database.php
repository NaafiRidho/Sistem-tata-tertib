<?php
class Database
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function executeQuery($query, $params = [])
    {
        $stmt = sqlsrv_prepare($this->conn, $query, $params);
        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }
        sqlsrv_execute($stmt);
        return $stmt;
    }

    public function fetchAssoc($stmt)
    {
        return sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    }
}
?>
