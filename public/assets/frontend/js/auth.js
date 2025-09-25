document.addEventListener("DOMContentLoaded", function () {
    "use strict";

    const registrationFormHandler = document.forms.registrationFormHandler;
    const loginFormHandler = document.forms.loginFormHandler;

    // Validation functions
    function validateName(name) {
        const nameRegex = /^[A-Za-z\s]{1,80}$/;
        if (!name.trim()) {
            return "Name is required.";
        }
        if (name.trim().length > 80) {
            return "Name must not exceed 80 characters.";
        }
        if (!nameRegex.test(name)) {
            return "Name can only contain letters and spaces.";
        }
        return "";
    }

    function validateEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!email) {
            return "Email is required.";
        }
        if (!emailRegex.test(email)) {
            return "Please enter a valid email address.";
        }
        return "";
    }

    function validateMobile(mobile) {
        const mobileRegex = /^[6-9]\d{9}$/;
        if (!mobile) {
            return "Mobile number is required.";
        }
        if (!mobileRegex.test(mobile)) {
            return "Please enter a valid 10-digit Indian mobile number.";
        }
        return "";
    }

    function validatePassword(password) {
        const passwordRegex = /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@#$%^&*+=!])[A-Za-z\d@#$%^&*+=!]{8,20}$/;
        if (!password) {
            return "Password is required.";
        }
        if (password.length < 8) {
            return "Password must be at least 8 characters long.";
        }
        if (password.length > 20) {
            return "Password must not exceed 20 characters.";
        }
        if (!passwordRegex.test(password)) {
            return "Password must contain at least one uppercase letter, one lowercase letter, one number, and one special character (@#$%^&*+=!). No spaces or other characters allowed.";
        }
        return "";
    }

    function validateConfirmPassword(password, confirmPassword) {
        if (!confirmPassword) {
            return "Confirm password is required.";
        }
        if (confirmPassword !== password) {
            return "Passwords do not match.";
        }
        return "";
    }

    // registration form validation
    if (registrationFormHandler) {
        const nameInput = registrationFormHandler.querySelector('input[name="name"]');
        const emailInput = registrationFormHandler.querySelector('input[name="email"]');
        const mobileInput = registrationFormHandler.querySelector('input[name="mobile"]');
        const passwordInput = registrationFormHandler.querySelector('input[name="password"]');
        const confirmPasswordInput = registrationFormHandler.querySelector('input[name="password_confirmation"]');
        const nameError = document.getElementById('name-error');
        const emailError = document.getElementById('email-error');
        const mobileError = document.getElementById('mobile-error');
        const passwordError = document.getElementById('password-error');
        const confirmPasswordError = document.getElementById('cPassword-error');
        const eyeIcons = registrationFormHandler.querySelectorAll('.eye');

        // Real-time validation on input
        nameInput.addEventListener('input', function () {
            nameError.textContent = validateName(this.value);
        });

        emailInput.addEventListener('input', function () {
            emailError.textContent = validateEmail(this.value);
        });

        mobileInput.addEventListener('input', function () {
            mobileError.textContent = validateMobile(this.value);
        });

        passwordInput.addEventListener('input', function () {
            passwordError.textContent = validatePassword(this.value);
            // Re-validate confirm password when password changes
            // confirmPasswordError.textContent = validateConfirmPassword(this.value, confirmPasswordInput.value);
        });

        confirmPasswordInput.addEventListener('input', function () {
            confirmPasswordError.textContent = validateConfirmPassword(passwordInput.value, this.value);
        });

        // Password visibility toggle
        eyeIcons.forEach(function (eye) {
            eye.addEventListener('click', function () {
                const input = this.parentNode.querySelector("input");
                // console.log("input: ", input);
                const icon = this.querySelector('i');
                if (input.type === 'password') {
                    input.type = 'text';
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                } else {
                    input.type = 'password';
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                }
            });
        });

        // Form submission validation
        registrationFormHandler.addEventListener('submit', function (event) {
            event.preventDefault(); // Prevent default submission

            const nameErrorMsg = validateName(nameInput.value);
            const emailErrorMsg = validateEmail(emailInput.value);
            const mobileErrorMsg = validateMobile(mobileInput.value);
            const passwordErrorMsg = validatePassword(passwordInput.value);
            const confirmPasswordErrorMsg = validateConfirmPassword(passwordInput.value, confirmPasswordInput.value);

            // Display errors
            nameError.textContent = nameErrorMsg;
            emailError.textContent = emailErrorMsg;
            mobileError.textContent = mobileErrorMsg;
            passwordError.textContent = passwordErrorMsg;
            confirmPasswordError.textContent = confirmPasswordErrorMsg;

            // If no errors, submit the form
            if (!nameErrorMsg && !emailErrorMsg && !mobileErrorMsg && !passwordErrorMsg && !confirmPasswordErrorMsg) {
                this.submit();
            }
        });
    }

    // login form validation
    if (loginFormHandler) {
        const emailInput = loginFormHandler.querySelector('input[name="email"]');
        const passwordInput = loginFormHandler.querySelector('input[name="password"]');
        const emailError = document.getElementById('email-error');
        const passwordError = document.getElementById('password-error');
        const eyeIcon = loginFormHandler.querySelector('.eye');

        emailInput.addEventListener('input', function () {
            emailError.textContent = validateEmail(this.value);
        });

        passwordInput.addEventListener('input', function () {
            passwordError.textContent = validatePassword(this.value);
        });

        // Password visibility toggle
        eyeIcon.addEventListener('click', function () {
            const input = this.parentNode.querySelector("input");
            // console.log("input: ", input);
            const icon = this.querySelector('i');
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });

        // Form submission validation
        loginFormHandler.addEventListener('submit', function (event) {
            event.preventDefault(); // Prevent default submission

            const emailErrorMsg = validateEmail(emailInput.value);
            const passwordErrorMsg = validatePassword(passwordInput.value);

            // Display errors
            emailError.textContent = emailErrorMsg;
            passwordError.textContent = passwordErrorMsg;

            // If no errors, submit the form
            if (!emailErrorMsg && !passwordErrorMsg) {
                this.submit();
            }
        });
    }



    // Detect navigation away from login or registration pages
    const isLoginPage = window.location.pathname.includes("/login");
    const isRegisterPage = window.location.pathname.includes("/register");

    if (isLoginPage || isRegisterPage) {
        // Handle browser back/forward or other navigation
        window.addEventListener("popstate", () => {
            const newPath = window.location.pathname;
            // Allow navigation from login to register without clearing
            if (!(isLoginPage && newPath.includes("/register"))) {
                localStorage.removeItem("homeStayURL");
                console.log(
                    "Cleared homeStayURL from localStorage due to navigation"
                );
            }
        });

        // Handle page unload (e.g., clicking other links)
        window.onbeforeunload = () => {
            const newUrl = document.referrer || window.location.href;
            // Allow navigation from login to register
            if (!(isLoginPage && newUrl.includes("/register"))) {
                localStorage.removeItem("homeStayURL");
                console.log("Cleared homeStayURL from localStorage on unload");
            }
        };
    }
});
