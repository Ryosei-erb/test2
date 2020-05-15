<?php

namespace Tests\Feature;

use App\Message;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MessagesControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function testCreateMessage() {
        $data = [
            "content" => "hello world",
            "room_id" => 1,
            "user_id" => 1,
        ];
        $this->assertDatabaseMissing("messages", $data);
        Message::create($data);
        $this->assertDatabaseHas("messages", $data);
    }

    public function testMessageContentRequire() {
        $data = ["content" => ""];
        $response = $this->from("/rooms/1")->post("/messages", $data);
        $response->assertSessionHasErrors(["content" => "The content field is required."]);
        $response->assertStatus(302)->assertRedirect("/rooms/1");
    }

    public function testMessageContentNameString() {
        $data = ["content" => 1];
        $response = $this->from("/rooms/1")->post("/messages", $data);
        $response->assertSessionHasErrors(["content" =>  "The content must be a string."]);
        $response->assertStatus(302)->assertRedirect("/rooms/1");
    }
}
