<?php
use Illuminate\Support\Facades\DB;

    $product = DB::table('externalproducts')
            ->select('brand', 'supplier_product_code')
            ->where('product_type','=','Accessoire')
            ->where('stock','>', 0)
            ->orderBy('brand')
            ->get();//dit pakt alleen de brand waar van stock er is.       
    $checkmerk= '';//niet weg halen anders doet de code het niet meer
if(!$_GET){
    $zetcheck='';
}
else{
    $zetcheck = implode(" ",explode("|",$_GET['merk']));
}

function merk($value, $checkmerk){
    echo"
    <div class='phone_brand_wrapper'>    
    <label class='merk_label'> 
    <input type='checkbox' value=".$value. "   name='merk' class='merk submit'  onClick='submit()';>" .$checkmerk." 
    <span class='check'></span>
    </label>
    </div>";
};

?>

<div class="sort">
<form method="get" action="<?php echo ($_SERVER['PHP_SELF']); ?>">
    @foreach($product as $merk)
            <?php 
            if($checkmerk == $merk->brand){
            }
            else{
                $checkmerk= $merk->brand;
                $checkstring= explode(" ", $checkmerk);

                if($checkmerk == 'Sony Ericsson'){}
                else{
                        if($zetcheck == $checkmerk){
                            echo"
                            <div  class='phone_brand_wrapper'>    
                            <label  class='merk_label'> 
                            <input type='checkbox' value=".$checkmerk.  " checked name='merkt' class='merkt'  onClick='submit()';>" .$checkmerk." 
                            <span  class='check'></span>
                            </label>
                            </div>"; //dit is als die gecheked is
                        }

                        else{
                            $implode=implode("|", $checkstring);
                            merk($implode, $checkmerk);
                        }  
                    }
            }
            ?>

    @endforeach
</form>
</div>