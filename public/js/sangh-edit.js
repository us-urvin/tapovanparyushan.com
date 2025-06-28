// Stepper functionality
class Stepper {
    constructor() {
        this.currentStep = 1;
        this.totalSteps = 3;
        this.init();
    }

    init() {
        this.updateStepperUI();
        this.setupNavigationButtons();
        this.setupStepClickHandlers();
        this.setupFormValidation();
        this.setupSanghTypeHandler();
    }

    setupFormValidation() {
        // Add input event listeners to clear errors when user starts typing
        document.querySelectorAll('input:not([type="checkbox"]), select').forEach(input => {
            input.addEventListener('input', () => {
                this.clearError(input);
            });
        });
    }

    validateField(input) {
        const value = input.value.trim();
        let isValid = true;
        let errorMessage = '';

        // Check if required field is empty
        if (input.hasAttribute('required') && !value) {
            isValid = false;
            errorMessage = 'This field is required';
        }

        // Validate based on input type and name
        if (isValid && value) {
            if (input.type === 'email') {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(value)) {
                    isValid = false;
                    errorMessage = 'Please enter a valid email address';
                }
            } else if (input.name.includes('phone') || input.name.includes('mobile')) {
                const phoneRegex = /^\d{10}$/;
                if (!phoneRegex.test(value)) {
                    isValid = false;
                    errorMessage = 'Please enter a valid 10-digit phone number';
                }
            } else if (input.name === 'pincode') {
                const pincodeRegex = /^\d{6}$/;
                if (!pincodeRegex.test(value)) {
                    isValid = false;
                    errorMessage = 'Please enter a valid 6-digit pincode';
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
        
        // Remove any existing error message
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
        const inputs = stepContent.querySelectorAll('input:not([type="checkbox"]):not([disabled]), select:not([disabled])');
        
        inputs.forEach(input => {
            this.clearError(input);
            // Numeric and positive value validation for number inputs
            if (input.type === 'number') {
                const value = input.value.trim();
                if (value !== '' && (!/^\d+$/.test(value) || parseInt(value) < 0)) {
                    this.showError(input, 'Please enter a valid number');
                    isValid = false;
                    return;
                }
            }
            const { isValid: fieldValid, errorMessage } = this.validateField(input);
            
            if (!fieldValid) {
                this.showError(input, errorMessage);
                isValid = false;
            }
        });

        // Conditional validation for Teacher's Details if has_pathshala == 1
        if (stepNumber === 2) {
            const hasPathshala = stepContent.querySelector('select[name="has_pathshala"]');
            if (hasPathshala && hasPathshala.value === '1') {
                const teacherFields = [
                    { name: 'pathshala_first_name', label: 'First name' },
                    { name: 'pathshala_last_name', label: 'Last name' },
                    { name: 'pathshala_email', label: 'Email Address', type: 'email' },
                    { name: 'pathshala_phone', label: 'Phone Number', type: 'phone' }
                ];
                teacherFields.forEach(field => {
                    const input = stepContent.querySelector(`[name="${field.name}"]`);
                    if (input) {
                        this.clearError(input);
                        const value = input.value.trim();
                        let valid = true;
                        let message = '';
                        if (!value) {
                            valid = false;
                            message = `This field is required`;
                        } else if (field.type === 'email') {
                            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                            if (!emailRegex.test(value)) {
                                valid = false;
                                message = 'Please enter a valid email address';
                            }
                        } else if (field.type === 'phone') {
                            const phoneRegex = /^\d{10}$/;
                            if (!phoneRegex.test(value)) {
                                valid = false;
                                message = 'Please enter a valid 10-digit phone number';
                            }
                        }
                        if (!valid) {
                            this.showError(input, message);
                            isValid = false;
                        }
                    }
                });
            }

            // Conditional validation for Other Sangh table if has_other_sangh == 1
            const hasOtherSangh = stepContent.querySelector('select[name="has_other_sangh"]');
            if (hasOtherSangh && hasOtherSangh.value === '1') {
                const tbody = document.getElementById('otherSanghTbody');
                let validRowFound = false;
                if (tbody) {
                    const rows = tbody.querySelectorAll('tr');
                    rows.forEach(row => {
                        const particulars = row.querySelector('select[name*="[particulars]"]');
                        const familyCount = row.querySelector('input[name*="[family_count]"]');
                        const memberCount = row.querySelector('input[name*="[member_count]"]');
                        let rowValid = true;
                        
                        if (!particulars || particulars.value === '') rowValid = false;
                        if (!familyCount || familyCount.value === '' || isNaN(familyCount.value) || parseInt(familyCount.value) < 0) rowValid = false;
                        if (!memberCount || memberCount.value === '' || isNaN(memberCount.value) || parseInt(memberCount.value) < 0) rowValid = false;
                        if (rowValid) validRowFound = true;
                        // Show errors for invalid fields
                        if (familyCount && (familyCount.value !== '' && (isNaN(familyCount.value) || parseInt(familyCount.value) < 0))) {
                            this.showError(familyCount, 'Please enter a valid number');
                            isValid = false;
                        }
                        if (memberCount && (memberCount.value !== '' && (isNaN(memberCount.value) || parseInt(memberCount.value) < 0))) {
                            this.showError(memberCount, 'Please enter a valid number');
                            isValid = false;
                        }
                    });
                }
                if (!validRowFound) {
                    // Show a general error message (could highlight the first row)
                    const tbody = document.getElementById('otherSanghTbody');
                    if (tbody && tbody.querySelector('tr')) {
                        const firstInput = tbody.querySelector('input, select');
                        if (firstInput) {
                            this.showError(firstInput, 'At least one valid details is required');
                        }
                    }
                    isValid = false;
                }
            }

            // Age-wise Distribution Of Members validation
            const ageTable = document.getElementById('ageDistributionTable');
            if (ageTable) {
                const ageInputs = ageTable.querySelectorAll('input[name^="age_group["]:not([readonly])');
                ageInputs.forEach(input => {
                    this.clearError(input);
                    const value = input.value.trim();
                    if (value === '') {
                        this.showError(input, 'This field is required');
                        isValid = false;
                    } else if (isNaN(value) || parseInt(value) < 0) {
                        this.showError(input, 'Please enter a valid number');
                        isValid = false;
                    }
                });
            }
        }

        // Bus Transportation validation
        if (stepNumber === 3) {
            const busCheckbox = document.getElementById('bus_transportation');
            if (busCheckbox && busCheckbox.checked) {
                const tbody = document.getElementById('busTransportTbody');
                let validRowFound = false;
                if (tbody) {
                    const rows = tbody.querySelectorAll('tr');
                    rows.forEach(row => {
                        const fromInput = row.querySelector('input[name*="[from]"]');
                        const toInput = row.querySelector('input[name*="[to]"]');
                        const busNameInput = row.querySelector('input[name*="[bus_name]"]');
                        let rowValid = true;
                        if (!fromInput || fromInput.value.trim() === '') rowValid = false;
                        if (!toInput || toInput.value.trim() === '') rowValid = false;
                        if (!busNameInput || busNameInput.value.trim() === '') rowValid = false;
                        if (rowValid) validRowFound = true;
                        if (fromInput && fromInput.value.trim() === '') {
                            this.showError(fromInput, 'This field is required');
                            isValid = false;
                        }
                        if (toInput && toInput.value.trim() === '') {
                            this.showError(toInput, 'This field is required');
                            isValid = false;
                        }
                        if (busNameInput && busNameInput.value.trim() === '') {
                            this.showError(busNameInput, 'This field is required');
                            isValid = false;
                        }
                    });
                }
                if (!validRowFound) {
                    if (tbody && tbody.querySelector('input')) {
                        this.showError(tbody.querySelector('input'), 'At least one valid details is required');
                    }
                    isValid = false;
                }
            }

            // Train Transportation validation
            const trainCheckbox = document.getElementById('train_transportation');
            if (trainCheckbox && trainCheckbox.checked) {
                const tbody = document.getElementById('trainTransportTbody');
                let validRowFound = false;
                if (tbody) {
                    const rows = tbody.querySelectorAll('tr');
                    rows.forEach(row => {
                        const fromInput = row.querySelector('input[name*="[from]"]');
                        const trainNameInput = row.querySelector('input[name*="[train_name]"]');
                        const toInput = row.querySelector('input[name*="[to]"]');
                        let rowValid = true;
                        if (!fromInput || fromInput.value.trim() === '') rowValid = false;
                        if (!trainNameInput || trainNameInput.value.trim() === '') rowValid = false;
                        if (!toInput || toInput.value.trim() === '') rowValid = false;
                        if (rowValid) validRowFound = true;
                        if (fromInput && fromInput.value.trim() === '') {
                            this.showError(fromInput, 'This field is required');
                            isValid = false;
                        }
                        if (trainNameInput && trainNameInput.value.trim() === '') {
                            this.showError(trainNameInput, 'This field is required');
                            isValid = false;
                        }
                        if (toInput && toInput.value.trim() === '') {
                            this.showError(toInput, 'This field is required');
                            isValid = false;
                        }
                    });
                }
                if (!validRowFound) {
                    if (tbody && tbody.querySelector('input')) {
                        this.showError(tbody.querySelector('input'), 'At least one valid details is required');
                    }
                    isValid = false;
                }
            }
        }

        return isValid;
    }

    validateAllSteps() {
        let isValid = true;
        let firstInvalidStep = null;

        // Remove error highlight from all steps
        document.querySelectorAll('.stepper-step .step-circle').forEach(circle => {
            circle.classList.remove('border-red-500', 'animate-pulse');
        });

        // Validate all steps to find errors
        for (let i = 1; i <= this.totalSteps; i++) {
            if (!this.validateStep(i)) {
                isValid = false;
                if (firstInvalidStep === null) {
                    firstInvalidStep = i;
                }
            }
        }

        // If there are errors, redirect to the first step with errors
        if (!isValid && firstInvalidStep !== null) {
            // Hide all step contents
            document.querySelectorAll('.step-content').forEach(content => {
                content.classList.add('hidden');
            });

            // Show the step with errors
            const invalidStepContent = document.querySelector(`.step-content[data-step="${firstInvalidStep}"]`);
            if (invalidStepContent) {
                invalidStepContent.classList.remove('hidden');
            }

            // Update current step
            this.currentStep = firstInvalidStep;

            // Update stepper UI
            this.updateStepperUI();

            // Add error highlight to the step with error
            const stepCircle = document.querySelector(`.stepper-step[data-step="${firstInvalidStep}"] .step-circle`);
            if (stepCircle) {
                stepCircle.classList.add('border-red-500', 'animate-pulse');
            }

            // Scroll to the first error
            const firstError = document.querySelector('.border-red-500');
            if (firstError) {
                firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                firstError.focus();
            }
        }

        return isValid;
    }

    setupStepClickHandlers() {
        const steps = document.querySelectorAll('.stepper-step');
        steps.forEach((step, index) => {
            step.addEventListener('click', (e) => {
                e.preventDefault();
                e.stopPropagation();
                const stepNumber = index + 1;
                if (stepNumber <= this.currentStep + 1) {
                    if (stepNumber === this.currentStep + 1) {
                        if (!this.validateStep(this.currentStep)) {
                            return false;
                        }
                    }
                    this.goToStep(stepNumber);
                }
            });
            step.style.cursor = 'pointer';
        });
    }

    setupNavigationButtons() {
        const prevButtons = document.querySelectorAll('.prev-step');
        prevButtons.forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.preventDefault();
                e.stopPropagation();
                if (this.currentStep > 1) {
                    this.goToStep(this.currentStep - 1);
                }
            });
        });

        const nextButtons = document.querySelectorAll('.next-step');
        nextButtons.forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.preventDefault();
                e.stopPropagation();
                if (this.currentStep < this.totalSteps) {
                    if (!this.validateStep(this.currentStep)) {
                        return false;
                    }
                    this.goToStep(this.currentStep + 1);
                }
            });
        });
    }

    updateStepperUI() {
        document.querySelectorAll('.stepper-step').forEach(step => {
            const stepNumber = parseInt(step.getAttribute('data-step'));
            const stepCircle = step.querySelector('.step-circle');
            const stepText = step.querySelector('.step-text');
            const stepDot = step.querySelector('.step-circle .rounded-full');
            const stepLine = step.nextElementSibling && step.nextElementSibling.classList.contains('step-line')
                ? step.nextElementSibling
                : null;

            // Remove any error styling
            stepCircle.classList.remove('border-red-500', 'animate-pulse');

            if (stepNumber < this.currentStep) {
                // Completed steps
                stepCircle.classList.add('bg-[#C9A14A]', 'border-[#C9A14A]');
                stepCircle.classList.remove('border-[#E5E5E5]');
                stepText.classList.add('text-[#C9A14A]');
                stepText.classList.remove('text-black');
                if (stepLine) {
                    stepLine.classList.add('bg-[#C9A14A]');
                    stepLine.classList.remove('bg-[#E5E5E5]');
                }
                if (stepDot) {
                    stepDot.classList.add('bg-[#C9A14A]');
                    stepDot.classList.remove('bg-black');
                }
            } else if (stepNumber === this.currentStep) {
                // Current step
                stepCircle.classList.add('border-[#C9A14A]');
                stepCircle.classList.remove('border-[#E5E5E5]');
                stepText.classList.add('text-[#C9A14A]');
                stepText.classList.remove('text-black');
                if (stepLine) {
                    stepLine.classList.remove('bg-[#C9A14A]');
                    stepLine.classList.add('bg-[#E5E5E5]');
                }
                if (stepDot) {
                    stepDot.classList.add('bg-[#C9A14A]');
                    stepDot.classList.remove('bg-black');
                }
            } else {
                // Future steps
                stepCircle.classList.add('border-[#E5E5E5]');
                stepCircle.classList.remove('border-[#C9A14A]');
                stepText.classList.add('text-black');
                stepText.classList.remove('text-[#C9A14A]');
                if (stepLine) {
                    stepLine.classList.add('bg-[#E5E5E5]');
                    stepLine.classList.remove('bg-[#C9A14A]');
                }
                if (stepDot) {
                    stepDot.classList.add('bg-black');
                    stepDot.classList.remove('bg-[#C9A14A]');
                }
            }
        });
    }

    goToStep(stepNumber) {
        if (stepNumber >= 1 && stepNumber <= this.totalSteps) {
            this.currentStep = stepNumber;
            this.updateStepperUI();
            this.showStepContent(stepNumber);
        }
    }

    showStepContent(stepNumber) {
        document.querySelectorAll('.step-content').forEach(content => {
            if (parseInt(content.getAttribute('data-step')) === stepNumber) {
                content.classList.remove('hidden');
            } else {
                content.classList.add('hidden');
            }
        });
    }

    setupSanghTypeHandler() {
        const sanghTypeSelect = document.querySelector('select[name="sangh_type"]');
        if (sanghTypeSelect) {
            // Set initial state
            this.handleSanghTypeChange(sanghTypeSelect.value);
            
            // Add event listener for changes
            sanghTypeSelect.addEventListener('change', (e) => {
                this.handleSanghTypeChange(e.target.value);
            });
        }
    }

    handleSanghTypeChange(sanghType) {
        const countryField = document.getElementById('country_field');
        const stateInput = document.getElementById('state_input');
        const stateDropdown = document.getElementById('state_dropdown');

        if (sanghType === '1') { // India
            // Set country to India and disable
            if (countryField) {
                countryField.value = 'India';
                countryField.disabled = true;
                countryField.style.backgroundColor = '#f3f4f6';
            }

            // Show dropdown, hide input
            if (stateInput && stateDropdown) {
                stateInput.style.display = 'none';
                stateInput.disabled = true;
                stateDropdown.style.display = 'block';
                stateDropdown.disabled = false;
                stateDropdown.classList.remove('hidden');
            }
        } else { // Outside India
            // Enable country field
            if (countryField) {
                countryField.disabled = false;
                countryField.style.backgroundColor = '';
                if (countryField.value === 'India') {
                    countryField.value = '';
                }
            }

            // Show input, hide dropdown
            if (stateInput && stateDropdown) {
                stateInput.style.display = 'block';
                stateInput.disabled = false;
                stateDropdown.style.display = 'none';
                stateDropdown.disabled = true;
                stateDropdown.classList.add('hidden');
            }
        }
    }
}

