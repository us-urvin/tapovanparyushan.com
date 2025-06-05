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
    }

    updateStepperUI() {
        const steps = document.querySelectorAll('.stepper-step');
        steps.forEach((step, index) => {
            const stepNumber = index + 1;
            const stepCircle = step.querySelector('.step-circle');
            const stepText = step.querySelector('.step-text');
            const stepDot = step.querySelector('.step-circle .rounded-full');
            const stepLine = step.nextElementSibling && step.nextElementSibling.classList.contains('step-line')
                ? step.nextElementSibling
                : null;

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
        const stepContents = document.querySelectorAll('.step-content');
        stepContents.forEach((content, index) => {
            if (index + 1 === stepNumber) {
                content.classList.remove('hidden');
            } else {
                content.classList.add('hidden');
            }
        });
    }

    setupNavigationButtons() {
        const prevButtons = document.querySelectorAll('.prev-step');
        prevButtons.forEach(btn => {
            btn.addEventListener('click', () => {
                if (this.currentStep > 1) {
                    this.goToStep(this.currentStep - 1);
                }
            });
        });

        const nextButtons = document.querySelectorAll('.next-step');
        nextButtons.forEach(btn => {
            btn.addEventListener('click', () => {
                if (this.currentStep < this.totalSteps) {
                    // Validate current step before proceeding
                    let stepContents = document.querySelectorAll('.step-content');
                    let currentStepContent = stepContents[this.currentStep - 1];
                    if (!currentStepContent) return;

                    // Get all inputs in the current step
                    let inputs = currentStepContent.querySelectorAll('input:not([type="checkbox"]), select, textarea');
                    let isValid = true;
                    let firstInvalidInput = null;

                    // Check if pathshala is "No"
                    const pathshalaSelect = currentStepContent.querySelector('.pathshala-select');
                    const isPathshalaNo = pathshalaSelect && pathshalaSelect.value === 'No';

                    // Check if other sangh exists is "No"
                    const otherSanghSelect = currentStepContent.querySelector('.other-sangh-exists-select');
                    const isOtherSanghNo = otherSanghSelect && otherSanghSelect.value === 'No';

                    inputs.forEach(input => {
                        // Skip validation for pathshala fields if "No" is selected
                        if (isPathshalaNo && input.closest('#teachersDetailsSection')) {
                            return;
                        }

                        // Skip validation for other sangh fields if "No" is selected
                        if (isOtherSanghNo && input.closest('#otherSanghTableSection')) {
                            return;
                        }

                        // Find the label for this input
                        let label = currentStepContent.querySelector(`label[for="${input.id}"]`) || 
                                    input.closest('div').querySelector('label');
                        
                        // Check if the label contains an asterisk
                        let isRequired = label && label.innerHTML.includes('<span class="text-red-500">*</span>');
                        
                        // For table rows, check if the column header has an asterisk
                        if (!isRequired && input.closest('td')) {
                            let table = input.closest('table');
                            let columnIndex = Array.from(input.closest('tr').children).indexOf(input.closest('td'));
                            let headerCell = table.querySelector(`thead th:nth-child(${columnIndex + 1})`);
                            if (headerCell && headerCell.innerHTML.includes('<span class="text-red-500">*</span>')) {
                                isRequired = true;
                            }
                        }

                        // Validate the input
                        if (isRequired && !input.value.trim()) {
                            isValid = false;
                            input.classList.add('border-red-500');
                            if (!firstInvalidInput) firstInvalidInput = input;
                        } else {
                            input.classList.remove('border-red-500');
                        }
                    });

                    if (!isValid) {
                        firstInvalidInput?.focus();
                        return;
                    }

                    this.goToStep(this.currentStep + 1);
                }
            });
        });

        // Add input event listeners to remove red border when user starts typing
        document.querySelectorAll('input:not([type="checkbox"]), select, textarea').forEach(input => {
            input.addEventListener('input', () => {
                input.classList.remove('border-red-500');
            });
        });
    }
}

// Trustees table functionality
class TrusteesTable {
    constructor() {
        this.trusteeIndex = 1;
        this.init();
    }

    init() {
        this.setupAddTrusteeButton();
        this.setupDeleteTrusteeButtons();
    }

    setupAddTrusteeButton() {
        const addButton = document.getElementById('addTrusteeBtn');
        if (addButton) {
            addButton.addEventListener('click', () => this.addTrusteeRow());
        }
    }

    setupDeleteTrusteeButtons() {
        const tbody = document.getElementById('trusteesTbody');
        if (tbody) {
            tbody.addEventListener('click', (e) => {
                if (e.target.closest('.deleteTrusteeBtn')) {
                    e.target.closest('tr').remove();
                    this.updateTrusteeRowNumbers();
                }
            });
        }
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
        });
    }
}

