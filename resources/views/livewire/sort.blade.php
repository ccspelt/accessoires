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
    function searchvalues($checkvalue, $name, $a){
        $values = DB::table('externalproducts')
    ->select('externalproducts.model', 'externalproducts.supplier_product_code', 'externalproductspecifications.value', 'externalproductspecifications.name')
    ->join('externalproductspecifications','externalproducts.supplier_product_code','=','externalproductspecifications.supplier_product_code')
    ->where('product_type','=','Accessoire')
    ->where('brand','=', $checkvalue)
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

    function tabeles($merk, $checkmerk, $zetcheckmerk){
        
        if($checkmerk == $merk){
        }
        else{
            $checkmerk= $merk;
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
    }
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
            tabeles($merk->brand,$checkmerk, $zetcheckmerk) ;
            $checkmerk= $merk->brand;

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
                    tabeles($merk->model,$checkmerk, $zetcheckmodel) ;
                    $checkmodel= $merk->model;

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
                        tabeles($merk->value,$checkvalue, $zetcheckvalue) ;
                        $checkvalue= $merk->value;
            
            ?>
    
    @endforeach
    <?php
    ;}
?>

</div>
</div>
<div class="menu-sort">
<div class="sort">
<?php


if(isset($_GET['model'])&& isset($_GET['merk'])){

    ?>
    @foreach($kleur as $merk)
            <?php 
                        tabeles($merk->value,$checkvalue, $zetcheckvalue) ;
                        $checkvalue= $merk->value;
            
            ?>
    
    @endforeach
    <?php
    ;}
?>

</div>
</div>