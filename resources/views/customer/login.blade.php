<form method="POST" action="/login">
    @csrf
    <input type="email" name="email" placeholder="Customer Email">
    <input type="password" name="password" placeholder="Password">
    <button type="submit">Customer Login</button>
</form>
