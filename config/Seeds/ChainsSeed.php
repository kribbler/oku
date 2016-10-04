<?php
use Migrations\AbstractSeed;

/**
 * Chains seed.
 */
class ChainsSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     *
     * @return void
     */
    public function run()
    {
        $data = array(
            array('id' => 1, 'name' => 'Box'),
            array('id' => 2, 'name' => 'Figaro'),
            array('id' => 3, 'name' => 'Rolo'),
            array('id' => 4, 'name' => 'Cable'),
            array('id' => 5, 'name' => 'Bead')
        );

        $table = $this->table('chains');
        $table->insert($data)->save();
    }
}
