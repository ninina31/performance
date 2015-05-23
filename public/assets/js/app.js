$( document ).ready(function() {
  $('#calculadora').on('submit', function(e){
    e.preventDefault();
    var cp = $('#codpostal').val();
    window.location.href = "/calculadora-provincia/" + cp;
  });
});
