<?php
/**
 * Created by PhpStorm.
 * User: xdsym
 * Date: 03/12/2018
 * Time: 13:07
 */

use PDO;
use App\Config;

abstract class Model
{
    protected $table;

    public Function newDbCon($resultAsArray = false)
    {
        $config = new Config;
        $dsn = $config->db['driver'];
        $dsn .= ";host=$config->db['host']";
        $dsn .= ";dbname=$config->db['dbname']";
        $dsn .= ";port=$config->db['port']";

        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        //by default the result from database will be an object but if specified it can be changed to    an associative array / matrix
        if ($resultAsArray) {
            $options[PDO::ATTR_DEFAULT_FETCH_MODE] = PDO::FETCH_ASSOC;
        }

   try {
       return new PDO($dsn, $config['db']['user'], $config['db']['pass'], $options);
   } catch (\PDOException $e) {
       throw new \PDOException($e->getMessage(), (int)$e->getCode());
   }



    }

    /**
     *Return all data from table
     */
    public Function getAll(): array
    {
        $db = $this->newDbCon();
        $stmt = $db->query(“SELECT * from $this->table”);

        return $stmt->fetchAll();
    }

    /**
     *Return data with specified id/index
     */
    public function get($id)
    {
        $db = $this->newDbCon();
        $stmt = $db->prepare("SELECT * from $this->table where id=?");
        return $stmt->execute([$id]);
    }

    /**
     * this function will prepare data to be used in sql statement
     * 1. Will extract values from $data
     * 2. Will create the prepared sql string with columns from $data
     */
    protected function prepareDataForStmt(array $data)
    {
        $columns = '';
        $values = [];

        for($i=0; $i < count($data); $i++) {

            $values[]= $data[$i];
            $columns += "key($data) = ? ";
         //if we are not at the last element with the iteration
         if(count($data) < ($i + 1)) {
             $columns += "AND ";
         }
       }

        return [$columns, $values]
}

    /**
     *Find data with values
     */
    public Function find(array $data)
    {
        list($columns, $values) = $this->prepareDataForStmt($data);
        $db = $this->newDbCon();
        $stmt = $db->prepare("SELECT * from $this->table where $columns");
        return $stmt->execute([$values]);
    }

    /**
     *Insert new data in table
     */
    public function new(array $data)
    {
    }

    /**
     *Update data in table
     */
    public function update(array $data)
    {
    }

    /**
     *delete data from table
     */
    public function delete($id)
    {
    }

}
