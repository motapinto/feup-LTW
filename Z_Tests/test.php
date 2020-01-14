<!DOCTYPE html>
<html>
<head>
    <title> TEST </title>
</head>
<body>
    <section id="tic-tac-toe" data-id="1234">
        <div class="square"></div>
        <div class="square"></div>
        <div class="square"></div>
        <div class="square">X</div>
        <div class="square">X</div>
        <div class="square">O</div>
        <div class="square"></div>
        <div class="square"></div>
        <div class="square">O</div>
        <p id="state">playing</p>
    </section>
</body>
</html>

<script>
    document.addEventListener("load", initLoad);

    function initLoad() {
        let req = new XMLHttpRequest();
        req.open("POST", "", true);
        let id = document.getElementById("tic-tac-toe").getAttribute("data-id");
        req.send(encodeForAjax({id:id}));
        req.addEventListener("load", loadReq);
    }

    function loadReq() {
        let response = JSON.parse(this.responseText);
        let state = response.state;
        let squares = response.squares;
        document.getElementById("id").innerHTML = state;
        for(let i=0; i<squares.length; i++) {
            let elem = document.getElementsByClassName("square")[i];
            elem.innerHTML = squares[i];
        }
    }

    let squares = document.querySelectorAll("#tic-tac-toe div");
    for(let i=0; i<squares.length; i++) {
        squares[i].addEventListener("click", clickSquare.bind(squares[i], i));
    }

    function clickSquare(index) {
        console.log(index);

        if(this.innerHTML == "") {
            let req = new XMLHttpRequest();
            req.open("POST", "play.php", true);
            let id = document.getElementById("tic-tac-toe").getAttribute("data-id");
            req.send(encodeForAjax({id:id, position: index}));
            req.addEventListener("load", loadReq);
        }
    }
</script>


<!-- 17/01/2019 -->
<!-- 
    1) title
    2)b
    3)a
    4)c
    5)b,c
    6)b
    7)c
    8)a
    9)b
    10)d
    11)d
    12)c,d?
    13)R1: 0,0,1,1
    14)R2: 0,0,2,1
    15)R3: 0,1,0,1
    16)R4: 0,0,1,1
    17)R5: 0,0,3,2
    18)R6: 0,1,2,2
    19) Purple
    20) A [groundhog would hog all the ground he could hog, if a groundhog could hog g]round
    21) A [groundhog would hog] all the ground he could hog, if a groundhog could hog ground
    22) A groundhog would hog a[ll] the ground he could hog, if a groundhog could hog ground
    23) A groundhog would hog all the [ground] he could hog, if a groundhog could hog ground
    24) A groundhog would hog all the ground he could hog, if a groundhog could hog [ground]
    25) A [groundhog would hog all the gro]und he could hog, if a groundhog could hog ground
    29) //ingredient/text()
    30) //recipe[name/text()="Mixed Toast"]/ingredients/count(ingredient)
    31) //recipes/count(recipe[@difficulty="medium"])
    32) //recipe[ingredients/ingredient/text()="Apple"]/name/text()

    26-28)  
    <script>
        document.addEventListener("load", initLoad);

        function initLoad() {
            let req = new XMLHttpRequest();
            req.open("POST", "", true);
            let id = document.getElementById("tic-tac-toe").getAttribute("data-id");
            req.send(encodeForAjax({id:id}));
            req.addEventListener("load", loadReq);
        }

        function loadReq() {
            let response = JSON.parse(this.responseText);
            let state = response.state;
            let squares = response.squares;
            document.getElementById("id").innerHTML = state;
            for(let i=0; i<squares.length; i++) {
                let elem = document.getElementsByClassName("square")[i];
                elem.innerHTML = squares[i];
            }
        }

        let squares = document.querySelectorAll("#tic-tac-toe div");
        for(let i=0; i<squares.length; i++) {
            squares[i].addEventListener("click", clickSquare.bind(squares[i], i));
        }

        function clickSquare(index) {
            console.log(index);

            if(this.innerHTML == "") {
                let req = new XMLHttpRequest();
                req.open("POST", "play.php", true);
                let id = document.getElementById("tic-tac-toe").getAttribute("data-id");
                req.send(encodeForAjax({id:id, position: index}));
                req.addEventListener("load", loadReq);
            }
        }
    </script>
    <?php
        // $id = $_POST['id'];
        // $position = $_POST['position'];
        // if(!isset($position)) {
        //     $state = state($id);
        //     return json_encode($state);
        // }
        // else if($position < 1 || $position > 9) die();
        // else {
        //     play($id, $position);
        //     $state = state($id);
        //     return json_encode($state);
        // }
    ?> 
-->

