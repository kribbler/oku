<?php
use Migrations\AbstractSeed;

/**
 * Genders seed.
 */
class GendersSeed extends AbstractSeed
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
            array('id' => 1, 'name' => 'Woman'),
            array('id' => 2, 'name' => 'Man'),
            array('id' => 3, 'name' => 'Children')
        );

        $table = $this->table('genders');
        $table->insert($data)->save();
    }
}
