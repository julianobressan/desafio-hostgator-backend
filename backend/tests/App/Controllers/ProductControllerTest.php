<?php
// namespace Tests\

use App\Controllers\ProductController;
use PHPUnit\Framework\TestCase;
use App\Models\Product;

class ProductControllerTest extends TestCase
{
    /**
     * @covers ProductController::getAllPricesOfProducts
     */
    public function testGetAllPricesOfProducts()
    {
        $reflect = self::reflectMethod("allProductsToArray");
        $controller = new ProductController();
        $return = $reflect->invokeArgs($controller, []);
        $this->assertNotNull($return);
    }

    /**
     * @covers ProductController::productPricesToArray
     */
    public function testProductPricesToArray()
    {
        $reflect = self::reflectMethod("productPricesToArray");
        $controller = new ProductController();
        $products = $reflect->invokeArgs($controller, ["id" => 5]);
        $this->assertNotNull($products);
    }

    protected static function reflectMethod($name) {
        $class = new ReflectionClass(ProductController::class);
        $method = $class->getMethod($name);
        $method->setAccessible(true);
        return $method;
      }
}