<x-layout>
  <div class="container">
    <h2>Register</h2>
    @if ($errors->any())
      <div class="error-message">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif
    <form action="{{ route('register') }}" method="POST">
      @csrf
      <div class="form-group">
        <label for="name">Imię</label>
        <input type="text" name="name" id="name" value="{{ old('name') }}" required autofocus>
      </div>
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" value="{{ old('email') }}" required>
      </div>
      <div class="form-group">
        <label for="password">Hasło</label>
        <input type="password" name="password" id="password" required>
      </div>
      <div class="form-group">
        <label for="password_confirmation">Potwierdź hasło</label>
        <input type="password" name="password_confirmation" id="password_confirmation" required>
      </div>
      <button type="submit" class="btn">Zarejestruj</button>
    </form>
    <div class="text-center mt-3">
      <p>Posiadasz już konto? <a href="{{ route('login') }}">Zaloguj się</a></p>
    </div>
  </div>
</x-layout>
