<?php
// namespace Tests\
use PHPUnit\Framework\TestCase;
use App\Models\Cycle;
use App\Models\Database;

class DatabaseTest extends TestCase
{
    /**
     * @covers Database::selectRowsByForeign
     */
    public function testSelectRowsByForeign()
    {
        $cycles = Database::selectRowsByForeign(Cycle::class, ["product_id" => 5]);
        $this->assertEquals(count($cycles), 6);
    }
}