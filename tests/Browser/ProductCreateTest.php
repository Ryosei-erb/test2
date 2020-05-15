<?php

namespace Tests\Browser;

use App\Product;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ProductCreateTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function testCreateView() {
        $this->browse(function (Browser $browser) {
            $browser->visit("/register")
                    ->type("name", "name")
                    ->type("email", "email@email.com")
                    ->type("password", "password")
                    ->type("password_confirmation", "password")
                    ->press("Register")
                    ->visit("/products/create")
                    ->assertSee("出品")
                    ->type("name", "product_sample")
                    ->type("description", "de")
                    ->type("pickup_times", "p")
                    ->type("price", 10)
                    ->type("address", "tokyo")
                    ->press("出品する")
                    ->pause(1000)
                    ->assertPathIs("/products");
        });
    }
}
