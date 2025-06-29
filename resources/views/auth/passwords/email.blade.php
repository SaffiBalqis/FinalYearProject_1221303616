<form method="POST" action="{{ route('password.email') }}">
    @csrf
    <label>Email:</label>
    <input type="email" name="email" required>
    <button type="submit">Send Password Reset Link</button>
    @if (session('status'))
        <div>{{ session('status') }}</div>
    @endif
    @error('email')<div>{{ $message }}</div>@enderror
</form>