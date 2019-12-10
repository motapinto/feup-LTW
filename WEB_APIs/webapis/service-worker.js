const urlsToCache = [
  '/~arestivo/webapis/',
  '/~arestivo/webapis/index.html',
  '/~arestivo/webapis/getdata.php'
]

self.addEventListener('install', function(event) {
  console.log('Install')
  event.waitUntil(
    caches.open('LOCAL_CACHE')
      .then(function(cache) {
        console.log('Opened cache');
        return cache.addAll(urlsToCache);
      }).catch(function() {
        console.log('Failed to open cache')
      })
  )
})

self.addEventListener('activate', function(event) {
  console.log('Activate')
})

// Listen for network requests from the main document
self.addEventListener('fetch', function(event) {
  console.log(`Fetch: ${event.request.url}`)

  caches.match(event.request).then(function(response){
    return response || fetch(event.request).then(function(response) {
      caches.add(event.request, response.clone()).then(function() {
        console.log('Saved Cache')
      })
    })
  })
})