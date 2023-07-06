<?php
namespace App\Http\Livewire;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
class producten extends Component
{
    use WithPagination;
    public function index()
    {
        return view('livewire.producten', [
             $products = \DB::table('externalproducts')
             ->select('externalproducts.product_code', 'externalproducts.supplier_product_code', 'externalproducts.model', 'externalproductimages.url')
             ->distinct()
             ->join('externalproductimages', 'externalproducts.supplier_product_code', '=', 'externalproductimages.supplier_product_code')
             ->paginate(20),
        ]);
    }
}
