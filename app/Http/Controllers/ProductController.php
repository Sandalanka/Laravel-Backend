<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Interfaces\Products\ProductRepositoryInterface;
use App\Classes\ApiCatchErrors;
use App\Http\Controllers\BaseController as BaseController;
use App\Http\Resources\ProductResource;
use Illuminate\Support\Facades\DB; 

class ProductController extends BaseController
{
    private ProductRepositoryInterface $productRepositoryInterface;

    public function __construct(ProductRepositoryInterface $productRepositoryInterface)
    {
        $this->productRepositoryInterface = $productRepositoryInterface;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->productRepositoryInterface->index();

        return $this->sendResponse(ProductResource::collection($data),'');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        Db::beginTransaction();
        try{
            $productDetails =[
                'name' => $request->name,
                'description' => $request->description
            ];
            $data = $this->productRepositoryInterface->store($productDetails);
            DB::commit();

            return $this->sendResponse(new ProductResource($data),'Product Add Successful');

        }catch(\Exception $ex){
            return ApiCatchErrors::rollback($ex);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   try{
            $data = $this->productRepositoryInterface->getById($id);
            return $this->sendResponse(new ProductResource($data),'');
        }catch(\Exception $ex){
            return ApiCatchErrors::throw($ex);
        }
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, $id)
    {
        DB::beginTransaction();
        try{
            $productDetails =[
                'name' => $request->name,
                'description' => $request->description
            ];
            $data = $this->productRepositoryInterface->update($id,$productDetails);
            DB::commit();
            
            return $this->sendResponse('Product Update Successful','');

        }catch(\Exception $ex){
            return ApiCatchErrors::rollback($ex);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->productRepositoryInterface->getById($id);

        return $this->sendResponse('Product Delete Successful','');
    }
}
