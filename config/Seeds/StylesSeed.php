<?php
use Migrations\AbstractSeed;

/**
 * Styles seed.
 */
class StylesSeed extends AbstractSeed
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
            array('id' => 1, 'name' => 'Link'),
            array('id' => 2, 'name' => 'Bangle'),
            array('id' => 3, 'name' => 'Charm'),
            array('id' => 4, 'name' => 'Tennis'),
            array('id' => 5, 'name' => 'Cuff'),
            array('id' => 6, 'name' => 'Identification'),
            array('id' => 7, 'name' => 'Strand'),
            array('id' => 8, 'name' => 'Stretch'),
            array('id' => 9, 'name' => 'Wrap'),
            array('id' => 10, 'name' => 'Chandelier'),
            array('id' => 11, 'name' => 'Cluster'),
            array('id' => 12, 'name' => 'Drop/Dangle'),
            array('id' => 13, 'name' => 'Hoop'),
            array('id' => 14, 'name' => 'Huggie'),
            array('id' => 15, 'name' => 'Journey'),
            array('id' => 16, 'name' => 'Stick'),
            array('id' => 17, 'name' => 'Stud'),
            array('id' => 18, 'name' => 'Threader')
        );

        $table = $this->table('styles');
        $table->insert($data)->save();
    }
}
