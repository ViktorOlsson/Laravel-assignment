<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Tests\DuskTestCase;
use Laravel\Dusk\Chrome;

class PostProduct extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {

      $data = [
        "title" => "Elite",
        "brand" => "HP",
        "price" => 5499,
        "description" => "HP Elite x3 kombinerar persondatorns kraft och produktivitet, surfplattans mobilitet och smarta telefonens smidiga uppkoppling.",
        "image" => "https://media.dustin.eu/image/193471/400/320/hp-elite-x3-dual-sim-headset-64gb-svart-krom.jpg"
      ];

        $response = $this->get('products/create', $data);

        $response->assertStatus(200);
        
    }
}
