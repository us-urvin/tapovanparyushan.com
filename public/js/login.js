class LoginHandler {
    constructor() {
        this.form = document.getElementById('shanghLoginForm');
        this.pincodeInput = document.getElementById('pincode');
        this.userInfo = document.getElementById('userInfo');
        this.pincodeError = document.getElementById('pincodeError');
        this.sendOtpBtn = document.getElementById('sendOtpBtn');
        this.districtDropdown = document.getElementById('districtDropdown');
        this.sanghDropdown = document.getElementById('sanghDropdown');
        this.pincodeInputWrapper = document.getElementById('pincodeInputWrapper');
        this.districtDropdownWrapper = document.getElementById('districtDropdownWrapper');
        this.sanghDropdownWrapper = document.getElementById('sanghDropdownWrapper');
        this.searchByPincodeRadio = document.getElementById('searchByPincode');
        this.searchByCityRadio = document.getElementById('searchByCity');
        this.toggleHandle = document.getElementById('toggleHandle');
        this.districtError = document.getElementById('districtError');
        this.sanghError = document.getElementById('sanghError');
        
        this.init();
        this.initDropdowns();
        this.initSearchModeToggle();
        
        this.pincodeInput.addEventListener('input', async (e) => {
            const pincode = e.target.value.trim();
            this.pincodeError.textContent = '';
            this.pincodeError.classList.add('hidden');
            if (!pincode) {
                this.hideSanghDropdown();
                return;
            }
            try {
                const res = await fetch(`/login/sanghs-by-pincode?pincode=${encodeURIComponent(pincode)}`);
                const sanghs = await res.json();
                if (Array.isArray(sanghs) && sanghs.length > 0) {
                    this.populateSanghDropdown(sanghs);
                } else {
                    this.hideSanghDropdown();
                    this.pincodeError.textContent = 'No Sangh found for this pincode! Please register your sangh.';
                    this.pincodeError.classList.remove('hidden');
                }
            } catch (err) {
                this.hideSanghDropdown();
                this.pincodeError.textContent = 'No Sangh found for this pincode! Please register your sangh.';
                this.pincodeError.classList.remove('hidden');
            }
        });
    }

    init() {
        this.form.addEventListener('submit', this.handleSubmit.bind(this));
    }

    handleSubmit(e) {
        e.preventDefault();
        this.pincodeError.classList.add('hidden');
        this.districtError.textContent = '';
        this.sanghError.textContent = '';

        const mobile = document.getElementById('mobileInfo').textContent.trim();

        if (this.searchByPincodeRadio.checked) {
            if (!this.pincodeInput.value.trim()) {
                this.showError(this.pincodeError, 'Pincode is required.');
                return;
            }
        } else {
            if (!$(this.districtDropdown).val()) {
                this.showError(this.districtError, 'Please select a City/Village.');
                return;
            }
        }

        if (!this.sanghDropdown.value) {
            this.showError(this.sanghError, 'Please select a Sangh.');
            return;
        }
        
        if (!mobile) {
            this.showError(this.sanghError, 'Could not retrieve Sangh details. Please select again.');
            return;
        }

        document.getElementById('hiddenMobile').value = mobile;
        const loader = document.getElementById('sendOtpBtnLoader');
        const text = document.getElementById('sendOtpBtnText');
        this.sendOtpBtn.disabled = true;
        loader.classList.remove('hidden');
        text.textContent = 'Sending...';
        this.form.submit();
    }

    initSearchModeToggle() {
        const pincodeLabel = document.querySelector('label[for="searchByPincode"]');
        const cityLabel = document.querySelector('label[for="searchByCity"]');

        const moveHandle = () => {
            if (this.searchByPincodeRadio.checked) {
                this.toggleHandle.style.width = `${pincodeLabel.offsetWidth}px`;
                this.toggleHandle.style.left = `${pincodeLabel.offsetLeft}px`;
            } else {
                this.toggleHandle.style.width = `${cityLabel.offsetWidth}px`;
                this.toggleHandle.style.left = `${cityLabel.offsetLeft}px`;
            }
        };

        this.searchByPincodeRadio.addEventListener('change', () => {
            if (this.searchByPincodeRadio.checked) {
                this.pincodeInputWrapper.classList.remove('hidden');
                this.hideAnimated(this.districtDropdownWrapper);
                this.hideSanghDropdown();
                this.hideUserInfo();
                moveHandle();
            }
        });

        this.searchByCityRadio.addEventListener('change', () => {
            if (this.searchByCityRadio.checked) {
                this.pincodeInputWrapper.classList.add('hidden');
                this.showAnimated(this.districtDropdownWrapper);
                this.hideSanghDropdown();
                this.hideUserInfo();
                $(this.districtDropdown).val(null).trigger('change');
                moveHandle();
            }
        });

        // Set initial state after a short delay to ensure correct rendering
        setTimeout(() => {
            moveHandle();
        }, 100);

        // Recalculate on window resize to maintain layout
        window.addEventListener('resize', moveHandle);
    }

    showAnimated(element) {
        if (!element) return;
        element.classList.remove('hidden');
        setTimeout(() => {
            element.classList.add('visible');
        }, 10);
    }

    hideAnimated(element) {
        if (!element || !element.classList.contains('visible')) return;
        
        const transitionEnded = () => {
            element.classList.add('hidden');
            element.removeEventListener('transitionend', transitionEnded);
        };
        
        element.classList.remove('visible');
        element.addEventListener('transitionend', transitionEnded);
    }

    async initDropdowns() {
        $(this.districtDropdown).select2({
            placeholder: 'Select City/Village',
            width: '100%',
            allowClear: true
        });
        $(this.sanghDropdown).select2({
            placeholder: 'Select Sangh',
            width: '100%',
            allowClear: true
        });

        const res = await fetch('/login/districts');
        const districts = await res.json();
        const districtOptions = districts.map(d => `<option value="${d}">${d}</option>`).join('');
        this.districtDropdown.innerHTML = '<option></option>' + districtOptions;

        $(this.districtDropdown).on('change', async (e) => {
            this.districtError.textContent = '';
            const district = e.target.value;
            if (!district) {
                this.hideSanghDropdown();
                return;
            }
            const res = await fetch(`/login/sanghs?district=${encodeURIComponent(district)}`);
            const result = await res.json();
            const sanghs = Array.isArray(result) ? result : result.data;
            this.populateSanghDropdown(sanghs);
        });

        $(this.sanghDropdown).on('change', async (e) => {
            this.sanghError.textContent = '';
            const selectedId = e.target.value;
            if (selectedId) {
                this.showUserInfo(selectedId);
            } else {
                this.hideUserInfo();
            }
        });
    }

    populateSanghDropdown(sanghs) {
        const sanghOptions = sanghs.map(s => `<option value="${s.id}">${s.sangh_name}</option>`).join('');
        this.sanghDropdown.innerHTML = '<option></option>' + sanghOptions;
        this.sanghDropdown.disabled = false;
        this.showAnimated(this.sanghDropdownWrapper);
        $(this.sanghDropdown).val(null).trigger('change');
    }

    hideSanghDropdown() {
        this.sanghDropdown.innerHTML = '<option></option>';
        this.sanghDropdown.disabled = true;
        this.hideAnimated(this.sanghDropdownWrapper);
        $(this.sanghDropdown).val(null).trigger('change');
        this.hideUserInfo();
    }

    async showUserInfo(sanghId) {
        try {
            const res = await fetch(`/login/sangh-info?id=${sanghId}`);
            const data = await res.json();
            if (data.success) {
                document.getElementById('shanghName').textContent = data.data.sangh_name;
                document.getElementById('trusteeName').textContent = data.data.trustee_name;
                document.getElementById('email').textContent = data.data.email;
                document.getElementById('mobileInfo').textContent = data.data.mobile;
                this.userInfo.classList.remove('hidden');
                
                const items = this.userInfo.querySelectorAll('.info-item');
                items.forEach((item, index) => {
                    setTimeout(() => {
                        item.classList.add('visible');
                    }, index * 100);
                });
            } else {
                this.hideUserInfo();
            }
        } catch (err) {
            this.hideUserInfo();
        }
    }

    hideUserInfo() {
        this.userInfo.classList.add('hidden');
        this.userInfo.querySelectorAll('.info-item').forEach(item => {
            item.classList.remove('visible');
        });
    }

    showError(element, message) {
        element.textContent = message;
        element.classList.remove('hidden');
    }
}

document.addEventListener('DOMContentLoaded', () => {
    new LoginHandler();
}); 