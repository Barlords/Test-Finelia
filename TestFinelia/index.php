<?php  
    session_start();
?>
<!DOCTYPE html>
<html lang="fr" >
    <head>
        <meta charset="utf-8">
        <title>Login</title>
        <link rel="stylesheet" href="style.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <div id ="containerClient">
            <div class="wrapper">
                <div class="title-text">
                    <div class="title login">
                        Bienvenue
                    </div>
                    <div class="title signup">
                    </div>
                </div>
                <div class="form-container">
                    <div class="slide-controls">
                        <input type="radio" name="slide" id="login" checked>
                        <input type="radio" name="slide" id="signup">
                        <label for="login" class="slide login">Login</label>
                        <label for="signup" class="slide signup">Inscription</label>
                        <div class="slider-tab"></div>
                    </div>
                    <div class="form-inner">
                        <form method="post"  action="login.php" class="login">
                            <div class="field">
                                <input type="text" placeholder="Adresse Email" required name="mail">
                            </div>
                            <div class="field">
                                <input type="password" placeholder="Mot De Passe" required name="password">
                            </div>
                            <div class="field btn">
                                <div class="btn-layer"></div>
                                <input type="submit" value="Se connecter">
                            </div>
                            <?php if($_SESSION["success"] == -1) {?>
                                <div class="error">
                                    ERROR : Le mot de passe ne correspond pas au compte
                                </div>
                                <?php } if($_SESSION["success"] == -2) {?>
                                <div class="error">
                                    ERROR : Le compte n'éxiste pas
                                </div>
                                <?php } ?>
                            <div class="signup-link">
                                Pas encore membre ? <a href="">S'inscrire !</a>
                            </div>
                        </form>
                        <form method="post" action="signUp.php" class="signup">
                            <div class="field">
                                <input type="text" placeholder="Nom" required name="name">
                            </div>
                            <div class="field">
                                <input type="text" placeholder="Prénom" required name="fname">
                            </div>
                            <div class="field">
                                <input type="text" placeholder="Adresse Email" required name="mail">
                            </div>
                            <div class="field">
                                <input type="password" placeholder="Mot De Passe" required name="password">
                            </div>
                            <div class="field btn">
                                <div class="btn-layer"></div>
                                <input type="submit" value="S'inscire">
                            </div>
                            <?php if($_SESSION["success"] == -3) {?>
                                <div class="error">
                                    ERROR : le compte existe déjà
                                </div>
                                <?php } ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script>
            const loginText = document.querySelector(".title-text .login");
            const loginForm = document.querySelector("form.login");
            const loginBtn = document.querySelector("label.login");
            const signupBtn = document.querySelector("label.signup");
            const signupLink = document.querySelector("form .signup-link a");
            signupBtn.onclick = (()=>{
              loginForm.style.marginLeft = "-50%";
            });
            loginBtn.onclick = (()=>{
              loginForm.style.marginLeft = "0%";
            });
            signupLink.onclick = (()=>{
              signupBtn.click();
              return false;
            });
        </script>
    </body>
</html>

