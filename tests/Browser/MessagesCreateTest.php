<?php

namespace Tests\Browser;

use App\User;
use App\Product;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use GoogleMaps;

class MessagesCreateTest extends DuskTestCase
{
    use DatabaseMigrations;
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testMessagesCreateView()
    {
        $user = factory(User::class)->create();
        $product = factory(Product::class)->create(["user_id" => $user->id]);
        $this->browse(function (Browser $browser) {
            $browser->visit("/register")
                    ->type("name", "name")
                    ->type("email", "email@email.com")
                    ->type("password", "password")
                    ->type("password_confirmation", "password")
                    ->press("Register")
                    ->visit("/products/1")
                    ->press("チャットを始める")
                    ->assertDontSee("Hello World !!")
                    ->type("content", "Hello World !!")
                    ->press("+")
                    ->assertSee("Hello World !!");
        });
    }
}
