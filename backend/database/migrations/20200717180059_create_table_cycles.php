<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateTableCycles extends AbstractMigration
{

    public function up(): void
    {
        $exists = $this->hasTable('cycles');
        if ($exists) {
            $this->table('cycles')->drop()->save();
        }

        $table = $this->table('cycles');
        $table->addColumn('product_id', 'integer')
              ->addColumn('cycleType_id', 'integer')
              ->addColumn('priceRenew', 'decimal', ['precision' => 10, 'scale' => 2])
              ->addColumn('priceOrder', 'decimal', ['precision' => 10, 'scale' => 2])
              ->addTimestamps()
              ->addForeignKey('product_id', 'products', 'id', ['delete' => 'RESTRICT', 'update'=> 'NO_ACTION'])
              ->addForeignKey('cycleType_id', 'cycleTypes', 'id', ['delete' => 'RESTRICT', 'update'=> 'NO_ACTION'])
              ->create();
              
    }

    public function down()
    {
        $this->dropTable('cycles');
    }
}
