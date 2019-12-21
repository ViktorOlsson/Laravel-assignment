<?php

namespace Tests\Feature;

use App\User;
use App\Product;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductsTest extends TestCase
{

    /** A basic test to see if we can get all products */
    /** @test */
    public function getAllProducts()
    {
        $response = $this->get('/products');
        $response->assertStatus(200);
    }

    /** A basic test to see if it is possible to get only one product, other wise a lot of other functionallity would not work */
    /** @test */
    public function getOneProduct()
    {
        $response = $this->get('/products/1');
        $response->assertStatus(200);
    }

    /** Checks if we have access to all stores */
    /** @test */
    public function getAllStores()
    {
        $response = $this->get('/stores');
        $response->assertStatus(200);
    }

    /** Checks if we have access to all reviews */
    /** @test */
    public function getAllReviews()
    {
        $response = $this->get('/reviews');
        $response->assertStatus(200);
    }
    
    /** Makes sure that any unauthorised user cannot access, important for integrity of the system */
    /** @test */
    public function unauthenticatedUsersCanNotAccessEdit()
    {
        $response = $this->get('/products/1/edit')
            ->assertRedirect('/login');
    }

    /** Makes sure that any authorised user can acctually access the system */
    /** @test */
    public function authenticatedUsersCanAccessEdit()
    {
        $this->actingAs(factory (User::class)->create());

        $response = $this->get('/products/1/edit')
        ->assertOk();
    }

    /** Makes sure that any unauthorised user cannot access, important for integrity of the system */
    /** @test */
    public function unauthenticatedUsersCanNotAccessCreate()
    {
        $response = $this->get('/products/create')
            ->assertRedirect('/login');
    }

    /** Makes sure that any authorised user can acctually access the system */
    /** @test */
    public function authenticatedUsersCanAccessCreate()
    {
        $this->actingAs(factory (User::class)->create());

        $response = $this->get('/products/create')
        ->assertOk();
    }

    /** Makes sure that any authorised user can acctually post a new product */
    /** Redirected with success = 302 */
    /** @test */
    public function authenticatedUsersCanPostNewProduct()
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

    /** For integirty reasons it is important that only logged in users can make a new product */
    /** @test */
    public function unauthenticatedUsersCanNotPostNewProduct()
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

    /** Only logged in users can update a product */

    /** @test */
    public function authenticatedUsersCanPatchProduct()
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

    /** Only authenticated users can update a product */
    /** @test */
    public function unauthenticatedUsersCanNotPatchProduct()
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

    /** Makes sure that any authorised user can acctually delete a product */
    /** @test */
    public function authenticatedUsersCanDeleteProduct()
    {
        $this->actingAs(factory (User::class)->create());
        $response = $this->delete('/products/1')
            ->assertStatus(302);

    }

    /** Makes sure that any unauthorised user can not delete a product */
    /** @test */
    public function unauthenticatedUsersCanNotDeleteProduct()
    {
        $response = $this->delete('/products/2')
            ->assertRedirect('/login');

    }


    /** It is important to make sure that any user who tries to input invalid data cannot do so */
    /** 'description', 'price' and 'store' has been given invalid data*/
    /** @test */
    public function authenticatedUsersCanNotPostInvalidData()
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