// Trustees table functionality
class TrusteesTable {
    constructor() {
        this.trusteeIndex = 0;
        this.init();
    }

    init() {
        this.setupAddTrusteeButton();
        this.setupDeleteTrusteeButtons();
        this.updateTrusteeRowNumbers();
    }

    setupAddTrusteeButton() {
        const addBtn = document.getElementById('addTrusteeBtn');
        if (addBtn) {
            addBtn.addEventListener('click', () => this.addTrusteeRow());
        }
    }

    setupDeleteTrusteeButtons() {
        const tbody = document.getElementById('trusteesTbody');
        if (!tbody) return;

        tbody.addEventListener('click', (e) => {
            if (e.target.closest('.deleteTrusteeBtn')) {
                const row = e.target.closest('tr');
                if (row) {
                    row.remove();
                    this.updateTrusteeRowNumbers();
                }
            }
        });
    }

    addTrusteeRow() {
        const tbody = document.getElementById('trusteesTbody');
        if (!tbody) return;

        const row = document.createElement('tr');
        row.innerHTML = `
            <td class="text-center align-middle">${tbody.querySelectorAll('tr').length + 1}</td>
            <td>
                <input type="text" name="trustees[${this.trusteeIndex}][first_name]" placeholder="First Name"
                    class="w-60 bg-white border border-[#F3E6C7] rounded-lg px-4 py-2 my-1 focus:outline-none focus:ring-2 focus:ring-[#C9A14A]" required>
            </td>
            <td>
                <input type="text" name="trustees[${this.trusteeIndex}][surname]" placeholder="Surname"
                    class="w-60 bg-white border border-[#F3E6C7] rounded-lg px-4 py-2 my-1 focus:outline-none focus:ring-2 focus:ring-[#C9A14A]" required>
            </td>
            <td>
                <input type="text" name="trustees[${this.trusteeIndex}][phone]" placeholder="Phone No."
                    class="w-60 bg-white border border-[#F3E6C7] rounded-lg px-4 py-2 my-1 focus:outline-none focus:ring-2 focus:ring-[#C9A14A]" required>
            </td>
            <td>
                <input type="text" name="trustees[${this.trusteeIndex}][position]" placeholder="Position Held"
                    class="w-60 bg-white border border-[#F3E6C7] rounded-lg px-4 py-2 my-1 focus:outline-none focus:ring-2 focus:ring-[#C9A14A]" required>
            </td>
            <td>
                <input type="email" name="trustees[${this.trusteeIndex}][email]" placeholder="Email"
                    class="w-48 bg-white border border-[#F3E6C7] rounded-lg px-4 py-2 my-1 focus:outline-none focus:ring-2 focus:ring-[#C9A14A]" required>
            </td>
            <td>
                <div class="flex gap-2 justify-center items-center min-h-[40px]">
                    <button type="button" class="deleteTrusteeBtn text-red-500 hover:text-red-700 flex items-center" title="Delete">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </div>
            </td>
        `;
        tbody.appendChild(row);
        this.trusteeIndex++;
        this.updateTrusteeRowNumbers();
    }

