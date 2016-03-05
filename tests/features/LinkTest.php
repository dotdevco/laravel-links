<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LinkTest extends TestCase
{
    use DatabaseTransactions;

    public function testWeSeeAListOfLinks()
    {
        factory(App\Link::class)->create([
            'title' => 'Laravel News',
        ]);
        $this->visit('/')
             ->see('Laravel News');
    }

    public function testWeSeeLinksForm()
    {
        $this->visit('/submit')
            ->see('Submit a link');
    }

    public function testLinksFormValidation()
    {
        $this->visit('/submit')
            ->press('Submit')
            ->see('The title field is required')
            ->see('The url field is required')
            ->see('The description field is required');
    }

public function testSubmitLinksToDb()
{
    $this->visit('/submit')
        ->type('dotdev', 'title')
        ->type('https://dotdev.co', 'url')
        ->type('My description', 'description')
        ->press('Submit')
        ->seeInDatabase('links', ['title' => 'dotdev']);
}
}
