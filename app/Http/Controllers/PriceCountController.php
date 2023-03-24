<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supply;
use App\Services\PriceCountService;
use App\Http\Requests\PriceCountRequest;

class PriceCountController extends Controller
{

    private PriceCountService $priceCountService;

    public function __construct(PriceCountService $priceCountService)
    {
        $this->priceCountService = $priceCountService;
    }

     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(PriceCountRequest $request){

        return $this->priceCountService->index($request);
    }
}
