<form method="POST" action="/admin/login">
    @csrf
    <input type="email" name="email" placeholder="Admin Email">
    <input type="password" name="password" placeholder="Password">
    <button type="submit">Admin Login</button>
</form>
