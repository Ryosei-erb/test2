<?php

namespace Tests\Browser;

use App\Product;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ProductsIndexTest extends DuskTestCase
{
    use DatabaseMigrations;
    private $product;

    protected function setUp(): void {
        parent::setUp();
        $this->product = Product::create([
            "name" => "product_sample",
            "description" => "Lorem ipsum dolor sit amet, consectetur adipisicing elit,",
            "pickup_times" => "pm",
            "price" => 100,
            "user_id" => 1,
            "address" => "tokyo"
        ]);
    }

    public function testIndexView()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/products')
            ->assertSee("出品リスト")
            ->assertSee("product_sample")
            ->assertSee(100)
            ->screenshot("file");
        });
    }
    public function testIndextoShowLink() {
        $this->browse(function (Browser $browser) {
            $browser->visit("/products")
            ->assertSeeLink("product_sample")
            ->assertDontSee("Lorem ipsum dolor sit amet, consectetur adipisicing elit,")
            ->clickLink("product_sample")
            ->assertPathIs("/products/" . $this->product->id)
            ->assertSee("Lorem ipsum dolor sit amet, consectetur adipisicing elit,")
            ->screenshot("test4");
        });
    }
}
