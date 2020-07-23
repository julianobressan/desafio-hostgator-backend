<?php

namespace App\Models;

use App\Models\Database;

/**
 * Abstract class to provide base properties, methods and behavior Entities of the project.
 * 
 * @copyright 2020, Juliano Bressan, BRX Digital (http://brxdigital.com)
 */
abstract class Model
{

	/* INTERNAL METHODS */

	/**
	 * Converts an array of valeus in an object of the provided type
	 * @param string $class Type of the objects that will be parsed by the method
	 * @param array $array An array with the properties of the object
	 * 
	 * @return Model
	 */
	static protected function fetchObject($class, $array): Model
	{
		$object = new $class();

		foreach ($array as $key => $value) {
			$object->$key = $value;
			$object->oldValues[$key] = $value;
		}

		return $object;
	}

	/**
	 * Return one object of a N:1 (many-to-one) relationship
	 * @param string $class Type of object that contains many object of this type
	 * 
	 * @return Model The object that this entity belongs to. NULL will be returned if none exists.
	 */
	protected function belongsTo($class) : Model
	{
		$classToArray = explode('\\', $class);
		$fkName = lcfirst(array_pop($classToArray)) . '_id';
		return Database::selectById($class, $this->$fkName);
	}

	/**
	 * Return all objects that have this object in their foreign keys
	 * @param string $class The type of desired entities
	 * 
	 * @return array An array with all object found of the type provided and that belongs to this entity
	 */
	protected function hasMany($class): array
	{
		$classToArray = explode('\\', get_class($this));
		$className = array_pop($classToArray);
		return Database::selectRowsByForeign($class, [lcfirst($className) . "_id" => $this->id]);
	}

	/* PUBLIC METHODS TO AN INSTANCE OF MODEL */

	/**
	 * Insert (if entity do not exists) or update (if the entity already exists) one entity on database. Must be invoqued by an instancied object.
	 * @return void
	 */
	public function save(): void
	{
		throw new \Exception('To be implemented.');

		$class = get_class($this);
		/* If it is already a persistent object, runs update - DONE */
		if (isset($this->id)) {
			/* Get changed properties to persist - TODO: Move to private function */
			$newValues = array();
			foreach ($this->oldValues as $key => $value) {
				if ($key != 'id' && $value != $this->$key) $newValues[$key] = $this->$key;
			}
			Database::update($class, $this->id, $newValues);
		}
		/* If it is new object, runs insert - DONE */ else {
			$values = array();
			foreach (get_object_vars($this) as $key => $value) {
				if ($key != 'id') $values[$key] = $this->$key;
			}
			$this->id = Database::insert($class, $values);
		}
	}

	/**
	 * Delete from database the instanced object. Will be implemented on next version.
	 * @return void
	 */
	public function delete(): void
	{
		throw new \Exception('To be implemented.');
	}

	/**
	 * Update on database the instanced object. Will be implemented on next version.
	 * @return void
	 */
	public function update($array): void
	{
		throw new \Exception('To be implemented.');
	}


	/* PUBLIC AND STATIC METHODS */

	/**
	 * Select on object of type the invoquing class from database, based on provided ID. Example: To return a Person with ID 1, call Person::find(1);
	 * @param integer $id The ID of the desired object
	 * 
	 * @return mixed The object corresponding with the provided ID. NULL will be returned with do not exists.
	*/
	static public function find($id = null)
	{
		if (is_null($id)) throw new \InvalidArgumentException("Object ID not provided.");

		$class = get_called_class();
		$object = Database::selectById($class, $id);

		// if (is_null($object)) {
		// 	throw new \Exception("Don't exists a object $class with ID $id");
		// }

		return $object;
	}

	static public function all() : array
	{
		$class = get_called_class();
		$rows = Database::selectRowsByType($class);

		return $rows;
	}

	static public function destroy($id) : void
	{
		throw new \Exception('To be implemented.');
	}
}
