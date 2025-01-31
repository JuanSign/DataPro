<!-- app/Views/data_processor.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Processor - DataPro</title>
    <link rel="stylesheet" href="<?= base_url('/styles/data_processor.css') ?>">
</head>

<body>
    <div class="container">
        <form action="<?= base_url('data-processor/process') ?>" method="POST" enctype="multipart/form-data">
            <div class="split-layout">
                <!-- Left Section -->
                <div class="left-panel">
                    <div class="panel-content">
                        <h2>Dataset</h2>
                        <!-- Upload Section (shown by default) -->
                        <div id="uploadSection" class="upload-section">
                            <div class="upload-box">
                                <input type="file" id="dataFile" name="dataFile" accept=".csv,.xlsx,.xls" required>
                                <label for="dataFile">
                                    <div class="upload-icon">📤</div>
                                    <div class="upload-text">
                                        <span class="primary">Click to upload</span> or drag and drop
                                        <span class="secondary">CSV or Excel files supported</span>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <!-- Preview Section (hidden initially) -->
                        <div id="previewSection" class="preview-section hidden">
                            <div class="file-info">
                                <h3>Uploaded File: <span id="fileName">No file selected</span></h3>
                                <button type="button" class="btn-change">Change File</button>
                            </div>
                            <div class=" preview-container">
                                <div class="preview-table">
                                    <!-- Table will be populated via JavaScript -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Section -->
                <div class="right-panel">
                    <div class="panel-content">
                        <!-- Analysis Options -->
                        <div class="analysis-section">
                            <h2>Processing Options</h2>
                            <div id="analysisError" class="error-message hidden">
                                For predictive modeling (regression/classification), your dataset must include a 'label' column.
                            </div>
                            <div class="analysis-options">
                                <div class="analysis-card">
                                    <input type="radio" id="statistical" name="analysisType" value="statistical">
                                    <label for="statistical">
                                        <div class="card-icon">📊</div>
                                        <h3>Statistical Analysis</h3>
                                        <p>Comprehensive statistical testing and analysis</p>
                                    </label>
                                </div>
                                <div class="analysis-card">
                                    <input type="radio" id="predictive" name="analysisType" value="predictive" disabled>
                                    <label for="predictive">
                                        <div class="card-icon">🤖</div>
                                        <h3>Predictive Modeling</h3>
                                        <p>Machine learning models for prediction</p>
                                    </label>
                                </div>
                            </div>

                            <!-- Model Options (hidden initially) -->
                            <div id="modelOptions" class="model-options hidden">
                                <h3>Model Type</h3>
                                <div class="radio-group">
                                    <div class="radio-option">
                                        <input type="radio" id="regression" name="modelType" value="regression">
                                        <label for="regression">Regression</label>
                                    </div>
                                    <div class="radio-option">
                                        <input type="radio" id="classification" name="modelType" value="classification">
                                        <label for="classification">Classification</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Email Setup -->
                        <div class="email-section">
                            <h2>Results Delivery</h2>
                            <div class="form-group">
                                <div class="radio-group">
                                    <div class="radio-option">
                                        <input type="radio" id="registered" name="emailChoice" value="registered" checked>
                                        <label for="registered">Use my registered email</label>
                                    </div>
                                    <div class="radio-option">
                                        <input type="radio" id="custom" name="emailChoice" value="custom" disabled>
                                        <label for="custom">Use different email</label>
                                    </div>
                                </div>
                                <div id="customEmailInput" class="custom-email hidden">
                                    <input type="email" id="customEmail" name="customEmail" placeholder="Enter email address">
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="submit-section">
                            <button type="submit" class="btn-submit" disabled>Process Data</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script src="<?= base_url('/data_processor.js') ?>"></script>
</body>

</html>