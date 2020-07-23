<?php

namespace Config;

/**
 * Returns the environments variables, based on /env.php file. 
 * 
 * @copyright 2020, Juliano Bressan, BRX Digital (http://brxdigital.com)
 */
class Configuration 
{
	protected $data;

	protected $default;

	public function __construct()
	{
		$this->load(__DIR__ . "/../env.php");
	}
	
	/**
	 * @param string $file Filename of configuration file
	 * 
	 * @return void
	 */
	private function load($file) : void
	{
		$this->data = require $file;
	}

	/**
	 * Gets a key from configuration file. The properties can be accessed by sintax: 
	 * $config = new Configuration();
	 * $config->get("varibleName.separated.by.dots");
	 * 
	 * @param string $key The name of key. The dots will be used to advance one level in sub arrays. Example: ["somekey"] = ["subkey1" => "value", "subkey2" => "value"], where subkey1 can be accessed by $config->get("somekey.subkey1");
	 * @param null $default The default value, if a variable do not exists on configuration file
	 * 
	 * @return string The value of the variable
	 */
	public function get($key, $default = null)
	{
		$this->default = $default;

		$segments = explode('.', $key);
		$data = $this->data;

		foreach($segments as $seg) {
			if(isset($data[$seg]))
			{
				$data = $data[$seg];
			} 
			else
			{
				$data = $this->default;
			break;
			}
		}
		return $data;
	}

}