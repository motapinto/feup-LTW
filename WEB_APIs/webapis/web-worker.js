self.onmessage = function(event) {
  console.log(`Worker received ${event.data}`);

  // Send message to main file
  self.postMessage(event.data * 10);
}