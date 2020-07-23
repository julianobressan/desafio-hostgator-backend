<?php
// namespace Tests\
use PHPUnit\Framework\TestCase;
use App\Models\Product;
use App\Models\Cycle;
use App\Models\Database;

class CycleTest extends TestCase
{
    /**
     * @covers Cycle::find
     */
    public function testFindExistentCycle()
    {
        $cycle = Cycle::find(5);
        $this->assertNotNull($cycle);
        $this->assertEquals($cycle->priceRenew, 393.36);
    }

    /**
     * @covers Cycle::find
     */
    public function testFindNotExistentCycle()
    {
        // $this->expectExceptionMessage("Don't exists a object App\Models\Cycle with ID 1");
        $cycle = Cycle::find(100);
        $this->assertNull($cycle);
    }

    /**
     * @covers Cycle::all
     */
    public function testAllCyclesFinding()
    {
        $allCycles = Cycle::all();
        $this->assertEquals(25, count($allCycles));

        $this->assertEquals($allCycles[0]->priceRenew, 24.19);

    }

    /**
     * @covers Cycle::delete
     * @expectedException \Exception
     * @expectedExceptionMessage To be implemented.
     */
    public function testDeleteCycle()
    {
        $this->expectExceptionMessage("To be implemented.");
        $cycle = Cycle::find(5);
        $cycle->delete();
    }

    /**
     * @covers Cycle::save
     * @expectedException \Exception
     * @expectedExceptionMessage To be implemented.
     */
    public function testSaveChangesOnCycle()
    {
        $this->expectExceptionMessage("To be implemented.");
        $cycle = Cycle::find(5);
        $cycle->priceRenew = 1.00;
        $cycle->save();
    }

    /**
     * @covers Cycle::product
     */
    public function testGetProductOfACycle()
    {
        $cycle = Cycle::find(5);
        $product = $cycle->product();
        $this->assertNotNull($product);

    }

    /**
     * @covers Cycle::cycleType
     */
    public function testGetCycleTypeOfACycle()
    {
        $cycle = Cycle::find(5);
        $cycleType = $cycle->cycleType();
        $this->assertNotNull($cycleType);

    }
}