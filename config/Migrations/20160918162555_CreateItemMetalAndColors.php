<?php
use Migrations\AbstractMigration;

class CreateItemMetalAndColors extends AbstractMigration
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
        $table = $this->table('item_metal_and_colors');
        $table->addColumn('item_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('metal_and_color_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('changed', 'boolean', [
            'default' => null,
            'limit' => 0,
            'null' => true,
        ]);
        $table->addColumn('deleted', 'boolean', [
            'default' => null,
            'limit' => 0,
            'null' => true,
        ]);
        $table->create();
    }
}
