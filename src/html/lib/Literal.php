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
        public function Searchtr()
    {
        $query = 'SELECT * FROM [dbo].[fn_getSynsetLiterals](SynsetID,"sr")';
        $resultArray = $this->ds->select($query);
        return $resultArray;
    }

       
    public function Search($kw,$tip,$lit,$def,$dom,$usage)
    {
        $kw = $_POST["literal"];
        $query = 'SELECT * ss.IdSrpwn, ss.ID, ss.Domain FROM SRPWN ss
        INNER JOIN dbo.Synonyms sy ON ss.IdSrpwn=sy.IdSrpwn 
        WHERE sy.Literal like :kw1
        UNION
	SELECT    ss.IdSrpwn, ss.ID, ss.Domain FROM SRPWN ss
	JOIN dbo.Definitions d ON ss.IdSrpwn=d.IdSrpwn
    WHERE d.Def like :kw1  and :Def=1
    UNION
	SELECT    ss.IdSrpwn, ss.ID, ss.Domain FROM SRPWN ss
	JOIN dbo.Usages u ON ss.IdSrpwn=u.IdSrpwn
	WHERE u.Usage like :kw1  and :Usage=1' ;
        $param = [':literal' => $kw.'%'];
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
