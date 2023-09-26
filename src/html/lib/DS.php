<?php
/**
 * Copyright (C) DreamTeam
 *
 */
namespace SRPWn;

use PDO;
class DatabaseHandler {
    private $pdo;
    const host = "LAPTOP-O86B7GAO ";
    const dbname = "SWN_Demo";
    const username = "sa";
    const password = "1234";    
    public function __construct() {
        try {
            $this->pdo = new PDO( "sqlsrv:server= LAPTOP-O86B7GAO ; Database = SWN_Demo","sa","12345");            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            // Log the error and handle it appropriately
            error_log("Connection failed: " . $e->getMessage(), 0);
            throw new Exception("Database connection failed");
        }
    }
    
    public function executeQuery($query, $params = []) {
        try {
            $statement = $this->pdo->prepare($query);
            $statement->execute($params);
            return $statement;
        } catch (PDOException $e) {
            // Log the error and handle it appropriately
            error_log("Query execution failed: " . $e->getMessage(), 0);
            throw new Exception("Query execution failed");
        }
    }
    
    public function select($query, $params = []) {
        $statement = $this->executeQuery($query, $params);
         $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
         return $rows;
    }
    
    public function fetchOne($query, $params = []) {
        $statement = $this->executeQuery($query, $params);
        return $statement->fetch(PDO::FETCH_ASSOC);
    }
    
    // Add more methods as needed for specific operations (insert, update, delete, etc.)
}
?>