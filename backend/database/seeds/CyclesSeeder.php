<?php


use Phinx\Seed\AbstractSeed;

class CyclesSeeder extends AbstractSeed
{
    public function getDependencies()
    {
        return [
            'CycleTypesSeeder',
            'ProductsSeeder'
        ];
    }


    public function run()
    {
        $data = [
            ['product_id' => 5,'cycleType_id' => 1,'priceRenew' => 24.19,'priceOrder' => 24.19],
            ['product_id' => 5,'cycleType_id' => 2,'priceRenew' => 67.17,'priceOrder' => 67.17],
            ['product_id' => 5,'cycleType_id' => 3,'priceRenew' => 128.34,'priceOrder' => 128.34],
            ['product_id' => 5,'cycleType_id' => 4,'priceRenew' => 220.66,'priceOrder' => 220.66],
            ['product_id' => 5,'cycleType_id' => 5,'priceRenew' => 393.36,'priceOrder' => 393.36],
            ['product_id' => 5,'cycleType_id' => 6,'priceRenew' => 561.13,'priceOrder' => 561.13],

            ['product_id' => 6,'cycleType_id' => 1,'priceRenew' => 29.69,'priceOrder' => 29.69],
            ['product_id' => 6,'cycleType_id' => 2,'priceRenew' => 82.77,'priceOrder' => 82.77],
            ['product_id' => 6,'cycleType_id' => 3,'priceRenew' => 159.54,'priceOrder' => 159.54],
            ['product_id' => 6,'cycleType_id' => 4,'priceRenew' => 286.66,'priceOrder' => 286.66],
            ['product_id' => 6,'cycleType_id' => 5,'priceRenew' => 532.562,'priceOrder' => 532.56],
            ['product_id' => 6,'cycleType_id' => 6,'priceRenew' => 764.22,'priceOrder' => 764.22],

            ['product_id' => 7,'cycleType_id' => 1,'priceRenew' => 44.99,'priceOrder' => 44.99],
            ['product_id' => 7,'cycleType_id' => 2,'priceRenew' => 131.97,'priceOrder' => 131.97],
            ['product_id' => 7, 'cycleType_id' => 3,'priceRenew' => 257.94,'priceOrder' => 257.94],
            ['product_id' => 7,'cycleType_id' => 4,'priceRenew' => 503.88,'priceOrder' => 503.88],
            ['product_id' => 7,'cycleType_id' => 5,'priceRenew' => 983.76,'priceOrder' => 983.76],
            ['product_id' => 7,'cycleType_id' => 6,'priceRenew' => 1439.64,'priceOrder' => 1439.64],

            ['product_id' => 335,'cycleType_id' => 1,'priceRenew' => 47.24,'priceOrder' => 47.24],
            ['product_id' => 335,'cycleType_id' => 2,'priceRenew' => 138.57,'priceOrder' => 138.57],
            ['product_id' => 335,'cycleType_id' => 3,'priceRenew' => 270.84,'priceOrder' => 270.84],
            ['product_id' => 335,'cycleType_id' => 4,'priceRenew' => 529.07,'priceOrder' => 529.07],
            ['product_id' => 335,'cycleType_id' => 5,'priceRenew' => 1032.95,'priceOrder' => 1032.95],
            ['product_id' => 335,'cycleType_id' => 6,'priceRenew' => 1511.62,'priceOrder' => 1511.62],

            ['product_id' => 341,'cycleType_id' => 1,'priceRenew' => 14.99,'priceOrder' => 14.99],

        ];

        $cycles = $this->table('cycles');
        $cycles->insert($data)
              ->saveData();

    }
}
