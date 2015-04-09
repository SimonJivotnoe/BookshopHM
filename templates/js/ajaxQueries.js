function insertList( url, args, method, insert )
{
    var dataToInsert = '';
    var disable = buttonDis();
    $.ajax( {
        url   : url + args,
        method: method
    } ).then( function ( data )
    {
        var objJSON = JSON.parse( data );
        $.each( objJSON, function ( key, val )
        {
            if ( args == 'books' || args == '' )
            {
                dataToInsert += "<div class='col-md-3 well content'><div class='col-md-3'><span class='price'>";
                dataToInsert += val[ "price" ] + "</span><span>$</span></div><div class='bookWrapper'>";
                dataToInsert += "<a name = index.php?page=ajaxbookctrl&bk_id=" + val[ "id" ] + "><h4 class='col-md-12'>";
                dataToInsert += val[ "name" ];
                dataToInsert += "</h4><img class='image' src='templates/images/" + val[ "image" ];
                dataToInsert += "'></a></div><button type='button' class='btn btn-success addToCart'" + disable + " name=";
                dataToInsert += val[ "id" ] + " >Add to cart</button></div>";
            } else if ( args == 'authors' )
            {
                dataToInsert += "<li><a name = index.php?page=ajaxauthorsctrl&author_id=" + val[ "id" ] + ">" + val[ "name" ] + "</a></li>";
            } else if ( args == 'genres' )
            {
                dataToInsert += "<li><a name = index.php?page=ajaxgenresctrl&gr_id=" + val[ "id" ] + ">" + val[ "name" ] + "</a></li>";
            } else
            {
            }

        } );
        $( insert ).html( dataToInsert );
    } )
}
function bookDetails( url, method )
{
    var dataToInsert = '';
    $.ajax( {
        url   : url,
        method: method
    } ).then( function ( data )
    {
        var objJSON = JSON.parse( data );
        $.each( objJSON, function ( key, val )
        {
            dataToInsert += "<p>" + val[ "name" ] + "</p>";
            dataToInsert += "<p><img src=templates/images/" + val[ "image" ] + "></p>";
            dataToInsert += "<p>" + val[ "description" ] + "</p>";
            dataToInsert += "<p>genre(s): " + val[ "genre" ] + "</p>";
            dataToInsert += "<p>author(s): " + val[ "author" ] + "</p>";
            dataToInsert += "<p>price: " + val[ "price" ] + " uah</p>";

        } );
        $( '.product-index' ).html( dataToInsert );

    } );
}

