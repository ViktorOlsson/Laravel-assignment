<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Tests\DuskTestCase;
use Laravel\Dusk\Chrome;

class DeleteProduct extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testDeleteProduct()
    {
        $response = $this->delete('/products/2');

        $response->assertStatus(302);
    }
}
