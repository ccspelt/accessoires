<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
<?php
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;
use App\Models\User;

      //INNER JOIN on the table, so i get the correct images and text underneath them.
              $products = \DB::table('externalproducts')
            ->select('externalproducts.product_code', 'externalproducts.supplier_product_code', 'externalproducts.model', 'externalproductimages.url', 'externalproducts.price')
            ->distinct()
            ->join('externalproductimages', 'externalproducts.supplier_product_code', '=', 'externalproductimages.supplier_product_code')
            ->paginate(20);
?>
<!-- foreach loop running trough every item ( will add pagination soon ) -->
        @foreach($products as $product)
          <div class="product"> 
            <?php echo '<a href=http://127.0.0.1:8000/product?code=' . $product->supplier_product_code . '><img src=' . $product->url . '></a>' ?>
            <?php echo '<a href=http://127.0.0.1:8000/product?code=' . $product->supplier_product_code . '><b>' . $product->model . '</b></a>'  ?> 
            <br><b class="prijs">€<?php echo $product->price ?></b> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
          </div>
        @endforeach

        <div class="mx-auto pb-10 w-4/5">
          {{ $products->links()}}
        </div>
    
