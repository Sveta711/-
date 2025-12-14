<?php session_start(); ?>

<!DOCTYPE html>
<html>
    <head>
        <style>
:root {
    --branch-dark: #1a1a1a;
    --branch-grey: #f4f4f4;
    --branch-text-muted: #666;
    --branch-accent: #3d4a3e;
    --white: #ffffff;
    --border-color: #e0e0e0;
}

body {
    font-family: 'Inter', sans-serif;
    background-color: var(--branch-grey);
    margin: 0;
    padding: 40px 0; /* Ավելացնում ենք տարածք վերևից/ներքևից */
    display: flex;
    justify-content: center;
}

.registration-container {
    width: 100%;
    max-width: 550px; /* Մի փոքր ավելի լայն քան լոգինը */
}

.registration-box {
    background: var(--white);
    padding: 40px;
    border:2px solid #354a40;
    border-radius: 15px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
}

.registration-header {
    text-align: center;
    margin-bottom: 35px;
}

.registration-header h2 {
    font-size: 28px;
    font-weight: 500;
    color: #354a40;
    margin: 0 0 10px 0;
}

.registration-header p {
    color: var(--branch-text-muted);
    font-size: 14px;
}

/* Երկու սյունակով դասավորության համար */
.form-row {
    display: flex;
    gap: 15px;
}

.form-row .input-group {
    flex: 1;
}

.input-group {
    margin-bottom: 20px;
}

.input-group label {
    display: block;
    font-size: 11px;
    font-weight: 700;
    margin-bottom: 8px;
    color: var(--branch-dark);
    text-transform: uppercase;
    letter-spacing: 1px;
}

.input-group input, 
.input-group select {
    width: 100%;
    padding: 12px;
    border: 1px solid var(--border-color);
    border-radius: 2px;
    box-sizing: border-box;
    font-size: 14px;
    background-color: #fafafa;
    transition: all 0.2s ease;
}

.input-group input:focus,
.input-group select:focus {
    outline: none;
    border-color: #354a40;
    background-color: var(--white);
}

.btn-primary {
    width: 100%;
    padding: 16px;
    background-color: #354a40;
    color: white;
    border: none;
    border-radius: 4px;
    font-size: 14px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1px;
    cursor: pointer;
    margin-top: 10px;
    transition: background-color 0.3s;
}

.btn-primary:hover {
    background-color: #648575ff;
}

.footer-link {
    margin-top: 25px;
    text-align: center;
    font-size: 13px;
  
}

.footer-link a {
    color: var(--branch-dark);
    font-weight: 700;
    text-decoration: underline;
}
.footer-link a:hover{
      color: #97c0acff;
}


@media (max-width: 480px) {
    .form-row {
        flex-direction: column;
        gap: 0;
    }
}
.error { background-color: white; color: #c81e1e; }
        .success { background-color: white; color: #03543f;  }
        ul { list-style: none; padding: 0; margin: 0; }
            </style>
</head>
<body>
    
     
    <div class="registration-container">
    <div class="registration-box">
        <div class="registration-header">
            <h2>Create Account</h2>
            <p>Join our community and design your workspace.</p>
        </div>
        
        <form method="post" action="save.php">
            <div class="form-row">
                <div class="input-group">
                    <label for="first-name">First Name</label>
                    <input type="text" name="firstname"  >
                </div>
                <div class="input-group">
                    <label for="last-name">Last Name</label>
                    <input type="text" name="lastname"  >
                </div>
            </div>

            <div class="input-group">
                <label for="username">Username</label>
                <input type="text" name="username" >
            </div>
            <div class="input-group">
                <label for="email">Email</label>
                <input type="email" name="email"  >
            </div>

            <div class="form-row">
                <div class="input-group">
                    <label for="age">Age</label>
                    <input type="number" name="age" >
                </div>
                <div class="input-group">
                    <label for="gender">Gender</label>
                    <select name="gender" >
                        <option value="" disabled selected>Select</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="other">Other</option>
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" >
                </div>
                <div class="input-group">
                    <label for="confirm-password">Confirm Password</label>
                    <input type="password" name="valid" >
                </div>
            </div>

            <div class="input-group">
                <label for="card-number">Card Number (Optional)</label>
                <input type="text" name="cardnumber" placeholder="0000 0000 0000 0000" maxlength="16">
            </div>

            <button type="submit" class="btn-primary">Create Account</button>
            <?php if (isset($_SESSION['errors'])): ?>
                    <div class="msg-box error">
                        <ul>
                            <?php foreach ($_SESSION['errors'] as $error): ?>
                                <li><?php echo $error; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <br>
                    <?php unset($_SESSION['errors']); ?>
                <?php endif; ?>

                <?php if (isset($_SESSION['success'])): ?>
                    <div class="msg-box success">
                        <?php echo $_SESSION['success']; ?>
                    </div>
                    <?php unset($_SESSION['success']); ?>
                <?php endif; ?>
            <div class="footer-link">
                Already have an account? <a href="signin.php">Sign In</a>
            </div>
        </form>
        

    </div>
</div>
</body>
</html>