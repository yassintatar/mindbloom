const admin = document.getElementById('admin');
const user = document.getElementById('user');
const adminkey = document.getElementById('adminkey');

const passmod = document.getElementById('passmod');
const newpass = document.getElementById('newpass');
const forgotpass = document.getElementById('forgotpass');
const changepass = document.getElementById('changepass');

// Function to handle password change form visibility
function chpass() {
    passmod.style.display = "none";
    newpass.style.display = "block";
}

// Function to handle forgot password form visibility
function forpass() {
    newpass.style.display = "none";
    passmod.style.display = "block";
}
changepass.addEventListener("click", forpass);
forgotpass.addEventListener("click", chpass);



function keyU()
{
    if(user.value=="user"){
        adminkey.style.display="none";
    }
}

function keyA()
{
    if(admin.value=="admin"){
        adminkey.style.display="block";
    }
}


admin.addEventListener("change",keyA);
user.addEventListener("change",keyU);