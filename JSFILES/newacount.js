let form = document.getElementsByTagName("form")[0];
let pass = document.getElementById("pass");
let cpass = document.getElementById("cpass");



document.addEventListener('DOMContentLoaded', function () {
    // var inputElement = document.querySelector('input[required]');
    // var pass = document.getElementById("pass");

    pass.addEventListener('invalid', function () {
        this.setCustomValidity('يرجى إدخال قيمة');
    });

    pass.addEventListener('input', function () {
        this.setCustomValidity('');
    });
});

form.onsubmit = function (e) {
    if (checkConfirmPass(pass.value, cpass.value)) {
        return
    }
    else {
        e.preventDefault();
        let div = document.createElement("div");
        let h2 = document.createElement("h2");
        let p = document.createElement("p");
        h2.innerHTML = "ERROR";
        h2.style.color = "#c01616"
        p.innerHTML = "in confirm password ";
        let btn = document.createElement("button");
        btn.style.cssText = " width: 20px;height: 20px;border-radius: 50%;background-color: red;position: absolute;top: -10px;right: -5px; "
        div.style.cssText = "width:200px; height:80px; padding:15px ; background-color:#777;position:absolute;border-radius:5px;left:50%;transform: translateX(-50%);";
        let eror = document.querySelector(".Error");
        btn.onclick = () => div.remove()
        div.appendChild(btn)
        div.appendChild(h2)
        div.appendChild(p)
        eror.appendChild(div);
    }
}


function checkConfirmPass(pass, cpass) {
    return pass === cpass ? true : false;
}



// =====================
