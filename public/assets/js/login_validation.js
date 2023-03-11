document.addEventListener("DOMContentLoaded", () => {
    const $form = document.querySelector("#login_form");
    const $email = document.querySelector("#email");
    const $password = document.querySelector("#password");
    const $emailErrorValid = document.querySelector(".email_error_valid");
    const $passwordError = document.querySelector(".password-error");
  
    const getValidations = ({ email, password }) => {
      let emailIsValid = false;
      let passwordIsValid = false;
  
      if (email !== "" &&
         /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email)
        ) {
        emailIsValid = true;
      }
  
      if (password !== "") {
        passwordIsValid = true;
      }
  
      return {
        emailIsValid,
        passwordIsValid,
      };
    };

    $form.addEventListener("submit", (e) => {
      e.preventDefault();
      const { email, password } = e.target.elements;
      const values = {
        email: email.value,
        password: password.value,
      };
      const validations = getValidations(values);
  
      if (!validations.emailIsValid) {
        $email.classList.add("is-invalid");
        $emailErrorValid.classList.remove("d-none");
      } else {
        $email.classList.remove("is-invalid");
        $emailErrorValid.classList.add("d-none");
      }
  
      if (!validations.passwordIsValid) {
        $password.classList.add("is-invalid");
        $passwordError.classList.remove("d-none");
      } else {
        $password.classList.remove("is-invalid");
        $passwordError.classList.add("d-none");
      }
  
      if (validations.emailIsValid && validations.passwordIsValid) {
        $form.submit();
      }
    });

    $email.addEventListener("input", (e) => {
        getValidations(e.target.value);
    
        if ($password !== "") {
            $email.classList.remove("is-invalid");
            $emailErrorValid.classList.add("d-none");
        }
    });

    $password.addEventListener("input", (e) => {
        getValidations(e.target.value);
    
        if ($password !== "") {
            $password.classList.remove("is-invalid");
            $passwordError.classList.add("d-none");
        }
    });

    $emailErrorValid.classList.add("d-none");
    $passwordError.classList.add("d-none");
  });
  