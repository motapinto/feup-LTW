    //  Without defer in script element in html file
    /*window.addEventListener('load', function() {
        let products = document.getElementById('products');
        console.log(products);
    });*/

    //  With defer in script element in html file
    //  This makes the browser wait for the DOM to be completely loaded before running the script.
    let products = document.getElementById('products');
    console.log(products);