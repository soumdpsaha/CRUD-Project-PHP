$(document).ready(function() {

	$("#namecheck").hide();
	$("#agecheck").hide();
	$("#colorcheck").hide();

    let nameError = true;
    let ageError = true;
    let colorError = true;

    $("#name").keyup(function () {
		validateName();
	});

    function validateName() {
		let nameValue = $("#name").val();
		if (nameValue.length == "") {
			$("#namecheck").show();
			$("#namecheck").html("**Please fill your name!!!");
			$("#namecheck").focus();
            $("#namecheck").css("color", "red");

            nameError = false;
            return false;
        }else{
            $("#namecheck").hide();
        }
	}

    $("#age").keyup(function () {
		validateAge();
	});

    function validateAge() {
		let ageValue = $("#age").val();
		if (ageValue.length == "") {
			$("#agecheck").show();
			$("#agecheck").html("**Please fill your age!!!");
			$("#agecheck").focus();
            $("#agecheck").css("color", "red");

            ageError = false;
            return false;
        }
        else if(ageValue<3 || ageValue>150){
            $("#agecheck").show();
			$("#agecheck").html("**Please enter correct age. Age must be between 3 and 150");
			$("#agecheck").focus();
            $("#agecheck").css("color", "red");

            ageError = false;
            return false;
        }
        else{
            $("#agecheck").hide();
        }
	}

    $("#color").keyup(function () {
		validateColor();
	});

    function validateColor() {
		let nameValue = $("#color").val();
		if (nameValue.length == "") {
			$("#colorcheck").show();
			$("#colorcheck").html("**Please fill your Favourite color!!!");
			$("#colorcheck").focus();
            $("#colorcheck").css("color", "red");

            colorError = false;
            return false;
        }else{
            $("#colorcheck").hide();
        }
	}

    // Submit button
    $("#myForm").submit(function (event) {
        nameError = true;
        ageError = true;
        colorError = true;

        validateName();
        validateAge();
        validateColor();
        if (
            nameError == true &&
            ageError == true &&
            colorError == true
        ) {
            return true;
        } else {
            event.preventDefault(); // Prevent form submission
            alert("Please check the fields!");
            return false;
        }
    });

    // $("#submitbtn").click(function () {
    //     validateName();
    //     validateAge();
    //     validateColor();
    //     if (
    //         nameError == true &&
    //         ageError == true &&
    //         foodError == true
    //     ) {
    //         // If all the validation checks pass, submit the form
    //         $("#form").submit();
    //     } else {
    //         // If any of the validation checks fail, prevent the form from being submitted
    //         return false;
    //     }
    // });
    

    // // Validate favorite color
    // let colorValue = $("#color").val();
    // if (colorValue.length === 0) {
    //     $("#colorcheck").html("Please fill in your favorite color!");
    //     event.preventDefault(); // Prevent form submission
    // } else {
    //     $("#colorcheck").text("");
    // }
});