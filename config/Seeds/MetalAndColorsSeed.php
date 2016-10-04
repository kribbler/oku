<?php
use Migrations\AbstractSeed;

/**
 * MetalAndColors seed.
 */
class MetalAndColorsSeed extends AbstractSeed
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
            array('id' => 4, 'name' => 'Yellow & White Gold'),
            array('id' => 5, 'name' => 'Red Gold'),
            array('id' => 6, 'name' => 'Rose Gold'),
            array('id' => 7, 'name' => 'Red & Rose Gold'),
            array('id' => 8, 'name' => 'Red & White Gold'),
            array('id' => 9, 'name' => 'Silver'),
            array('id' => 10, 'name' => 'Bronze'),
            array('id' => 11, 'name' => 'Steel'),
            array('id' => 12, 'name' => 'Pink Gold'),
            array('id' => 13, 'name' => 'Red & Pink Gold'),
            array('id' => 14, 'name' => 'Rose & White Gold'),
            array('id' => 15, 'name' => 'Red, White & Yellow Gold'),
            array('id' => 16, 'name' => 'Yellow & Pink Gold'),
            array('id' => 17, 'name' => 'White & Pink Gold')
        );

        $table = $this->table('metal_and_colors');
        $table->insert($data)->save();
    }
}
