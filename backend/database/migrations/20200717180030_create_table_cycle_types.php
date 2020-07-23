<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;
use Phinx\Db\Adapter\MysqlAdapter;

final class CreateTableCycleTypes extends AbstractMigration
{
    public function up()
    {
        $table = $this->table('cycleTypes');
        $table->addColumn('name', 'string', ['limit' => 50])
              ->addColumn('months', 'integer', ['limit' => MysqlAdapter::INT_TINY])
              ->addTimestamps()
              ->addIndex('name', ['unique' => true, 'name' => 'index_cycleTypes_name'])
              ->create();
    }

    public function down()
    {
        $this->dropTable('cycleTypes');
    }
}
