<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SeederTest extends TestCase
{
    use DatabaseTransactions;

    public function testLinksTable()
    {
        factory(App\Link::class)->create([
            'title' => 'Laravel News',
        ]);
        $this->seeInDatabase('links', ['title' => 'Laravel News']);
    }
}
