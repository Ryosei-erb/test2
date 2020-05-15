<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Auth;
use App\Product;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;

class ProductsControllerTest extends TestCase
{
    use RefreshDatabase;
    private $product;

    protected function setUp(): void {
        parent::setUp();
        $this->product = Product::create([
            "name" => "product_sample",
            "description" => "Lorem ipsum dolor sit amet, consectetur adipisicing elit,",
            "pickup_times" => "pm",
            "price" => 100,
            "user_id" => 2,
            "address" => "tokyo"
        ]);
    }

    public function testProductsIndexPath() {
        $response = $this->get("/products");
        $response->assertStatus(200);
    }
    public function testProductsShowPath() {
        $response = $this->get("/products/" . $this->product->id);
        $response->assertStatus(200);
    }
    public function testProductsCreatePath() {
        $response = $this->get("/products/create");
        $response->assertStatus(200);
    }
    public function testProductsStorePath() {
        $response = $this->post("/products");
        $response->assertStatus(302);
    }

    public function testCreateProduct() {
        $user = factory(User::class)->create();
        $image = UploadedFile::fake()->image('image.jpeg');
        $data = [
            "name" => "name",
            "description" => "des",
            "pickup_times" => "pickup_times",
            "price" => 100,
            "user_id" => $user->id,
            "image" => $image,
            "address" => "tokyo"
        ];
        $this->withoutExceptionHandling();
        $this->assertDatabaseMissing("products", $data);
        Product::create($data);
        $this->assertDatabaseHas("products", $data);
    }

    public function testProductNameRequire() {
        $data = ["name" => ""];
        $response = $this->from("/products/create")->post("/products", $data);
        $response->assertSessionHasErrors(["name" => "The name field is required."]);
        $response->assertStatus(302)->assertRedirect("/products/create");
    }

    public function testProductNameString() {
        $data = ["name" => 1000];
        $response = $this->from("/products/create")->post("/products", $data);
        $response->assertSessionHasErrors(["name" => 'The name must be a string.']);
        $response->assertStatus(302)->assertRedirect("/products/create");
    }

    public function testProductDescriptionRequired() {
        $data = ["description" => ""];
        $response = $this->from("/products/create")->post("/products", $data);
        $response->assertSessionHasErrors(["description" => "The description field is required."]);
        $response->assertStatus(302)->assertRedirect("/products/create");
    }

    public function testProductDescriptionString() {
        $data = ["description" => 1000];
        $response = $this->from("/products/create")->post("/products", $data);
        $response->assertSessionHasErrors(["description" => 'The description must be a string.']);
        $response->assertStatus(302)->assertRedirect("/products/create");
    }

    public function testProductPickup_timesRequired() {
        $data = ["pickup_times" => ""];
        $response = $this->from("/products/create")->post("/products", $data);
        $response->assertSessionHasErrors(["pickup_times" => "The pickup times field is required."]);
        $response->assertStatus(302)->assertRedirect("/products/create");
    }

    public function testProductPickup_timesString() {
        $data = ["pickup_times" => 1000];
        $response = $this->from("/products/create")->post("/products", $data);
        $response->assertSessionHasErrors(["pickup_times" => 'The pickup times must be a string.']);
        $response->assertStatus(302)->assertRedirect("/products/create");
    }

    public function testProductPriceRequired() {
        $data = ["price" => ""];
        $response = $this->from("/products/create")->post("/products", $data);
        $response->assertSessionHasErrors(["price" => "The price field is required."]);
        $response->assertStatus(302)->assertRedirect("/products/create");
    }
}
