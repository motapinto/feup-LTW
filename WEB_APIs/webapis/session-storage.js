function save() {
  const saved = document.getElementById('secret').value

  //localStorage.theme = 'dark'
  //localStorage['theme'] = 'dark'
  sessionStorage.setItem('secret', document.getElementById('secret').value) // Recommended

  console.log(`Saved: ${saved}`)
}

function load() {
  //const text = localStorage.theme)
  //const text = ocalStorage['theme']
  const loaded = sessionStorage.getItem('secret')
  console.log(`Loaded: ${loaded}`)

  document.getElementById('secret').value = loaded
}

function clear() {
  sessionStorage.removeItem('secret')
  console.log('Cleared')
}

document.getElementById('save').addEventListener('click', save)
document.getElementById('load').addEventListener('click', load)
document.getElementById('clear').addEventListener('click', clear)