    updateTrusteeRowNumbers() {
        const tbody = document.getElementById('trusteesTbody');
        if (!tbody) return;
        const rows = tbody.querySelectorAll('tr');
        rows.forEach((row, idx) => {
            const noCell = row.querySelector('td');
            if (noCell) noCell.textContent = idx + 1;
            
            // Update the array index in the name attributes
            const inputs = row.querySelectorAll('input');
            inputs.forEach(input => {
                const name = input.getAttribute('name');
                if (name) {
                    input.setAttribute('name', name.replace(/trustees\[\d+\]/, `trustees[${idx}]`));
                }
            });
        });
    }
}

// Other Sangh Table Functionality
class OtherSanghTable {
    constructor() {
        this.otherSanghIndex = 1;
        this.init();
    }

    init() {
        this.setupAddOtherSanghButton();
        this.setupDeleteOtherSanghButtons();
        this.setupOtherSanghToggle();
    }

    setupAddOtherSanghButton() {
        const addButton = document.getElementById('addOtherSanghRowBtn');
        if (addButton) {
            addButton.addEventListener('click', () => this.addOtherSanghRow());
        }
    }

    setupDeleteOtherSanghButtons() {
        const tbody = document.getElementById('otherSanghTbody');
        if (tbody) {
            tbody.addEventListener('click', (e) => {
                if (e.target.closest('.deleteOtherSanghRowBtn')) {
                    e.target.closest('tr').remove();
                    this.updateOtherSanghRowNumbers();
                }
            });
        }
    }

