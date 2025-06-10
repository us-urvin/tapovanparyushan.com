class ParyushanStepper {
    constructor() {
        this.currentStep = 1;
        this.totalSteps = 6;
        this.init();
    }

    init() {
        this.updateStepperUI();
        this.setupNavigationButtons();
        this.setupStepClickHandlers();
        this.setupFormValidation();
    }

    setupFormValidation() {
        document.querySelectorAll('#paryushanEventForm input:not([type="checkbox"]), #paryushanEventForm select').forEach(input => {
            input.addEventListener('input', () => {
                this.clearError(input);
            });
        });
    }

    validateField(input) {
        const value = input.value.trim();
        let isValid = true;
        let errorMessage = '';
        if (input.hasAttribute('required') && !value) {
            isValid = false;
            errorMessage = 'This field is required';
        }
        if (isValid && value) {
            if (input.type === 'email') {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(value)) {
                    isValid = false;
                    errorMessage = 'Please enter a valid email address';
                }
            } else if (input.type === 'number') {
                if (isNaN(value) || parseInt(value) < 0) {
                    isValid = false;
                    errorMessage = 'Please enter a valid number';
                }
            }
        }
        return { isValid, errorMessage };
    }

    showError(input, message) {
        input.classList.add('border-red-500');
        const errorDiv = document.createElement('div');
        errorDiv.className = 'text-red-500 text-xs mt-1';
        errorDiv.textContent = message;
        const existingError = input.parentElement.querySelector('.text-red-500');
        if (existingError) {
            existingError.remove();
        }
        input.parentElement.appendChild(errorDiv);
    }

    clearError(input) {
        input.classList.remove('border-red-500');
        const errorDiv = input.parentElement.querySelector('.text-red-500');
        if (errorDiv) {
            errorDiv.remove();
        }
    }

    validateStep(stepNumber) {
        const stepContent = document.querySelector(`.step-content[data-step="${stepNumber}"]`);
        if (!stepContent) return true;
        let isValid = true;
        const inputs = stepContent.querySelectorAll('input:not([type="checkbox"]):not([type="hidden"]), select, textarea');
        inputs.forEach(input => {
            this.clearError(input);
            const { isValid: fieldValid, errorMessage } = this.validateField(input);
            if (!fieldValid) {
                this.showError(input, errorMessage);
                isValid = false;
            }
        });
        // For step 6, ensure the terms checkbox is checked
        if (stepNumber === 6) {
            const terms = stepContent.querySelector('input[type="checkbox"][name="terms_agree"]');
            if (terms && !terms.checked) {
                this.showError(terms, 'You must agree to the terms and conditions');
                isValid = false;
            }
        }
        return isValid;
    }

    setupNavigationButtons() {
        document.querySelectorAll('.next-step').forEach(btn => {
            btn.addEventListener('click', () => {
                if (this.validateStep(this.currentStep)) {
                    this.goToStep(this.currentStep + 1);
                }
            });
        });
        document.querySelectorAll('.prev-step').forEach(btn => {
            btn.addEventListener('click', () => {
                this.goToStep(this.currentStep - 1);
            });
        });
        // On submit, validate last step
        const form = document.getElementById('paryushanEventForm');
        if (form) {
            form.addEventListener('submit', (e) => {
                if (!this.validateStep(this.totalSteps)) {
                    e.preventDefault();
                }
            });
        }
    }

    setupStepClickHandlers() {
        document.querySelectorAll('.stepper-step').forEach(step => {
            step.addEventListener('click', () => {
                const stepNum = parseInt(step.getAttribute('data-step'));
                if (stepNum <= this.currentStep) {
                    this.goToStep(stepNum);
                }
            });
        });
    }

    updateStepperUI() {
        const steps = document.querySelectorAll('.stepper-step');
        steps.forEach((step, idx) => {
            const circle = step.querySelector('.step-circle');
            const dot = circle.querySelector('div');
            const text = step.querySelector('.step-text');
            // Line before this step
            const line = idx > 0 ? steps[idx - 1].nextElementSibling : null;
            if (idx + 1 < this.currentStep) {
                // Completed step
                circle.classList.add('border-[#C9A14A]', 'bg-[#C9A14A]');
                circle.classList.remove('border-[#E5E5E5]', 'bg-[#FFFCF5]');
                if (dot) dot.className = 'w-3 h-3 rounded-full bg-white';
                text.classList.add('text-[#C9A14A]');
                text.classList.remove('text-black');
                if (line) line.classList.add('bg-[#C9A14A]');
                if (line) line.classList.remove('bg-[#E5E5E5]');
            } else if (idx + 1 === this.currentStep) {
                // Current step
                circle.classList.add('border-[#C9A14A]', 'bg-[#FFFCF5]');
                circle.classList.remove('border-[#E5E5E5]', 'bg-[#C9A14A]');
                if (dot) dot.className = 'w-3 h-3 rounded-full bg-[#C9A14A]';
                text.classList.add('text-[#C9A14A]');
                text.classList.remove('text-black');
                if (line) line.classList.add('bg-[#C9A14A]');
                if (line) line.classList.remove('bg-[#E5E5E5]');
            } else {
                // Upcoming step
                circle.classList.remove('border-[#C9A14A]', 'bg-[#C9A14A]');
                circle.classList.add('border-[#E5E5E5]', 'bg-[#FFFCF5]');
                if (dot) dot.className = 'w-3 h-3 rounded-full bg-black';
                text.classList.remove('text-[#C9A14A]');
                text.classList.add('text-black');
                if (line) line.classList.remove('bg-[#C9A14A]');
                if (line) line.classList.add('bg-[#E5E5E5]');
            }
        });
        this.showStepContent(this.currentStep);
    }

    goToStep(stepNumber) {
        if (stepNumber < 1 || stepNumber > this.totalSteps) return;
        this.currentStep = stepNumber;
        this.updateStepperUI();
    }

    showStepContent(stepNumber) {
        document.querySelectorAll('.step-content').forEach(content => {
            content.classList.add('hidden');
        });
        const active = document.querySelector(`.step-content[data-step="${stepNumber}"]`);
        if (active) active.classList.remove('hidden');
    }
}

document.addEventListener('DOMContentLoaded', function() {
    new ParyushanStepper();
}); 