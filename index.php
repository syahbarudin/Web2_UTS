<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo (isset($_GET['page']) && $_GET['page'] == 'register') ? 'Register' : 'Login'; ?></title>
    <link rel="stylesheet" href="style.css"/>
</head>
<body>
    <?php if (isset($_GET['page']) && $_GET['page'] == 'register') { ?>
        <div class="vid-container">
            <video class="bgvid" autoplay="autoplay" muted="muted" preload="auto" loop>
                <source src="bg/background.mp4" type="video/mp4">
            </video>
            <div class="inner-container">
                <div class="box">
                    <h1>Daftar</h1>
                    <form action="src/register.php" method="post" enctype="multipart/form-data">
                        <input type="text" name="username" placeholder="Username" required />
                        <input type="password" name="password" placeholder="Password" required />
                        <button type="submit">Daftar</button>
                    </form>
                    <p>Already a member? <a href="index.php?page=login">Login</a></p>
                </div>
            </div>
        </div>
    <?php } else { ?>
        <div class="vid-container">
            <video class="bgvid" autoplay="autoplay" muted="muted" preload="auto" loop>
                <source src="bg/background.mp4" type="video/mp4">
            </video>
            <div class="inner-container">
                <div class="box">
                    <h1>Login</h1>
                    <form action="src/login.php" method="post">
                        <input type="text" name="username" placeholder="Username" required />
                        <input type="password" name="password" placeholder="Password" required />
                        <button type="submit">Login</button>
                    </form>
                    <p>Not a member? <a href="index.php?page=register">Sign Up</a></p>
                </div>
            </div>
        </div>
    <?php } ?>
</body>
</html>
