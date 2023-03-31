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
    $toestel = DB::table('externalproductcompatibles')
    ->select( 'externalproductcompatibles.device_model' )
    ->join('externalproducts','externalproducts.supplier_product_code','=','externalproductcompatibles.supplier_product_code')
    //->distinct()
    //->where('product_type','=','Accessoire')
    //->where('brand','=', $checkmerk)
    ->where('stock','>', 0)
    //->orderBy('device_model')
    ->limit(7030)
    ->get();
    
    function searchproducts($checkmerk){
        $models = DB::table('externalproductcompatibles')
    ->select('externalproducts.model', 'externalproducts.supplier_product_code', 'externalproductcompatibles.device_model' )
    ->join('externalproducts','externalproductcompatibles.supplier_product_code','=','externalproducts.supplier_product_code')
    //->join('externalproductdetails','externalproductdetails.supplier_product_code','=','externalproducts.supplier_product_code')
    ->distinct()
    ->where('product_type','=','Accessoire')
    ->where('device_model','=', $checkmerk)
    ->where('stock','>', 0)
    //->where('externalproductdetails.name', '=','Bescherming van zijde')
    //->orderBy('device_model')
    ->limit(3)
    ->get();
    return $models;
    };
    function searchvalues($checkvalue, $name, $a){
        $values = DB::table('externalproducts')
    ->select('externalproducts.model', 'externalproducts.supplier_product_code', 'externalproductspecifications.value', 'externalproductspecifications.name')
    ->join('externalproductspecifications','externalproducts.supplier_product_code','=','externalproductspecifications.supplier_product_code')
    //->leftJoin('externalproductcompatibles','externalproducts.supplier_product_code','=','externalproductcompatibles.supplier_product_code')
    ->where('product_type','=','Accessoire')
    //->where('device_model','=', $checkvalue)
    ->where('name', $a, $name)
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

    function tabeles($merk, $checkmerk, $zetcheckmerk, $soort){
        
        if($checkmerk == $merk){
        }
        else{
            $checkmerk= $merk;
            $checkstring= explode(" ", $checkmerk);
            if($checkmerk == 'Sony Ericsson'){}
            else{
                    if($zetcheckmerk == $checkmerk){
                    
                        $implode=implode("|", $checkstring);
                        merk($implode, $checkmerk, $soort, 'checked'); //dit is als die gecheked is
                    }
                    else{
                        $implode=implode("|", $checkstring);
                        merk($implode, $checkmerk, $soort, 'unchecked');
                    }  
                }
        }
    }
    // Hier boven zijn alle functies die we nodig hebben voor de filter kan mischien beter een functie weer alleen niet hoe.

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
    $values =searchvalues($zetcheckmerk, 'l', '!=');
    $kleur= searchvalues($zetcheckmerk, 'kleur' , '=');
}
elseif(isset($_GET['model']) && isset($_GET['merk'])){
    $zetcheckmodel = implode(" ",explode("|",$_GET['model']));
    $zetcheckmerk = implode(" ",explode("|",$_GET['merk']));
    $zetcheckvalue = '';
    $models= searchproducts($zetcheckmerk);
    $values =searchvalues($zetcheckmerk, 'l', '!=' );
    $kleur= searchvalues($zetcheckmerk, 'kleur' , '=');
}
elseif(isset($_GET['toestel'])){
    $zetcheckmerk = implode(" ",explode("|",$_GET['toestel']));
    $zetcheckmodel='';
    $zetcheckvalue = '';
    $models= searchproducts($zetcheckmerk);
    $values =searchvalues($zetcheckmerk, 'l', '!=' );
    $kleur= searchvalues($zetcheckmerk, 'kleur' , '=');
}
else{
    $zetcheckmerk = '';
    $zetcheckmodel='';
}
?>
<!-- <div class="menu-sort">
<div class="sort">

    @foreach($product as $merk)
            <?php
            //tabeles($merk->brand,$checkmerk, $zetcheckmerk, 'merk') ;
            //$checkmerk= $merk->brand;
            ?>
    @endforeach
</div>
</div> -->
<div class="menu-sort">
<div class="sort">

    @foreach($toestel as $merk)
            <?php
            tabeles($merk->device_model,$checkmerk, $zetcheckmerk, 'toestel') ;
            $checkmerk= $merk->device_model;
            ?>
    @endforeach
</div>
</div>

<?php

if(isset($_GET['toestel'])){

    ?>
    <div class="menu-sort">
<div class="sort">
    @foreach($values as $merk)
            <?php 
                        tabeles($merk->value,$checkvalue, $zetcheckvalue, 'value') ;
                        $checkvalue= $merk->value;
            ?>
    @endforeach
    </div>
</div>
    <?php
    ;}
?>


<?php
if(isset($_GET['toestel'])){

    ?>
    <div class="menu-sort">
<div class="sort">
    @foreach($kleur as $merk)
            <?php 
                        tabeles($merk->value,$checkvalue, $zetcheckvalue, 'kleur') ;
                        $checkvalue= $merk->value;
            
            ?>
    
    @endforeach
    </div>
</div>
    <?php
    ;}
?>