<!-- 17/01/2018  -->
<!-- 
    <script>
        // 26
        let itens = document.querySelectorAll('#game ul li');
        let textInput = document.querySelector('#game input[type=text]');

        let article = document.getElementById('ul')
        console.log(article.firstElementChild)                        
        console.log(article.firstElementChild.textContent)

        function listener() {
            let className = this.className;
            console.log(this.className)
            if(!className.match(/used/)){
                this.classList.add('used')
                textInput.value+=this.innerHTML;
            }
        }

        for(let i=0; i<itens.length; i++) {
            itens[i].addEventListener('click', listener)
        }

        // 27
        let reset = document.querySelector('#game input[name=reset]');
        reset.addEventListener('click', handleReset);

        function handleReset(){
            for(let i=0; i<itens.length; i++) {
                itens[i].classList.remove('used')
            }
            textInput.value = '';
        }

        //28
        let send = document.querySelector('#game input[name=send]');
        send.addEventListener('click', handleSend);

        function handleSend(){
            let req = new XMLHttpRequest();
            req.addEventListener('load', handleRes);
            req.open('POST', 'is_guess_correct.php', true);
            req.send(encodeForAjax({guess: textInput.value}));
        }

        function handleRes(){
            let res = JSON.parse(this.responseText);

            if(res.result === 'wrong'){
                alert("WRONG");
            }
            else {
                textInput.value = '';
                let ul = document.querySelector('#game ul');

                for(let i=0; i<itens.length; i++) {
                    ul.removeChild(itens[i]);
                }

                for(let i=0; i<res.word.length; i++) {
                    let word = res.word[i];

                    let li = document.createElement('li');
                    li.innerHTML = res.word[i];
                    ul.appendChild(li);
                }
            }
        }
    </script> 
-->

<!-- 26/01/2017  -->
<!-- 
    <script>
        //3a
        let imagesList = document.querySelectorAll("#photos ul li");
        let mainImg = document.querySelector("#photos img.large");
        
        imagesList.forEach(function(element) {
            element.addEventListener("click", imageClick);
        })

        function imageClick() {
            let source = this.querySelector("img").getAttribute("src");
            let filename ="large/"+ source;
            mainImg.setAttribute("src", filename);
        }

        let load = document.getElementByClassName("load")[0];
        load.addEventListener("click", init);

        //3b
        function init() {
            let request = new XMLHttpRequest();
            request.addEventListener("load", handleRes);
            request.open('GET',"getrandomimages.php", true);
            request.send();
        }

        function handleRes() {
            let response = JSON.parse(this.responseText);
            let list = document.getElementById("photos")

            for(let i=0; i++; i<3) {
                let li = document.createElement('li');
                let img = document.createElement('img');
                img.setAttribute('src', response[i]);
                li.appendChild(img);
                list.appendChild(li);
            }
        }
    </script> 
-->

<!-- 12/01/2017  -->
<!-- 
    <script>
        //a
        let listLinks = document.querySelectorAll("#products ul li a");
        listLinks.forEach(function(element) {
            element.addEventListener("click", incrementElem);
        });

        function incrementElem(event) {
            this.parentNode.querySelector("span").innerHTML ++;
        }

        let buy = document.getElementsByClassName("buy")[0];
        buy.addEventListener("click", init);

        function init() {
            let request = new XMLHttpRequest();

            let products = [];
            let listElems = document.querySelectorAll("#products ul li"); 
            listElems.forEach(function(element) {
                let name = element.innerHTML
                console.log(element)
                let elem = {name: name, qty: parseInt(element.querySelector("span").innerHTML)}
                products.push(elem);
            })
            console.log(products)

            request.open("POST","calculatetotal.php", true);
            request.send(encodeForAjax({}));
            request.addEventListener("click", loadRequest)
        }

        function loadRequest() {

        }

        //b
    </script> 
-->

<!-- 1/02/2016  -->
<!-- 
    <script>
        //a
        let numbers = document.querySelectorAll("#keypad a");
        numbers.forEach(function(element) {
            element.addEventListener("click", clickNum);
        });

        function clickNum(event) {
            let num = parseInt(this.innerHTML);
            document.querySelector("#pin input[name=pin]").value += num;
        }

        //b
        let btn = document.querySelector("#pin input[type=submit]");
        btn.addEventListener("click", init);
        function init() {
            let request = new XMLHttpRequest();
            let username = document.querySelector("#pin input[name=username]").value
            let pin = document.querySelector("#pin input[name=pin]").value

            request.open("POST","verify_pin.php", true);
            request.send(encodeForAjax({username: username, pin: pin}));
            request.addEventListener("load", loadList);
        }
        function loadList() {
            let response = JSON.parse(this.responseText);
            if(!response.valid) {
                document.querySelector("#pin input[name=pin]").style ="border-color: red";
                document.querySelector("#pin input[name=pin]").value ="";
            }
        }
    </script>
-->

<!-- 19/01/2016 -->
<!-- 
    <script>
        //a
        let pass = document.querySelector("#register input[name=password]");
        pass.addEventListener("blur", blurPass);
        function blurPass() {
            let regex = /.{8,}((\W{1,}) | (\d{1,}) | (\_{1,))/
            if(regex.test(pass.value))
                pass.style = "border-color: black;"
            else
                pass.style = "border-color: red;"
        }
        //b
        let username = document.querySelector("#register input[name=username]");
        let submit = document.querySelector("#register input[type=submit]");
        submit.addEventListener("click", init);
        function init() {
            let req = new XMLHttpRequest();
            req.open("POST", "verifyusername.php", true);

            req.send(encodeForAjax({username: username}));
            req.addEventListener("load", loadReq);
        }
        function loadReq(event) {
            let response = JSON.parse(this.responseText);
            if(response.valid)
                username.style = "border-color: black;"
            else {
                username.style = "border-color: red;"
                event.preventDefault();
            }
        }
    </script>
-->