    setupOtherSanghToggle() {
        const otherSanghExistsSelect = document.querySelector('.other-sangh-exists-select');
        const otherSanghTableSection = document.getElementById('otherSanghTableSection');
        if (otherSanghExistsSelect && otherSanghTableSection) {
            function toggleOtherSanghTable() {
                if (otherSanghExistsSelect.value === '1') {
                    otherSanghTableSection.style.display = '';
                } else {
                    otherSanghTableSection.style.display = 'none';
                }
            }
            otherSanghExistsSelect.addEventListener('change', toggleOtherSanghTable);
            toggleOtherSanghTable();
        }
    }

    addOtherSanghRow() {
        const tbody = document.getElementById('otherSanghTbody');
        if (!tbody) return;

        // Create particulars options HTML
        let particularsOptions = '';
        if (window.PARTICULARS) {
            for (const [key, value] of Object.entries(window.PARTICULARS)) {
                particularsOptions += `<option value="${key}">${value}</option>`;
            }
        }

        const row = document.createElement('tr');
        row.innerHTML = `
            <td class="text-center align-middle px-2 py-1">${tbody.querySelectorAll('tr').length + 1}</td>
            <td class="px-2 py-1">
                <select name="other_sanghs[${this.otherSanghIndex}][particulars]" class="w-full bg-white border border-[#F3E6C7] rounded-lg px-4 py-2 text-[#1A2B49] text-sm font-medium">
                    ${particularsOptions}
                </select>
            </td>
            <td class="px-2 py-1">
                <input type="number" name="other_sanghs[${this.otherSanghIndex}][family_count]" placeholder="No. of members" class="w-full bg-white border border-[#F3E6C7] rounded-lg px-4 py-2 text-[#1A2B49] text-sm font-medium">
            </td>
            <td class="px-2 py-1">
                <input type="number" name="other_sanghs[${this.otherSanghIndex}][member_count]" placeholder="No. of jain families" class="w-full bg-white border border-[#F3E6C7] rounded-lg px-4 py-2 text-[#1A2B49] text-sm font-medium">
            </td>
            <td class="text-center px-2 py-1">
                <button type="button" class="deleteOtherSanghRowBtn text-red-500 hover:text-red-700"><i class="fa-solid fa-trash"></i></button>
            </td>
        `;
        tbody.appendChild(row);
        this.otherSanghIndex++;
        this.updateOtherSanghRowNumbers();
    }