// Transportation Table Functionality for Step 3
class TransportationTable {
    constructor() {
        this.busRowIndex = 1;
        this.trainRowIndex = 1;
        this.init();
    }

    init() {
        this.setupAddBusRowButton();
        this.setupDeleteBusRowButton();
        this.setupAddTrainRowButton();
        this.setupDeleteTrainRowButton();
        this.setupEditBusRowButton();
        this.setupEditTrainRowButton();
    }

    setupAddBusRowButton() {
        const addBtn = document.getElementById('addBusRowBtn');
        const tbody = document.getElementById('busTransportTbody');
        if (addBtn && tbody) {
            addBtn.addEventListener('click', () => {
                this.busRowIndex = tbody.querySelectorAll('tr').length + 1;
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td class="align-middle row-index px-2 py-1">${this.busRowIndex}</td>
                    <td class="px-2 py-1"><input type="text" name="bus_from[]" class="bus-from-input w-full bg-white border border-[#F3E6C7] rounded-lg px-4 py-2 text-[#1A2B49] text-sm font-medium"></td>
                    <td class="px-2 py-1"><input type="text" name="bus_to[]" class="bus-to-input w-full bg-white border border-[#F3E6C7] rounded-lg px-4 py-2 text-[#1A2B49] text-sm font-medium"></td>
                    <td class="text-center px-2 py-1">
                        <button type="button" class="deleteBusRowBtn text-red-500 hover:text-red-700"><i class="fa-solid fa-trash"></i></button>
                    </td>
                `;
                tbody.appendChild(row);
                this.updateRowIndexes(tbody);
            });
        }
    }

    setupDeleteBusRowButton() {
        const tbody = document.getElementById('busTransportTbody');
        if (tbody) {
            tbody.addEventListener('click', (e) => {
                if (e.target.closest('.deleteBusRowBtn')) {
                    e.target.closest('tr').remove();
                    this.updateRowIndexes(tbody);
                }
            });
        }
    }

    setupEditBusRowButton() {
        const tbody = document.getElementById('busTransportTbody');
        if (tbody) {
            tbody.addEventListener('click', (e) => {
                if (e.target.closest('.editBusRowBtn')) {
                    const tr = e.target.closest('tr');
                    const inputs = tr.querySelectorAll('input[type="text"]');
                    inputs.forEach(input => input.focus());
                }
            });
        }
    }

    setupAddTrainRowButton() {
        const addBtn = document.getElementById('addTrainRowBtn');
        const tbody = document.getElementById('trainTransportTbody');
        if (addBtn && tbody) {
            addBtn.addEventListener('click', () => {
                this.trainRowIndex = tbody.querySelectorAll('tr').length + 1;
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td class="align-middle row-index px-2 py-1">${this.trainRowIndex}</td>
                    <td class="px-2 py-1"><input type="text" name="train_from[]" class="train-from-input w-full bg-white border border-[#F3E6C7] rounded-lg px-4 py-2 text-[#1A2B49] text-sm font-medium"></td>
                    <td class="px-2 py-1"><input type="text" name="train_name[]" class="train-name-input w-full bg-white border border-[#F3E6C7] rounded-lg px-4 py-2 text-[#1A2B49] text-sm font-medium"></td>
                    <td class="px-2 py-1"><input type="text" name="train_to[]" class="train-to-input w-full bg-white border border-[#F3E6C7] rounded-lg px-4 py-2 text-[#1A2B49] text-sm font-medium"></td>
                    <td class="text-center px-2 py-1">
                        <button type="button" class="deleteTrainRowBtn text-red-500 hover:text-red-700"><i class="fa-solid fa-trash"></i></button>
                    </td>
                `;
                tbody.appendChild(row);
                this.updateRowIndexes(tbody);
            });
        }
    }

