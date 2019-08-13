$(function(){
  ////search controll /////
  let searchBut = $('#search-but');
  searchBut.click((e) => {
    let searchValue = $('#search-box').val();
    if(searchValue.length == 0){
      $("#search-box").focus();
    }else{
      //handle search value
    }
  });
  ////search controll ends////

  ////search controll /////
  let subsearchBut = $('#sub-search-but');
  subsearchBut.click((e) => {
    let subsearchValue = $('#sub-search-box').val();
    if(subsearchValue.length == 0){
      $("#sub-search-box").focus();
    }else{
      //handle search value
    }
  });
  ////search controll ends////


  //////side pane controller///
  let sidePane = $(".side-pane");
  let displayMain = $('.display-main');
  $('.menu1').click((e) => {
    sidePane.toggle('slide',function(){
      if(!displayMain.attr('style')){
        displayMain.attr('style','padding-left:20px;');
      }else{
        displayMain.removeAttr('style');
      }
    });
  });

  $('.menu2').click((e) => {
    sidePane.toggle('slide',function(){
      if(!displayMain.attr('style')){
        displayMain.attr('style','padding-left:180px;');
      }else{
        displayMain.removeAttr('style');
      }
    });
  });



  $('#stock').click((e) => {
    $('.stock-sub').toggle('slide');
    $('.stock-down').toggle('slide');
    $('.stock-up').toggle('slide');
  });


  $('#acct').click((e) => {
    $('.acct-sub').toggle('slide');
    $('.acct-down').toggle('slide');
    $('.acct-up').toggle('slide');
  });

  $('#staff').click((e) => {
    $('.staff-sub').toggle('slide');
    $('.staff-down').toggle('slide');
    $('.staff-up').toggle('slide');
  });

  ////side pane controller ends////


  //// reg form validator////
  $('.reg-form').submit((e) => {
    $('.reg-form-error').hide();
    let fname = $('#fname').val();
    let lname = $('#lname').val();
    let uname = $('#uname').val();
    let email = $('#email').val();
    let position = $('#position').val();
    let phone = $('#phone').val();
    let gender = $("input[name='sex']");
    let permission = $("input[name='permission']");
    let pwd = $('#pwd').val();
    let pwd2 = $('#conf-pwd').val();
    let addr = $('#addr').val();
    
    //regex expressions
    let alphaRegex = new RegExp("^[a-zA-Z]+$");
    let emailRegex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    let phoneRegex = /[0-9 -()+]+$/;
    if(!alphaRegex.test(fname) || fname == '' ) {
       $('.fname-error').show();
       $('.fname-error').text("Please enter a valid first name");
       $('#fname').val("");
       $('#fname').focus();
       e.preventDefault();
       $('html,body').animate({scrollTop:0}, 'slow');
    }else if(!alphaRegex.test(lname) || lname == '' ) {
      $('.lname-error').show();
      $('.lname-error').text("Please enter a valid last name");
      $('#lname').val("");
      $('#lname').focus();
      e.preventDefault();
      $('html,body').animate({scrollTop:0}, 'slow');
   }else if (!emailRegex.test(email) || email == '') {
    $('.email-error').show();
    $('.email-error').text("Please enter a valid email");
    $('#email').val("");
    $('#email').focus();
    e.preventDefault();
    $('html,body').animate({scrollTop:0}, 'slow');
   }else if (position == ''){
    $('.position-error').show();
    $('.position-error').text("Please enter a valid position");
    $('#position').val("");
    $('#position').focus();
    e.preventDefault();
    $('html,body').animate({scrollTop:0}, 'slow');
   }else if(!phoneRegex.test(phone) || phone.length < 11 || phone.length > 14){
    $('.phone-error').show();
    $('.phone-error').text("Please enter a valid phone number");
    $('#phone').val("");
    $('#phone').focus();
    e.preventDefault();
    $('html,body').animate({scrollTop:0}, 'slow');
   }else if (addr == ''){
    $('.addr-error').show();
    $('.addr-error').text("Please enter an address");
    $('#addr').val("");
    $('#addr').focus();
    e.preventDefault();
    $('html,body').animate({scrollTop:0}, 'slow');
   }else if(!gender.is(':checked')){
     
    $('.gender-error').show();
    $('.gender-error').text("Please select a valid gender");
    e.preventDefault();
    $('html,body').animate({scrollTop:200}, 'slow');
   }else if(!permission.is(':checked')){
     
    $('.permission-error').show();
    $('.permission-error').text("Please select a valid Permission level");
    e.preventDefault();
    $('html,body').animate({scrollTop:200}, 'slow');
   }else if($("input[name='permission']:checked").val() != 'staff'){
     if(uname == ''){
      $('.uname-error').show();
      $('.uname-error').text("Please enter a valid username");
      
      $('#uname').focus();
      e.preventDefault();
      $('html,body').animate({scrollTop:400}, 'slow');
     }else if(pwd == ''){
      $('.pwd-error').show();
      $('.pwd-error').text("Please enter a valid password");
      
      $('#pwd').focus();
      e.preventDefault();
      $('html,body').animate({scrollTop:400}, 'slow');
     }else if(pwd != pwd2){
      $('.pwd2-error').show();
      $('.pwd2-error').text("Passwords do not match");
      $('#conf-pwd').val("");
      $('#conf-pwd').focus();
      e.preventDefault();
      $('html,body').animate({scrollTop:400}, 'slow');
     }
   }
    


  })
  
  ////reg form validator ends////


});
