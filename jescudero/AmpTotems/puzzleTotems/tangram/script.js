$(document).ready(function() {
        
    $('.block').draggable({
        containment:'window',
        stack: '.block',
        snap: true,
        snapMode: 'outer',
        snapTolerance: 13,
    });

    $('#blockTray').on('mousedown', function () {
          $('#instruction').fadeOut('slow');
    });

// Make blocks rotate 90 deg on each click
    var angle = 90;    

    $('.block').click(function() {
       
        $(this).css({
            '-webkit-transform': 'rotate(' + angle + 'deg)', // Chrome, Safari, versiones más nuevas de Opera
            '-moz-transform': 'rotate(' + angle + 'deg)', // Firefox
            '-o-transform': 'rotate(' + angle + 'deg)', // Versiones antiguas de Opera
            '-ms-transform': 'rotate(' + angle + 'deg)', // Internet Explorer
            'transform': 'rotate(' + angle + 'deg)' // Estándar, para navegadores modernos
        });
        
        angle+=90;
    });

});