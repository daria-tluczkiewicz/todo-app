<x-layout>
  <div class="container">
    @if(session('registrationSuccessful'))
      <div>Dziękujemy za rejestrację <b>{{ session('username') }}</b>, możesz się teraz zalogować</div>
    @endif
    <h2>Login</h2>
      @if(session('message'))
        <div class="alert">{{ session('message') }}</div>
      @endif
    <!-- Display validation errors -->
    @if ($errors->any())
      <div class="error-message">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif
    <!-- Login Form -->
    <form action="{{ route('login') }}" method="POST">
      @csrf
      <!-- Email -->
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus>
      </div>
      <!-- Password -->
      <div class="form-group">
        <label for="password">Hasło</label>
        <input type="password" name="password" id="password" required>
      </div>
      <!-- Submit Button -->
      <button type="submit" class="btn">Login</button>
    </form>
    <div class="text-center mt-3">
      <p>Nie masz jeszcze konta? <a href="{{ route('register') }}">Zarejestruj się</a></p>
    </div>
  </div>
</x-layout>
