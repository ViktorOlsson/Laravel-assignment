<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Product;
use App\Store;
use App\ProductStore;
use App\Review;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        $title = 'Produkter';
        $products = Product::all();
        return view('products/index')->with('title', $title)->with('products', $products);
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Ny produkt';
        $stores = Store::all();
        return view('products/create')->with('title', $title)-> with('stores', $stores);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'brand' => 'required',
            'image' => 'required',
            'price' => 'required'
        ]);

        $product = new Product;
        $product->title = $request->input('title');
        $product->brand = $request->input('brand');
        $product->price = $request->input('price');
        $product->description = $request->input('description');
        $product->image = $request->input('image');
        $product->save();

        // Gets id of newest product ie id of above product
        $productId = DB::table('products')->select('id')->latest('created_at')->first();

        // Loops each store id from form
        foreach ($request->get("stores") as $storeId) {
            $productStore = new ProductStore;
            
            // Assigns store id and product id to productStore
            $productStore->product_id = $productId->id;
            $productStore->store_id = $storeId;
            $productStore->save();
        }
        return redirect('/products')->with('success', 'Produkt skapad');
    }

      
    
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $product = Product::find($id);
      $product_stores = ProductStore::where('product_id', $id)->get();
      $reviews = Review::where('product_id', $id)->get();

      $product->{"reviews"} = $reviews;
      $store_list = array();

      foreach($product_stores as $product_store) {
        $fetchStores = Store::where('id', $product_store->store_id)->get();
        foreach($fetchStores as $fetchStore) {
          $store_object = $fetchStore;
          $store_object->{"pivot"} = $product_store;
          $store_list[] = $store_object;
        }
      }
      $product->{"stores"} = $store_list;
      //return $product;
      return view('products.product')->with('product', $product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $product = Product::find($id);
      $product_stores = ProductStore::where('product_id', $id)->get();
      $reviews = Review::where('product_id', $id)->get();

      $product->{"reviews"} = $reviews;
      $store_list = array();

      foreach($product_stores as $product_store) {
        $fetchStores = Store::where('id', $product_store->store_id)->get();
        foreach($fetchStores as $fetchStore) {
          $store_object = $fetchStore;
          $store_object->{"pivot"} = $product_store;
          $store_list[] = $store_object;
        }
      }
      $product->{"stores"} = $store_list;
      return view('products.edit')->with('product', $product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $this->validate($request, [
        'title' => 'required',
        'description' => 'required',
        'brand' => 'required',
        'image' => 'required',
        'price' => 'required'
    ]);

    $products = Product::find($id);
    $products->title = $request->input('title');
    $products->description = $request->input('description');
    $products->brand = $request->input('brand');
    $products->image = $request->input('image');
    $products->price = $request->input('price');
    $products->save();

    $remove_productstore = ProductStore::where('product_id', $id);
    $remove_productstore->delete();
    $stores = $request->input('stores');
    foreach($stores as $store) {
      $storeInt = intval($store);
      $add_product_store = new ProductStore;
      $add_product_store->store_id = $storeInt;
      $add_product_store->product_id = $id;
      $add_product_store->save();
    }
    return redirect('/products')->with('success', 'Produkt updaterad');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      ProductStore::where('product_id',$id)->delete();
      Review::where('product_id',$id)->delete();
      $product = Product::find($id);
      $product->delete();
      return redirect('/products')->with('success', 'Produkt borta');
    }
}
