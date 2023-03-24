<?php

namespace App\Services;

use App\Http\Requests\StoreSupplyRequest;
use App\Models\Supply;
use App\Models\Stock;

class SupplyService
{

    public function store(StoreSupplyRequest $request){

        $supply = Supply::create( $request->validated() );
  
        return response()->json([

            'supply' => $supply, 
            'stock' => $this->stockIncrement($request->validated()['stock_id'], $request->validated()['quantity'])
        ]);
    }

    private function stockIncrement(int $stock_id, int $quantity){

        $stock = Stock::findOrFail( $stock_id);
        $stock->increment('quantity', $quantity); 
        return $stock;
    }

}