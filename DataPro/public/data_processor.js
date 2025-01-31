// public/js/data_processor.js

class DataProcessor {
    constructor() {
        this.initializeElements();
        this.initializeEventListeners();
        this.fileTypes = {
            'csv': 'text/csv',
            'xlsx': 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'xls': 'application/vnd.ms-excel'
        };
    }

    initializeElements() {
        // Form elements
        this.form = document.querySelector('form');
        this.fileInput = document.getElementById('dataFile');
        this.submitBtn = document.querySelector('.btn-submit');

        // Sections
        this.uploadSection = document.getElementById('uploadSection');
        this.previewSection = document.getElementById('previewSection');
        this.uploadBox = document.querySelector('.upload-box');

        // Analysis options
        this.predictiveRadio = document.getElementById('predictive');
        this.modelOptions = document.getElementById('modelOptions');
        this.analysisError = document.getElementById('analysisError');

        // Email options
        this.registeredRadio = document.getElementById('registered');
        this.customRadio = document.getElementById('custom');
        this.customEmailInput = document.getElementById('customEmailInput');

        // Preview elements
        this.fileNameElement = document.getElementById('fileName');
        this.previewTable = document.querySelector('.preview-table');
    }

    initializeEventListeners() {
        // File handling
        this.fileInput.addEventListener('change', this.handleFileUpload.bind(this));

        // Drag and drop
        this.uploadBox.addEventListener('dragover', this.handleDragOver.bind(this));
        this.uploadBox.addEventListener('dragleave', this.handleDragLeave.bind(this));
        this.uploadBox.addEventListener('drop', this.handleDrop.bind(this));

        // Analysis type
        this.predictiveRadio.addEventListener('change', () => {
            this.toggleModelOptions();
            this.validateForm();
        });

        // Email choice
        this.customRadio.addEventListener('change', () => {
            this.toggleCustomEmail();
            this.validateForm();
        });

        // Form submission
        this.form.addEventListener('submit', this.handleSubmit.bind(this));

        // Reset button
        const resetBtn = document.querySelector('.btn-change');
        if (resetBtn) {
            resetBtn.addEventListener('click', this.resetUpload.bind(this));
        }
    }

    handleDragOver(e) {
        e.preventDefault();
        this.uploadBox.style.borderColor = '#3498db';
    }

    handleDragLeave(e) {
        e.preventDefault();
        this.uploadBox.style.borderColor = '#ddd';
    }

    handleDrop(e) {
        e.preventDefault();
        this.uploadBox.style.borderColor = '#ddd';

        const files = e.dataTransfer.files;
        if (files.length) {
            this.fileInput.files = files;
            this.handleFileUpload({ target: this.fileInput });
        }
    }

    isValidFileType(file) {
        const extension = file.name.split('.').pop().toLowerCase();
        return (
            Object.values(this.fileTypes).includes(file.type) ||
            ['csv', 'xlsx', 'xls'].includes(extension)
        );
    }

    async handleFileUpload(event) {
        const file = event.target.files[0];
        if (!file) return;

        if (!this.isValidFileType(file)) {
            alert('Please upload a valid CSV or Excel file');
            return;
        }

        // Update UI
        this.fileNameElement.textContent = file.name;
        this.uploadSection.classList.add('hidden');
        this.previewSection.classList.remove('hidden');

        try {
            if (file.name.toLowerCase().endsWith('.csv')) {
                const text = await this.readFileAsText(file);
                this.displayCSVPreview(text);
            } else {
                // Excel preview placeholder
                this.previewTable.innerHTML = '<div class="p-4 text-gray-600">Excel preview will be processed server-side</div>';
            }
        } catch (error) {
            console.error('Error processing file:', error);
            alert('Error processing file. Please try again.');
            this.resetUpload();
        }

        this.validateForm();
    }

    readFileAsText(file) {
        return new Promise((resolve, reject) => {
            const reader = new FileReader();
            reader.onload = (e) => resolve(e.target.result);
            reader.onerror = (e) => reject(e);
            reader.readAsText(file);
        });
    }

    displayCSVPreview(csv) {
        const rows = csv.split('\n').filter(row => row.trim());
        if (rows.length === 0) return;

        const headers = rows[0].split(',').map(header => header.trim());
        let tableHTML = this.generateTableHeader(headers);
        tableHTML += this.generateTableBody(rows.slice(1, 6), headers.length);

        this.previewTable.innerHTML = tableHTML;

        // Check for 'label' column if predictive modeling is selected
        const hasLabelColumn = headers.some(header =>
            header.toLowerCase() === 'label'
        );
        this.analysisError.classList.toggle('hidden', hasLabelColumn || !this.predictiveRadio.checked);
        this.validateForm();
    }

    generateTableHeader(headers) {
        return `
            <table class="w-full">
                <thead>
                    <tr>
                        ${headers.map(header => `<th class="p-2 border text-left">${header}</th>`).join('')}
                    </tr>
                </thead>`;
    }

    generateTableBody(rows, columnCount) {
        return `
                <tbody>
                    ${rows.map(row => `
                        <tr>
                            ${row.split(',', columnCount)
                .map(cell => `<td class="p-2 border">${cell.trim()}</td>`)
                .join('')}
                        </tr>
                    `).join('')}
                </tbody>
            </table>`;
    }

    toggleModelOptions() {
        this.modelOptions.classList.toggle('hidden', !this.predictiveRadio.checked);
    }

    toggleCustomEmail() {
        this.customEmailInput.classList.toggle('hidden', !this.customRadio.checked);
    }

    resetUpload() {
        this.fileInput.value = '';
        this.uploadSection.classList.remove('hidden');
        this.previewSection.classList.add('hidden');
        this.validateForm();
    }

    validateForm() {
        const file = this.fileInput.files[0];
        const analysisType = document.querySelector('input[name="analysisType"]:checked');
        const modelType = document.querySelector('input[name="modelType"]:checked');
        const customEmail = document.getElementById('customEmail');

        const conditions = {
            hasFile: !!file,
            hasAnalysisType: !!analysisType,
            validModelType: !this.predictiveRadio.checked || (this.predictiveRadio.checked && modelType),
            validEmail: !this.customRadio.checked || (this.customRadio.checked && customEmail?.value)
        };

        const isValid = Object.values(conditions).every(condition => condition);
        this.submitBtn.disabled = !isValid;
        return isValid;
    }

    handleSubmit(e) {
        e.preventDefault();
        if (!this.validateForm()) return;

        const formData = new FormData(this.form);
        const requestBody = new FormData();

        requestBody.append('file', formData.get('dataFile'));
        if (formData.get('analysisType') == 'statistical')
            requestBody.append('type', 'stats');

        console.log("PROCESSING");
        fetch('/upload-file', {
            method: 'POST',
            body: requestBody,
        })
            .then(response => {
                console.log('Response status:', response.status);
                return response.json();
            })
            .then(data => {
                console.log("Response from PHP controller:", data);
            })
            .catch(error => {
                console.error("Error:", error);
            });

    }
}

// Initialize the processor when the DOM is ready
document.addEventListener('DOMContentLoaded', () => {
    new DataProcessor();
});