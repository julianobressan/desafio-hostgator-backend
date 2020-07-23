<?php


use Phinx\Seed\AbstractSeed;

class ProductsSeeder extends AbstractSeed
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
                'id' => 5,
                'name' => 'Plano P'
            ],
            [
                'id' => 6,
                'name' => 'Plano M'
            ],
            [
                'id' => 7,
                'name' => 'Plano Business'
            ],
            [
                'id' => 329,
                'name' => 'Empreendedor'
            ],
            [
                'id' => 332,
                'name' => 'Negócios'
            ],
            [
                'id' => 335,
                'name' => 'Plano Turbo'
            ],
            [
                'id' => 341,
                'name' => 'Presença Digital'
            ],
        ];

        $products = $this->table('products');
        $products->insert($data)
              ->saveData();

    }
}
