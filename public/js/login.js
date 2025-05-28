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
        this.sendOtpBtn.addEventListener('click', this.handleSendOtp.bind(this));
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
                document.getElementById('shanghName').textContent = data.data.shangh_name;
                document.getElementById('trusteeName').textContent = data.data.trustee_name;
                document.getElementById('email').value = data.data.email;
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

    handleSendOtp() {
        const mobile = this.mobileInput.value;
        if (!mobile) {
            this.mobileError.textContent = 'Please enter mobile number';
            this.mobileError.classList.remove('hidden');
            return;
        }

        const loader = document.getElementById('sendOtpBtnLoader');
        const text = document.getElementById('sendOtpBtnText');
        
        this.sendOtpBtn.disabled = true;
        loader.classList.remove('hidden');
        text.textContent = 'Sending...';

        // Simulate sending OTP and redirect to OTP screen after a short delay
        setTimeout(() => {
            window.location.href = '/otp-verify';
        }, 1000);
    }
}

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    new LoginHandler();
}); 