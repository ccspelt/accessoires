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
    ->distinct()
    ->where('product_type','=','Accessoire')
    //->where('device_brand','=', 'samsung')
    ->where('stock','>', 0)
    ->where('externalproducts.supplier_product_code','=', '18165')
    //->orderBy('device_brand')
    ->limit(50)
    ->get();
    
    function searchproducts($checkmerk){
        $models = DB::table('externalproductcompatibles')
    ->select('externalproducts.model', 'externalproducts.supplier_product_code', 'externalproductcompatibles.device_model' )
    ->join('externalproducts','externalproductcompatibles.supplier_product_code','=','externalproducts.supplier_product_code')
    //->join('externalproductdetails','externalproductdetails.supplier_product_code','=','externalproducts.supplier_product_code')
    ->distinct()
    //->where('product_type','=','Accessoire')
    ->where('device_model','=', $checkmerk)
    ->where('stock','<', 0)
    //->where('externalproductdetails.name', '=','Bescherming van zijde')
    //->orderBy('device_model')
    ->limit(3)
    ->get();
    return $models;
    };
    function searchvalues($checkmerk, $name, $a){
        $values = DB::table('externalproductcompatibles')
    ->select( 'externalproductspecifications.value', 'externalproductspecifications.name')
    ->join('externalproductspecifications','externalproductcompatibles.supplier_product_code','=','externalproductspecifications.supplier_product_code')
    //->leftJoin('externalproductcompatibles','externalproducts.supplier_product_code','=','externalproductcompatibles.supplier_product_code')
    //->where('product_type','=','Accessoire')
    //->where('device_model','=', $checkvalue)
    ->where('device_model','=', $checkmerk)
    ->where('name', $a, $name)
    //->where('stock','>', 0)
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
    $zetcheckcolor = '' ;
    $zetcheckvalue='';
}
elseif(isset($_GET['toestel']) && isset($_GET['bescherming']) && isset ($_GET['kleur'])){
    $zetcheckcolor = implode(" ",explode("|",$_GET['kleur']));
    $zetcheckmerk = implode(" ",explode("|",$_GET['toestel']));
    $zetcheckvalue = '';
    $zetcheckbescherming= implode(" ",explode("|",$_GET['bescherming']));
    $models= searchproducts($zetcheckmerk);
    $values =searchvalues($zetcheckmerk, 'l', '!=' );
    $kleur= searchvalues($zetcheckmerk, 'kleur' , '=');
    $bescherming= searchvalues($zetcheckmerk, 'Bescherming van zijde' , '=');

}
elseif(isset($_GET['toestel']) && isset($_GET['bescherming'])){
    $zetcheckcolor = '' ;
    $zetcheckmerk = implode(" ",explode("|",$_GET['toestel']));
    $zetcheckvalue = '';
    $zetcheckbescherming= implode(" ",explode("|",$_GET['bescherming']));
    $models= searchproducts($zetcheckmerk);
    $values =searchvalues($zetcheckmerk, 'l', '!=' );
    $kleur= searchvalues($zetcheckmerk, 'kleur' , '=');
    $bescherming= searchvalues($zetcheckmerk, 'Bescherming van zijde' , '=');

}

elseif(isset($_GET['toestel'])&& isset($_GET['kleur'])){
    $zetcheckmerk = implode(" ",explode("|",$_GET['toestel']));
    $zetcheckcolor = implode(" ",explode("|",$_GET['kleur']));
    $zetcheckvalue = '';
    $zetcheckbescherming= '';
    $models= searchproducts($zetcheckmerk);
    $values =searchvalues($zetcheckmerk, 'l', '!=' );
    $kleur= searchvalues($zetcheckmerk, 'kleur' , '=');
    $bescherming= searchvalues($zetcheckmerk, 'Bescherming van zijde' , '=');

}
elseif(isset($_GET['toestel'])){
    $zetcheckmerk = implode(" ",explode("|",$_GET['toestel']));
    $zetcheckvalue = '';
    $zetcheckcolor = '' ;
    $zetcheckbescherming='';
    $models= searchproducts($zetcheckmerk);
    $values =searchvalues($zetcheckmerk, 'l', '!=' );
    $kleur= searchvalues($zetcheckmerk, 'kleur' , '=');
    $bescherming= searchvalues($zetcheckmerk, 'Bescherming van zijde' , '=');
}
else{
    $zetcheckmerk = '';

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
@foreach($bescherming as $merk)
            <?php 
                        tabeles($merk->value,$checkvalue, $zetcheckbescherming, 'bescherming van zijde') ;
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
                        tabeles($merk->value,$checkvalue, $zetcheckcolor, 'kleur') ;
                        $checkvalue= $merk->value;
            
            ?>
    
    @endforeach
    </div>
</div>
    <?php
    ;}
?>
