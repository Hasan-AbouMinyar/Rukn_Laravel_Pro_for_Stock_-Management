<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Purchase;
use App\Product;
use App\Category;
use App\Supplier;
use App\Sales;
use App\Http\Resources\PurchaseCollection;
use App\Http\Resources\PurchaseResource;
use App\Http\Resources\ProductCollection;
class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        $purschase = Purchase::orderBy('id','DESC')->paginate(10);
         $purschase->load('supplier','product');
         return new PurchaseCollection($purschase);

    }
    public function allpurchase(){
        $purschas = Purchase::latest()->get();
        $purschas->load('product');
        return new PurchaseCollection($purschas);
    }
    public function search($f, $q)
    {
        if ($f == "product") {
            $productIds = Product::where('name', 'LIKE', "%$q%")
                ->pluck('id');
            $purchases = Purchase::whereIn('product_id', $productIds)
                ->orderBy('id', 'DESC')
                ->with(['product', 'supplier'])
                ->paginate(10);
            return new PurchaseCollection($purchases);
        }
        if ($f == "supplier") {
            $supplierIds = Supplier::where('name', 'LIKE', "%$q%")
                ->pluck('id');
            $purchases = Purchase::whereIn('supplier_id', $supplierIds)
                ->orderBy('id', 'DESC')
                ->with(['product', 'supplier'])
                ->paginate(10);
            return new PurchaseCollection($purchases);
        }
        return response()->json(["data" => [], "meta" => ["current_page" => 1, "last_page" => 1, "total" => 0]]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|unique:purchases',
            'supplier_id' => 'required',
            'product_quantity' => 'required|numeric|min:0',
            'retail_price' => 'required|numeric|min:0',
            'sale_price' => 'required|numeric|min:0'
        ]);

        $purschase = new Purchase();
        $purschase->product_id = $request->product_id;
        $purschase->supplier_id = $request->supplier_id;
        $purschase->product_quantity = $request->product_quantity;
        $purschase->retail_price = $request->retail_price;
        $purschase->sale_price = $request->sale_price;
        $purschase->save();
        return new PurchaseResource($purschase);

        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $purschase = Purchase::findOrFail($id);
        return new PurchaseResource($purschase);
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
        $request->validate([
            'product_id' => 'required|unique:purchases,product_id,'.$id,
            'supplier_id' => 'required',
            'product_quantity' => 'required|numeric|min:0',
            'retail_price' => 'required|numeric|min:0',
            'sale_price' => 'required|numeric|min:0'
        ]);

        $purschaseOld = Purchase::findOrFail($id);
        //compute quantity
        $oldQuantity = $purschaseOld->product_quantity;
        $newQuantity = $request->product_quantity;
        $toata_quantity = $oldQuantity + $newQuantity;

        $purschaseOld->product_id = $request->product_id;
        $purschaseOld->supplier_id = $request->supplier_id;
        $purschaseOld->product_quantity = $toata_quantity;
        $purschaseOld->retail_price = $request->retail_price;
        $purschaseOld->sale_price = $request->sale_price;
        $purschaseOld->save();

        return new PurchaseResource($purschaseOld);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delSales = Sales::where('purchases_id',$id)->delete();
        $purschase = Purchase::findOrFail($id);
        $purschase->delete();
        return new PurchaseResource($purschase);
    }
}
