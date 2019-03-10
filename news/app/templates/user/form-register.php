<form method="post" action="user-register.php" class="user">
    <h2>Sing up with new account</h2>
    <input name="first_name" type="text" placeholder="First name" class="form-control"/>
    <input name="last_name" type="text" placeholder="Last name" class="form-control"/>
    <div class="radio-2">
        <input id="gender_1" name="gender" type="radio" value="1"/><label for="gender_1" class="form-control">boy</label>
        <input id="gender_2" name="gender" type="radio" value="2"/><label for="gender_2" class="form-control">girl</label>
    </div>
    <input name="email" type="email" placeholder="E-mail" class="form-control"/>
    <input name="password" type="password" placeholder="Password" class="form-control"/>
    <div class="buttons">
        <button type="submit" class="btn btn-success">Submit</button>
    </div>
    <p>Got account already? Just <a href="user-login.php">sign in</a>.</p>
</form>