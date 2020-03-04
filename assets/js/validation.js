

function allLetter(inputtxt) {
    inputtxt.nextElementSibling.classList.remove('show');
    var letters = /^[a-z]*$/i;
    if (!inputtxt.value.match(letters)) {
        inputtxt.nextElementSibling.classList.add('show');
    }
}

// function phoneNumber(inputtxt) {
//     inputtxt.nextElementSibling.classList.remove('show');
//     var phoneno = /^\d{11}$/;
//     if (!inputtxt.value.match(phoneno)) {
//         inputtxt.nextElementSibling.classList.add('show');
//     }
// }

function licenceNo(inputtxt) {
    var licenceno = /^\d{11}$/;
    if (!inputtxt.value.match(licenceno)) {
        alert('من فصلك أدخل رقم رخصة صحيح');
    }
}

function passwordcheck(inputtxt) {
    // at least one number, one lowercase and one uppercase letter
    // at least 8 characters that are letters, numbers or the underscore
    var passwordrgx = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])\w{7,}$/;
    if (!inputtxt.value.match(passwordrgx)) {
        alert("كلمة المرور يجن أن تحتوي علي الاقل علي حرف كبير وحرف صغير و رقم و ألا تقل عن 8 حروف");
    }
}

function confirmedpassword(inputtxt) {
    var password = document.getElementById("password").value;
    if (inputtxt.value != password) {
        alert("غير متطابقين");
    }
}