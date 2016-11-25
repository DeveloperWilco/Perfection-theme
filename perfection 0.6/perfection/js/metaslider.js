  
jQuery(function($){
    // Lets make the slider stretch.
    $('body #main-slider[data-stretch="true"]').each(function(){
        var $$ = $(this);
        $$.find('>div').css('max-width', '100%');
        $$.find('.slides li').each(function(){
            var $s = $(this);

            // Move the image into the background
            var $img = $s.find('img.ms-default-image').eq(0);
            if(!$img.length) {
                $img = $s.find('img').eq(0);
            }

            $s.css('background-image', 'url(' + $img.attr('src') + ')');
            $img.css('visibility', 'hidden');
            // Add a wrapper
            $s.wrapInner('<div class="limit-perfection"></div>');
            // This is because IE doesn't detect links correctly when we stretch slider images.
            var link = $s.find('a');
            if(link.length) {
                $s.mouseover(function () {
                    $s.css('cursor', 'hand');
                });
                $s.mouseout(function () {
                    $s.css('cursor', 'pointer');
                });
                $s.click(function ( event ) {
                    event.preventDefault();
                    var clickTarget = $(event.target);
                    var navTarget = clickTarget.is('a') ? clickTarget : link;
                    window.open( navTarget.attr( 'href' ), navTarget.attr( 'target' ) );
                });
            }
        });
    });

});