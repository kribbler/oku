<?php
use Migrations\AbstractSeed;

/**
 * Websites seed.
 */
class WebsitesSeed extends AbstractSeed
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
            array('id' => 1, 'name' => 'http://www.bjorklund.no', 'pretty_name' => 'Bjørklund', 'manual' => 0),
            array('id' => 2, 'name' => 'http://www.mestergull.no', 'pretty_name' => 'Mestergull', 'manual' => 0),
            array('id' => 3, 'name' => 'http://david-andersen.no', 'pretty_name' => 'David Andersen', 'manual' => 0),
            array('id' => 4, 'name' => 'http://www.gullfunn.no', 'pretty_name' => 'Gullfunn', 'manual' => 0),
            array('id' => 5, 'name' => 'http://www.thune.no', 'pretty_name' => 'Thune', 'manual' => 0)
        );

        $table = $this->table('websites');
        $table->insert($data)->save();
    }
}
