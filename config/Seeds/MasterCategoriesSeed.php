<?php
use Migrations\AbstractSeed;

/**
 * MasterCategories seed.
 */
class MasterCategoriesSeed extends AbstractSeed
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
            array('id' => 1, 'name' => 'Enstar jewelry', 'active' => 0),
            array('id' => 2, 'name' => 'Rings', 'active' => 1),
            array('id' => 3, 'name' => 'Earrings', 'active' => 1),
            array('id' => 4, 'name' => 'Pendants', 'active' => 0),
            array('id' => 5, 'name' => 'Necklacess', 'active' => 0),
            array('id' => 6, 'name' => 'Bracelets', 'active' => 1),
            array('id' => 7, 'name' => 'Diamond Jewelry', 'active' => 0),
            array('id' => 8, 'name' => 'Drop Jewelry', 'active' => 0),
            array('id' => 9, 'name' => 'Children Jewelry', 'active' => 0),
            array('id' => 10, 'name' => 'Mens Jewellery', 'active' => 0),
            array('id' => 11, 'name' => 'Jewellery', 'active' => 0),
            array('id' => 12, 'name' => 'Confirmation', 'active' => 0),
            array('id' => 13, 'name' => 'Woodwork', 'active' => 0),
            array('id' => 14, 'name' => 'Charms', 'active' => 0),
            array('id' => 15, 'name' => 'Necklacess & Pendants', 'active' => 1),
            array('id' => 16, 'name' => 'the eng','active' =>  0)
        );

        $table = $this->table('master_categories');
        $table->insert($data)->save();
    }
}
