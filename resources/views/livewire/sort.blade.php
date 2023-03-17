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
    $checkvalue='';
    
    
    function searchproducts($checkmerk){
        $models = DB::table('externalproducts')
    ->select('externalproducts.model', 'externalproducts.supplier_product_code')
    ->where('product_type','=','Accessoire')
    ->where('brand','=', $checkmerk)
    ->where('stock','>', 0)
    ->orderBy('brand')
    ->get();
    return $models;
    };
    function searchvalues($checkvalue){
        $values = DB::table('externalproducts')
    ->select('externalproducts.model', 'externalproducts.supplier_product_code', 'externalproductspecifications.value')
    ->join('externalproductspecifications','externalproducts.supplier_product_code','=','externalproductspecifications.supplier_product_code')
    ->where('product_type','=','Accessoire')
    ->where('brand','=', $checkvalue)
    ->where('stock','>', 0)
    ->orderBy('value')
    ->get();
    return $values;
    }
    function merk($value, $checkmerk, $name, $check){
        echo"
        <div class='phone_brand_wrapper'>    
        <label class='merk_label'> 
        <input type='checkbox' value=".$value. "   $check name=".$name." class='merk submit'  onClick='submit()';>" .$checkmerk." 
        <span class='check'></span>
        </label>
        </div>";
    };
    // Hier boven zijn alle functies die we nodig hebben vort de filter kan mischien beter een functie weer alleen niet hoe.

if(!$_GET){
    $zetcheckmerk='';
    $zetcheckmodel='';
    $zetcheckvalue='';
}
elseif(isset($_GET['model']) && isset($_GET['merk'])&& isset($_GET['value'])){
    $zetcheckmodel = implode(" ",explode("|",$_GET['model']));
    $zetcheckmerk = implode(" ",explode("|",$_GET['merk']));
    $zetcheckvalue = implode(" ",explode("|",$_GET['value']));
    $models= searchproducts($zetcheckmerk);
    $values =searchvalues($zetcheckmerk);
}
elseif(isset($_GET['model']) && isset($_GET['merk'])){
    $zetcheckmodel = implode(" ",explode("|",$_GET['model']));
    $zetcheckmerk = implode(" ",explode("|",$_GET['merk']));
    $zetcheckvalue = '';
    $models= searchproducts($zetcheckmerk);
    $values =searchvalues($zetcheckmerk);
}
elseif(isset($_GET['merk'])){
    $zetcheckmerk = implode(" ",explode("|",$_GET['merk']));
    $zetcheckmodel='';
    $zetcheckvalue = '';
    $models= searchproducts($zetcheckmerk);

}

else{
    $zetcheckmerk = '';
    $zetcheckmodel='';
}




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
                        
                            $implode=implode("|", $checkstring);
                            merk($implode, $checkmerk, 'merk', 'checked'); //dit is als die gecheked is
                        }
                        else{
                            $implode=implode("|", $checkstring);
                            merk($implode, $checkmerk, 'merk', 'unchecked');
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
                        $implode=implode("|", $checkstring);
                        merk($implode, $checkmodel, 'model', 'checked'); //dit is als die gecheked is
                    }
                    else{
                        $implode=implode("|", $checkstring);
                        merk($implode, $checkmodel, 'model', 'unchecked');
                    }  
        }
        ?>

@endforeach
</div>
</div>
<div class="menu-sort">
<div class="sort">
<?php
;}

if(isset($_GET['model'])&& isset($_GET['merk'])){

    ?>
    @foreach($values as $merk)
            <?php 
            if($checkvalue == $merk->value){
            }
            else{
                $checkvalue= $merk->value;
                $checkstring= explode(" ", $checkvalue);
    
                
                        if($zetcheckvalue == $checkvalue){
                            $implode=implode("|", $checkstring);
                            merk($implode, $checkvalue, 'value', 'checked'); //dit is als die gecheked is
                        }
                        else{
                            $implode=implode("|", $checkstring);
                            merk($implode, $checkvalue, 'value', 'unchecked');
                        }  
            }
            ?>
    
    @endforeach
    <?php
    ;}
?>

</div>
</div>