$(document).ready(function () {    

    $('.btnTrack').click(function (e) { 
    
        if ($(this).data('track')) {
            e.preventDefault();
            var link = $(this);

            $.ajax({
                type: 'POST',
                url: (($('base').length)?$('base').attr('href'):'/') + 'track.php' ,
                data: {track:$(this).data('track')}                
            })
            .always(function (dataOrjqXHR, textStatus, jqXHRorErrorThrown) {
                if(link.attr('target') && link.attr('target') == '_blank'){
                    window.open(link.attr('href'));
                }else{
                    document.location.href = link.attr('href');
                }                    
            });
        }
    });
});