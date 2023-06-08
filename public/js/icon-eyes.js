$(document).ready(function () {

const eye = document.querySelector(".feather-eye");
const eyeoff = document.querySelector(".feather-eye-off");
const passwordField = document.querySelector("[id='password']");
const passwordField2 = document.querySelector("[id='password2']");

eye.addEventListener("click", () => {
    eye.style.display = "none";
    eyeoff.style.display = "block";
    passwordField.type = "text";
    passwordField2.type = "text";
  });
  
  eyeoff.addEventListener("click", () => {
    eyeoff.style.display = "none";
    eye.style.display = "block";
    passwordField.type = "password";
    passwordField2.type = "password";
  });

});