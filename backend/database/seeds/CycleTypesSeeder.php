<?php


use Phinx\Seed\AbstractSeed;

class CycleTypesSeeder extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     */
    public function run()
    {
        $data = [
            [
                'id' => 1,
                'name' => 'monthly',
                'months' => 1
            ],
            [
                'id' => 2,
                'name' => 'quarterly',
                'months' => 3
            ],
            [
                'id' => 3,
                'name' => 'semiannually',
                'months' => 6
            ],
            [
                'id' => 4,
                'name' => 'annually',
                'months' => 12
            ],
            [
                'id' => 5,
                'name' => 'bienally',
                'months' => 24
            ],
            [
                'id' => 6,
                'name' => 'trienally',
                'months' => 36
            ],            
        ];

        $cycleTypes = $this->table('cycleTypes');
        $cycleTypes->insert($data)
              ->saveData();
    }
}
