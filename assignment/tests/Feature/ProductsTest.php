<?php

namespace Tests\Feature;

use App\User;
use App\Product;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductsTest extends TestCase
{

    /** @test */
    public function get_all_products()
    {
        $response = $this->get('/products');
        $response->assertStatus(200);
    }

    /** @test */
    public function get_one_product()
    {
        $response = $this->get('/products/1');
        $response->assertStatus(200);
    }

    /** @test */
    public function get_all_stores()
    {
        $response = $this->get('/stores');
        $response->assertStatus(200);
    }

    /** @test */
    public function get_all_reviews()
    {
        $response = $this->get('/reviews');
        $response->assertStatus(200);
    }
    
    /** @test */
    public function unauthenticated_users_can_not_access_edit()
    {
        $response = $this->get('/products/1/edit')
            ->assertRedirect('/login');
    }

    /** @test */
    public function authenticated_users_can_access_edit()
    {
        $this->actingAs(factory (User::class)->create());

        $response = $this->get('/products/1/edit')
        ->assertOk();
    }

    /** @test */
    public function unauthenticated_users_can_not_access_create()
    {
        $response = $this->get('/products/create')
            ->assertRedirect('/login');
    }

    /** @test */
    public function authenticated_users_can_access_create()
    {
        $this->actingAs(factory (User::class)->create());

        $response = $this->get('/products/create')
        ->assertOk();
    }

    /** Redirected with success = 302 */
    /** @test */
    public function authenticated_users_can_post_new_product()
    {
        $this->actingAs(factory (User::class)->create());

        $response = $this->post('/products', [
            'title' => 'PRODUCT NAME',
            'description' => 'DESCRIPTION',
            'brand' => 'BRAND',
            'image' => 'https://media.dustin.eu/image/193471/400/320/hp-elite-x3-dual-sim-headset-64gb-svart-krom.jpg',
            'price' => 9999,
            'stores' => [1,2]
        ])->assertStatus(302);

    }

    /** @test */
    public function unauthenticated_users_can_not_post_new_product()
    {
        $response = $this->post('/products', [
            'title' => 'PRODUCT NAME',
            'description' => 'DESCRIPTION',
            'brand' => 'BRAND',
            'image' => 'https://media.dustin.eu/image/193471/400/320/hp-elite-x3-dual-sim-headset-64gb-svart-krom.jpg',
            'price' => 9999,
            'stores' => [1,2]
        ])->assertRedirect('/login');

    }

    /** @test */
    public function authenticated_users_can_patch_product()
    {
        $this->actingAs(factory (User::class)->create());

        $response = $this->patch('/products/1', [
            'title' => 'PRODUCT NAME',
            'description' => 'DESCRIPTION',
            'brand' => 'BRAND',
            'image' => 'https://media.dustin.eu/image/193471/400/320/hp-elite-x3-dual-sim-headset-64gb-svart-krom.jpg',
            'price' => 8888,
            'stores' => [1,2]
        ])->assertStatus(302);

    }

    /** @test */
    public function unauthenticated_users_can_not_patch_product()
    {

        $response = $this->patch('/products/1', [
            'title' => 'PRODUCT NAME',
            'description' => 'DESCRIPTION',
            'brand' => 'BRAND',
            'image' => 'https://media.dustin.eu/image/193471/400/320/hp-elite-x3-dual-sim-headset-64gb-svart-krom.jpg',
            'price' => 8888,
            'stores' => [1,2]
        ])->assertRedirect('/login');

    }

    /** @test */
    public function authenticated_users_can_delete_product()
    {
        $this->actingAs(factory (User::class)->create());
        $response = $this->delete('/products/1')
            ->assertStatus(302);

    }

    /** @test */
    public function unauthenticated_users_can_not_delete_product()
    {
        $response = $this->delete('/products/2')
            ->assertRedirect('/login');

    }


    /** 'description', 'price' and 'store' has been given invalid data*/
    /** @test */
    public function authenticated_users_can_not_post_invalid_data()
    {
        $this->actingAs(factory (User::class)->create());

        $response = $this->post('/products', [
            'title' => 'PRODUCTNAME',
            'description' => 123,
            'brand' => 'BRAND',
            'image' => 'https://media.dustin.eu/image/193471/400/320/hp-elite-x3-dual-sim-headset-64gb-svart-krom.jpg',
            'price' => '9999',
            'stores' => [1,2,56]
        ])->assertStatus(400);

    }

}

