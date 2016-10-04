<?php
use Migrations\AbstractSeed;

/**
 * Occasions seed.
 */
class OccasionsSeed extends AbstractSeed
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
            array('id' => 1, 'name' => 'Baptism'),
            array('id' => 2, 'name' => 'Wedding'),
            array('id' => 3, 'name' => 'Anniversary'),
            array('id' => 4, 'name' => 'Engagement'),
            array('id' => 5, 'name' => 'Alliance'),
            array('id' => 6, 'name' => 'Confirmation'),
            array('id' => 7, 'name' => 'Promisering')
        );

        $table = $this->table('occasions');
        $table->insert($data)->save();
    }
}
