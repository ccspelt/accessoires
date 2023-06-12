<?php
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\SortController;

    $product = DB::table('externalproducts')
            ->select('brand', 'supplier_product_code')
            ->where('product_type','=','Accessoire')
            ->where('stock','>', 0)
            ->orderBy('brand')
            ->get();//dit pakt alleen de brand waar van stock er is.       
    $checkmerk= '';//niet weg halen anders doet de code het niet meer
    $checkmodel='';
    $checkvalue='';
    $checkbrand= '';
    $checkkleur='';
    $sort = ["bescherming,van,zijde|geschite,aantal,passjes|hoes,opdruk|mate,van,valbescherming|materiaal","mah|serie|max,ampère(A)","lengte,kabel|type,connector","soort|type,headset,connector|uitvoering","capaciteit(mAh)","aantal,gb|leessnelheid(mb/s)|schrijfsnelheid(MB/s)|sd,adapter,meegeleverd|type,geheugen","blue,filter|case,friendly|material,screen,protector|model,specifiek","aantaloutputs|meegeleverde,accessoires"];
    $sortcount = 0;
    $sortvalue =['hoesje','opladers','kabels','oortjes','voedingen','usbs en sds','screen protectors','power banks']

?>

<?php

    $brand = DB::table('externalproductcompatibles')
    ->leftJoin('externalproducts','externalproductcompatibles.supplier_product_code', '=', 'externalproducts.supplier_product_code')
    ->distinct()
    ->select('device_brand')
    ->where('product_type', '=', 'accessoire')
    ->where('stock', '>', 0)
    ->limit(5)
    ->get();

    function searchvalues($checkmerk, $name, $a , $order ){
        $values = DB::table('externalproductcompatibles')
        ->select( 'externalproductspecifications.'.$order)
        ->join('externalproductspecifications','externalproductcompatibles.supplier_product_code','=','externalproductspecifications.supplier_product_code')
        //->leftJoin('externalproductcompatibles','externalproducts.supplier_product_code','=','externalproductcompatibles.supplier_product_code')
        //->where('product_type','=','Accessoire')
        //->where('device_model','=', $checkvalue)
        ->where('device_model','=', $checkmerk)
        ->where('name', $a, $name)
        //->where('value', $b , $c )
        //->where('stock','>', 0)
        ->distinct()
        ->orderBy($order)
        ->get();
        return $values;
        }

        
    function searchtoestel($checkbrand){    
        $toestel = DB::table('externalproductcompatibles')
        ->select( 'externalproductcompatibles.device_model' )
        ->join('externalproducts','externalproducts.supplier_product_code','=','externalproductcompatibles.supplier_product_code')
        ->distinct()
        ->where('product_type','=','Accessoire')
        //->where('device_brand','=', 'samsung')
        ->where('stock','>', 0)
        ->where('device_brand','=', $checkbrand)
        //->orderBy('device_brand')
        ->limit(50)
        ->get();
        return $toestel;
    }


    function searchaccessoiretype($device){
        $accessoire=DB::table('externalproductspecifications')
        ->select('value', 'name')
        ->join('externalproductcompatibles','externalproductspecifications.supplier_product_code','=','externalproductcompatibles.supplier_product_code')
        ->where('device_model','=',$device)
        ->limit(20)
        ->distinct()
        ->get();
        return $accessoire;
        
    };
    function merk($value, $checkmerk, $name, $check){
        echo"
        <div class='phone_brand_wrapper'>    
        <label class='merk_label'> 
        <input type='checkbox' value=".$value. "   $check name=".$name." class='merk submit'  onClick='submit()';>" .$checkmerk." 
        <span class='check'></span>
        </label>
        </div>";
    
    };

    function acctable($accessoirename, $check){

        if($accessoirename == $check ){
            echo"<input type='checkbox' value=".$accessoirename ."   checked name='sort' class='merk submit'  onClick='submit()';>
            "; 
        }
        else {
            echo"<input type='checkbox' value=".$accessoirename ."    name='sort' class='merk submit'  onClick='submit()';>
        "; 
        }

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
    ->limit(51)
    ->get();
    return $models;
    }
    // Hier boven zijn alle functies die we nodig hebben voor de filter kan mischien beter een functie weer alleen niet hoe.

