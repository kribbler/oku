<?php
use Migrations\AbstractSeed;

/**
 * NecklaceTypes seed.
 */
class NecklaceTypesSeed extends AbstractSeed
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
            array('id' => 1, 'name' => 'Pendant with Necklace'),
            array('id' => 2, 'name' => 'Pendant (All)'),
            array('id' => 3, 'name' => 'Necklace (All)'),
            array('id' => 4, 'name' => 'Pearl Necklace'),
            array('id' => 5, 'name' => 'Ankle Chain'),
            array('id' => 6, 'name' => 'Pearl Pendant')
        );

        $table = $this->table('necklace_types');
        $table->insert($data)->save();
    }
}
