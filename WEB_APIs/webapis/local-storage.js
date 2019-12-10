

function changed() {
  const text = document.getElementById('text').value
  localStorage.setItem('text', document.getElementById('text').value) // Recommended
}

function received(event) {
  const text = localStorage.getItem('text')
  document.getElementById('text').value = text
}

document.getElementById('text').addEventListener('input', changed)

window.addEventListener('storage', received)