if(!$_GET){
    $zetcheckmerk='';
    $zetcheckcolor = '' ;
    $zetcheckvalue='';
    $zetcheckbrand= '';
}

elseif(isset($_GET['merk'])&&isset($_GET['toestel'])&&isset($_GET['kleur'])){
    $zetcheckbrand= implode(" ",explode("|", $_GET['merk']));
    $zetcheckmerk= implode(" ",explode("|", $_GET['toestel']));
    $zetcheckcolor = implode(" ",explode("|",$_GET['kleur']));
    $zetcheckvalue='';
    $zetcheckbescherming= '';
    $zetchecktypeaccessoiretype = implode(" ",explode("|", $_GET['toestel']));
    $accessoire = searchaccessoiretype($zetchecktypeaccessoiretype); 
    $toestel = searchtoestel($zetcheckbrand);
    $models= searchproducts($zetcheckmerk);
    $values =searchvalues($zetcheckmerk, 'l', '!=', 'name' );
    $kleur= searchvalues($zetcheckmerk, 'kleur' , '=',  'value');
    $bescherming= searchvalues($zetcheckmerk, 'Bescherming van zijde' , '='  , 'name');
}
elseif(isset($_GET['merk'])&& isset($_GET['toestel'])&& isset($_GET['value'])){
    $zetcheckbrand= implode(" ",explode("|", $_GET['merk']));
    $zetcheckmerk= implode(" ",explode("|", $_GET['toestel']));
    $zetcheckcolor = '' ;
    $zetcheckvalue= implode(" ",explode("|",$_GET['value']));
    $zetcheckbescherming= '';
    $zetchecktypeaccessoiretype = implode(" ",explode("|", $_GET['toestel']));
    $accessoire = searchaccessoiretype($zetchecktypeaccessoiretype); 
    $toestel = searchtoestel($zetcheckbrand);
    $models= searchproducts($zetcheckmerk);
    $values =searchvalues($zetcheckmerk, 'l', '!=', 'name' );
    $kleur= searchvalues($zetcheckmerk, 'kleur' , '=',  'value');
    $bescherming= searchvalues($zetcheckmerk, 'Bescherming van zijde' , '='  , 'name');
    
}
elseif(isset($_GET['merk'])&& isset($_GET['toestel'])&& isset($_GET['sort'])){
    $zetcheckbrand= implode(" ",explode("|", $_GET['merk']));
    $zetcheckmerk= implode(" ",explode("|", $_GET['toestel']));
    $zetchecksort =$_GET['sort'];
    $zetcheckbescherming= '';
    $zetchecktypeaccessoiretype = implode(" ",explode("|", $_GET['toestel']));
    $accessoire = searchaccessoiretype($zetchecktypeaccessoiretype); 
    $toestel = searchtoestel($zetcheckbrand);
    $models= searchproducts($zetcheckmerk);
    $values =searchvalues($zetcheckmerk, 'l', '!=', 'name' );
    $kleur= searchvalues($zetcheckmerk, 'kleur' , '=',  'name');
    $bescherming= searchvalues($zetcheckmerk, 'Bescherming van zijde' , '='  , 'name');
    
}
elseif(isset($_GET['merk'])&& isset($_GET['toestel'])){
    $zetcheckbrand= implode(" ",explode("|", $_GET['merk']));
    $zetcheckmerk= implode(" ",explode("|", $_GET['toestel']));
    $zetcheckcolor = '' ;
    $zetcheckvalue='';
    $zetcheckbescherming= '';
    $zetchecksort = '';
    $zetchecktypeaccessoiretype = implode(" ",explode("|", $_GET['toestel']));
    $accessoire = searchaccessoiretype($zetchecktypeaccessoiretype); 
    $toestel = searchtoestel($zetcheckbrand);
    $models= searchproducts($zetcheckmerk);
    $values =searchvalues($zetcheckmerk, 'l', '!=', 'name' );
    $kleur= searchvalues($zetcheckmerk, 'kleur' , '=',  'name');
    $bescherming= searchvalues($zetcheckmerk, 'Bescherming van zijde' , '='  , 'name');
    
}
elseif(isset($_GET['toestel']) && isset($_GET['bescherming']) && isset ($_GET['kleur'])){
    $zetcheckcolor = implode(" ",explode("|",$_GET['kleur']));
    $zetcheckmerk = implode(" ",explode("|",$_GET['toestel']));
    $zetcheckvalue = '';
    $zetcheckbescherming= implode(" ",explode("|",$_GET['bescherming']));
    $models= searchproducts($zetcheckmerk);
    $values =searchvalues($zetcheckmerk, 'l', '!=', '!=', 'l' );
    $kleur= searchvalues($zetcheckmerk, 'kleur' , '=', '=', $zetcheckbescherming);
    $bescherming= searchvalues($zetcheckmerk, 'Bescherming van zijde' , '=' ,'!=' , '33');

}
elseif(isset($_GET['toestel']) && isset($_GET['bescherming'])){
    $zetcheckcolor = '' ;
    $zetcheckmerk = implode(" ",explode("|",$_GET['toestel']));
    $zetcheckvalue = '';
    $zetcheckbescherming= implode(" ",explode("|",$_GET['bescherming']));
    $models= searchproducts($zetcheckmerk);
    $values =searchvalues($zetcheckmerk, 'l', '!=', '!=', 'l' );
    $kleur= searchvalues($zetcheckmerk, 'kleur' , '=', '=', $zetcheckbescherming);
    $bescherming= searchvalues($zetcheckmerk, 'Bescherming van zijde' , '=' ,'!=' , '33');

}

