<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

public function index(){

    return view('livewire.producten', [
        'producten' => \DB::table('externalproducts')
        ->select('externalproducts.product_code', 'externalproducts.supplier_product_code', 'externalproducts.model', 'externalproductimages.url')
        ->distinct()
        ->join('externalproductimages', 'externalproducts.supplier_product_code', '=', 'externalproductimages.supplier_product_code')
        ->paginate(20),
    ]);
}

}