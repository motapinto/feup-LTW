document.addEventListener("cut", cut)
document.addEventListener("copy", copy)
document.addEventListener("paste", paste)

function cut(event) {
  console.log(`Cut: ${event.clipboardData.getData('text/plain')}`)
}

function copy(event) {
  const text = document.getSelection().toString()
  event.clipboardData.setData('text/plain', `${text} [from: ${document.location}]`)
  event.preventDefault(); // Prevent overriding
}

function paste(event) {
  const text = event.clipboardData.getData('text/plain')
  console.log(`Paste: ${event.clipboardData.getData('text/plain')}`)

  const paste = text.split('').reverse().join('') // Reverse pasted text
  const selection = window.getSelection();
  if (!selection.rangeCount) return false;
  selection.deleteFromDocument();
  selection.getRangeAt(0).insertNode(document.createTextNode(paste));

  event.preventDefault() // Prevent overriding
}