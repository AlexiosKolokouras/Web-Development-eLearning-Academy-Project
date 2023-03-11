document.addEventListener("DOMContentLoaded", (e) =>{
    const $togglePassword = document.querySelector(".toggle_password");
    const $password = document.querySelector(".pswd");

    $togglePassword.addEventListener("click", (e) => {
    const type = $password.getAttribute("type") === "password" ? "text" : "password";
    $password.setAttribute("type", type);
    
    if($password.getAttribute("type") === "text"){
        $togglePassword.classList.add("fa-solid"); 
        $togglePassword.classList.remove("fa-regular");
    }else{
        $togglePassword.classList.add("fa-regular");
        $togglePassword.classList.remove("fa-solid"); 
            
    }
});
}); 