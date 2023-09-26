<?php

/**
 * Copyright (C) DreamTeam
 *
 */

namespace SRPWn;
use Exception;

class Literal
{

    private $ds;

    function __construct()
    {
        require_once __DIR__ . '/../lib/DS.php';
        $this->ds = new DatabaseHandler();
    }
        public function getLiteral()
        {
            $query = 'SELECT * FROM dbo.Synonyms';
            $definitionsRecord = $this->ds->select($query);
            return $definitionsRecord;
        }
        public function Search()
    {
        $query = 'SELECT * FROM [dbo].[fn_getSynsetLiterals](SynsetID,"sr")';
        $resultArray = $this->ds->select($query);
        return $resultArray;
    }

       
    public function literalContains()
    {
        $literal = $_POST["literal"];
        $query = 'SELECT * FROM dbo.Definitions d 
        INNER JOIN dbo.Synonyms s ON s.IdSrpwn = d.IdSrpwn 
        INNER JOIN dbo.SRPWN sr ON sr.IdSrpwn = d.IdSrpwn 
        WHERE Def LIKE :literal' ;
        $param = [':literal' => $literal.'%'];
        $resultArray = $this->ds->select($query, $param);
        return $resultArray;
    }
    
    public function definitionsSearch()
    {
        $literal = $_POST["literal"];
        $query = 'SELECT * FROM dbo.Definitions d 
        INNER JOIN dbo.Synonyms s ON s.IdSrpwn = d.IdSrpwn 
        INNER JOIN dbo.SRPWN sr ON sr.IdSrpwn = d.IdSrpwn 
        WHERE Def LIKE :literal' ;
        $param = [':literal' => '%'.$literal.'%'];
        $resultArray = $this->ds->select($query, $param);
        return $resultArray;
    }
    
    public function definitionContains()
    {
        $literal = $_POST["literal"];
        $query = 'SELECT * FROM dbo.Definitions d 
        INNER JOIN dbo.Synonyms s ON s.IdSrpwn = d.IdSrpwn 
        INNER JOIN dbo.SRPWN sr ON sr.IdSrpwn = d.IdSrpwn 
        WHERE Def LIKE :literal' ;
        $param = [':literal' => $literal.'%'];
        $resultArray = $this->ds->select($query, $param);
        return $resultArray;
    }
    }
?>