    const passwordInput = document.getElementById('password');
    const passwordStrength = document.getElementById('password-strength');

    passwordInput.addEventListener('input', function() {
        const password = passwordInput.value;
        let strength = 0;

        // Check length
        if (password.length >= 8) {
            strength += 1;
        }

        // Check for numbers
        if (/\d/.test(password)) {
            strength += 1;
        }

        // Check for uppercase letters
        if (/[A-Z]/.test(password)) {
            strength += 1;
        }

        // Check for lowercase letters
        if (/[a-z]/.test(password)) {
            strength += 1;
        }

        // Check for special characters
        if (/[^A-Za-z0-9]/.test(password)) {
            strength += 1;
        }

        if (strength < 3) {
            passwordStrength.textContent = 'Weak';
            passwordStrength.className = 'weak';
        } else if (strength < 5) {
            passwordStrength.textContent = 'Average';
            passwordStrength.className = 'average';
        } else {
            passwordStrength.textContent = 'Strong';
            passwordStrength.className = 'strong';
        }
    });


    function validateForm() {
        var password = document.getElementsByName('password')[0].value;
        var confirmPassword = document.getElementsByName('confirmPassword')[0].value;
    
        if (password !== confirmPassword) {
            alert("Passwords do not match.");
            return false;
        }
    }