function insertInCart( url, args, method, details, book, priceB, bookName )
{
    var price = 0;
    var quantity = 0;
    $.ajax( {
        url   : url + args,
        method: method
    } ).then( function ( data )
    {
        var objJSON = JSON.parse( data );
        //console.log(objJSON.length);
        if ( details == '' )
        {
            if ( objJSON.length != 0 )
            {
                $.each( objJSON, function ( key, val )
                {
                    price += parseInt( val[ 'price' ] ) * parseInt( val[ 'quantity' ] );
                    quantity += parseInt( val[ 'quantity' ] );
                } );
                $( '.price span' ).html( price );
                $( '.items span' ).html( quantity );
            } else
            {

                if ( $('.authorization').length == 1 && localStorage.getItem( 'guest' ) == null )
                {
                   // localStorage[ 'guest' ] = JSON.stringify( [ { "book": 0, "quantity": 0, "price": 0, "name": '' } ] );
                } else
                {
                    if ( book != '' )
                    {
                       /* var check = 0;
                        var lsJSON = JSON.parse( localStorage[ 'guest' ] );
                        $.each( lsJSON, function ( key, val )
                        {
                            if ( val[ 'book' ] == 0 )
                            {
                                val[ 'book' ] = book;
                                check = 1;
                                val[ 'quantity' ] = parseInt( val[ 'quantity' ] ) + 1;
                                val[ 'price' ] = val[ 'quantity' ] * priceB;
                                val[ 'name' ] = bookName;
                                localStorage[ 'guest' ] = JSON.stringify( lsJSON );
                                getItemsFromLS();
                            } else
                            {
                                if ( val[ 'book' ] == book )
                                {
                                    val[ 'quantity' ] = parseInt( val[ 'quantity' ] ) + 1;
                                    val[ 'price' ] = val[ 'quantity' ] * priceB;
                                    val[ 'name' ] = bookName;
                                    check = 1;
                                    localStorage[ 'guest' ] = JSON.stringify( lsJSON );
                                    getItemsFromLS();
                                }
                            }
                        } );
                        if ( check == 0 )
                        {
                            lsJSON.push( { "book": book, "quantity": 1, "price": priceB, "name": bookName } );
                            check = 0;
                            localStorage[ 'guest' ] = JSON.stringify( lsJSON );
                            getItemsFromLS();
                        } else {
                            check = 0;
                        }*/
                    } else {
                       // getItemsFromLS();
                    }
                }
            }
        } else
        {
            if ( objJSON.length > 0)
            {
                var output = '';
                var i = 1;
                var quantityD = 0;
                var total = 0;
                $.each( objJSON, function ( key, val )
                {
                    output += '<tr class="cartTr"><td>' + i + '</td>';
                    output += '<td class="bookName" name="' + val[ 'id' ] + '">' + val[ 'name' ] + '</td>';
                    output += '<td><span class="glyphicon glyphicon-minus" aria-hidden="true"></span><span class="quantity">';
                    output += val[ 'quantity' ] + '</span><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></td>';
                    output += '<td><span class="price">' + parseInt( val[ 'price' ] ) * val[ 'quantity' ] + '</span>$</td>';
                    output += '<td><a class="delete" name="' + val[ 'id' ] + '">X</a></td></tr>';
                    i ++;

                    quantityD += parseInt( val[ 'quantity' ] );
                    total += parseInt( val[ 'price' ] ) * parseInt( val[ 'quantity' ] );
                } );
                output += '<tr class="cartTr"><td></td><td>TOTAL:</td><td ><span id="totalQuantity">' + quantityD + '</span></td><td><span id="totalPrice">' + total + '</span>$</td><td></td></tr>'
                $( '.tbody' ).append( output );
                $( '.messCart' ).html( '' );
                $( '.btn-success' ).show();
            } else
            {
                $( '.messCart' ).html( 'cart is empty' );
            }
        }

    } )
}

function buttonDis()
{
    if ( $( '.cart' ).length == 0 )
    {
        return 'disabled';
        //return '';
    } else
    {
        return '';
    }
}

function deleteFromCart( url, args, method )
{
    $.ajax( {
        url   : url + args,
        method: method
    } )
}

function getItemsFromLS(){
    var objJSON = JSON.parse( localStorage[ 'guest' ] );
    var i = 1;
    var price = 0;
    var quantity = 0;
    var output = '';
    $.each( objJSON, function ( key, val ){
        quantity += parseInt(val[ 'quantity' ]);
        price += parseInt(val[ 'price' ]);
        output += '<tr class="cartTr"><td>' + i + '</td>';
        output += '<td class="bookName" name="' + val[ 'book' ] + '">' + val[ 'name' ] + '</td>';
        output += '<td><span class="glyphicon glyphicon-minus" aria-hidden="true"></span><span class="quantity">';
        output += val[ 'quantity' ] + '</span><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></td>';
        output += '<td><span class="price">' + parseInt( val[ 'price' ] )+'</span>$</td>';
        output += '<td><a class="delete" name="' + val[ 'id' ] + '">X</a></td></tr>';
        i ++;
    });
    output += '<tr class="cartTr"><td></td><td>TOTAL:</td><td ><span id="totalQuantity">' + quantity + '</span></td><td><span id="totalPrice">' + price + '</span>$</td><td></td></tr>';

    if(price > 0 && quantity > 0){
        $( '.guestTbody' ).append( output );
        $( '.messCart' ).html( '' );
        $( '.price span' ).html( price );
        $( '.items span' ).html( quantity );
        $( '.btn-success' ).show();
    }
}

function sendAjax(){

    var tmp = localStorage[ 'guest' ];
    $.ajax({
        type: 'POST',
        url: 'index.php',
        data: {'guest': tmp},
        success: function(msg) {
            console.log(msg);
        }
    });
}

