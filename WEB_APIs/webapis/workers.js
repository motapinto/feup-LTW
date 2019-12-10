/* Web Workers */

const worker = new Worker('web-worker.js');

worker.postMessage(20)

worker.onmessage = function(event) {
  console.log(`Main received ${event.data}`);
}

/* Service Workers */

/*navigator.serviceWorker.register('service-worker.js').then(function() {
  console.log('Registered')
}).catch(function() {
  console.log('Failed')
})*/

/* Ajax */

document.getElementById('load').addEventListener('click', function() {
  const request = new XMLHttpRequest()
  request.open("get", "getdata.php", true)
  request.addEventListener("load", data)
  request.send()
})

function data(event) {
  console.log(JSON.parse(this.responseText))
}



