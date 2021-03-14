let checkbox = document.getElementById("create_an_account");
let formGroup = document.getElementById("passwordCreate");


checkbox.addEventListener('click', function () {
    formGroup.classList.toggle("visible");
});
