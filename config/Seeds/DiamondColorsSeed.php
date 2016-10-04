<?php
use Migrations\AbstractSeed;

/**
 * DiamondColors seed.
 */
class DiamondColorsSeed extends AbstractSeed
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
            array('id' => 1, 'name' => 'R'),
            array('id' => 2, 'name' => 'TW'),
            array('id' => 3, 'name' => 'W'),
            array('id' => 4, 'name' => 'TCR'),
            array('id' => 5, 'name' => 'CR'),
            array('id' => 6, 'name' => 'TC'),
            array('id' => 7, 'name' => 'C'),
            array('id' => 8, 'name' => 'D'),
            array('id' => 9, 'name' => 'E'),
            array('id' => 10, 'name' => 'F'),
            array('id' => 11, 'name' => 'G'),
            array('id' => 12, 'name' => 'H'),
            array('id' => 13, 'name' => 'I'),
            array('id' => 14, 'name' => 'J'),
            array('id' => 15, 'name' => 'K'),
            array('id' => 16, 'name' => 'L'),
            array('id' => 17, 'name' => 'M'),
            array('id' => 18, 'name' => 'TLB')
        );

        $table = $this->table('diamond_colors');
        $table->insert($data)->save();
    }
}
