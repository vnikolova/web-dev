function getQR(){
    var mobile = $('#mobile').val();
    var message = $('#message').val();
    var theLink = 'http://www.ecuanota.com/api-send-sms?key=NzI2-YmMy-YjI2-NTk3-Nzcw-MWE5-Nzc5-M2E0-YWQ3-MTQ4-N2Y6&mobile='+mobile+'&message='+message;
    var link = encodeURIComponent(theLink);
      //insert AJAX
    // $.getJSON(theLink, function(jData){
    //   console.log(jData);
    var qrCode="https://chart.googleapis.com/chart?cht=qr&chs=250x250&chl="+link;
    $('#displayQR').html('<img src="'+qrCode+'"></img>');
    $('#displayQR').effect('pulsate',{times:3}, 200);
      // //change background color depending on status
      // if(jData.status == "ok")
      // {
      //   $('body').css({"backgroundColor": "green"});
      // }
      // else {
      //   $('body').css({"backgroundColor": "red"});
      // }
    // });
  }
