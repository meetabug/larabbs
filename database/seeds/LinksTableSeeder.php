<?php

use App\Models\Link;
use Illuminate\Database\Seeder;

class LinksTableSeeder extends Seeder
{

    public function run()
    {
        $links = factory(Link::class)->times(6)->make();

        Link::insert($links->toArray());
    }
}
