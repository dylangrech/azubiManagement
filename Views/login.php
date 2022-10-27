<body class="loginBody">
    <div class="loginForm">
        <form action="<?php echo $this->getUrl('index.php'); ?>" method="post">
            <input type="hidden" name="controller" value="Login">
            <input type="hidden" name="action" value="loginUser">
            <p style="margin: 20px">
                <label class="labelEmail" for="user-email">Enter E-Mail</label>
                <br>
                <input style="height: 20px" type="text" name="user-email" id="user-email">
            </p>
            <br>
            <p style="margin: 20px">
                <label class="labelPassword" for="password-log">Enter Password</label>
                <br>
                <input style="height: 20px" type="password" name="password-log" id="password-log">
            </p>
            <br>
            <p>
                <input class="submitLogin" name="logout" type="submit" value="Login">
            </p>
            <br>
        </form>
    </div>
</body>
