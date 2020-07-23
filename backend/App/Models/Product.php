<?php
 
namespace App\Models;

use App\Models\Model;
 
//use Illuminate\Database\Eloquent\Model;
 
/**
 * An object that represents Product entities
 * 
 * @copyright 2020, Juliano Bressan, BRX Digital (http://brxdigital.com)
 */
final class Product extends Model {

    /**
     * The name of the table in database
     * @var string
     */
    public static $table = 'products';
    
    /**
     * The fields the can be inserted by users
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * Return all the Cycle object that are relacioned with this Product object
     * @return array An array with Cycle objects
     */
    public function cycles() : array
    {
        return $this->hasMany('App\Models\Cycle');
    }
}
 