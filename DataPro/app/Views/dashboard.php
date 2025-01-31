<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DataPro - Simplify Your Data Journey</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Montserrat', sans-serif;
        }

        body {
            background: white;
            min-height: 90vh;
            display: flex;
            flex-direction: column;
        }

        .main-content {
            flex: 1;
            display: flex;
            padding: 2vh 7vw;
            gap: 4vw;
            align-items: center;
        }

        .left-section {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 3vh;
        }

        .dataprogif {
            max-width: 50%;
            height: auto;
        }

        .description {
            font-size: 1.2rem;
            color: #666;
            line-height: 1.6;
            max-width: 600px;
        }

        .cta-button {
            display: inline-block;
            padding: 12px 30px;
            background-color: #2196F3;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            transition: background-color 0.3s ease;
            border: none;
            cursor: pointer;
            width: fit-content;
        }

        .cta-button:hover {
            background-color: #1976D2;
        }

        .right-section {
            flex: 1;
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            align-content: center;
        }

        .feature-card {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .feature-card i {
            font-size: 2rem;
            color: #2196F3;
            margin-bottom: 15px;
        }

        .feature-card h3 {
            color: #333;
            margin-bottom: 10px;
            font-size: 1.1rem;
        }

        .feature-card p {
            color: #666;
            font-size: 0.9rem;
            line-height: 1.5;
        }

        @media (max-width: 1024px) {
            .main-content {
                flex-direction: column;
                padding: 4vh 4vw;
            }

            .right-section {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
    <main class="main-content">
        <div class="left-section">
            <!-- <video class="dataprogif" autoplay loop muted style="max-width: 100%; height: auto;">
                <source src="dataprogif.mp4" type="video/mp4">
                Your browser does not support the video tag.
            </video> -->
            <h1 style="font-size: 2.5rem; color: #333;">DataPro</h1>
            <p class="description">
                "Simplify Your Data Journey – From Analysis to Modeling"
            </p>
            <a href="/data_processor" class="cta-button">Start Processing</a>
        </div>

        <div class="right-section">
            <div class="feature-card">
                <i class="fas fa-upload"></i>
                <h3>Input Data</h3>
                <p>Upload dataset in CSV or Excel format</p>
            </div>

            <div class="feature-card">
                <i class="fas fa-cogs"></i>
                <h3>Choose Processing</h3>
                <p>Select Statistics or Modeling options</p>
            </div>

            <div class="feature-card">
                <i class="fas fa-chart-bar"></i>
                <h3>Statistical Analysis</h3>
                <p>Comprehensive statistics result</p>
            </div>

            <div class="feature-card">
                <i class="fas fa-brain"></i>
                <h3>Machine Learning</h3>
                <p>Classification and regression for labeled data</p>
            </div>

            <div class="feature-card">
                <i class="fas fa-shield-alt"></i>
                <h3>Data Security</h3>
                <p>Advanced data protection and privacy</p>
            </div>

            <div class="feature-card">
                <i class="fas fa-envelope"></i>
                <h3>Email Report</h3>
                <p>Detailed report through your email</p>
            </div>
        </div>
    </main>
</body>

</html>