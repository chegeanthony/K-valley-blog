<form method="POST" action="{{ route('author.login') }}">
    @csrf
    <input type="text" name="id" required autofocus>
    <button type="submit">Log in</button>
</form>