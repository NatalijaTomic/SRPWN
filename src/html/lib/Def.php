<?php

/**
 * Copyright (C) DreamTeam
 *
 */

namespace SRPWn;
use Exception;

class Definitions
{

    private $ds;

    function __construct()
    {
        require_once __DIR__ . '/../lib/DS.php';
        $this->ds = new DatabaseHandler();
    }
        public function getDefinitions()
        {
            $query = 'SELECT top 10 * FROM dbo.Definitions d 
            INNER JOIN dbo.Synonyms s ON d.IdSrpwn = s.IdSrpwn
            INNER JOIN dbo.SRPWN srp ON srp.IdSrpwn = s.IdSrpwn';
            $definitionsRecord = $this->ds->select($query);
            return $definitionsRecord;
        }
        public function definitionsSearch()
    {
        $query = 'SELECT * FROM dbo.Definitions d 
        INNER JOIN dbo.Synonyms s ON s.IdSrpwn = d.IdSrpwn 
        INNER JOIN dbo.Ilrs i ON i.IdSrpwn = d.IdSrpwn
        WHERE literal LIKE :literal' ;
        $param = [':literal' => '%$literal%'];
        $resultArray = $this->ds->select($query, $param);
        return $resultArray;
        foreach ($resultArray as $definition) {
            $id = $definition['Literal'];
            echo $id;

    }}
    public function agencyInsert()
        {
                if (strlen($_POST["agency-name"])>0){
                    $response = array(
                        "status" => "error",
                        "message" => "Ime agencije nije uneto."
                    );
                } else if (strlen($_POST["agency-adresa"])>0){
                    $response = array(
                        "status" => "error",
                        "message" => "Adresa nije uneta."
                    );
                }
                $image = $_FILES['agency-slika']['name'];  //the original name of the image

                $file_tmp =$_FILES['agency-slika']['tmp_name']; //The temporary filename of the file in which the uploaded image was stored on the server.
                try{
                    move_uploaded_file($file_tmp,"images/".$image); //uploads the image to the defined folder
                }
                catch (Exception $ex){
                    $image = "";
                }

                $query = 'INSERT INTO tbl_agency (agency, adresa, opis, slika) 
                                                    VALUES (?, ?, ?, ?)';
                $paramType = 'ssss';
                $paramValue = array(
                    $_POST["agency-name"],
                    $_POST["agency-adresa"],
                    $_POST["agency-opis"],
                    $image,
                );
                try{
                $agencyId = $this->ds->insert($query, $paramType, $paramValue);
                if (!empty($agencyId)) {
                    $response = array(
                        "status" => "success",
                        "message" => "Uspešno ste uneli agenciju.",
                        "id" => $agencyId
                    );
                }
                else
                $response = array(
                    "status" => "error",
                    "message" => "Agencija nije uneta."
                );
                }catch (Exception $e){
                    $response = array(
                        "status" => "error",
                        "message" => $e->getMessage()
                    );
                }
                return $response;
            }
    }
?>