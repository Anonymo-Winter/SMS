// Function to check if the input contains only letters and spaces

function checkName(name) {
    var letters = /^[A-Za-z ]+$/;  
    return letters.test(name.trim());
}

// Function to check if the input matches the ID pattern
function checkId(sid) {
    var idPattern = /^[Ss]\d{6}$/;
    return idPattern.test(sid.trim());
}

// Function to show or hide error messages
function toggleErrorMessage(input, message) {
    var errorElement = input.next("small");
    if (message) {
        errorElement.text(message).removeClass("d-none");
    } else {
        errorElement.text("").addClass("d-none");
    }
}

// Event listener for name input
$("#sname").on("keyup", function() {
    var name = $(this).val();
    if (!name) {
        toggleErrorMessage($(this), "This field is required!");
    } else if (!checkName(name)) {
        toggleErrorMessage($(this), "Invalid Name!");
    } else {
        toggleErrorMessage($(this));
    }
});

// Event listener for ID input
$("#sid").on("keyup", function() {
    var sid = $(this).val();
    if (!sid) {
        toggleErrorMessage($(this), "This field is required!");
    } else if (!checkId(sid)) {
        toggleErrorMessage($(this), "Invalid ID!");
    } else {
        toggleErrorMessage($(this));
    }
});

// Event listener for class input
$("#sclass").on("keyup", function() {
    var sclass = $(this).val();
    if (!sclass) {
        toggleErrorMessage($(this), "This field is required!");
    } else {
        toggleErrorMessage($(this));
    }
});

// Event listener for form inputs to enable/disable submit button
$("form input").on("keyup", function() {
    var name = $("#sname").val().trim();
    var sid = $("#sid").val().trim();
    var sclass = $("#sclass").val().trim();
    
    var isNameValid = name && checkName(name);
    var isIdValid = sid && checkId(sid);
    var isClassValid = sclass.length > 0;

    if (isNameValid && isIdValid && isClassValid) {
        $("#submit-btn").prop("disabled", false);
    } else {
        $("#submit-btn").prop("disabled", true);
    }
});
