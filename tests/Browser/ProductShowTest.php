<?php

namespace Tests\Browser;

use App\User;
use App\Product;
use GoogleMaps;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ProductShowTest extends DuskTestCase
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

    public function testShowView() {
        $this->browse(function (Browser $browser) {
            $browser->visit("/products/" . $this->product->id)
                    ->assertSee("価格")
                    ->assertSee("Lorem ipsum dolor sit amet, consectetur adipisicing elit,");
        });
    }

    public function testShowtoIndexLink() {
        $this->browse(function (Browser $browser) {
            $browser->visit("/products/" . $this->product->id)
                    ->assertDontSee("出品リスト")
                    ->assertSeeLink("一覧ページへ戻る")
                    ->clickLink("一覧ページへ戻る")
                    ->assertPathIs("/products")
                    ->assertSee("出品リスト");
        });
    }
}
