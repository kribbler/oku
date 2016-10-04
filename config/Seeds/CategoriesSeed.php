<?php
use Migrations\AbstractSeed;

/**
 * Categories seed.
 */
class CategoriesSeed extends AbstractSeed
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
            array(
                'id' => 1,
                'name' => 'ringer', 
                'pretty_name' => 'Ringer', 
                'website_id' => 1, 
                'master_category_id' => 2
            ),
            array(
                'id' => 2,
                'name' => 'ringer', 
                'pretty_name' => 'Ringer', 
                'website_id' => 1, 
                'master_category_id' => 2
            ),
            array(
                'id' => 3, 
                'name' => 'halssmykker', 
                'pretty_name' => 'Halssmykker', 
                'website_id' => 1, 
                'master_category_id' => 4
            ),
            array(
                'id' => 4, 
                'name' => 'halskjeder', 
                'pretty_name' => 'Halskjeder', 
                'website_id' => 1, 
                'master_category_id' => 5
            ),
            array(
                'id' => 5, 
                'name' => 'armbaand', 
                'pretty_name' => 'Armbånd', 
                'website_id' => 1, 
                'master_category_id' => 6
            ),
            array(
                'id' => 6, 
                'name' => 'diamanter', 
                'pretty_name' => 'Diamanter', 
                'website_id' => 1, 
                'master_category_id' => 7
            ),
            array(
                'id' => 7, 
                'name' => 'drapesmykker', 
                'pretty_name' => 'Dråpesmykker', 
                'website_id' => 1, 
                'master_category_id' => 8
            ),
            array(
                'id' => 8, 
                'name' => 'barnesmykker', 
                'pretty_name' => 'Barnesmykker', 
                'website_id' => 1, 
                'master_category_id' => 9
            ),
            array(
                'id' => 9, 
                'name' => 'herresmykker', 
                'pretty_name' => 'Herresmykker', 
                'website_id' => 1, 
                'master_category_id' => 10),
            array(
                'id' => 10, 
                'name' => 'andre-smykker',
                'pretty_name' =>  'Andre smykker',
                'website_id' =>  1, 
                'master_category_id' => 11),
            array(
                'id' => 11, 
                'name' => 'enstens_smykker', 
                'pretty_name' => 'Enstens smykker',
                'website_id' =>  2, 
                'master_category_id' => 1
            ),
            array(
                'id' => 12, 
                'name' => 'ringer', 
                'pretty_name' => 'Ringer', 
                'website_id' => 2, 
                'master_category_id' => 2
            ),
            array(
                'id' => 13, 
                'name' => 'orepynt', 
                'pretty_name' => 'Ørepynt', 
                'website_id' => 2, 
                'master_category_id' => 3
            ),
            array(
                'id' => 14, 
                'name' => 'anheng', 
                'pretty_name' => 'Anheng', 
                'website_id' => 2, 
                'master_category_id' => 4
            ),
            array(
                'id' => 15, 
                'name' => 'armband', 
                'pretty_name' => 'Armbånd', 
                'website_id' => 2, 
                'master_category_id' => 6
            ),
            array(
                'id' => 16, 
                'name' => 'herre', 
                'pretty_name' => 'Herre', 
                'website_id' => 2, 
                'master_category_id' => 10),
            array(
                'id' => 17, 
                'name' => 'ringer', 
                'pretty_name' => 'Ringer', 
                'website_id' => 3, 
                'master_category_id' => 2
            ),
            array(
                'id' => 18, 
                'name' => 'ørepynt', 
                'pretty_name' => 'Ørepynt', 
                'website_id' => 3, 
                'master_category_id' => 3
            ),
            array(
                'id' => 19, 
                'name' => 'anheng-og-kjeder',
                'pretty_name' => 'Kjeder Og Anheng',
                'website_id' => 3,
                'master_category_id' => 4
            ),
            array(
                'id' => 20, 
                'name' => 'armbånd', 
                'pretty_name' => 'Armbånd', 
                'website_id' => 3, 
                'master_category_id' => 6
            ),
            array(
                'id' => 21, 
                'name' => 'diamantsmykker', 
                'pretty_name' => 'Diamantsmykker', 
                'website_id' => 3, 
                'master_category_id' => 7
            ),
            array(
                'id' => 22, 
                'name' => 'barn', 
                'pretty_name' => 'Barn', 
                'website_id' => 3, 
                'master_category_id' => 9
            ),
            array(
                'id' => 23, 
                'name' => 'herre', 
                'pretty_name' => 'Herre', 
                'website_id' => 3, 
                'master_category_id' => 10),
            array(
                'id' => 24, 
                'name' => 'konfirmasjon', 
                'pretty_name' => 'Konfirmasjon ', 
                'website_id' => 3, 
                'master_category_id' => 12),
            array(
                'id' => 25, 
                'name' => 'brosjer', 
                'pretty_name' => 'Brosjer', 
                'website_id' => 3, 
                'master_category_id' => 13),
            array(
                'id' => 26, 
                'name' => 'charms', 
                'pretty_name' => 'Charms', 
                'website_id' => 3, 
                'master_category_id' => 14),
            array(
                'id' => 27, 
                'name' => 'ringer', 
                'pretty_name' => 'Ringer', 
                'website_id' => 4, 
                'master_category_id' => 2
            ),
            array(
                'id' => 28, 
                'name' => 'ringer', 
                'pretty_name' => 'Rings', 
                'website_id' => 5, 
                'master_category_id' => 2
            ),
            array(
                'id' => 29, 
                'name' => 'armband', 
                'pretty_name' => 'Armbånd', 
                'website_id' => 5, 
                'master_category_id' => 6
            ),
            array(
                'id' => 30, 
                'name' => 'ørepynt', 
                'pretty_name' => 'Ørepynt', 
                'website_id' => 5, 
                'master_category_id' => 3
            ),
            array(
                'id' => 31, 
                'name' => 'anheng', 
                'pretty_name' => 'Anheng', 
                'website_id' => 2, 
                'master_category_id' => 15),
            array(
                'id' => 32, 
                'name' => 'kjeder-og-anheng',
                'pretty_name' => 'Kjeder Og Anheng',
                'website_id' => 3,
                'master_category_id' => 15
            ),
            array(
                'id' => 33, 
                'name' => 'halssmykker', 
                'pretty_name' => 'Halssmykker', 
                'website_id' => 5, 
                'master_category_id' => 15),
            array(
                'id' => 34, 
                'name' => 'anheng', 
                'pretty_name' => 'Anheng', 
                'website_id' => 4, 
                'master_category_id' => 15),
            array(
                'id' => 35, 
                'name' => 'ørepynt', 
                'pretty_name' => 'Ørepynt', 
                'website_id' => 4, 
                'master_category_id' => 3
            ),
            array(
                'id' => 36, 
                'name' => 'halssmykker|halskjeder',
                'pretty_name' =>  'Halssmykker & Halskjeder',
                'website_id' => 1,
                'master_category_id' => 15),
            array(
                'id' => 37, 
                'name' => 'armbaand', 
                'pretty_name' => 'Armbånd', 
                'website_id' => 4, 
                'master_category_id' => 6
            )

        );

        $table = $this->table('categories');
        $table->insert($data)->save();
    }
}
