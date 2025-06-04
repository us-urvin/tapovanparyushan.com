class OtpVerifyHandler {
    constructor() {
        this.otpInputs = document.querySelectorAll('input[name="otp[]"]');
        this.form = document.getElementById('otpVerifyForm');
        this.resendForm = document.querySelector('form[action*="login/send-otp"]');
        this.resendButton = this.resendForm.querySelector('button[type="submit"]');
        
        this.init();
    }

    init() {
        // Initialize event listeners
        this.initializeEventListeners();
    }

    initializeEventListeners() {
        // Initialize OTP input handlers
        this.initializeOtpInputs();

        // Handle form submission
        this.form.addEventListener('submit', (e) => this.handleSubmit(e));

        // Handle resend OTP
        this.resendForm.addEventListener('submit', (e) => this.handleResendOtp(e));
    }

    initializeOtpInputs() {
        this.otpInputs.forEach((input, index) => {
            // Handle input event
            input.addEventListener('input', () => this.handleInput(input, index));

            // Handle keydown event
            input.addEventListener('keydown', (e) => this.handleKeyDown(e, input, index));

            // Handle paste event
            input.addEventListener('paste', (e) => this.handlePaste(e));

            // Prevent non-numeric input
            input.addEventListener('keypress', (e) => this.handleKeyPress(e));
        });
    }

    handleInput(input, index) {
        // Remove any non-numeric characters
        input.value = input.value.replace(/[^0-9]/g, '');
        
        // If input is not empty and is a number, move to next input
        if (input.value.length === 1 && /^[0-9]$/.test(input.value)) {
            if (index < this.otpInputs.length - 1) {
                this.otpInputs[index + 1].focus();
            }
        }
    }

    handleKeyDown(e, input, index) {
        if (e.key === 'Backspace') {
            if (input.value.length === 0 && index > 0) {
                this.otpInputs[index - 1].focus();
            }
        }
    }

    handlePaste(e) {
        e.preventDefault();
        const pastedData = e.clipboardData.getData('text').replace(/[^0-9]/g, '').slice(0, 4);
        
        // Fill the inputs with pasted data
        pastedData.split('').forEach((digit, index) => {
            if (index < this.otpInputs.length) {
                this.otpInputs[index].value = digit;
            }
        });

        // Focus the next empty input or the last input
        const nextEmptyIndex = pastedData.length < this.otpInputs.length ? pastedData.length : this.otpInputs.length - 1;
        this.otpInputs[nextEmptyIndex].focus();
    }

    handleKeyPress(e) {
        if (!/^[0-9]$/.test(e.key)) {
            e.preventDefault();
        }
    }

    handleSubmit(e) {
        e.preventDefault();
        
        // Get entered OTP
        const enteredOtp = Array.from(this.otpInputs)
            .map(input => input.value)
            .join('');

        if (enteredOtp.length !== 4) {
            iziToast.error({
                title: 'Error',
                message: 'Please enter all 4 digits of the OTP',
                position: 'topRight'
            });
            return;
        }

        // Disable submit button and show loading state
        const submitBtn = this.form.querySelector('button[type="submit"]');
        const originalText = submitBtn.innerHTML;
        submitBtn.disabled = true;
        submitBtn.innerHTML = `
            <svg class="w-5 h-5 animate-spin" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="#fff" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
            </svg>
        `;

        // Submit the form
        this.form.submit();
    }

    handleResendOtp(e) {
        e.preventDefault();
        
        // Disable resend button and show loading state
        this.resendButton.disabled = true;
        const originalText = this.resendButton.innerHTML;
        this.resendButton.innerHTML = 'Sending...';

        // Submit the form
        this.resendForm.submit();
    }
}

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    new OtpVerifyHandler();
}); 