<?php
// namespace Tests\
use PHPUnit\Framework\TestCase;
use App\Models\Product;

class ProductTest extends TestCase
{
    /**
     * @covers Product::find
     */
    public function testFindExistentProduct()
    {
        $product = Product::find(5);
        $this->assertNotNull($product);
        $this->assertEquals($product->name, "Plano P");
    }

    /**
     * @covers Product::find
     */
    public function testFindNotExistentProduct()
    {
        // $this->expectExceptionMessage("Don't exists a object App\Models\Product with ID 1");
        $product = Product::find(1);
        $this->assertNull($product);
    }

    /**
     * @covers Product::all
     */
    public function testAllProductsFinding()
    {
        $allProducts = Product::all();
        $this->assertEquals(7, count($allProducts));

        $this->assertEquals($allProducts[0]->name, "Plano P");
        $this->assertEquals($allProducts[1]->name, "Plano M");

    }

    /**
     * @covers Product::delete
     * @expectedException \Exception
     * @expectedExceptionMessage To be implemented.
     */
    public function testDeleteProduct()
    {
        $this->expectExceptionMessage("To be implemented.");
        $product = Product::find(5);
        $product->delete();
    }

    /**
     * @covers Product::save
     * @expectedException \Exception
     * @expectedExceptionMessage To be implemented.
     */
    public function testSaveChangesOnProduct()
    {
        $this->expectExceptionMessage("To be implemented.");
        $product = Product::find(5);
        $product->name = "Plano B";
        $product->save();
    }

    /**
     * @covers Product::find
     */
    public function testGetCyclesOfAProduct()
    {
        $product = Product::find(5);
        $cycles = $product->cycles();
        $this->assertEquals(count($cycles), 6);
    }
}

