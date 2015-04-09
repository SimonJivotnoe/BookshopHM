$( document ).ready( function ()
{
    /*console.log(localStorage.getItem('guest' ) == null);
    console.log('ok');
   if (localStorage.getItem('guest' ) == null){
       insertInCart( 'index.php?page=ajaxcartctrl', '', 'GET', 'details', '' );
   } else{
       $("#tableBody").attr('class', 'guestTbody');
       if($( '.messCart' ).text().length > 0){
           $( '.btn-success' ).hide();
       } else {
           console.log('ok');
           $( '.btn-success' ).show();
       }
       getItemsFromLS();
   */
	if($('.messCart').text().length != 0){
		$('.btn-success').hide();
		}
    insertInCart( 'index.php?page=ajaxcartctrl', '', 'GET', 'details', '' );
    $( '.tbody, .guestTbody' ).on( 'click', '.glyphicon-minus, .glyphicon-plus', function ()
    {
        var bookId = $( this ).parent().parent().find( '.bookName' ).attr( 'name' );
        var quantity = parseInt( $( this ).parent().parent().find( '.quantity' ).text() );
        var price = parseInt( $( this ).parent().parent().find( '.price' ).text() );
        var oneBookPrice = price / quantity;
        var totalQuantity = parseInt( $( this ).parent().parent().parent().find( '#totalQuantity' ).text() );
        var totalPrice = parseInt( $( this ).parent().parent().parent().find( '#totalPrice' ).text() );
        if ( $( this ).hasClass( 'glyphicon-minus' ) )
        {
            if ( quantity <= 1 )
            {

            } else
            {
                quantity = quantity - 1;
                $( this ).parent().parent().find( '.quantity' ).html( quantity );
                $( this ).parent().parent().find( '.price' ).html( quantity * oneBookPrice );
                $( this ).parent().parent().parent().find( '#totalQuantity' ).html( totalQuantity - 1 );
                $( this ).parent().parent().parent().find( '#totalPrice' ).html( totalPrice - oneBookPrice );
                if(!$( this ).parent().parent().parent().hasClass( 'guestTbody' )){
                    insertInCart( 'index.php?page=ajaxcartctrl', '&bk_id=' + bookId + '&quantity=-1', 'GET', '', '' );
                } else {
                    addToLS(bookId, -1, oneBookPrice);
                }
            }
        } else
        {
            quantity = quantity + 1;
            $( this ).parent().parent().find( '.quantity' ).html( quantity );
            $( this ).parent().parent().find( '.price' ).html( quantity * oneBookPrice );
            $( this ).parent().parent().parent().find( '#totalQuantity' ).html( totalQuantity + 1 );
            $( this ).parent().parent().parent().find( '#totalPrice' ).html( totalPrice + oneBookPrice );
            if(!$( this ).parent().parent().parent().hasClass( 'guestTbody' )){
                insertInCart( 'index.php?page=ajaxcartctrl', '&bk_id=' + bookId + '&quantity=1', 'GET', '', '' );
            } else {
                addToLS(bookId, 1, oneBookPrice);
            }
        }
    } )

    $( '.tbody' ).on( 'click', '.delete', function ()
    {
        var bookId = $(this ).attr('name');
        deleteFromCart('index.php?page=ajaxcartctrl', '&bk_id=' + bookId +'&delete=delete', 'GET');
        $('.cartTr' ).remove();
        $('.btn-success').hide();
        insertInCart( 'index.php?page=ajaxcartctrl', '', 'GET', 'details', '' );
    })


} )

function addToLS(bookId, quantity, oneBookPrice){
    var objJSON = JSON.parse( localStorage[ 'guest' ] );
    $.each( objJSON, function ( key, val ){
        if(val[ 'book' ] == bookId){
            val[ 'quantity' ] = parseInt( val[ 'quantity' ] ) + quantity;
            val[ 'price' ] = val[ 'quantity' ] * oneBookPrice;
            console.log(val[ 'quantity' ]);
            console.log(val[ 'price' ]);
            localStorage[ 'guest' ] = JSON.stringify( objJSON );
        }
    });
}
