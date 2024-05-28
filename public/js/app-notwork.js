require('./bootstrap');

function copyFunction(url) {
  var copyText = url;
  // create an input element
  let input = document.createElement('input');
  // setting it's type to be text
  input.setAttribute('type', 'text');
  // setting the input value to equal to the text we are copying
  input.value = copyText;
  // appending it to the document
  document.body.appendChild(input);
  // calling the select, to select the text displayed
  // if it's not in the document we won't be able to
  input.select();
  // calling the copy command
  document.execCommand("copy");
  // removing the input from the document
  document.body.removeChild(input)
}