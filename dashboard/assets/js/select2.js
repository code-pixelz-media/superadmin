$(document).ready(function () {
  // Initialize Select2
  $("#filterByName").select2({
    placeholder: "Select a name",
    allowClear: true,
  });

  // Handle change event for filtering
  $("#filterByName").on("change", function () {
    var selectedName = $(this).val();
    console.log("Selected Name ID: " + selectedName);
    // Implement your filtering logic here
  });
});
