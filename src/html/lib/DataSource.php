<?php
/**
 * Copyright (C) DreamTeam
 *
 */
namespace SRPWn;

use PDO;

class DataSource extends PDO
{
    private $conn;
    public function __construct()
   {
      $this->conn = new PDO( "sqlsrv:server= LAPTOP-O86B7GAO ; Database = SWN_Demo","sa","12345");
   }

   public function getConnection()
   {
      $conn = new PDO("sqlsrv:server= LAPTOP-O86B7GAO ; Database = SWN_Demo", "sa", "12345");
      if ($conn) {
         echo "Connection established.<br />";
      }
      return $conn;
   }
   public function select($query, $paramType = "", $paramArray = array())
    {
        $stmt = $this->conn->prepare($query);

        if (! empty($paramType) && ! empty($paramArray)) {

            $stmt->bindParam( $paramType, $paramArray);
        } 
        $stmt->execute();
        $rows = $stmt->fetchAll();

        return $rows;
        }
public function execute($query, $paramType = "", $paramArray = array())
    {
        $stmt = $this->conn->prepare($query);

        if (! empty($paramType) && ! empty($paramArray)) {
            $this->bindQueryParams($stmt, $paramType, $paramArray);
        }
        $stmt->execute();
    }
}