    setupDeleteTrainRowButton() {
        const tbody = document.getElementById('trainTransportTbody');
        if (tbody) {
            tbody.addEventListener('click', (e) => {
                if (e.target.closest('.deleteTrainRowBtn')) {
                    e.target.closest('tr').remove();
                    this.updateRowIndexes(tbody);
                }
            });
        }
    }

    setupEditTrainRowButton() {
        const tbody = document.getElementById('trainTransportTbody');
        if (tbody) {
            tbody.addEventListener('click', (e) => {
                if (e.target.closest('.editTrainRowBtn')) {
                    const tr = e.target.closest('tr');
                    const inputs = tr.querySelectorAll('input[type="text"]');
                    inputs.forEach(input => input.focus());
                }
            });
        }
    }

    updateRowIndexes(tbody) {
        const rows = tbody.querySelectorAll('tr');
        rows.forEach((row, idx) => {
            const indexCell = row.querySelector('.row-index');
            if (indexCell) indexCell.textContent = idx + 1;
        });
    }
}

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    // Initialize stepper
    const stepper = new Stepper();
    
    // Initialize trustees table
    const trusteesTable = new TrusteesTable();

    // Initialize transportation table for step 3
    new TransportationTable();

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
            if (pathshalaSelect.value === 'Yes') {
                teachersDetailsSection.style.display = '';
            } else {
                teachersDetailsSection.style.display = 'none';
            }
        }
        pathshalaSelect.addEventListener('change', toggleTeachersDetails);
        // Set initial state
        toggleTeachersDetails();
    }

    // Other Sangh Information add/delete row functionality
    const otherSanghTbody = document.getElementById('otherSanghTbody');
    const addOtherSanghRowBtn = document.getElementById('addOtherSanghRowBtn');
    if (otherSanghTbody && addOtherSanghRowBtn) {
        addOtherSanghRowBtn.addEventListener('click', () => {
            const rowCount = otherSanghTbody.querySelectorAll('tr').length + 1;
            const row = document.createElement('tr');
            row.innerHTML = `
                <td class="text-center align-middle px-2 py-1">${rowCount}</td>
                <td class="px-2 py-1">
                    <select name="other_sangh_particulars[]" class="w-full bg-white border border-[#F3E6C7] rounded-lg px-4 py-2 text-[#1A2B49] text-sm font-medium">
                        <option value="Shanahavaksi">Shanahavaksi</option>
                    </select>
                </td>
                <td class="px-2 py-1">
                    <input type="number" name="other_sangh_family_count[]" placeholder="No. of jain families" class="w-full bg-white border border-[#F3E6C7] rounded-lg px-4 py-2 text-[#1A2B49] text-sm font-medium">
                </td>
                <td class="px-2 py-1">
                    <input type="number" name="other_sangh_member_count[]" placeholder="No. of members" class="w-full bg-white border border-[#F3E6C7] rounded-lg px-4 py-2 text-[#1A2B49] text-sm font-medium">
                </td>
                <td class="text-center px-2 py-1">
                    <button type="button" class="deleteOtherSanghRowBtn text-red-500 hover:text-red-700"><i class="fa-solid fa-trash"></i></button>
                </td>
            `;
            otherSanghTbody.appendChild(row);
            updateOtherSanghRowNumbers();
        });
        otherSanghTbody.addEventListener('click', (e) => {
            if (e.target.closest('.deleteOtherSanghRowBtn')) {
                e.target.closest('tr').remove();
                updateOtherSanghRowNumbers();
            }
        });
        function updateOtherSanghRowNumbers() {
            const rows = otherSanghTbody.querySelectorAll('tr');
            rows.forEach((row, idx) => {
                const noCell = row.querySelector('td');
                if (noCell) noCell.textContent = idx + 1;
            });
        }
    }

    // Other Sangh Information show/hide table based on dropdown
    const otherSanghExistsSelect = document.querySelector('.other-sangh-exists-select');
    const otherSanghTableSection = document.getElementById('otherSanghTableSection');
    if (otherSanghExistsSelect && otherSanghTableSection) {
        function toggleOtherSanghTable() {
            if (otherSanghExistsSelect.value === 'Yes') {
                otherSanghTableSection.style.display = '';
            } else {
                otherSanghTableSection.style.display = 'none';
            }
        }
        otherSanghExistsSelect.addEventListener('change', toggleOtherSanghTable);
        // Set initial state
        toggleOtherSanghTable();
    }
}); 