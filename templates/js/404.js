$( document ).ready( function ()
{
    var i = 3;
    $( '#count' ).html( i );
    function count() {
        i--;$( '#count' ).html( i );
    }


        setInterval(count,1000);
        //$( '#count' ).html( i );





    setTimeout( function ()
    {
        window.location = '/~user1/PHP/Bookshop/index.php';
    }, 3000 );

} );

