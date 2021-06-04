$(function () {
    $('#forgotpassword').css('display', 'none');
    $('#signup').css('display', 'none');
    $('#otp_verify').css('display', 'none');
    $('#editprofilesetting').css('display', 'none');
});

function openpasspopup() {
    $('#signin').css('display', 'none');
    $('#forgotpassword').css('display', 'block');
 }

 function closepasspopup() {
     $('#forgotpassword').css('display', 'none');
     $('#signin').css('display', 'block');
 }
 function opensigninpopup() {
     $('#signin').css('display', 'none');
     $('#signup').css('display', 'block');
 }
 function closesigninpopup() {
     $('#signup').css('display', 'none');
     $('#signin').css('display', 'block');
 }
 function openeditprofilesetting() {
     $('#viewprofilesetting').css('display', 'none');
     $('#editprofilesetting').css('display', 'block');
 }
 function closeeditprofilesetting() {
     $('#editprofilesetting').css('display', 'none');
     $('#viewprofilesetting').css('display', 'block');
 }

 function openotp_verify() {
     $('#signup').css('display', 'none');
     $('#forgotpassword').css('display', 'none');
     $('#otp_verify').css('display', 'block');
 }
 function closeotp_verify() {
     $('#otp_verify').css('display', 'none');
     $('#signup').css('display', 'block');
 }