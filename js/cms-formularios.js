$.fn.serializeObject = function()
{
    var o = {};
    var a = this.serializeArray();
    $.each(a, function() {
        if (o[this.name] !== undefined) {
            if (!o[this.name].push) {
                o[this.name] = [o[this.name]];
            }
            o[this.name].push(this.value || '');
        } else {
            o[this.name] = this.value || '';
        }
    });
    return o;
};





$(function() {

    $('.cmsForm').each(function(){
        if($(this).data('clases').length > 0){
            $(this).addClass($(this).data('clases'));
        }
    });

    $('.cmsForm').submit(function(e){
        e.preventDefault();
        var _self = $(this);
        
        $.ajax({
          url: $(this).attr('action'),
          type: 'POST',
          data: $(this).serializeObject(),
          dataType: 'json'
        })
        .done(function(resultado) {           

            $('span.errorForm').remove();      
            $('#OK' + resultado.id).html(resultado.mensaje).show().delay(5000).fadeOut();
            $('#Error' + resultado.id).hide();
            _self.find('input[type="text"], textarea').val('');
            $('select').find('option:eq(0)').prop('selected', true);
            _self.find('input[type="checkbox"]').prop('checked', false);                        
        })
        .fail(function( jqXHR, textStatus, errorThrown ) {
            
            

            var msg = '';
                $.each(jqXHR.responseJSON, function(index, value){
                    
                    _self.find('input[name="'+index+'"], textarea[name="'+index+'"], select[name="'+index+'"]').parent().addClass('has-error');

                    _self.find('input[name="'+index+'"], textarea[name="'+index+'"]').addClass('cms_error').after($('<span>', {
                      'class':'errorForm',
                      'id':'error'+index
                    }).text(value));
                    _self.find('select[name="'+index+'"]').after($('<span>', {
                      'class':'errorForm',
                      'id':'error'+index
                    }).text(value));



                    _self.find('input[name="'+index+'"], textarea[name="'+index+'"]').keypress(function(event) {
                        $(this).removeClass('cms_error');
                        $(this).parent().removeClass('has-error');
                        $('#error'+index).remove();
                    }).change(function(event) {
                        $(this).parent().removeClass('has-error');
                        $('#error'+index).remove();
                    }).parent().addClass('has-error');
                    _self.find('select[name="'+index+'"]').parent().addClass('has-error');
                    _self.find('select[name="'+index+'"]').change(function(event) {
                        $(this).parents('.has-error').removeClass('has-error');
                        $('#error'+index).remove();
                    });
      
                });
               if(msg.length > 0) $('#appointmentError, #appointmentError2, #contactError').html(msg).show();
                $('#appointmentSuccess, #appointmentSuccess2, #contactSuccess').hide();





        });
      });







});