<?php
use Migrations\AbstractSeed;

/**
 * FilterMetalAndColors seed.
 */
class FilterMetalAndColorsSeed extends AbstractSeed
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
            array('id' => 1, 'name' => 'Gold (All)'),
            array('id' => 2, 'name' => 'Yellow Gold'),
            array('id' => 3, 'name' => 'White Gold'),
            array('id' => 4, 'name' => 'Multi-Tone Gold'),
            array('id' => 5, 'name' => 'Rose Gold'),
            array('id' => 6, 'name' => 'Solv'),
            array('id' => 7, 'name' => 'Other Metal')
        );

        $table = $this->table('filter_metal_and_colors');
        $table->insert($data)->save();
    }
}