    updateOtherSanghRowNumbers() {
        const tbody = document.getElementById('otherSanghTbody');
        if (!tbody) return;
        const rows = tbody.querySelectorAll('tr');
        rows.forEach((row, idx) => {
            const noCell = row.querySelector('td');
            if (noCell) noCell.textContent = idx + 1;
            
            // Update the array index in the name attributes
            const particularsSelect = row.querySelector('select[name^="other_sanghs["]');
            const membersInput = row.querySelector('input[name^="other_sanghs["][name$="[no_of_members]"]');
            const familiesInput = row.querySelector('input[name^="other_sanghs["][name$="[no_of_jain_families]"]');
            
            if (particularsSelect) particularsSelect.name = `other_sanghs[${idx}][particulars]`;
            if (membersInput) membersInput.name = `other_sanghs[${idx}][no_of_members]`;
            if (familiesInput) familiesInput.name = `other_sanghs[${idx}][no_of_jain_families]`;
        });
    }
}

// Bus Transportation Table Functionality
class BusTransportTable {
    constructor() {
        this.init();
    }

    init() {
        this.setupAddBusButton();
        this.setupDeleteBusButtons();
        this.setupBusToggle();
    }

    setupAddBusButton() {
        const addBtn = document.getElementById('addBusRowBtn');
        if (addBtn) {
            addBtn.addEventListener('click', () => this.addBusRow());
        }
    }

