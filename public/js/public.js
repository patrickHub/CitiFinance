$(function() {
  $("#datepicker").datepicker();
});

function showOnRadioCheck(tagId) {
  switch (tagId) {
    case "radio-new-customer": {
      if (document.getElementById(tagId).checked) {
        document.getElementById("info-new-customer").style.display = "flex";
        document.getElementById("info-redirect-login-page").style.display =
          "none";
      }
      break;
    }
    case "radio-not-new-customer": {
      if (document.getElementById(tagId).checked) {
        document.getElementById("info-redirect-login-page").style.display =
          "flex";
        document.getElementById("info-new-customer").style.display = "none";
      }
      break;
    }
  }
}
