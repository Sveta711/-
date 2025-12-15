<!DOCTYPE html>
<html>
<head>
    <style>
        /* Գույների փոփոխականներ՝ ըստ Branch-ի ոճի */
:root {
    --branch-dark: #1a1a1a;
    --branch-grey: #f4f4f4;
    --branch-text-muted: #666;
    --branch-accent: #3d4a3e; /* Sage green երանգ */
    --white: #ffffff;
}

body {
    font-family: 'Inter', -apple-system, sans-serif;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
}
   

.login-container {
    width: 100%;
    max-width: 400px;
    padding: 20px;
}

.login-box {
    background: var(--white);
    padding: 40px;
    border: 2px solid #354a40;; /* Branch-ը սիրում է ուղիղ, բայց նուրբ եզրեր */
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
    border-radius:15px;
}

.login-header h2 {
 color: #354a40;
     font-size: 24px;
    font-weight: 500;
    margin-bottom: 8px;
    text-align: center;
}

.login-header p {
    color: var(--branch-text-muted);
    font-size: 14px;
    margin-bottom: 30px;
    text-align: center;
}

.input-group {
    margin-bottom: 20px;
}

.input-group label {
    display: block;
    font-size: 13px;
    font-weight: 600;
    margin-bottom: 8px;
    color: var(--branch-dark);
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.input-group input {
    width: 100%;
    padding: 12px;
    border: 1px solid #ddd;
    border-radius: 2px;
    box-sizing: border-box;
    font-size: 14px;
    transition: border-color 0.2s;
}

.input-group input:focus {
    outline: none;
    border-color: #354a40;
}

.actions {
    margin-bottom: 20px;
    text-align: right;
}

.forgot-password {
    font-size: 13px;
    color: var(--branch-text-muted);
    text-decoration: underline;
}
.forgot-password:hover{
    color: #678f7cff;
}

.btn-primary {
    width: 100%;
    padding: 14px;
    background-color: #354a40;
    color: white;
    border: none;
    border-radius: 4px;
    font-size: 15px;
    font-weight: 500;
    cursor: pointer;
    transition: opacity 0.2s;
}

.btn-primary:hover {
    opacity: 0.9;
    background-color: #678f7cff;
}

.footer-link {
    margin-top: 25px;
    text-align: center;
    font-size: 14px;
    color: var(--branch-text-muted);
}

.footer-link a {
    color: var(--branch-dark);
    font-weight: 600;
    text-decoration: none;
}
      </style>
      </head>
      <body>
        <div class="login-container">
    <div class="login-box">
        <div class="login-header">
            <h2>Welcome Back</h2>
            <p>Please enter your details to sign in.</p>
        </div>
        
        <form method="post" action="login_action.php">
            <div class="input-group">
                <label for="email">Username</label>
                <input type="text" name="username" required>
            </div>
            
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" name="password"  required>
            </div>
            <?php 
    session_start();
    if(isset($_SESSION['login_error'])): ?>
        <p style="color:red; font-size:12px;"><?php echo $_SESSION['login_error']; unset($_SESSION['login_error']); ?></p>
    <?php endif; ?>
            
            <div class="actions">
                <a href="#" class="forgot-password">Forgot password?</a>
            </div>
            
            <button type="submit" class="btn-primary">Sign In</button>
            
            <div class="footer-link">
                Don't have an account? <a href="account.php">Create one</a>
            </div>
        </form>
    </div>
</div>

</body>
</html>