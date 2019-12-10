const settings = {
  enableHighAccuracy: true,
  maximumAge        : 30000,
  timeout           : 20000
};

navigator.permissions.query({ name: "geolocation" }).then(({ state }) => {
  switch (state) {
    case "granted": 
      console.log('granted (remembered)')
      navigator.geolocation.getCurrentPosition(success, denied, settings);
      break;
    case "prompt": 
      console.log('prompt')
      navigator.geolocation.getCurrentPosition(success, denied, settings);
      break;
    case "denied": 
      console.log('denied (remembered)')
      break;
  }
})

function success(pos) {
  var crd = pos.coords;

  console.log('Your current position is:');
  console.log(`Latitude : ${crd.latitude}`);
  console.log(`Longitude: ${crd.longitude}`);
  console.log(`More or less ${crd.accuracy} meters.`);
}

function denied() {
  console.log('denied (once)')
}