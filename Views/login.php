<body class="loginBody">
    <div class="container">
        <div class="row">
            <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                <div id="hover" class="card border-0 shadow rounded-3 my-5">
                    <div class="card-body p-4 p-sm-5">
                        <h5 class="card-title text-center mb-5 fw-light fs-5"><b>Sign in to the Azubi Experience</b></h5>
                        <form action="<?php echo $this->getUrl('index.php'); ?>" method="post">
                            <input type="hidden" name="controller" value="Login">
                            <input type="hidden" name="action" value="loginUser">
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" name="user-email" id="floatingInput" placeholder="name@example.com">
                                <label for="floatingInput">Email address</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" name="password-log" class="form-control" id="floatingPassword" placeholder="Password">
                                <label for="floatingPassword">Password</label>
                            </div>

                            <div class="d-grid">
                                <input class="btn btn-primary btn-login text-uppercase fw-bold" name="logout" type="submit" value="Login">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
