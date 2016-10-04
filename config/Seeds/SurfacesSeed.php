<?php
use Migrations\AbstractSeed;

/**
 * Surfaces seed.
 */
class SurfacesSeed extends AbstractSeed
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
            array('id' => 1, 'name' => 'Rhodinert'),
            array('id' => 2, 'name' => 'Delvis rhodinert'),
            array('id' => 3, 'name' => 'Emaljert'),
            array('id' => 4, 'name' => 'Delvis emaljert'),
            array('id' => 5, 'name' => 'Forgylling'),
            array('id' => 6, 'name' => 'Hvit/forgylt'),
            array('id' => 7, 'name' => 'Oksidering'),
            array('id' => 8, 'name' => 'Annet'),
            array('id' => 9, 'name' => '- - NO'),
            array('id' => 10, 'name' => 'Delvis forgylt')
        );

        $table = $this->table('surfaces');
        $table->insert($data)->save();
    }
}