    setupDeleteBusButtons() {
        const tbody = document.getElementById('busTransportTbody');
        if (!tbody) return;

        tbody.addEventListener('click', (e) => {
            if (e.target.closest('.deleteBusRowBtn')) {
                const row = e.target.closest('tr');
                if (row) {
                    row.remove();
                    this.updateBusRowNumbers();
                }
            }
        });
    }

    setupBusToggle() {
        const busCheckbox = document.getElementById('bus_transportation');
        const busTable = document.getElementById('busTransportTbody');
        if (!busCheckbox || !busTable) return;

        const toggleBusTable = () => {
            if (busCheckbox.checked) {
                busTable.closest('.overflow-x-auto').style.display = 'block';
                document.getElementById('addBusRowBtn').style.display = 'flex';
            } else {
                busTable.closest('.overflow-x-auto').style.display = 'none';
                document.getElementById('addBusRowBtn').style.display = 'none';
            }
        };

        busCheckbox.addEventListener('change', toggleBusTable);
        toggleBusTable(); // Initial state
    }

    addBusRow() {
        const tbody = document.getElementById('busTransportTbody');
        if (!tbody) return;

        var count = tbody.querySelectorAll('tr').length;
        const row = document.createElement('tr');
        row.innerHTML = `
            <td class="align-middle row-index px-2 py-1">${count + 1}</td>
            <td class="px-2 py-1">
                <input type="text" name="bus_transport[${count}][from]" class="bus-from-input w-full bg-white border border-[#F3E6C7] rounded-lg px-4 py-2 text-[#1A2B49] text-sm font-medium">
            </td>
            <td class="px-2 py-1">
                <input type="text" name="bus_transport[${count}][to]" class="bus-to-input w-full bg-white border border-[#F3E6C7] rounded-lg px-4 py-2 text-[#1A2B49] text-sm font-medium">
            </td>
            <td class="px-2 py-1">
                <input type="text" name="bus_transport[${count}][bus_name]" class="bus-name-input w-full bg-white border border-[#F3E6C7] rounded-lg px-4 py-2 text-[#1A2B49] text-sm font-medium">
            </td>
            <td class="text-center px-2 py-1">
                <button type="button" class="deleteBusRowBtn text-red-500 hover:text-red-700"><i class="fa-solid fa-trash"></i></button>
            </td>
        `;
        tbody.appendChild(row);
        this.updateBusRowNumbers();
    }

    updateBusRowNumbers() {
        const tbody = document.getElementById('busTransportTbody');
        if (!tbody) return;
        const rows = tbody.querySelectorAll('tr');
        rows.forEach((row, idx) => {
            const noCell = row.querySelector('td');
            if (noCell) noCell.textContent = idx + 1;
            // Update the array index in the name attributes
            const fromInput = row.querySelector('input[name^="bus_transport["][name$="[from]"]');
            const toInput = row.querySelector('input[name^="bus_transport["][name$="[to]"]');
            const nameInput = row.querySelector('input[name^="bus_transport["][name$="[bus_name]"]');
            if (fromInput) fromInput.name = `bus_transport[${idx}][from]`;
            if (toInput) toInput.name = `bus_transport[${idx}][to]`;
            if (nameInput) nameInput.name = `bus_transport[${idx}][bus_name]`;
        });
    }
}

// Train Transportation Table Functionality
class TrainTransportTable {
    constructor() {
        this.trainIndex = 1;
        this.init();
    }

    init() {
        this.setupAddTrainButton();
        this.setupDeleteTrainButtons();
        this.setupTrainToggle();
    }

    setupAddTrainButton() {
        const addButton = document.getElementById('addTrainRowBtn');
        if (addButton) {
            addButton.addEventListener('click', () => this.addTrainRow());
        }
    }

    setupDeleteTrainButtons() {
        const tbody = document.getElementById('trainTransportTbody');
        if (tbody) {
            tbody.addEventListener('click', (e) => {
                if (e.target.closest('.deleteTrainRowBtn')) {
                    e.target.closest('tr').remove();
                    this.updateTrainRowNumbers();
                }
            });
        }
    }

