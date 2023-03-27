
    
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
elseif(isset($_GET['merk'])&& isset($_GET['model'])&& isset($_GET['value'])){
    $zetcheckmerk = explode('|',$_GET['merk']);
    $implodecheckmerk = implode(" " ,$zetcheckmerk);
    $zetcheckmodel = explode('|',$_GET['model']);
    $implodecheckmodel = implode(" ; "  ,$zetcheckmodel);
    $zetcheckvalue = explode('|',$_GET['value']);
    $implodecheckvalue = implode(" ; "  ,$zetcheckvalue);
   
    $products = DB::table('externalproducts')
    ->select('externalproducts.brand', 'externalproducts.product_type', 'externalproducts.supplier_product_code', 'externalproducts.model', 'externalproductimages.url', 'externalproductspecifications.value', )
    ->join('externalproductimages','externalproducts.supplier_product_code','=','externalproductimages.supplier_product_code')
    ->join('externalproductspecifications','externalproducts.supplier_product_code','=','externalproductspecifications.supplier_product_code')
    ->where('product_type','=','Accessoire')
    ->where('stock','>', 0)
    ->where('brand','=', $implodecheckmerk)
    ->where('value', '=', $implodecheckvalue)
    //->where('model', '= ', $implodecheckmodel)
    ->limit(51)
    ->get();
}
elseif(isset($_GET['merk'])&& isset($_GET['model'])){
    $zetcheckmerk = explode('|',$_GET['merk']);
    $implodecheckmerk = implode(" " ,$zetcheckmerk);
    $zetcheckmodel = explode('|',$_GET['model']);
    $implodecheckmodel = implode(" ; "  ,$zetcheckmodel);
    
   
    $products = DB::table('externalproducts')
    ->select('externalproducts.brand', 'externalproducts.product_type', 'externalproducts.supplier_product_code', 'externalproducts.model', 'externalproductimages.url', )
    ->join('externalproductimages','externalproducts.supplier_product_code','=','externalproductimages.supplier_product_code')
    ->where('product_type','=','Accessoire')
    ->where('stock','>', 0)
    ->where('brand','=', $implodecheckmerk)
    //->where('model', '= ', $implodecheckmodel)
    ->limit(51)
    ->get();
}
elseif(isset($_GET['merk'])){
    $zetcheck = explode('|',$_GET['merk']);
    $tel=count($zetcheck);

        
    if($zetcheck == 'sony'){
        $products = DB::table('externalproducts')
        ->select('brand','model')
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
        $implodecheckmerk= implode(" ",$zetcheck);
        $products=search($implodecheckmerk);
    }

}
elseif(isset($_GET['toestel'])){
    $toestel=$_GET['toestel'];

    
    $products = DB::table('externalproducts')
    ->select('externalproducts.brand', 'externalproducts.product_type', 'externalproducts.supplier_product_code', 'externalproducts.model', 'externalproductcompatibles.device_model', 'externalproductimages.url')
    ->join('externalproductcompatibles','externalproducts.supplier_product_code','=','externalproductcompatibles.supplier_product_code')
    ->rightjoin('externalproductimages','externalproducts.supplier_product_code','=','externalproductimages.supplier_product_code')
    ->where('product_type','=','Accessoire')
    ->where('stock','>',0)
    ->where('device_model','=',$toestel)
    ->distinct()
    ->limit(51)
    ->get();
}

else{
    $products = DB::table('externalproducts')
    ->select('externalproducts.brand', 'externalproducts.product_type', 'externalproducts.supplier_product_code', 'externalproducts.model', 'externalproductimages.url')
    ->join('externalproductimages','externalproducts.supplier_product_code','=','externalproductimages.supplier_product_code')
    ->where('product_type','=','Accessoire')
    ->where('stock','>', 0)
    ->limit(51)
    ->get();
}
?>
        <p>

        <?php 
        // var_dump($implodecheckmerk);
        // var_dump($implodecheckmodel)
        ?>
        </p>
        
        @foreach($products as $product)
        <div class="product">
        
        <?php 
        echo "<b>" . $product->model . "</b>";
        echo '<a href=https://www.youtube.com/watch?v=sI0VSWzK8qU&t=5s&ab_channel=spoonkid2> <img src=' . $product->url . '></a>' ;
        ?>
        
        </div>
        @endforeach
    
