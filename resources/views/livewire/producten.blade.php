
    
 <?php
 use Illuminate\Support\Facades\DB;
 function search($a){
    $products = DB::table('externalproducts')
    ->select('externalproducts.brand', 'externalproducts.product_type', 'externalproducts.supplier_product_code', 'externalproducts.model', 'externalproductimages.url')
    ->join('externalproductimages','externalproducts.supplier_product_code','=','externalproductimages.supplier_product_code')
    ->where('product_type','=','Accessoire')
    ->where('stock','>', 0)
    ->where('brand','=', $a)
    ->limit(51)
    ->get();


    return $products;
 };

 if(!$_GET){
    $products = DB::table('externalproducts')
    ->select('externalproducts.brand', 'externalproducts.product_type', 'externalproducts.supplier_product_code', 'externalproducts.model', 'externalproductimages.url')
    ->join('externalproductimages','externalproducts.supplier_product_code','=','externalproductimages.supplier_product_code')
    ->where('product_type','=','Accessoire')
    ->where('stock','>', 0)
    ->limit(51)
    ->get();
}
else{
    $zetcheck = explode('|',$_GET['merk']);
    $tel=count($zetcheck);

        
    if($zetcheck == 'sony'){
        $products = DB::table('externalproducts')
        ->select('brand','model')
        ->where('product_type','=','Accessoire')
        ->where('stock','>', 0)
        ->where('brand','=', 'sony')
        ->orwhere('brand','=', 'Sony Ericsson')
        ->where('product_type','=','Accessoire')
        ->where('stock','>', 0)
        ->orderBy('brand')
        ->limit(51)
        ->get();
    }
    else{
        $implodecheck= implode(" ",$zetcheck);
        $products=search($implodecheck);
    }

}
?>
        
        @foreach($products as $product)
        <div class="product">
        
        <?php 

        echo '<a href=https://www.youtube.com/watch?v=sI0VSWzK8qU&t=5s&ab_channel=spoonkid2> <img src=' . $product->url . '></a>' ;
        echo "<b>" . $product->model . "</b>";
        ?>
        </div>
        @endforeach
    
