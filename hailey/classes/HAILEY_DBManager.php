<?php

/*
 * The MIT License
 *
 * Copyright 2015 s.kalski.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

/**
 * 
 *
 * @author s.kalski
 */
abstract class HAILEY_DBManager {

    protected $pkname;
    protected $tablename;
    protected $dbhfnname;
    protected $QUOTE_STYLE = 'MYSQL'; // valid types are MYSQL,MSSQL,ANSI
    protected $COMPRESS_ARRAY = true;
    public $rs = array(); // for holding all object property variables

    function __construct($pkname = '', $tablename = '', $dbhfnname = 'getdbh', $quote_style = 'MYSQL', $compress_array = true) {
        $this->pkname = $pkname; //Name of auto-incremented Primary Key
        $this->tablename = $tablename; //Corresponding table in database
        $this->dbhfnname = $dbhfnname; //dbh function name
        $this->QUOTE_STYLE = $quote_style;
        $this->COMPRESS_ARRAY = $compress_array;
    }

    /*
     * To change this license header, choose License Headers in Project Properties.
     * To change this template file, choose Tools | Templates
     * and open the template in the editor.
     */

    protected function getdbh() {
        return call_user_func($this->dbhfnname);
    }

    /**
     *   return all tables of the in configfile selected database
     * 
     * @author Swen Kalski
     * @return array with all tables
     */
    function readTables() {
        $dbh = $this->getdbh();
        $stmt = $dbh->prepare('show tables');
        $stmt->execute();
        return $stmt->fetchALL(PDO::FETCH_ASSOC);
    }

     /**
     *   return all colums of an selected table
     * 
     * @author Swen Kalski
     * @param string $table name of the table
     * @return array with all colums of table
     */
    function getCols($table) {
        $dbh = $this->getdbh();
        $stmt = $dbh->prepare('SHOW COLUMNS FROM ' . $table);
        $stmt->execute();
        return $stmt->fetchALL(PDO::FETCH_ASSOC);
    }
    
     /**
     *   return all private key of an selected table
     * 
     * @author Swen Kalski
     * @param string $table name of the table
     * @return array with private key colum of table
     */
    function getPK($table) {
        $dbh = $this->getdbh();
        $stmt = $dbh->prepare("SHOW INDEX FROM $table WHERE Key_name = 'PRIMARY'");
        $stmt->execute();
        return $stmt->fetchALL(PDO::FETCH_ASSOC);
    }
    
     /**
     *   proof if table exists
     * 
     * @author Swen Kalski
     * @param string $table name of the table
     * @return array with private key of table
     */
    function tableExists($table) {
        $dbh = $this->getdbh();
        $stmt = $dbh->prepare("SHOW INDEX FROM $table WHERE Key_name = 'PRIMARY'");
        $stmt->execute();
        return $stmt->fetchALL(PDO::FETCH_ASSOC);
    }
    
     /**
     *   creates an model class on the fly
     * 
     * @author Swen Kalski
     * @param string $table name of the table
     * @return class modell to futher use by controller
     */
    function createModel($table) {
        $pk = $this->getPK($table);
        $cols = $this->getCols($table);
        try {
            $class = "class " . $table . " extends H_Model { "
                    . "function " . $table . "() { "
                    . "parent::__construct('" . $pk[0]["Column_name"] . "','" . $table . "','getdbh');";
            foreach ($cols as $row => $key) {
                $class .= '$this->rs[\'' . $key['Field'] . '\']= \'\';';
            }
            $class .= "}"
                    . "}";
            eval($class);
        } catch (PDOException $pe) {
            trigger_error('Could not connect to MySQL database. ' . $pe->getMessage(), E_USER_ERROR);
        }
    }

}
