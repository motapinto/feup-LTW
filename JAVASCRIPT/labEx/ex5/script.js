let formInput = document.getElementsByTagName('form');

formInput[0].addEventListener('submit', function() {
  alert('Submitted!');
  event.preventDefault();
});
//????????
