$(document).ready(function(){

  $('#selectAllBoxes').click(function(event){
    if(this.checked){
      $('.checkBoxes').each(function(){
        this.checked= true;
      })
    }
    else{
      $('.checkBoxes').each(function(){
        this.checked= false;
      })
    }
  })
  var div_box = "<div id='load-screen'><div id='loading'></div></div>";
  
  $("body").prepend(div_box);
  
  $('#load-screen').delay(700).fadeOut(600,function(){
    $(this).remove();
  });
  
  function loadUsersOnline(){
  
    $.get("functions.php?onlineusers=result",function(user){
      $(".usersonline").text(user);
    
    });
  }
  setInterval(function(){
    loadUsersOnline();
  
  },500);
  ClassicEditor.create(document.querySelector("#editor")).catch((error) => {
    console.log(error);
  });
});

