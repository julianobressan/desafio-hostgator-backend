<?php
 
namespace App\Models;
 
use App\Models\Model;
use App\Models\Product;
use App\Models\CycleType;
 
/**
 * A class that represents a Cycle object
 * 
 * @copyright 2020, Juliano Bressan, BRX Digital (http://brxdigital.com)
 */
class Cycle extends Model {
    
    /**
     * The name of the table in database
     * @var string
     */
    public static $table = 'cycles';

    /**
     * The fields the can be inserted by users
     * @var array
     */
    protected $fillable = ['product_id', 'type_id', 'priceRenew', 'priceOrder'];

    /**
     * Return the Product associed with this Cycle
     * @return Product A Product object
     */
    public function product() : Product
    {
        return $this->belongsTo(Product::class);
    }
    
    /**
     * Return the CycleType associed with this Cycle
     * @return CycleType A CycleType object
     */
    public function cycleType() : CycleType
    {
        return $this->belongsTo(CycleType::class);
    }
}
 