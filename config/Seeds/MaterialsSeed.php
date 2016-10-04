<?php
use Migrations\AbstractSeed;

/**
 * Materials seed.
 */
class MaterialsSeed extends AbstractSeed
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
            array('id' => 1, 'name' => 'Gold'),
            array('id' => 2, 'name' => 'Silver'),
            array('id' => 3, 'name' => 'Steel'),
            array('id' => 4, 'name' => 'Palladium'),
            array('id' => 5, 'name' => 'Platinum'),
            array('id' => 6, 'name' => 'Sølv & Gull'),
            array('id' => 7, 'name' => 'Bronze'),
            array('id' => 8, 'name' => 'Leather'),
            array('id' => 9, 'name' => 'Cotton'),
            array('id' => 10, 'name' => 'Other Materials'),
            array('id' => 11, 'name' => 'Yellow'),
            array('id' => 12, 'name' => 'Silver & Gold')
        );

        $table = $this->table('materials');
        $table->insert($data)->save();
    }
}
