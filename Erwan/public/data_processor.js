// public/js/data_processor.js
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('processorForm');
    const fileInput = document.getElementById('dataFile');
    const uploadSection = document.getElementById('uploadSection');
    const previewSection = document.getElementById('previewSection');
    const fileName = document.getElementById('fileName');
    const previewTable = document.getElementById('previewTable');
    const submitBtn = document.getElementById('submitBtn');
    const predictiveRadio = document.getElementById('predictive');
    const modelOptions = document.getElementById('modelOptions');
    const analysisError = document.getElementById('analysisError');
    const customEmailRadio = document.getElementById('custom');
    const customEmailInput = document.getElementById('customEmailInput');

    // Handle file selection
    fileInput.addEventListener('change', handleFileUpload);

    // Handle drag and drop
    const uploadBox = document.querySelector('.upload-box');
    uploadBox.addEventListener('dragover', (e) => {
        e.preventDefault();
        uploadBox.style.borderColor = '#2196f3';
    });

    uploadBox.addEventListener('dragleave', (e) => {
        e.preventDefault();
        uploadBox.style.borderColor = '#ddd';
    });

    uploadBox.addEventListener('drop', (e) => {
        e.preventDefault();
        uploadBox.style.borderColor = '#ddd';
        const files = e.dataTransfer.files;
        if (files.length) {
            fileInput.files = files;
            handleFileUpload({ target: fileInput });
        }
    });

    // Handle analysis type selection
    predictiveRadio.addEventListener('change', () => {
        modelOptions.classList.toggle('hidden', !predictiveRadio.checked);
        validateForm();
    });

    // Handle email choice
    customEmailRadio.addEventListener('change', () => {
        customEmailInput.classList.toggle('hidden', !customEmailRadio.checked);
        validateForm();
    });

    // Form submission
    form.addEventListener('submit', (e) => {
        e.preventDefault();
        if (!validateForm()) {
            return;
        }
        // Here you would typically send the data to your server
        console.log('Form submitted successfully');
    });

    function handleFileUpload(event) {
        const file = event.target.files[0];
        if (!file) return;

        // Validate file type
        const validTypes = [
            'application/vnd.ms-excel',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'text/csv'
        ];
        
        if (!validTypes.includes(file.type) && 
            !file.name.endsWith('.csv') && 
            !file.name.endsWith('.xlsx') && 
            !file.name.endsWith('.xls')) {
            alert('Please upload a valid CSV or Excel file');
            return;
        }

        // Update UI
        fileName.textContent = file.name;
        uploadSection.classList.add('hidden');
        previewSection.classList.remove('hidden');

        // Read and preview file
        if (file.name.endsWith('.csv')) {
            const reader = new FileReader();
            reader.onload = (e) => {
                const text = e.target.result;
                displayCSVPreview(text);
            };
            reader.readAsText(file);
        } else {
            // For Excel files, you would typically send to server
            // Here we'll just show a placeholder message
            previewTable.innerHTML = '<tr><td>Excel preview will be processed server-side</td></tr>';
        }

        validateForm();
    }

    function displayCSVPreview(csv) {
        const rows = csv.split('\n');
        if (rows.length === 0) return;

        const headers = rows[0].split(',');
        let html = '<thead><tr>';
        headers.forEach(header => {
            html += `<th>${header.trim()}</th>`;
        });
        html += '</tr></thead><tbody>';

        // Show first 5 rows
        const previewRows = rows.slice(1, 6);
        previewRows.forEach(row => {
            html += '<tr>';
            row.split(',').forEach(cell => {
                html += `<td>${cell.trim()}</td>`;
            });
            html += '</tr>';
        });
        html += '</tbody>';

        previewTable.innerHTML = html;

        // Check for 'label' column if predictive modeling is selected
        const hasLabelColumn = headers.some(header => 
            header.trim().toLowerCase() === 'label'
        );
        analysisError.classList.toggle('hidden', hasLabelColumn || !predictiveRadio.checked);
        validateForm();
    }

    function resetUpload() {
        fileInput.value = '';
        uploadSection.classList.remove('hidden');
        previewSection.classList.add('hidden');
        validateForm();
    }

    function validateForm() {
        const file = fileInput.files[0];
        const analysisType = document.querySelector('input[name="analysisType"]:checked');
        const modelType = document.querySelector('input[name="modelType"]:checked');
        const emailChoice = document.querySelector('input[name="emailChoice"]:checked');
        const customEmail = document.getElementById('customEmail');

        let isValid = true;

        // Check if file is uploaded
        if (!file) isValid = false;

        // Check if analysis type is selected
        if (!analysisType) isValid = false;

        // If predictive is selected, check if model type is selected
        if (predictiveRadio.checked) {
            if (!modelType) isValid = false;
        }
        // Check if email choice is selected and valid if custom email is chosen
        if (emailChoice.value === 'custom' && !customEmail.value) {
            isValid = false;
        }

        // Enable or disable the submit button based on form validity
        submitBtn.disabled = !isValid;
        return isValid;
    }
});