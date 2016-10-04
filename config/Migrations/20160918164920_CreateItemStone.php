<?php
use Migrations\AbstractMigration;

class CreateItemStone extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('item_stones');
        $table->addColumn('item_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('stone_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('changed', 'boolean', [
            'default' => null,
            'null' => true,
        ]);
        $table->create();
    }
}
