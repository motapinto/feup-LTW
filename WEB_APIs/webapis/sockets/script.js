let conn = new WebSocket('ws://localhost:8080')

conn.addEventListener('open', function() {
  console.log("Connection established!");
})

conn.addEventListener('message', function(e) {
  textarea.value += e.data + "\n"
})

let textarea = document.querySelector('textarea') 
let form = document.querySelector('form')
let input = document.querySelector('input[type=text]')

form.addEventListener('submit', function(e) {
  e.preventDefault()
  conn.send(input.value)
  textarea.value += input.value + "\n"
  input.value = ''
})