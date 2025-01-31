<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Register</title>
    <link rel="stylesheet" href="styles/auth.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>
    <div class="container">
        <!-- Login Section -->
        <div class="form-container sign-in-container">
            <form action="/login_action" method="POST">
                <?= csrf_field() ?>
                <img src="logo_datapro_nobg.png" alt="DataPro Logo" class="logo">
                <h1>Sign In</h1>
                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert error"><?php echo session()->getFlashdata('error'); ?></div>
                <?php endif; ?>
                <?php if (session()->getFlashdata('success')): ?>
                    <div class="alert success"><?php echo session()->getFlashdata('success'); ?></div>
                <?php endif; ?>
                <div class="input-group">
                    <i class="fa fa-user input-icon"></i>
                    <input type="text" name="username" placeholder="Email/Username" required />
                </div>
                <div class="input-group">
                    <i class="fa fa-lock input-icon"></i>
                    <input type="password" name="password" placeholder="Password" required />
                </div>
                <button type="submit">Sign In</button>
            </form>
        </div>

        <!-- Register Section -->
        <div class="form-container sign-up-container">
            <form action="/register_action" method="POST">
                <?= csrf_field() ?>
                <img src="logo_datapro_nobg.png" alt="DataPro Logo" class="logo">
                <h1>Create Account</h1>
                <div class="input-group">
                    <i class="fa fa-user input-icon"></i>
                    <input type="text" name="firstName" placeholder="First Name" required />
                </div>
                <div class="input-group">
                    <i class="fa fa-user input-icon"></i>
                    <input type="text" name="lastName" placeholder="Last Name" required />
                </div>
                <div class="input-group">
                    <i class="fa fa-at input-icon"></i>
                    <input type="text" name="username" placeholder="Username" required />
                </div>
                <div class="input-group">
                    <i class="fa fa-envelope input-icon"></i>
                    <input type="email" name="email" placeholder="Email" required />
                </div>
                <div class="input-group">
                    <i class="fa fa-lock input-icon"></i>
                    <input type="password" name="password" placeholder="Password" required />
                </div>
                <button type="submit">Sign Up</button>
            </form>
        </div>

        <!-- Overlay Container -->
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <img src="logo_datapro_nobg.png" alt="DataPro Logo" class="logo">
                    <h1>Welcome Back!</h1>
                    <p>Already have an account? Sign in here!</p>
                    <button class="ghost" id="signIn">Sign In</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <img src="logo_datapro_nobg.png" alt="DataPro Logo" class="logo">
                    <h1>Hello, Friend!</h1>
                    <p>Don't have an account yet? Register here!</p>
                    <button class="ghost" id="signUp">Sign Up</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        const signUpButton = document.getElementById('signUp');
        const signInButton = document.getElementById('signIn');
        const container = document.querySelector('.container');

        signUpButton.addEventListener('click', () => {
            container.classList.add('right-panel-active');
        });

        signInButton.addEventListener('click', () => {
            container.classList.remove('right-panel-active');
        });
    </script>
</body>

</html>