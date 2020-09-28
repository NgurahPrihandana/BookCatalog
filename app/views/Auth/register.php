<body style="background-size: cover ;background-image: url(<?=BASEURL; ?>/assets/img/login-bg.jpg);">
<div class="flash-data" id="flash" data-toast-data="<?=Flasher::toast(); ?>"></div>
<div class="container d-flex flex-column justify-content-between" style="height: 100vh;">
    <div class="row"></div>
    <div class="row justify-content-center align-items-center rounded bg-light" style="overflow: hidden;"> 
        <div class="col-lg-6 d-lg-block d-none text-center align-self-center px-1 py-0">
            <img src="<?=BASEURL; ?>/assets/img/register.jpg" alt="">
        </div>
        <div class="col-lg-6 col-12 border p-4 text-white" style="background-color: #1E1E1E; border:none!important; min-width: 30rem">
            <form action="<?=BASEURL; ?>/Auth/register" method="POST">
            <h3 class="" style="letter-spacing: 1px;">Register</h3>
            <p class="mt-0 pb-2 mb-4 border-bottom border-success">Please fill the form below to create a new account</p>
            <div class="form-group p-1">
                    <label for="fullname">Fullname</label>
                    <input type="text" name="fullname" id="fullname" class="form-control border-success bg-transparent" style="border-width: 2px!important; background-color: #2b2b2a!important;" placeholder="Alex Smith" required>
                </div>
                <div class="form-group p-1">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control border-success bg-transparent" style="border-width: 2px!important; background-color: #2b2b2a!important;" placeholder="Alex@gmail.com" required>
                </div>
                <div class="form-group p-1">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" class="form-control border-success bg-transparent" style="border-width: 2px!important; background-color: #2b2b2a!important;" placeholder="Alex" required>
                </div>
                <div class="form-group p-1">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" class="form-control rounded-3 border-success bg-transparent" style="border-width: 2px!important; background-color: #2b2b2a!important;" required>
                </div>
                <div class="form-group p-1">
                    <label for="conf-password">Confirm Password</label>
                    <input type="password" id="conf-password" name="conf-password" class="form-control rounded-3 border-success bg-transparent" style="border-width: 2px!important; background-color: #2b2b2a!important;" required>
                </div>

                <div class="form-group m-0 mt-2">
                    <button name="register" class="btn btn-success form-control" style="letter-spacing: 1.2px;">Login</button>
                </div>
                <small>Already have an account <span><a href="<?= BASEURL; ?>/Auth/index">Click here to Login</a></span></small>
            </form>
        </div>
    </div>
    <div class="row"></div>
</div>