<?php
// namespace Tests\
use PHPUnit\Framework\TestCase;
use App\Models\CycleType;

class CycleTypesTest extends TestCase
{
    /**
     * @covers CycleType::find
     */
    public function testFindExistentCycleType()
    {
        $cycle = CycleType::find(5);
        $this->assertNotNull($cycle);
        $this->assertEquals($cycle->months, 24);
    }
}