elseif(isset($_GET['toestel'])&& isset($_GET['kleur'])){
    $zetcheckmerk = implode(" ",explode("|",$_GET['toestel']));
    $zetcheckcolor = implode(" ",explode("|",$_GET['kleur']));
    $zetcheckvalue = '';
    $zetcheckbescherming= '';
    $models= searchproducts($zetcheckmerk);
    $values =searchvalues($zetcheckmerk, 'l', '!=', '!=', 'l' );
    $kleur= searchvalues($zetcheckmerk, 'kleur' , '=', '=', $zetcheckbescherming);
    $bescherming= searchvalues($zetcheckmerk, 'Bescherming van zijde' , '=' ,'!=' , '33');

}

elseif(isset($_GET['merk'])){
    $zetcheckbrand= implode(" ",explode("|", $_GET['merk']));
    $zetcheckmerk='';
    $zetcheckcolor = '' ;
    $zetcheckvalue='';
    $toestel = searchtoestel($zetcheckbrand);
    $accessoire= '';
    
}
elseif(isset($_GET['toestel'])){
    $zetcheckmerk = implode(" ",explode("|",$_GET['toestel']));
    $zetcheckvalue = '';
    $zetcheckcolor = '' ;
    $zetcheckbescherming='';
    $zetcheckbrand= '';
    $models= searchproducts($zetcheckmerk);
    $values =searchvalues($zetcheckmerk, 'l', '!=', '!=', 'l' );
    $kleur= searchvalues($zetcheckmerk, 'kleur' , '=', '=', $zetcheckbescherming);
    $bescherming= searchvalues($zetcheckmerk, 'Bescherming van zijde' , '=' ,'!=' , '33');
    $accessoire= '';
}
else{
    $zetcheckmerk = '';
    $zetcheckvalue = '';
    $zetcheckcolor = '' ;
    $zetcheckbescherming='';
    $models='';
    $values='';
    $kleur='';
    $bescherming='';
    $accessoire= '';
}
?>
<div class="menu-sort">
<div class="sort">

    @foreach($brand as $merk)
            <?php
            tabeles($merk->device_brand,$checkbrand, $zetcheckbrand, 'merk') ;
            $checkbrand= $merk->device_brand;
            ?>
    @endforeach
</div>
</div>
<?php

if(isset($_GET['merk'])){

    ?>
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
}

if(isset($_GET['toestel'])){
?> 
<div class="menu-sort">
<div class="sort">
@foreach($sort as $value)
    <div class='phone_brand_wrapper'>    
        <label class='merk_label'> 
        <?php
        acctable($value,$zetchecksort);
        echo $sortvalue[$sortcount];
        $sortcount++;
        ?>
        <span class='check'></span>
        </label>
    </div>
    
@endforeach
    </div>
</div>
<?php
}

?>
