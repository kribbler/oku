<?php
use Migrations\AbstractSeed;

/**
 * Clasps seed.
 */
class ClaspsSeed extends AbstractSeed
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
            array('id' => 1, 'name' => 'Spring Ring'),
            array('id' => 2, 'name' => 'Lobster'),
            array('id' => 3, 'name' => 'Hook and Eye'),
            array('id' => 4, 'name' => 'Magnetic'),
            array('id' => 5, 'name' => 'Other clasp'),
            array('id' => 6, 'name' => 'No clasp'),
            array('id' => 7, 'name' => 'Spring Ring'),
            array('id' => 8, 'name' => 'Lobster'),
            array('id' => 9, 'name' => 'Hook and Eye'),
            array('id' => 10, 'name' => 'Magnetic'),
            array('id' => 11, 'name' => 'Other clasp'),
            array('id' => 12, 'name' => 'No clasp')
        );

        $table = $this->table('clasps');
        $table->insert($data)->save();
    }
}
