$(function() {
  openAddMoneyAccountDialog();
  changeFromToSelectInImmediateTransfer();

  $("#btn-toggle-menu").click(function() {
    if ($("#btn-toggle-menu").text() == "☰") {
      $("#btn-toggle-menu").text("🞬");
    } else {
      $("#btn-toggle-menu").text("☰");
    }

    $(".toggle").toggle("slow");
  });
});

function openAddMoneyAccountDialog() {
  var add_money_account_dialog = $("#add-money-account-dialog-form").dialog({
    autoOpen: false,
    modal: true,
    draggable: true,
    closeOnEscape: false,
    close: function() {},

    create: function(event, ui) {},
    beforeClose: function(event, ui) {
      $("#modal-backdrop").removeClass("modal-backdrop");
      $("#error-input-amount-add-money-account").text("");
      $("#input-amount-add-money-account").val("");
    }
  });

  $("#add-money-account")
    .button()
    .on("click", function() {
      $("#modal-backdrop").addClass("modal-backdrop");
      add_money_account_dialog.dialog("open");
    });
  $("#btn-add-money-account").click(function() {
    addMoneyAccount();
    return false;
  });

  $("#cancel").click(function() {
    add_money_account_dialog.dialog("close");
    return false;
  });
}
function addMoneyAccount() {
  if ($("#input-amount-add-money-account").val().length == 0) {
    $("#error-input-amount-add-money-account").text(
      "please provide an amount!"
    );
  } else {
    $("#form-add-money-account").submit();
    $("#add-money-account-dialog-form").dialog("close");
  }
}

function changeFromToSelectInImmediateTransfer() {
  from = document.getElementById("select-from-immediate-transfer");
  to = document.getElementById("select-to-immediate-transfer");

  if (from.value == to.value) {
    for (var i = 0; i < to.length; i++) {
      if (from.value != to.options[i].value) {
        to.value = to.options[i].value;
        break;
      }
    }
  }
}

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

function closeMainMsg() {
  $(".bloc-msg").css({
    display: "none"
  });
}
