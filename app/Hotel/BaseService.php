<?php

namespace Hotel;

use PDO;
use Exception;
use PDOException;
use Support\Configuration\Configuration;

class BaseService
{
    private static $pdo;

    public function __construct()
    {
        $this->initializePdo();
    }
    
    public function initializePdo()
    {
        //Check if pdo is already initialized
        if(!empty(self::$pdo)){
            return;
        }

        //Load database configuration
        $config = Configuration::getInstance();
        $databaseConfig = $config->getConfig()['database'];

        //Connect to database
        try{
            $this->pdo = new PDO(sprintf('mysql:host=%s;dbname=%s;charset=UTF8', $databaseConfig['host'],$databaseConfig['dbname']), $databaseConfig['username'],
            $databaseConfig['password'], [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"]);
            } catch(PDOException $ex){
                throw new Exception(sprintf('Could not connect to database. Error: %s', $ex->getMessage()));
            }
    }

    protected function execute($sql, $parameters)
    {
        // Prepare parameters
        $statement = $this->getPdo()->prepare($sql);

        // Execute
        $status = $statement->execute($parameters);
        if(!$status){
            throw new Exception($statement->errorInfo()[2]);
        }

        return $status;
    }

    protected function fetchAll($sql, $parameters = [], $type = PDO::FETCH_ASSOC)
    {
        //Parameters statement
        $statement = $this->getPdo()->prepare($sql);

        //execute
        $status = $statement->execute($parameters);
        if(!$status){
            throw new Exception($statement->errorInfo()[2]);
        }

        //Fetch all
        return $statement->fetchAll($type);
    }

    protected function fetch($sql, $parameters = [], $type = PDO::FETCH_ASSOC)
    {
        //Parameters statement
        $statement = $this->getPdo()->prepare($sql);

        //execute
        $status = $statement->execute($parameters);
        if(!$status){
            throw new Exception($statement->errorInfo()[2]);
        }

        //Fetch
        return $statement->fetch($type);
    }

    protected function getPdo()
    {
        return $this->pdo;
    }
}