    setupTrainToggle() {
        const trainTransportCheckbox = document.getElementById('train_transportation');
        const trainTableSection = document.getElementById('trainTransportTbody').closest('.overflow-x-auto');
        const addTrainButton = document.getElementById('addTrainRowBtn');
        
        if (trainTransportCheckbox && trainTableSection) {
            const toggleTrainTable = () => {
                if (trainTransportCheckbox.checked) {
                    trainTableSection.style.display = '';
                    if (addTrainButton) addTrainButton.style.display = '';
                } else {
                    trainTableSection.style.display = 'none';
                    if (addTrainButton) addTrainButton.style.display = 'none';
                }
            };
            
            trainTransportCheckbox.addEventListener('change', toggleTrainTable);
            toggleTrainTable(); // Set initial state
        }
    }

    addTrainRow() {
        const tbody = document.getElementById('trainTransportTbody');
        if (!tbody) return;

        const row = document.createElement('tr');
        row.innerHTML = `
            <td class="align-middle row-index px-2 py-1">${tbody.querySelectorAll('tr').length + 1}</td>
            <td class="px-2 py-1">
                <input type="text" name="train_transport[${this.trainIndex}][from]" class="train-from-input w-full bg-white border border-[#F3E6C7] rounded-lg px-4 py-2 text-[#1A2B49] text-sm font-medium">
            </td>
            <td class="px-2 py-1">
                <input type="text" name="train_transport[${this.trainIndex}][to]" class="train-to-input w-full bg-white border border-[#F3E6C7] rounded-lg px-4 py-2 text-[#1A2B49] text-sm font-medium">
            </td>
            <td class="px-2 py-1">
                <input type="text" name="train_transport[${this.trainIndex}][train_name]" class="train-name-input w-full bg-white border border-[#F3E6C7] rounded-lg px-4 py-2 text-[#1A2B49] text-sm font-medium">
            </td>
            <td class="px-2 py-1">
                <input type="text" name="train_transport[${this.trainIndex}][train_number]" class="train-number-input w-full bg-white border border-[#F3E6C7] rounded-lg px-4 py-2 text-[#1A2B49] text-sm font-medium">
            </td>
            <td class="text-center px-2 py-1">
                <button type="button" class="deleteTrainRowBtn text-red-500 hover:text-red-700"><i class="fa-solid fa-trash"></i></button>
            </td>
        `;
        tbody.appendChild(row);
        this.trainIndex++;
        this.updateTrainRowNumbers();
    }

    updateTrainRowNumbers() {
        const tbody = document.getElementById('trainTransportTbody');
        if (!tbody) return;
        const rows = tbody.querySelectorAll('tr');
        rows.forEach((row, idx) => {
            const noCell = row.querySelector('td');
            if (noCell) noCell.textContent = idx + 1;
            // Update the array index in the name attributes
            const fromInput = row.querySelector('input[name^="train_transport["][name$="[from]"]');
            const nameInput = row.querySelector('input[name^="train_transport["][name$="[train_name]"]');
            const numberInput = row.querySelector('input[name^="train_transport["][name$="[train_number]"]');
            const toInput = row.querySelector('input[name^="train_transport["][name$="[to]"]');
            if (fromInput) fromInput.name = `train_transport[${idx}][from]`;
            if (nameInput) nameInput.name = `train_transport[${idx}][train_name]`;
            if (numberInput) numberInput.name = `train_transport[${idx}][train_number]`;
            if (toInput) toInput.name = `train_transport[${idx}][to]`;
        });
    }
}

// Pathshala Teachers Table Functionality
class TeachersTable {
    constructor() {
        this.teacherIndex = 1;
        this.init();
    }

    init() {
        this.setupAddTeacherButton();
        this.setupDeleteTeacherButtons();
        this.updateTeacherRowNumbers();
    }

    setupAddTeacherButton() {
        const addBtn = document.getElementById('addTeacherRowBtn');
        if (addBtn) {
            addBtn.addEventListener('click', () => this.addTeacherRow());
        }
    }

    setupDeleteTeacherButtons() {
        const tbody = document.getElementById('teachersTbody');
        if (!tbody) return;

        tbody.addEventListener('click', (e) => {
            if (e.target.closest('.deleteTeacherRowBtn')) {
                const row = e.target.closest('tr');
                if (row) {
                    row.remove();
                    this.updateTeacherRowNumbers();
                }
            }
        });
    }

    addTeacherRow() {
        const tbody = document.getElementById('teachersTbody');
        if (!tbody) return;

        const row = document.createElement('tr');
        row.innerHTML = `
            <td class="text-center align-middle">${tbody.querySelectorAll('tr').length + 1}</td>
            <td><input type="text" name="teachers[${this.teacherIndex}][first_name]" class="w-full bg-white border border-[#F3E6C7] rounded-lg px-4 py-2 text-[#1A2B49] text-sm font-medium" required></td>
            <td><input type="text" name="teachers[${this.teacherIndex}][last_name]" class="w-full bg-white border border-[#F3E6C7] rounded-lg px-4 py-2 text-[#1A2B49] text-sm font-medium" required></td>
            <td><input type="email" name="teachers[${this.teacherIndex}][email]" class="w-full bg-white border border-[#F3E6C7] rounded-lg px-4 py-2 text-[#1A2B49] text-sm font-medium" required></td>
            <td><input type="text" name="teachers[${this.teacherIndex}][phone]" class="w-full bg-white border border-[#F3E6C7] rounded-lg px-4 py-2 text-[#1A2B49] text-sm font-medium" required></td>
            <td class="text-center align-middle"><button type="button" class="deleteTeacherRowBtn text-red-500 hover:text-red-700"><i class="fa-solid fa-trash"></i></button></td>
        `;
        tbody.appendChild(row);
        this.teacherIndex++;
        this.updateTeacherRowNumbers();
    }

