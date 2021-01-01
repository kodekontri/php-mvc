<h1>Create Account</h1>
<form action="/auth/create?hi=10" method="post">
    <div class="form-group">
        <label for="user">Username:</label>
        <input type="text" name='user' class="form-control">
    </div>
    <div class="form-group">
        <label for="email">Email:</label>
        <input type="text" name='email' class="form-control">
    </div>
    <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" name='password' class="form-control">
    </div>
    <button name="button">Submit</button>
</form>