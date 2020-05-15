<?php

namespace Tests\Browser;

use App\User;
use App\Product;
use GoogleMaps;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class TopPageTest extends DuskTestCase
{
    use DatabaseMigrations;
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testTopPage()
    {
        $user = factory(User::class)->create();
        $product = factory(Product::class)->create(["user_id" => $user->id]);
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('社会は変わる。')
                    ->visit("/products")
                    ->assertDontSee("社会は変わる");
        });
    }
}
