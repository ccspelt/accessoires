
    
 <?php
 use Illuminate\Support\Facades\DB;



 function paktacc($table, $zetcheckmodel){
    $tel=count($table);

    if($tel= 1){
    $products = DB::table('externalproducts')
    ->select('externalproducts.brand', 'externalproducts.product_type', 'externalproducts.supplier_product_code', 'externalproducts.model', 'externalproductspecifications.value', 'externalproductimages.url')
    ->join('externalproductspecifications','externalproducts.supplier_product_code','=','externalproductspecifications.supplier_product_code')
    ->join('externalproductimages','externalproducts.supplier_product_code','=','externalproductimages.supplier_product_code')
    ->Join('externalproductcompatibles','externalproducts.supplier_product_code','=','externalproductcompatibles.supplier_product_code')
//    ->where('product_type','=','Accessoire')
//    ->where('stock','>', 0)
//    ->where('externalproductspecifications.name','=','blue filter')
    ->Where('externalproductspecifications.name','=',$table[0])
    ->where('device_model','=', $zetcheckmodel) 
    ->limit(21)
    ->get();
    }
    elseif($tel= 2){
        $products = DB::table('externalproducts')
        ->select('externalproducts.brand', 'externalproducts.product_type', 'externalproducts.supplier_product_code', 'externalproducts.model', 'externalproductspecifications.value', 'externalproductimages.url')
        ->join('externalproductspecifications','externalproducts.supplier_product_code','=','externalproductspecifications.supplier_product_code')
        ->join('externalproductimages','externalproducts.supplier_product_code','=','externalproductimages.supplier_product_code')
        ->Join('externalproductcompatibles','externalproducts.supplier_product_code','=','externalproductcompatibles.supplier_product_code')
    //    ->where('product_type','=','Accessoire')
    //    ->where('stock','>', 0)
    //    ->where('externalproductspecifications.name','=','blue filter')
        ->Where('externalproductspecifications.name','=',$table[0])
        ->where('device_model','=', $zetcheckmodel)
        ->orWhere('externalproductspecifications.name','=',$table[1])
        ->where('device_model','=', $zetcheckmodel)
        ->limit(21)
        ->get();
    }
    elseif ($tel= 3){
        $products = DB::table('externalproducts')
        ->select('externalproducts.brand', 'externalproducts.product_type', 'externalproducts.supplier_product_code', 'externalproducts.model', 'externalproductspecifications.value', 'externalproductimages.url')
        ->join('externalproductspecifications','externalproducts.supplier_product_code','=','externalproductspecifications.supplier_product_code')
        ->join('externalproductimages','externalproducts.supplier_product_code','=','externalproductimages.supplier_product_code')
        ->Join('externalproductcompatibles','externalproducts.supplier_product_code','=','externalproductcompatibles.supplier_product_code')
    //    ->where('product_type','=','Accessoire')
    //    ->where('stock','>', 0)
    //    ->where('externalproductspecifications.name','=','blue filter')
        ->Where('externalproductspecifications.name','=',$table[0])
        ->where('device_model','=', $zetcheckmodel)
        ->orWhere('externalproductspecifications.name','=',$table[1])
        ->where('device_model','=', $zetcheckmodel)
        ->orWhere('externalproductspecifications.name','=',$table[2])
        ->where('device_model','=', $zetcheckmodel)
        ->limit(21)
        ->get();
    }
    elseif($tel= 4){
        $products = DB::table('externalproducts')
        ->select('externalproducts.brand', 'externalproducts.product_type', 'externalproducts.supplier_product_code', 'externalproducts.model', 'externalproductspecifications.value', 'externalproductimages.url')
        ->join('externalproductspecifications','externalproducts.supplier_product_code','=','externalproductspecifications.supplier_product_code')
        ->join('externalproductimages','externalproducts.supplier_product_code','=','externalproductimages.supplier_product_code')
        ->Join('externalproductcompatibles','externalproducts.supplier_product_code','=','externalproductcompatibles.supplier_product_code')
    //    ->where('product_type','=','Accessoire')
    //    ->where('stock','>', 0)
    //    ->where('externalproductspecifications.name','=','blue filter')
        ->Where('externalproductspecifications.name','=',$table[0])
        ->where('device_model','=', $zetcheckmodel)
        ->orWhere('externalproductspecifications.name','=',$table[1])
        ->where('device_model','=', $zetcheckmodel)
        ->orWhere('externalproductspecifications.name','=',$table[2])
        ->where('device_model','=', $zetcheckmodel)
        ->orWhere('externalproductspecifications.name','=',$table[3])
        ->where('device_model','=', $zetcheckmodel)

        ->limit(21)
        ->get();
    }
    elseif($tel= 5){
        $products = DB::table('externalproducts')
        ->select('externalproducts.brand', 'externalproducts.product_type', 'externalproducts.supplier_product_code', 'externalproducts.model', 'externalproductspecifications.value', 'externalproductimages.url')
        ->join('externalproductspecifications','externalproducts.supplier_product_code','=','externalproductspecifications.supplier_product_code')
        ->join('externalproductimages','externalproducts.supplier_product_code','=','externalproductimages.supplier_product_code')
        ->Join('externalproductcompatibles','externalproducts.supplier_product_code','=','externalproductcompatibles.supplier_product_code')
    //    ->where('product_type','=','Accessoire')
    //    ->where('stock','>', 0)
    //    ->where('externalproductspecifications.name','=','blue filter')
        ->Where('externalproductspecifications.name','=',$table[0])
        ->where('device_model','=', $zetcheckmodel)
        ->orWhere('externalproductspecifications.name','=',$table[1])
        ->where('device_model','=', $zetcheckmodel)
        ->orWhere('externalproductspecifications.name','=',$table[2])
        ->where('device_model','=', $zetcheckmodel)
        ->orWhere('externalproductspecifications.name','=',$table[3])
        ->where('device_model','=', $zetcheckmodel)
        ->orWhere('externalproductspecifications.name','=',$table[4])
        ->where('device_model','=', $zetcheckmodel)
        ->limit(21)
        ->get();
    }
    elseif($tel= 6){
        $products = DB::table('externalproducts')
        ->select('externalproducts.brand', 'externalproducts.product_type', 'externalproducts.supplier_product_code', 'externalproducts.model', 'externalproductspecifications.value', 'externalproductimages.url')
        ->join('externalproductspecifications','externalproducts.supplier_product_code','=','externalproductspecifications.supplier_product_code')
        ->join('externalproductimages','externalproducts.supplier_product_code','=','externalproductimages.supplier_product_code')
        ->Join('externalproductcompatibles','externalproducts.supplier_product_code','=','externalproductcompatibles.supplier_product_code')
    //    ->where('product_type','=','Accessoire')
    //    ->where('stock','>', 0)
    //    ->where('externalproductspecifications.name','=','blue filter')
        ->Where('externalproductspecifications.name','=',$table[0])
        ->where('device_model','=', $zetcheckmodel)
        ->orWhere('externalproductspecifications.name','=',$table[1])
        ->where('device_model','=', $zetcheckmodel)
        ->orWhere('externalproductspecifications.name','=',$table[2])
        ->where('device_model','=', $zetcheckmodel)
        ->orWhere('externalproductspecifications.name','=',$table[3])
        ->where('device_model','=', $zetcheckmodel)
        ->orWhere('externalproductspecifications.name','=',$table[4])
        ->where('device_model','=', $zetcheckmodel)
        ->orWhere('externalproductspecifications.name','=',$table[5])
        ->where('device_model','=', $zetcheckmodel)
        ->limit(21)
        ->get();
    }
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


elseif(isset($_GET['toestel'])&& isset($_GET['sort'])){
    $zetcheckbescherming = explode('|', implode(' ', explode(',',$_GET['sort'])));
    $zetcheckmodel = explode('|',$_GET['toestel']);
    $implodecheckmodel = implode(" "  ,$zetcheckmodel);
    $products = paktacc($zetcheckbescherming,$zetcheckmodel);
}
elseif(isset($_GET['toestel'])&& isset($_GET['kleur'])){

    $zetcheckmodel = explode('|',$_GET['toestel']);
    $implodecheckmodel = implode(" "  ,$zetcheckmodel);
    $zetcheckcolor = explode('|',$_GET['kleur']);
    $implodecheckcolor = implode(" ; "  ,$zetcheckcolor);
    $products = DB::table('externalproducts')
    ->select('externalproducts.product_type', 'externalproducts.supplier_product_code', 'externalproducts.model', 'externalproductspecifications.value', 'externalproductimages.url' )
    ->join('externalproductspecifications','externalproducts.supplier_product_code','=','externalproductspecifications.supplier_product_code')
    ->join('externalproductimages','externalproducts.supplier_product_code','=','externalproductimages.supplier_product_code')
    ->leftJoin('externalproductcompatibles','externalproducts.supplier_product_code','=','externalproductcompatibles.supplier_product_code')
    // ->where('product_type','=','Accessoire')
    //->where('stock','>',0)
    ->where('value','=',$zetcheckcolor)
    ->where('device_model','=','iphone 3g')
    ->limit(50)
    ->get();
}
elseif(isset($_GET['toestel'])&& isset($_GET['merk'])&&isset($_GET['kleur'])){
    $toestel=explode('|',$_GET['toestel']);
    $color= explode('|', $_GET['kleur']);
    $products =DB::table('externalproducts')
->select('externalproducts.brand', 'externalproducts.product_type', 'externalproducts.supplier_product_code', 'externalproducts.model', 'externalproductcompatibles.device_model','externalproductimages.url')
->leftJoin('externalproductcompatibles','externalproducts.supplier_product_code','=','externalproductcompatibles.supplier_product_code')
->rightJoin('externalproductimages','externalproducts.supplier_product_code','=','externalproductimages.supplier_product_code')
->where('product_type','=','Accessoire')
//->where('stock','>',0)
->where('device_model','=',$toestel)
->where('value', '=', $color)
->limit(51)
->get();


}
elseif(isset($_GET['toestel'])&& isset($_GET['merk'])){
    $toestel=explode('|',$_GET['toestel']);
    $products =DB::table('externalproducts')
->select('externalproducts.brand', 'externalproducts.product_type', 'externalproducts.supplier_product_code', 'externalproducts.model', 'externalproductcompatibles.device_model','externalproductimages.url')
->leftJoin('externalproductcompatibles','externalproducts.supplier_product_code','=','externalproductcompatibles.supplier_product_code')
->rightJoin('externalproductimages','externalproducts.supplier_product_code','=','externalproductimages.supplier_product_code')
->where('product_type','=','Accessoire')
//->where('stock','>',0)
->where('device_model','=',$toestel)
->limit(51)
->get();


}

elseif(isset($_GET['toestel'])){
    $toestel=explode('|',$_GET['toestel']);
    $products =DB::table('externalproducts')
->select('externalproducts.brand', 'externalproducts.product_type', 'externalproducts.supplier_product_code', 'externalproducts.model', 'externalproductcompatibles.device_model','externalproductimages.url')
->leftJoin('externalproductcompatibles','externalproducts.supplier_product_code','=','externalproductcompatibles.supplier_product_code')
->rightJoin('externalproductimages','externalproducts.supplier_product_code','=','externalproductimages.supplier_product_code')
->where('product_type','=','Accessoire')
//->where('stock','>',0)
->where('device_model','=',$toestel)
->limit(51)
->get();
}
elseif(isset($_GET['merk'])){
    $zetcheckmerk = explode('|',$_GET['merk']);
    $implodecheckmerk = implode(" "  ,$zetcheckmerk);
    $products = DB::table('externalproducts')
    ->select('externalproducts.brand', 'externalproducts.product_type', 'externalproducts.supplier_product_code', 'externalproducts.model', 'externalproductspecifications.value', 'externalproductimages.url' )
    ->join('externalproductspecifications','externalproducts.supplier_product_code','=','externalproductspecifications.supplier_product_code')
    ->join('externalproductimages','externalproducts.supplier_product_code','=','externalproductimages.supplier_product_code')
    //->Join('externalproductcompatibles','externalproducts.supplier_product_code','=','externalproductcompatibles.supplier_product_code')
    ->leftJoin('externalproductcompatibles','externalproducts.supplier_product_code','=','externalproductcompatibles.supplier_product_code')
    ->where('product_type','=','Accessoire')
    ->where('stock','>', 0)
    ->where('device_brand', '=', $zetcheckmerk)
    //->where('model', '= ', $implodecheckmodel)
    ->limit(51)
    ->get();
}

else{
    $products = DB::table('externalproducts')
    ->select('externalproducts.brand', 'externalproducts.product_type', 'externalproducts.supplier_product_code', 'externalproducts.model', 'externalproductimages.url')
    ->join('externalproductimages','externalproducts.supplier_product_code','=','externalproductimages.supplier_product_code')
    ->where('product_type','=','Accessoire')
    ->where('stock','>', 0)
    ->limit(1)
    ->get();
}
?>
        <p>

        <?php 
        // var_dump($implodecheckmerk);
        // var_dump($implodecheckmodel)
        $aantal = count($products);

        if ($aantal == 0) {
            ?>
            <p>geen producten L</p>
            <?php
        }
        else{
        ?>
        </p>
        


        @foreach($products as $product)
        <div class="product">
        
        <?php 
        echo "<b>" . $product->model . "</b>";
        echo '<a > <img src=' . $product->url . '></a>' ;
        //var_dump($implodecheckbescherming)
        
        ?>
        
        </div>
        @endforeach
    <?php
        }
    ?>
