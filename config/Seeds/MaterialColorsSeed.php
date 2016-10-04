<?php
use Migrations\AbstractSeed;

/**
 * MaterialColors seed.
 */
class MaterialColorsSeed extends AbstractSeed
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
            array('id' => 1, 'name' => 'White'),
            array('id' => 2, 'name' => 'Gult'),
            array('id' => 3, 'name' => 'Yellow & White'),
            array('id' => 4, 'name' => 'Rose'),
            array('id' => 5, 'name' => 'Red'),
            array('id' => 6, 'name' => 'Red & Pink'),
            array('id' => 7, 'name' => 'Pink'),
            array('id' => 8, 'name' => 'Rose & White'),
            array('id' => 9, 'name' => 'Red & Rose'),
            array('id' => 10, 'name' => 'Red & White'),
            array('id' => 11, 'name' => 'Red, White & Yellow'),
            array('id' => 12, 'name' => 'Yellow & Pink'),
            array('id' => 13, 'name' => 'White & Pink'),
            array('id' => 14, 'name' => 'Yellow'),
            array('id' => 15, 'name' => 'Yellow & Red')
        );

        $table = $this->table('material_colors');
        $table->insert($data)->save();
    }
}
