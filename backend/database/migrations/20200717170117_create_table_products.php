<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateTableProducts extends AbstractMigration
{
    public function up()
    {
        $exists = $this->hasTable('products');
        if ($exists) {
            $this->table('products')->drop()->save();
        }
        
        $table = $this->table('products');
        $table->addColumn('name', 'string', ['limit' => 50])
              ->addTimestamps()
              ->addIndex('name', ['unique' => true, 'name' => 'index_products_name'])
              ->create();
    }

    public function down()
    {
        $this->dropTable('users');
    }
}
