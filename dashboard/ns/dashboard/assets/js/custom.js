jQuery(document).ready(function($){ 
  $('input[name="daterange"]').daterangepicker();
  $('#dzn_datepicker').datepicker({
    uiLibrary: 'bootstrap5'
  });
  $("#dzn-cp-fileUpload").fileUpload(); 
  
});