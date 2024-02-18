<?php

namespace App\Repositories\Products;

use App\Interfaces\Products\ProductRepositoryInterface;
use App\Models\Product;

class ProductRepository implements ProductRepositoryInterface {
    
    public function index(){
        return Product::all();
    }
    public function getById($id){
        return Product::findOrFail($id);
    }
    public function store(array $data){
        return Product::create($data);
    }
    public function update($id,array $data){
        return Product::whereId($id)->update($data);
    } 
    public function delete($id){
        return Product::destroy($id);
    }

}