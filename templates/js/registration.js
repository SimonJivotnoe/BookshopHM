$( document ).ready( function ()
{
    $( "input" ).keyup( function ()
    {
        checkEmail( $( '#exampleInputEmail1' ).val() );
        if ( check( $( '#exampleInputName2' ).val() )
            && check( $( '#exampleInputPassword1' ).val() )
            && checkEmail( $( '#exampleInputEmail1' ).val() )
        )
        {
            if ( $( '.loginExist' ).text().length == 0 )
            {
                $( "input[type=submit]" ).removeAttr( "disabled" );
            }

        } else
        {
            $( "input[type=submit]" ).attr( "disabled", "disabled" );
        }
    } );

    function check( val )
    {
        val = $.trim( val )
        if ( val.length > 3 && val.length <= 10 )
        {
            return true
        } else
        {
            return false;
        }
    }

    function checkEmail( email )
    {
        var pattern = /^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,4}\.)?[a-z]{2,4}$/i;
        if ( pattern.test( email ) )
        {
            $( '#exampleInputEmail1' ).css( { 'border': '3px solid #569b44' } );
            return true;
        } else
        {
            $( '#exampleInputEmail1' ).css( { 'border': '1px solid #ff0000' } );
            return false;
        }
    }

    $( '#exampleInputName2' ).blur( function ()
    {
        $.ajax( {
            url   : 'index.php?page=ajaxregistrationctrl&login=' + $( '#exampleInputName2' ).val(),
            method: 'GET'
        } ).then( function ( data )
        {
            var objJSON = JSON.parse( data );
            if ( objJSON.length != 0 )
            {
                $( '.loginExist' ).html( ' This login already exist' );
            } else
            {
                $( '.loginExist' ).html( '' );
            }
        } )
    } )

    $('.btn-success').on('click', function(){
        sendAjax();
    })
   /*$('.test').on('click', function(){
        sendAjax();
    })*/
} );

