<form action="<?=BASEURL; ?>/Auth/register" method="POST">
    <input type="hidden" name="role" value="author">

    <label for="fullname">Fullname</label>
    <input type="text" name="fullname">

    <label for="email">Email</label>
    <input type="text" name="email">

    <label for="username">Username</label>
    <input type="text" name="username">

    <label for="password">Password</label>
    <input type="password" name="password">

    <label for="conf-password">Confirm Password</label>
    <input type="password" name="conf-password">

    <button name="register">Click to Register</button>
</form>
