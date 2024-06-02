function clearErrors(){

    errors = document.getElementsByClassName('formerror');
    for(let item of errors)
    {
        item.innerHTML = "";
    }


}
function seterror(id, error){
    //sets error inside tag of id 
    element = document.getElementById(id);
    element.getElementsByClassName('formerror')[0].innerHTML = error;

}

function validateForm(){
    var returnval = true;
    clearErrors();

    //perform validation and if validation fails, set the value of returnval to false
    var name = document.forms['myForm']["name"].value;
    if (name.length<2){
        seterror("name", "*Name cannot be a single character");
        returnval = false;
    }

    if (name.length == 0){
        seterror("name", "*Length of name cannot be zero!");
        returnval = false;
    }

    var age = document.forms['myForm']["age"].value;
    if (ageValue<3 || ageValue>150){
        seterror("age", "*Please enter correct age. Age must be between 3 and 150");
        returnval = false;
    }

    var gender = document.forms['myForm']["gender"].value;
    if (!document.querySelector('input[name="gender"]:checked')){
        seterror("gender", "*Please enter your gender");
        returnval = false;
    }

    var favFood = document.forms['myForm']["favFood"].value;
    if (!document.querySelector('input[name="gender"]:checked')){
        seterror("favFood", "*Please enter your favFood");
        returnval = false;
    }
    
    var color = document.forms['myForm']["color"].value;
    if (color.length == 0){
        seterror("color", "*Please enter your favColor");
        returnval = false;
    }

    return returnval;
}

// function seterror(id, error) {
//     // Sets error inside tag of id
//     element = document.getElementById(id);
//     element.getElementsByClassName('formerror')[0].innerHTML = error;
// }
// AI-generated code. Review and use carefully. More info on FAQ.
// Here’s what each part does:

// Function Declaration:
// function seterror(id, error): This line defines a function named seterror that takes two parameters: id and error.
// The id parameter represents the ID of an HTML element.
// The error parameter represents the error message that you want to display.
// Function Body:
// Inside the function, we have the following steps:
// element = document.getElementById(id);: This line retrieves an HTML element using its unique ID. The document.getElementById(id) method returns the element associated with the specified ID.
// element.getElementsByClassName('formerror')[0].innerHTML = error;: This line sets the inner HTML content of the first element with the class name 'formerror' to the provided error message.
// getElementsByClassName('formerror') returns a collection of elements with the class name 'formerror'.
// [0] accesses the first element in that collection.
// .innerHTML sets the content inside the selected element.
// Purpose:
// The purpose of this function is to dynamically update the error message displayed on a web page.
// It assumes that there is an HTML element with the specified id and a child element with the class name 'formerror'.
// By setting the inner HTML of the 'formerror' element, you can display custom error messages to the user.
// In summary, when you call seterror('someId', 'This is an error message'), it will find the element with the ID 'someId' and update its error message content to the provided text. This function is commonly used in form validation or error handling scenarios on websites. 😊