$( document ).ready( function ()
{
    insertList( 'index.php?page=ajaxctrl&table=', 'books', 'GET', '.product-index' );
    insertList( 'index.php?page=ajaxctrl&table=', 'authors', 'GET', '.fileAuthors' );
    insertList( 'index.php?page=ajaxctrl&table=', 'genres', 'GET', '.fileGenres' );

    $( '.modest' ).on( 'click', function ( evt )
    {
        var url = $( evt.target ).attr( 'name' );
        insertList(url, '', 'GET', '.product-index');

    } );

    $( '.booksList' ).on( 'click', function (  )
    {
        insertList('index.php?page=ajaxctrl&table=', 'books', 'GET', '.product-index');
    } );

    $(".hoverAuthors").hover(
        function () {
            $('ul.fileAuthors').stop(true, true).slideDown('medium');
        },
        function () {
            $('ul.fileAuthors').stop(true,true).slideUp('medium');
        }
    );
    $(".hoverGenres").hover(
        function () {
            $('ul.fileGenres').stop(true, true).slideDown('medium');
        },
        function () {
            $('ul.fileGenres').stop(true,true).slideUp('medium');
        }
    );
    $( '.product-index' ).on( {click: function (  )
    {
        var name = $(this).attr( 'name' );
        var price = $(this ).parent().find('.price' ).text();
        var bookName = $(this ).parent().find('h4' ).text();
        var sum = parseInt(price) + parseInt($('.price span').text());
        insertInCart('index.php?page=ajaxcartctrl', '&bk_id='+name+'&quantity=1', 'GET', '', name, price, bookName)
    }},'.addToCart' )

    $( '.product-index' ).on( {click: function (  )
    {
        bookDetails( $(this).attr( 'name' ), 'GET' )

    }},'.bookWrapper a' )

    insertInCart('index.php?page=ajaxcartctrl', '', 'GET', '', '', '');

    if ($( '.authorization' ).length == 0){
        localStorage.removeItem('guest');
    }


} );
