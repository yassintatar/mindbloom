const container = document.getElementById('container');
const registerBtn = document.getElementById('register');
const loginBtn = document.getElementById('login');

const admin=document.getElementById('admin');
const user=document.getElementById('user');
const adminkey=document.getElementById('adminkey');

const email1=document.getElementById('email1');
const email2=document.getElementById('email2');
const password1=document.getElementById('password1');
const password2=document.getElementById('password2');
const name1=document.getElementById('name');


const b1=document.getElementById('b1');
const b2=document.getElementById('b2');

const phone=document.getElementById('phone');
const phonenum=document.getElementById('phonenum');

function verifphone()
{
    let phonenum=document.getElementById('phonenum').value;
if( phonenum.length!=8){
    document.getElementById('phone').innerHTML="Insert Your Phone Number !";
}
else {
    document.getElementById('phone').innerHTML=" ";
}
}
b2.addEventListener("click",verifphone);


function verifname()
{
if( name1.value==""){
    document.getElementById('name11').innerHTML="Insert Your Name !";
}
else if(mask(name1.value)==false){
    document.getElementById('name11').innerHTML="Invalid Name !";}
else {
    document.getElementById('name11').innerHTML=" ";
}
}
function mask(name1)
{
     var x = /^[A-Za-z\s]+$/;
    if (x.test(name1))
    {
        return true;
    }
    else
    {
        return false;
    }
}
b2.addEventListener("click",verifname);


function verifemail1()
{
    var emailValue =  document.getElementById('email1').value; 
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

if (emailValue === "") {
    document.getElementById('p1').innerHTML = "Insert Your Email!";
} 
// Check if the input matches the email format
else if (!emailRegex.test(emailValue)) {
    document.getElementById('p1').innerHTML = "Invalid Email!";
} 
else {
    document.getElementById('p1').innerHTML = " ";
}
}

function verifemail2()
{
    var emailValue =  document.getElementById('email2').value; 
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

if (emailValue === "") {
    document.getElementById('p2').innerHTML = "Insert Your Email!";
} 

else if (!emailRegex.test(emailValue)) {
    document.getElementById('p2').innerHTML = "Invalid Email!";
} 
else {
    document.getElementById('p2').innerHTML = " ";
}
}

function confirmPassword() {
    
    var password0 = document.getElementById('password0').value;
    var password2 = document.getElementById('password2').value;
    
    var messageElement = document.getElementById('p8');

    // Check if any of the password input are empty
    if (password0 === "" || password2 === "") {
        messageElement.innerHTML = "Please fill in Both Password Fields.";
        messageElement.style.color = "red"; 
    } 

    else if (password0 !== password2) {
        messageElement.innerHTML = "Passwords do not Match!";
        messageElement.style.color = "red"; 
    } 

    else {
        messageElement.innerHTML = "Passwords Match!";
        messageElement.style.color = "green"; 
    }
}

b2.addEventListener('click', confirmPassword);



function password4()
{
if(password2.value==""){
    document.getElementById('p4').innerHTML="Insert Your Password !";
}
else{
    document.getElementById('p4').innerHTML=" ";
}
}
function password3()
{
if(password1.value=="" ){
    document.getElementById('p3').innerHTML="Insert Your Password !";
}
else{
    document.getElementById('p3').innerHTML=" ";
}
}


b2.addEventListener("click",verifemail2);
b1.addEventListener("click",verifemail1);
b1.addEventListener("click",password3);
b2.addEventListener("click",password4);




function add(){
    container.classList.add('active')
}

function remove(){
    container.classList.remove('active')
}

if (container && registerBtn && loginBtn) {
    registerBtn.addEventListener('click', add);
    loginBtn.addEventListener('click',remove);
}

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






