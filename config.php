<?php
class config
{
    protected $conn;
    function __construct()
    {
        $this->conn = new mysqli("localhost", "root", "", "product_api");
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }
}
?>