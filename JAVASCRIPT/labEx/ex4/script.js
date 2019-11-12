'use strict'

//  The form
let formInput = document.getElementsByTagName('form');
console.log(formInput[0]);

//  The second input inside the form 
let secondInput = document.querySelector('form label:nth-child(2) input');
let secondInputI = document.querySelector('form label [name=quantity]');
console.log(secondInput);
console.log(secondInputI);

//All the inputs inside the form ?????????????????????????
let allInputs = document.querySelectorAll('form label');
for (let input in allInputs) {
    console.log(input.firstChild.nextSibling);
}