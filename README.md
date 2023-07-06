this is the README for the main accessoires page for GSMWEB accessoires page

the biggest difference between this version and the current live version
is that there is a different page for the individual accessoires,
if you click on the image / item itself you go to a page for the item where you can choose if you want to buy it or put it in your cart(without functionality).

all of the contents are in livewire form, and are joined into one page in acc_view.blade.php

the page for the individual pages are joined in the acc_pagina.blade.php in the folder product_specifiek. and it gets the information by using the product id and requesting the data through a sql query.


Things that still need functionality:
•   the cart still needs to be implemented (can be done directly from the live version).
•   the buy button as of now only sends you back to the main page (needs to add things to cart).


The filter function. 
If you press the first button the website will reload with the button pressed and it will filter the products and only pick the products with whom the ‘merk’ relates to. 
If the second button is pressed the website will reload again and now the website knows which compatible accessories for the device the user has pressed.
If the third button is pressed the website will reload and which kind the accessories the user is searching for.

How the filter function works is that each time the website gets new information the website will reload and with information the website will get the website will search the data base and will find the products and then will show it. With third button there is more information. it counts how many words there are and with that search the products.

