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
        <div class="process-wrapper">
            <!-- Progress Bar -->
            <div class="progress-bar">
                <div class="step active">
                    <div class="step-number">1</div>
                    <div class="step-label">Upload Data</div>
                </div>
                <div class="step">
                    <div class="step-number">2</div>
                    <div class="step-label">Preview</div>
                </div>
                <div class="step">
                    <div class="step-number">3</div>
                    <div class="step-label">Choose Analysis</div>
                </div>
                <div class="step">
                    <div class="step-number">4</div>
                    <div class="step-label">Email Setup</div>
                </div>
            </div>

            <!-- Form Steps -->
            <form action="<?= base_url('data-processor/process') ?>" method="POST" enctype="multipart/form-data">
                <!-- Step 1: Upload -->
                <div class="step-content active" id="step1">
                    <h2>Upload Your Dataset</h2>
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
                    <button type="button" class="btn-next" onclick="nextStep(1)">Next</button>
                </div>

                <!-- Step 2: Preview -->
                <div class="step-content" id="step2">
                    <h2>Data Preview</h2>
                    <div class="preview-container">
                        <div class="preview-table">
                            <!-- Table will be populated via JavaScript -->
                        </div>
                    </div>
                    <div class="button-group">
                        <button type="button" class="btn-prev" onclick="prevStep(2)">Previous</button>
                        <button type="button" class="btn-next" onclick="nextStep(2)">Next</button>
                    </div>
                </div>

                <!-- Step 3: Analysis Choice -->
                <div class="step-content" id="step3">
                    <h2>Choose Analysis Type</h2>
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
                            <input type="radio" id="predictive" name="analysisType" value="predictive">
                            <label for="predictive">
                                <div class="card-icon">🤖</div>
                                <h3>Predictive Modeling</h3>
                                <p>Machine learning models for prediction</p>
                            </label>
                        </div>
                    </div>
                    <!-- Conditional Model Selection -->
                    <div id="modelOptions" class="hidden">
                        <h3>Choose Model Type</h3>
                        <div class="model-options">
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
                    <div class="button-group">
                        <button type="button" class="btn-prev" onclick="prevStep(3)">Previous</button>
                        <button type="button" class="btn-next" onclick="nextStep(3)">Next</button>
                    </div>
                </div>

                <!-- Step 4: Email Setup -->
                <div class="step-content" id="step4">
                    <h2>Email Setup</h2>
                    <div class="email-setup">
                        <div class="form-group">
                            <label for="emailChoice">Where should we send the results?</label>
                            <div class="radio-option">
                                <input type="radio" id="registered" name="emailChoice" value="registered" checked>
                                <label for="registered">Use my registered email</label>
                            </div>
                            <div class="radio-option">
                                <input type="radio" id="custom" name="emailChoice" value="custom">
                                <label for="custom">Use different email</label>
                            </div>
                        </div>
                        <div id="customEmailInput" class="form-group hidden">
                            <label for="customEmail">Email Address</label>
                            <input type="email" id="customEmail" name="customEmail" placeholder="Enter email address">
                        </div>
                    </div>
                    <div class="button-group">
                        <button type="button" class="btn-prev" onclick="prevStep(4)">Previous</button>
                        <button type="submit" class="btn-submit">Process Data</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</form>
</body>
</html>