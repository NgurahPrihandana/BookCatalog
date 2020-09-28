<body style="background-size: cover ;background-image: url(<?=BASEURL; ?>/assets/img/login-bg.jpg);">
<div class="flash-data" id="flash" data-toast-data="<?=Flasher::toast(); ?>"></div>
<div class="container d-flex flex-column justify-content-between" style="height: 100vh;">
    <div class="row"></div>
    <div class="row justify-content-center align-items-center rounded bg-light" style="overflow: hidden;"> 
        <div class="col-lg-6 d-lg-block d-none text-center align-self-center px-1 py-0">
            <img src="<?=BASEURL; ?>/assets/img/login.png" alt="">
        </div>
        <div class="col-lg-6 col-12 border p-4 text-white" style="background-color: #1E1E1E; border:none!important; min-width: 30rem">
            <form action="<?=BASEURL; ?>/Auth/index" method="POST">
            <h3 class="" style="letter-spacing: 1px;">Login</h3>
            <p class="mt-0 pb-2 mb-4 border-bottom border-success">Please fill the form below to continue</p>
                <div class="form-group p-1">
                    <label for="verificator">Username / Email</label>
                    <input type="text" name="verificator" id="verificator" class="form-control border-success bg-transparent" style="border-width: 2px!important; background-color: #2b2b2a!important;" placeholder="Alex" required>
                </div>
                <div class="form-group p-1">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" class="form-control rounded-3 border-success bg-transparent" style="border-width: 2px!important; background-color: #2b2b2a!important;" required>
                </div>

                <div class="form-group">
                    <div class="form-check">
                    <input class="form-check-input position-relative" name="remember" type="checkbox" id="gridCheck">
                    <label class="form-check-label" for="gridCheck">
                        Remember Me
                    </label>
                    </div>
                </div>

                <div class="form-group m-0 mt-2">
                    <button name="login" class="btn btn-success form-control" style="letter-spacing: 1.2px;">Login</button>
                </div>
                <small>Doesn't have an account yet ? <span><a href="<?= BASEURL; ?>/Auth/register">Click here to Register</a></span></small>
            </form>
        </div>
    </div>
    <div class="row"></div>
</div>



