<?php
use Illuminate\Support\Facades\DB;

    $product = DB::table('externalproducts')
            ->select('brand', 'supplier_product_code')
            ->where('product_type','=','Accessoire')
            ->where('stock','>', 0)
            ->orderBy('brand')
            ->get();//dit pakt alleen de brand waar van stock er is.       
    $checkmerk= '';//niet weg halen anders doet de code het niet meer
    $checkmodel='';
if(!$_GET){
    $zetcheckmerk='';
    $zetcheckmodel='';
}
elseif(isset($_GET['model']) && isset($_GET['merk'])){
    $zetcheckmodel = implode(" ",explode("|",$_GET['model']));
    $zetcheckmerk = implode(" ",explode("|",$_GET['merk']));
    $models = DB::table('externalproducts')
    ->select('model', 'supplier_product_code')
    ->where('product_type','=','Accessoire')
    ->where('brand','=', $zetcheckmerk)
    ->where('stock','>', 0)
    ->orderBy('brand')
    ->get();
}
elseif(isset($_GET['merk'])){
    $zetcheckmerk = implode(" ",explode("|",$_GET['merk']));
    $zetcheckmodel='';
    $models = DB::table('externalproducts')
    ->select('model', 'supplier_product_code')
    ->where('product_type','=','Accessoire')
    ->where('brand','=', $zetcheckmerk)
    ->where('stock','>', 0)
    ->orderBy('brand')
    ->get();

}
elseif(isset($_GET['model'])){
    $zetcheckmodel = implode(" ",explode("|",$_GET['model']));
    $zetcheckmerk='';
    $models = DB::table('externalproducts')
    ->select('model', 'supplier_product_code')
    ->where('product_type','=','Accessoire')
    ->where('brand','=', $zetcheckmerk)
    ->where('stock','>', 0)
    ->orderBy('brand')
    ->get();
}

else{
    $zetcheckmerk = '';
    $zetcheckmodel='';
}

function merk($value, $checkmerk, $name){
    echo"
    <div class='phone_brand_wrapper'>    
    <label class='merk_label'> 
    <input type='checkbox' value=".$value. "   name=".$name." class='merk submit'  onClick='submit()';>" .$checkmerk." 
    <span class='check'></span>
    </label>
    </div>";
};


?>
<div class="menu-sort">
<div class="sort">

    @foreach($product as $merk)
            <?php 
            if($checkmerk == $merk->brand){
            }
            else{
                $checkmerk= $merk->brand;
                $checkstring= explode(" ", $checkmerk);

                if($checkmerk == 'Sony Ericsson'){}
                else{
                        if($zetcheckmerk == $checkmerk){
                            echo"
                            <div  class='phone_brand_wrapper'>    
                            <label  class='merk_label'> 
                            <input type='checkbox' value=".$checkmerk.  " checked name='merk' class='merk'  onClick='submit()';>" .$checkmerk." 
                            <span  class='check'></span>
                            </label>
                            </div>"; //dit is als die gecheked is
                        }

                        else{
                            $implode=implode("|", $checkstring);
                            merk($implode, $checkmerk, 'merk');
                        }  
                    }
            }
            ?>

    @endforeach
</div>
</div>
<div class="menu-sort">
<div class="sort">
<?php 
if(isset($_GET['merk'])){

?>
@foreach($models as $merk)
        <?php 
        if($checkmodel == $merk->model){
        }
        else{
            $checkmodel= $merk->model;
            $checkstring= explode(" ", $checkmodel);

            
                    if($zetcheckmodel == $checkmodel){
                        echo"
                        <div  class='phone_brand_wrapper'>    
                        <label  class='merk_label'> 
                        <input type='checkbox' value=".$checkmodel.  " checked name='model' class='model'  onClick='submit()';>" .$checkmodel." 
                        <span  class='check'></span>
                        </label>
                        </div>"; //dit is als die gecheked is
                    }

                    else{
                        $implode=implode("|", $checkstring);
                        merk($implode, $checkmodel, 'model');
                    }  
            
        }
        ?>

@endforeach
<?php
;}
?>

</div>
</div>