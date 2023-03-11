document.addEventListener("DOMContentLoaded", () => {
  const $form = document.querySelector("#registerForm");
  const $name = document.querySelector(".name");
  const $email = document.querySelector(".email");
  const $emailCfrm = document.querySelector(".cfm_email");
  const $password = document.querySelector(".pswd");
  const $nameError = document.querySelector(".name_error");
  const $emailError = document.querySelector(".email_error");
  const $emailCfrmError = document.querySelector(".cfm_email_error");
  const $passwordError = document.querySelector(".password_error");
  const $emailCheckError = document.querySelector(".email_check_error");

  const getValidations = ({ name, email, emailCfrm, password }) => {
    let nameIsValid = false;
    let emailIsValid = false;
    let emailCfrmIsValid = false;
    let passwordIsValid = false;

    if (name !== "") {
      nameIsValid = true;
    }

    if (
      email !== "" &&
      /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email)
    ) {
      emailIsValid = true;
    }

    if (emailCfrm !== "" && $emailCfrm.value === $email.value) {
      emailCfrmIsValid = true;
    }

    if (password !== "" && password.length >= 8) {
      passwordIsValid = true;
    }

    return {
      nameIsValid,
      emailIsValid,
      emailCfrmIsValid,
      passwordIsValid,
    };
  };

  $form.addEventListener("submit", (e) => {
    e.preventDefault();
    const {name, email, password } = e.target.elements;
    const values = {
      name: name.value,
      email: email.value,
      emailCfrm: email.value,
      password: password.value,
    };
    const validations = getValidations(values);

    if (!validations.nameIsValid) {
      $name.classList.add("is-invalid");
      $nameError.classList.remove("d-none");
    } else {
      $name.classList.remove("is-invalid");
      $nameError.classList.add("d-none");
    }

    if (!validations.emailIsValid) {
      $email.classList.add("is-invalid");
      $emailError.classList.remove("d-none");
    } else {
      $email.classList.remove("is-invalid");
      $emailError.classList.add("d-none");
    }

    if (!validations.emailCfrmIsValid) {
      $emailCfrm.classList.add("is-invalid");
      $emailCfrmError.classList.remove("d-none");
    } else {
      $emailCfrm.classList.remove("is-invalid");
      $emailCfrmError.classList.add("d-none");
    }

    if (!validations.passwordIsValid) {
      $password.classList.add("is-invalid");
      $passwordError.classList.remove("d-none");
    } else {
      $password.classList.remove("is-invalid");
      $passwordError.classList.add("d-none");
    }

    if (validations.nameIsValid && validations.emailIsValid && validations.emailCfrmIsValid && validations.passwordIsValid) {
      $form.submit();
    }
  });

  const getInputValidation = ({name, email, emailCfrm}) => {

    if (name !== "") {
      nameIsValid = true;
    }

    if (email !== "" && $email.value === $emailCfrm.value) {
      emailIsValid = true;
    }else {
      emailIsValid = false;
    }

    if (emailCfrm !== "" && $email.value === $emailCfrm.value) {
      emailCfrmIsValid = true;
    }else {
      emailCfrmIsValid = false;
    }
  };

  const getpasswordValidation = (password) => {
    if (password.length >= 8) {
      passwordIsValid = true;
    }
  };

  $name.addEventListener("input", (e) => {
    getInputValidation(e.target.value);

    if (nameIsValid) {
      $name.classList.remove("is-invalid");
      $nameError.classList.add("d-none");
    }
  });

  $email.addEventListener("input", (e) => {
    getInputValidation(e.target.value);

    if (emailIsValid) {
      $email.classList.remove("is-invalid");
      $emailError.classList.add("d-none");
      $emailCfrm.classList.remove("is-invalid");
      $emailCfrmError.classList.add("d-none");
    }else{
      $emailCheckError.classList.add("d-none");
    }
  });

  $emailCfrm.addEventListener("input", (e) => {
    getInputValidation(e.target.value);

    if (emailCfrmIsValid) {
      $emailCfrm.classList.remove("is-invalid");
      $emailCfrmError.classList.add("d-none");
    }
  });

  $password.addEventListener("input", (e) => {
    getpasswordValidation(e.target.value);

    if (passwordIsValid) {
      $password.classList.remove("is-invalid");
      $passwordError.classList.add("d-none");
    }
  });
  
  $nameError.classList.add("d-none");
  $emailError.classList.add("d-none");
  $emailCfrmError.classList.add("d-none");
  $passwordError.classList.add("d-none");
});
