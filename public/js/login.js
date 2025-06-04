class LoginHandler {
    constructor() {
        this.form = document.getElementById('shanghLoginForm');
        this.pincodeInput = document.getElementById('pincode');
        this.mobileInput = document.getElementById('mobile');
        this.userInfo = document.getElementById('userInfo');
        this.pincodeError = document.getElementById('pincodeError');
        this.mobileError = document.getElementById('mobileError');
        this.sendOtpBtn = document.getElementById('sendOtpBtn');
        
        this.checkPincodeTimeout = null;
        this.init();
    }

    init() {
        this.pincodeInput.addEventListener('input', this.handlePincodeInput.bind(this));
        this.mobileInput.addEventListener('input', this.handleMobileInput.bind(this));
        this.form.addEventListener('submit', this.handleSubmit.bind(this));
    }

    handleMobileInput() {
        this.mobileError.classList.add('hidden');
        this.mobileInput.classList.remove('border-red-500');
        this.mobileInput.classList.add('border-gray-300');
    }

    validateMobileNumber(mobile) {
        // Indian mobile number validation (10 digits starting with 6-9)
        const mobileRegex = /^[6-9]\d{9}$/;
        return mobileRegex.test(mobile);
    }

    handlePincodeInput() {
        // Clear previous timeout
        clearTimeout(this.checkPincodeTimeout);
        
        // Reset UI
        this.pincodeError.classList.add('hidden');
        this.userInfo.classList.add('hidden');

        // Set new timeout - check as soon as user stops typing
        this.checkPincodeTimeout = setTimeout(() => {
            if (this.pincodeInput.value.trim() !== '') {
                this.checkPincode(this.pincodeInput.value);
            }
        }, 300);
    }

    async checkPincode(pincode) {
        try {
            const response = await fetch('/login/check-pincode', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ pincode })
            });

            const data = await response.json();
            
            if (data.success) {
                // Show user info
                document.getElementById('shanghName').textContent = data.data.sangh_name;
                document.getElementById('trusteeName').textContent = data.data.trustee_name;
                document.getElementById('email').textContent = data.data.email;
                this.mobileInput.value = data.data.mobile;
                this.userInfo.classList.remove('hidden');
            } else {
                // Show error message
                this.pincodeError.textContent = data.message;
                this.pincodeError.classList.remove('hidden');
            }
        } catch (error) {
            this.pincodeError.textContent = 'An error occurred. Please try again.';
            this.pincodeError.classList.remove('hidden');
        }
    }

    handleSubmit(e) {
        e.preventDefault();
        
        const mobile = this.mobileInput.value.trim();
        
        // Validate mobile number
        if (!mobile) {
            this.mobileError.textContent = 'Please enter mobile number';
            this.mobileError.classList.remove('hidden');
            this.mobileInput.classList.add('border-red-500');
            this.mobileInput.classList.remove('border-gray-300');
            return;
        }

        if (!this.validateMobileNumber(mobile)) {
            this.mobileError.textContent = 'Please enter a valid 10-digit mobile number starting with 6-9';
            this.mobileError.classList.remove('hidden');
            this.mobileInput.classList.add('border-red-500');
            this.mobileInput.classList.remove('border-gray-300');
            return;
        }

        const loader = document.getElementById('sendOtpBtnLoader');
        const text = document.getElementById('sendOtpBtnText');
        
        this.sendOtpBtn.disabled = true;
        loader.classList.remove('hidden');
        text.textContent = 'Sending...';
        
        // Submit the form
        this.form.submit();
    }
}

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    new LoginHandler();
}); 