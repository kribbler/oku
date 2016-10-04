<?php
use Migrations\AbstractSeed;

/**
 * FilterStones seed.
 */
class FilterStonesSeed extends AbstractSeed
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
            array('id' => 2, 'name' => 'Pearl'),
            array('id' => 3, 'name' => 'Diamonds'),
            array('id' => 4, 'name' => 'Cubic zirconia'),
            array('id' => 5, 'name' => 'Gemstones')
        );

        $table = $this->table('filter_stones');
        $table->insert($data)->save();
    }
}
