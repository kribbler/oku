<?php
use Migrations\AbstractSeed;

/**
 * DiamondClarities seed.
 */
class DiamondClaritiesSeed extends AbstractSeed
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
            array('id' => 1, 'name' => 'FL'),
            array('id' => 2, 'name' => 'IF'),
            array('id' => 3, 'name' => 'VVS'),
            array('id' => 4, 'name' => 'VS'),
            array('id' => 5, 'name' => 'SI'),
            array('id' => 6, 'name' => 'I'),
            array('id' => 7, 'name' => 'VVS1'),
            array('id' => 8, 'name' => 'VVS2'),
            array('id' => 9, 'name' => 'VS1'),
            array('id' => 10, 'name' => 'VS2'),
            array('id' => 11, 'name' => 'SI1'),
            array('id' => 12, 'name' => 'SI2'),
            array('id' => 13, 'name' => 'I1'),
            array('id' => 14, 'name' => 'I2'),
            array('id' => 15, 'name' => 'I3')
        );

        $table = $this->table('diamond_clarities');
        $table->insert($data)->save();
    }
}
