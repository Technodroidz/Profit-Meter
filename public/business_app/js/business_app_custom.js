var $data;
var $modal;

$(document).on('click','.dismiss_alert',function(){
    $(this).parent().css('display','none');
});

$(document).on('click','.dismiss_alert',function(){
    $(this).parent().css('display','none');
});

$('.form_modal').on('hide.bs.modal', function () {
    console.log('event trigger hua');
    $(this).find('form')[0].reset();
    $(this).find('.error_div').css('display','none');
});

$(document).on('click','[data-request="web-ajax-submit"]',function(){
    /*REMOVING PREVIOUS ALERT AND ERROR CLASS*/
    // $('.popup').show();  $('.alert').remove(); $(".has-error").removeClass('has-error'); $('.help-block').remove();
    $('.error_div').css('display','none');

    var $this           = $(this);
    var $target         = $this.data('target');
    var $replace_element= $this.attr('data-replace_element');
    var $url            = $($target).attr('action');
    var $method         = $($target).attr('method');
    var $show_error     = $this.data('show_error');
    $modal              = $this.data('modal');
    var skip_id         = $this.data('enable_element');
    var skip            = $this.data('skip');
    if(skip != undefined){
        if(skip == false ){
            $(skip_id).attr('disabled',true);
        }else{
            $(skip_id).removeAttr('disabled',false);
        }
    }
    
    
    $data               = new FormData($($target)[0]);

    if($show_error != undefined){
        $($show_error).html('');
    }

    $('#show_success_message').html('');
    
    if(!$method){ $method = 'get'; }
    $.ajax({
        url: $url, 
        data: $data,
        cache: false, 
        type: $method, 
        dataType: 'json',
        contentType: false, 
        processData: false,
        success: function($response){
            // console.log($response);
            if($response.success == false){
                if($show_error != undefined){
                    $($show_error).html($response.message);
                    $('.error_div').css('display','block');
                }
            }else{
                if($response.success == true){
                    if($response.data){
                        if($response.data.replace_html == true && $replace_element != undefined){
                            console.log($response.data.html_view);
                            $($replace_element).html($response.data.html_view);
                        }

                        if($response.data.close_modal == true){
                            $('.modal').modal('hide');
                        }

                        if($response.data.redirect_url){
                            window.location.href = $response.data.redirect_url;
                        }

                        if($response.reload){
                            window.location.href = window.location;
                        }

                        if($response.message){
                            $('#show_success_message').html($response.message);
                            $('.success_message_div').css('display','block');
                        }
                    }
                }
            }

            // if($response.status == 'success'){

            //     if($response.replace_html == true && $replace_element != undefined){
            //         $($replace_element).html($response.view);
            //     }

            //     if($response.ajax_request){
            //         $.ajax({
            //             url: $response.ajax_request + '?access_token=' + access_token,
            //             data: $data,
            //             cache: false, 
            //             type: $method, 
            //             dataType: 'json',
            //             contentType: false, 
            //             processData: false,                         
            //             success : function($newresponse){
            //                 if($newresponse.status == 'SUCCESS'){
            //                     if($newresponse.modal){
            //                         $($modal).trigger('click');
            //                     }
            //                 }else{
            //                     if($newresponse.message.length > 0){
            //                         if($show_error){
            //                             $($show_error).html($newresponse.message).css('color','red');
            //                         }
            //                     }
            //                     $('.popup').hide();
            //                 }
            //             }
            //         })
            //     }

            //     if($response.modal){
            //         $($modal).trigger('click');
            //     }

            //     if($response.modal_url){
            //         $data = JSON.parse($response.data);
            //         $('.popup').hide();
            //         $.ajax({
            //             url             : $response.modal_url,
            //             type            : 'POST',
            //             data            : {'id_appointment' : $data.id_appointment},
            //             success: function($inner_response){
                            
            //                 $('#nurse-rating-screen').html($inner_response);
            //                 $('#doctor-rating-screen').hide();
            //                 $('#nurse-rating-screen').modal({show:true});
            //             }
            //         });
            //     }

            //     if($response.socket == 'disconnect'){
            //         $('.popup').hide();
            //         swal({
            //             title: $response.message,
            //             type: 'success',
            //             showCancelButton: false,
            //             closeOnEsc: false,
            //             allowOutsideClick:false,
            //             confirmButtonColor: '#3085d6',
            //             button: 'Ok'
            //         }).then(function (result) {                        
            //             if (result) {
                            
            //                 $('[data-dismiss="modal"]').trigger('click');
            //             }
            //         })
            //     }

            //     if($response.redirect_website){
                    
            //         window.location.href = $response.redirect_website;
            //     }

            //     if($response.reload){
            //         window.location.href = window.location;
            //     }

            //     if($response.redirect){
            //         if($response.swal == false){
            //             if($response.message.length > 0){
            //                 if($show_error){
            //                     $($show_error).html($response.message).css('color','green');
            //                 }
            //             }
            //         }else{
            //             $('.popup').hide();
            //             var _buttons = 'Ok'
            //             var _closeOnClickOutside = true
            //             if ($response.redirect) {
            //                 _buttons = false,
            //                 _closeOnClickOutside = false
            //             }
            //             swal({
            //                 title: $response.message,
            //                 type: 'success',
            //                 showCancelButton: false,
            //                 closeOnEsc: false,
            //                 allowOutsideClick:false,
            //                 confirmButtonColor: '#3085d6',
            //                 button: _buttons,
            //                 closeOnClickOutside: _closeOnClickOutside,
            //                 showConfirmButton: typeof $response.showconfirmButton !== 'undefined' ? false : true,
            //             }).then(function (result) {
            //                     if (result) {
            //                         if (result === true) {
            //                             window.location.href = $response.redirect;
            //                         }
            //                     }
            //                 })
            //         }
            //     }

            //     if($response.new_redirect){
            //         if($response.swal == true){
            //             $('.popup').hide();
            //             swal({
            //                 text: $response.message,
            //                 buttons : false
            //             }).then(function(value){
            //                 // window.location.href = $response.new_redirect;
            //             });
            //             setTimeout(function(){window.location.href = $response.new_redirect;},4000);
            //         }
            //     }


            //     if($response.signature){
            //         $('[data-dismiss="modal"]').trigger('click');
            //         $("#sign-img").attr("src",$response.signature);
            //         $('.popup').hide();
            //     }

            //     if($response.saved=="true"){
            //         $('.popup').hide();
            //         swal({
            //             title: $response.message,
            //             text: "",
            //             type: 'success',
            //             showCancelButton: false,
            //             confirmButtonColor: '#3085d6',
            //             closeOnEsc: false,
            //             closeOnClickOutside:false,
            //             cancelButtonColor: '#d33',
            //             button: 'Ok',
            //             timer: 4000
            //         });


            //     }

            //     if($response.go_back_prescription == 'true'){
            //         $('.popup').hide();
            //         $('#lab_test_screen').removeClass('active');
            //         $('.calling_prescription_Sidebar').addClass('active');
            //     }

            //     if($response.close_modal == true){
            //         $('.popup').hide();
            //         $('.modal').modal('hide');
            //     }

            //     if($response.redirect){
            //         setTimeout(function(){window.location = $response.redirect;},1500)
            //         $('.popup').hide();
            //     }

            //     if($response.ajax == true){
                    
            //         var id_appointment = $response.id_appointment;

            //         $.ajax({
            //             url             : $response.ajax_url,
            //             type            : 'POST',
            //             data            : {id_appointment:id_appointment},
            //             success: function(response){
            //                 $('#labtest_category').html(response);
            //             }
            //         });

                    
            //     }

            //     if($response.call_function == true){
                    
            //         prescription_saved();
            //         // initListners.prescription_saved_listener();
            //     }

            // }else if($response.error == true){

            //     if($response.swal == false){
            //         if (Object.size($response.data) > 0) {
            //             show_validation_error($response.data);
            //         }
            //     }else{
            //         $('.popup').hide();

            //         swal({
            //             title: $response.message,
            //             text: "",
            //             icon: 'warning',
            //             button: 'Ok'
            //         });
            //     }
            //     $('.popup').hide();
            // }
            // else{

            //     if($response.swal == false){
            //         if($response.message.length > 0){
            //             if($show_error){
            //                 $($show_error).html($response.message).css('color','red');
            //             }
            //         }
            //     }else{
            //         $('.popup').hide();

            //         swal($response.message,{
            //             buttons: {
            //                 ok: "OK",
            //             }
            //         });
            //         // swal({
            //         //     title: $response.message,
            //         //     text: "",
            //         //     type: 'warning',
            //         //     showCancelButton: true,
            //         //     confirmButtonColor: '#3085d6',
            //         //     cancelButtonColor: '#d33',
            //         //     confirmButtonText: 'Ok'
            //         // }).then(function (result) {                        
                        
            //         // })
            //     }
            //     $('.popup').hide();
            // }
        }
    }); 
});

