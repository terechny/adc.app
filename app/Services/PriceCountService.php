<?php

namespace App\Services;

use App\Models\Supply;
use App\Models\Stock;
use App\Http\Requests\PriceCountRequest;

class PriceCountService
{

    public function index(PriceCountRequest $request)
    {

        $supply = $this->getLastSupply($request->validated()['date'], $request->validated()['stock_id']);          
        $price = $this->countPrice( $supply->price, $supply->quantity );
 
        return response()->json([
            'supply' => $supply,
            'price' => $price
        ]);
    }

    private function getLastSupply(string $date, int $stock_id)
    {
    
        $date = $date . ' 23.59.59';

        $sup = Supply::where('quantity', '>', 0)
            ->where('created_at', '<=', $date )
            ->where('stock_id', $stock_id)
            ->orderByDesc('created_at')                     
            ->first();

        if (!$sup) {
            abort(404);
        }

        $sup->stock;

        return $sup;
    }

    private function countPrice(float $price, int $quantity): float
    {
        $price = ( $price / $quantity ) * env('MARKUP_PERCENTAGE', 1); 
        return round( $price, 2 );
    }
}