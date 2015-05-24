$( document ).ready(function() {

  $('#calculadora').on('submit', function(e){
    e.preventDefault();
    var cp = $('#codpostal').val();
    window.location.href = "/calculadora-provincia/" + cp;
  });

  $.ajax({
    url: 'allMunicipios',
    method: 'GET',
    success: function (data) {

      $('#autocomplete').typeahead({ source: data });

    },
    error: function (jqXHR, textStatus, errorThrown) {
      console.log('error');
    }
  });

});
