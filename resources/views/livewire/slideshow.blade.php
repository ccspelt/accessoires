<?php
// SQL syntax to get the correct data (url to the images, the price, the model name and the description)
  $product_code = $_GET['code'];
  $products = DB::select
    (' 
      SELECT externalproducts.model, externalproductimages.url, externalproducts.price 
      FROM externalproducts
      INNER JOIN externalproductimages 
      ON externalproducts.supplier_product_code=externalproductimages.supplier_product_code 
      WHERE externalproducts.supplier_product_code = ' .  $product_code . ' '
    );
  $desc = DB::select
    ('
      SELECT externalproducts.supplier_product_code, externalproductdetails.description
      FROM externalproducts
      INNER JOIN externalproductdetails
      ON externalproducts.supplier_product_code = externalproductdetails.supplier_product_code
      WHERE externalproducts.supplier_product_code = ' .  $product_code . ' '
    );
?>

</body>
</html> 
<div class= "grid-container">
  <!-- Slideshow container -->
  <div class="slideshow-container">
    <?php
      foreach($products as $product){
        echo   '<div class="mySlides fade">'; 
        echo   '<img src="' . $product->url   . '" style="width:100%">';
        echo   '</div>';
      }
    ?>
    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
    <a class="next" onclick="plusSlides(1)">&#10095;</a>
  </div>
  <!-- Add to shopping card button (need to add functionality for adding to cart and returning to the main accessoires page.) -->
  <div class="toev-winkmnd">

        <button type="button" class="winkelmand"> toevoegen aan winkelwagen</button>
  </div>
  &nbsp
    <div class="ondr-wmnd">
      <p>Voor 23:00 besteld morgen in huis</p>
      <p>Prijs inclusief verzendkosten</p>
    </div>
    <!-- Text Underneath Slideshow -->
  <div class="text">
    <?php echo '<b> €' . $products[0]->price  . '</b>';?>
    </br>
    <b>Productbeschrijving:</b>
    </br>
    <?php echo '<div> ' . $desc[0]->description . ' </div>'; ?>
  </div>
</div>

<script>
  let slideIndex = 1;
    showSlides(slideIndex);

  function plusSlides(n) {
    showSlides(slideIndex += n);
  }

    // Thumbnail image controls
  function currentSlide(n) {
    showSlides(slideIndex = n);
  }

  function showSlides(n) {
    let i;
    let slides = document.getElementsByClassName("mySlides");
    let dots = document.getElementsByClassName("dot");
      if (n > slides.length) {slideIndex = 1}
      if (n < 1) {slideIndex = slides.length}
      for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
      }
      for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
      }
        slides[slideIndex-1].style.display = "block";
        dots[slideIndex-1].className += " active";
  }
</script>