    updateTeacherRowNumbers() {
        const tbody = document.getElementById('teachersTbody');
        if (!tbody) return;
        const rows = tbody.querySelectorAll('tr');
        rows.forEach((row, idx) => {
            const noCell = row.querySelector('td');
            if (noCell) noCell.textContent = idx + 1;
            // Update the array index in the name attributes
            const firstNameInput = row.querySelector('input[name^="teachers["][name$="[first_name]"]');
            const lastNameInput = row.querySelector('input[name^="teachers["][name$="[last_name]"]');
            const emailInput = row.querySelector('input[name^="teachers["][name$="[email]"]');
            const phoneInput = row.querySelector('input[name^="teachers["][name$="[phone]"]');
            if (firstNameInput) firstNameInput.name = `teachers[${idx}][first_name]`;
            if (lastNameInput) lastNameInput.name = `teachers[${idx}][last_name]`;
            if (emailInput) emailInput.name = `teachers[${idx}][email]`;
            if (phoneInput) phoneInput.name = `teachers[${idx}][phone]`;
        });
    }
}

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    // Initialize stepper
    const stepper = new Stepper();
    
    // Initialize trustees table
    const trusteesTable = new TrusteesTable();

    // Initialize other sangh table
    const otherSanghTable = new OtherSanghTable();

    // Initialize bus transport table
    const busTransportTable = new BusTransportTable();

    // Initialize train transport table
    const trainTransportTable = new TrainTransportTable();

    // Initialize teachers table
    const teachersTable = new TeachersTable();

    // Age-wise Distribution Of Members total calculation
    const ageTable = document.getElementById('ageDistributionTable');
    if (ageTable) {
        // Function to calculate total
        function calculateTotal() {
            const inputs = ageTable.querySelectorAll('input[type="number"]:not([readonly])');
            let total = 0;
            inputs.forEach(input => {
                const value = parseInt(input.value) || 0;
                total += value;
            });
            const totalInput = ageTable.querySelector('input[name="age_group[total]"]');
            if (totalInput) {
                totalInput.value = total;
            }
        }

        // Add input event listeners to all number inputs
        ageTable.querySelectorAll('input[type="number"]:not([readonly])').forEach(input => {
            input.addEventListener('input', calculateTotal);
        });

        // Initial calculation
        calculateTotal();

        // Delete row functionality
        ageTable.addEventListener('click', function(e) {
            if (e.target.closest('.deleteAgeRowBtn')) {
                const tr = e.target.closest('tr');
                // Only delete if not the last row (Total row)
                if (tr.nextElementSibling) {
                    tr.remove();
                    // Update row numbers
                    const rows = ageTable.querySelectorAll('tbody tr');
                    let num = 1;
                    rows.forEach((row, idx) => {
                        const noCell = row.querySelector('td');
                        // Only update if not the last row (Total row)
                        if (idx < rows.length - 1) {
                            if (noCell) noCell.textContent = num++;
                        } else {
                            if (noCell) noCell.textContent = '';
                        }
                    });
                    // Recalculate total after deletion
                    calculateTotal();
                }
            }
        });
    }

    // Pathshala Information toggle Teacher's Details
    const pathshalaSelect = document.querySelector('.pathshala-select');
    const teachersDetailsSection = document.getElementById('teachersDetailsSection');
    if (pathshalaSelect && teachersDetailsSection) {
        function toggleTeachersDetails() {
            if (pathshalaSelect.value === '1') {
                teachersDetailsSection.style.display = '';
            } else {
                teachersDetailsSection.style.display = 'none';
            }
        }
        pathshalaSelect.addEventListener('change', toggleTeachersDetails);
        // Set initial state
        toggleTeachersDetails();
    }

    // Form submission
    const form = document.getElementById('sanghForm');
    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Validate all steps before submission
            if (!stepper.validateAllSteps()) {
                return false;
            }

            const saveBtn = document.getElementById('saveBtn');
            const saveBtnLoader = document.getElementById('saveBtnLoader');

            if (saveBtn && saveBtnLoader) {
                saveBtnLoader.classList.remove('hidden');
                saveBtn.textContent = 'Sending...';
            }
            
            this.submit();
        });
    }
});