function show_validation_error(msg) {
    if ($.isPlainObject(msg)) {
        $data = msg;
    }else {
        $data = $.parseJSON(msg);
    }
    
    $.each($data, function (index, value) {
        var name    = index.replace(/\./g, '][');
        
        if (index.indexOf('.') !== -1) {
            name = name + ']';
            name = name.replace(']', '');
        }
        if (name.indexOf('[]') !== -1) {
            $('form [name="' + name + '"]').last().closest('.form-group').addClass('has-error');
            $('form [name="' + name + '"]').last().closest('.form-group').find('.message-group').append('<div class="help-block text-left font-12">' + value + '</div>');
        }else{
            if($('form [name="' + name + '"]').attr('type') == 'checkbox' || $('form [name="' + name + '"]').attr('type') == 'radio'){
                if($('form [name="' + name + '"]').attr('type') == 'checkbox'){
                    $('form [name="' + name + '"]').closest('.form-group').addClass('has-error');
                    $('form [name="' + name + '"]').parent().after('<div class="help-block text-left font-12">' + value + '</div>');
                }else{
                    $('form [name="' + name + '"]').closest('.form-group').addClass('has-error');
                    $('form [name="' + name + '"]').parent().parent().append('<div class="help-block text-left font-12">' + value + '</div>');
                }
            }else if($('form [name="' + name + '"]').get(0)){
                if($('form [name="' + name + '"]').get(0).tagName == 'SELECT'){
                    $('form [name="' + name + '"]').closest('.form-group').addClass('has-error');
                    $('form [name="' + name + '"]').parent().append('<div class="help-block text-left font-12">' + value + '</div>');
                    //$('form [name="' + name + '"]').after('<div class="help-block text-left font-12">' + value + '</div>');
                }else{
                    $('form [name="' + name + '"]').closest('.form-group').addClass('has-error');
                    $('form [name="' + name + '"]').after('<div class="help-block text-left font-12">' + value + '</div>');
                }
            }else{
                $('form [name="' + name + '"]').closest('.form-group').addClass('has-error');
                $('form [name="' + name + '"]').after('<div class="help-block text-left font-12">' + value + '</div>');
            }
        }

        // $('.help-block').html($('.help-block').text().replace(".,",". "));
    });

    /*SCROLLING TO THE INPUT BOX*/
    scroll();
}

function scroll() {
    if ($(".has-error").not('.modal .has-error').length > 0) {
        console.log($(".has-error").offset().top);
        if($(".mCustomScrollbar").length > 0){

            $(".mCustomScrollbar").mCustomScrollbar("scrollTo", "top");
        }
        $('html, body').animate({
            scrollTop: ($(".has-error").offset().top - 300)
        }, 200);
    }
}