<?php

namespace App\Models;

use Config\Configuration;

/**
 * This class connects to a MySQL database and executes the methods to manipulate a schema. 
 * TODO: Only the methods for select rows was implemented. The future implementations must be implement anothers methods of
 * manipulation of data. Also, suport for multiple DBs will be implemented.
 * 
 * @copyright 2020, Juliano Bressan, BRX Digital (http://brxdigital.com)
 */
final class Database {

	/**
	 * Function to connect with the database, base on the environment variables of /env.php file.
	 * 
	 * @return \PDO Return PDO object with the connection
	 */
	private static function connect() : \PDO
	{
		$config = new Configuration();
		$environment = $config->get("environment");
		$dbHost = $config->get("database.{$environment}.host");
		$dbSchema = $config->get("database.{$environment}.name");
		$link = new \PDO("mysql:host={$dbHost};dbname={$dbSchema}", $config->get("database.{$environment}.user"), $config->get("database.{$environment}.pass"));
		$link->exec('set names utf-8');
		return $link;
	}

	/**
	 * Return an object from database of any type inherited from Model by a provide ID (PK)
	 * @param string $class The type of object the inherits from Model class
	 * @param integer $id ID of the entity on the database
	 * 
	 * @return mixed Return an object of the same type provided in $class parameterm, corresponding of the ID provided. Null will be returned if do not exists.
	 */
	public static function selectById($class, $id)
	{
		$table = $class::$table;
		$statement = self::connect()->prepare("SELECT * FROM $table WHERE id = {$id}");
		$statement->execute();
		$objects = $statement->fetchAll(\PDO::FETCH_CLASS, $class);
		if(count($objects) == 0) return null;
		else return $objects[0];
	}

	/**
	 * Select all entities of a type in the database
	 * @param string $class The type of object the inherits from Model class
	 * 
	 * @return array Return an array with all objects found in the database with the provided type in @class parameter. An array empty will be returned if no rows was found.
	 */
	public static function selectRowsByType($class) : array
	{
		$table = $class::$table;
		$statement = self::connect()->prepare("SELECT * FROM $table");
		$statement->execute();
		return $statement->fetchAll(\PDO::FETCH_CLASS, $class);

	}

	/**
	 * Select all entities with some Foreign Key
	 * @param string $class The type of object the inherits from Model class
	 * @param array $foreignKeys An array with values of the foreign key (Example: ["person_id" => 1]). Use multiples valeus if the FK is complex.
	 * 
	 * @return array An array with all results of type provided in @class parameter that corresponds of the provided foreign key
	 */
	public static function selectRowsByForeign($class, array $foreignKeys) : array
	{
		$table = $class::$table;
		$whereClausules = "";
		foreach($foreignKeys as $key => $value)
		{
			if(!empty($whereClausules)) $whereClausules .= " AND ";
			$whereClausules .= $key . "='" . $value . "'";
		}
		$statement = self::connect()->prepare("SELECT * FROM $table WHERE $whereClausules");
		$statement->execute();
		return $statement->fetchAll(\PDO::FETCH_CLASS, $class);

	}

	/**
	 * Select one single value from a row of database
	 * @param string $table Table name
	 * @param string $column Name of the column
	 * @param array $array An array with the paramethers (only AND filters are allowed in this version)
	 * 
	 * @return mixed The value found
	 */
	public static function selectValue($table, $column, array $array) {
		$query = "SELECT {$column} FROM {$table} WHERE ";
		foreach ($array as $key => $value) {
			$query .= $key . " = '" . $value . "' AND ";
		}
		/* REMOVE LAST ' AND ' */
		$query = substr($query, 0, -5); 
		$statement = self::connect()->prepare($query);
		$statement->execute();
		$result = $statement->fetch();
		return $result[$column];
	}

	/**
	 * Select something based on a SQL query
	 * @param string $query The SQL query
	 * 
	 * @return array The return of the query
	 */
	public static function selectRaw($query) : array
	{
		$statement = self::connect()->prepare($query);
		$statement->execute();
		return $statement->fetchAll();
	}


	/**
	 * Delete on record of a type in the database, based on its ID. Not implemented on this version.
	 * @param string $class Object type
	 * @param mixed $id ID of the object
	 * 
	 * @return [type]
	 */
	public static function delete($class, $id) : void 
	{
		throw new \Exception("To be implemented.");
	}


	/**
	 * Inserts one new object on database
	 * @param string $class Type of the object
	 * @param array $values An array with fillable values of the object
	 * 
	 * @return integer The ID of inserted object
	 */
	public static function insert($class, array $values) {
		$table = $class::$table;

		$columns = "";
		$vals = "";
		foreach ($values as $key => $value) {
			$columns .= $key . ", ";
			$vals .= "'". $value . "', ";
		}
		/* REMOVE LAST ', ' */
		$columns = substr($columns, 0, -2); 
		$vals = substr($vals, 0, -2); 

		try{
			$pdo = self::connect();
			$statement = $pdo->prepare("INSERT INTO $table ($columns) VALUES ($vals)");
			$statement->execute($values);
			return $pdo->lastInsertId();
		}
		catch(\PDOException $e) {
			throw $e;
			
		}

	}

	/**
	 * Update values of a object in database
	 * @param string $class Type of the object
	 * @param integer $id The ID of the object
	 * @param array $newValues The new values to be updated
	 * 
	 * @return bool Retuns a oolean values indicating if was succefully executed
	 */
	public static function update($class, $id, array $newValues) {		 
		
		$table = $class::$table;

		$setClausules = "";
		foreach ($newValues as $key => $value) {
			$setClausules .= $key . "=:" . $key . ", ";
		}
		/* REMOVE LAST ', ' */
		$setClausules = substr($setClausules, 0, -2); 

		$statement = self::connect()->prepare("UPDATE {$table} SET {$setClausules} WHERE id = {$id}");
		$statement->execute($newValues);
		$count = $statement->rowCount();

		if($count =='0'){
		    return false;
		}
		return true;

	}

}