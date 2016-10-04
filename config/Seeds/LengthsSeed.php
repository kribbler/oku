<?php
use Migrations\AbstractSeed;

/**
 * CreateLengths seed.
 */
class LengthsSeed extends AbstractSeed
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
            array('id' => 26, 'name' => '19'),
            array('id' => 27, 'name' => '18.5'),
            array('id' => 28, 'name' => '18+2'),
            array('id' => 29, 'name' => '17+1'),
            array('id' => 30, 'name' => '18'),
            array('id' => 31, 'name' => '18+1'),
            array('id' => 32, 'name' => '19.5'),
            array('id' => 33, 'name' => '16.00'),
            array('id' => 34, 'name' => '11'),
            array('id' => 35, 'name' => 'Medium'),
            array('id' => 36, 'name' => '17/19'),
            array('id' => 37, 'name' => '16 og 18'),
            array('id' => 38, 'name' => '17 og 19'),
            array('id' => 39, 'name' => '16.5')
        );

        $table = $this->table('lengths');
        $table->insert($data)->save();
    }
}
