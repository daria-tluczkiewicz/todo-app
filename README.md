# ToDo App - Dokumentacja

Aplikacja do zarządzania zadaniami z możliwością udostępniania zadań innym użytkownikom oraz przypomnień o zbliżających się terminach.

---

## Wymagania

- PHP w wersji 8.2
- Composer
- Node.js i npm
- Serwer MySQL
- Laravel w wersji 11.35.1

---

## Instalacja

### Sklonuj repozytorium
```
git clone https://github.com/daria-tluczkiewicz/todo-app
cd todo-app
```

### Zainstaluj zależności PHP
```
 composer install
```
### Zainstaluj zależności frontendowe
```
  npm install
```

### Skonfiguruj plik .env
```
  cp .env.example .env
```
Uzupełnij dane dotyczące bazy danych:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1 lub indywidualna nazwa hosta
DB_PORT=3306 lub indywidualny port
DB_DATABASE=<nazwa_bazy>
DB_USERNAME=<użytkownik>
DB_PASSWORD=<hasło>
```

Skonfiguruj SendGrid lub inny serwis
```
MAIL_MAILER=sendgrid
MAIL_HOST=smtp.sendgrid.net
MAIL_PORT=587
MAIL_USERNAME=<Twój-API-Key-SendGrid>
MAIL_PASSWORD=<Hasło>
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=<Twój adres>
```
### Wygeneruj klucz aplikacji
```php artisan key:generate```

### Uruchom migracje i zainicjuj bazę danych
```php artisan migrate --seed```

### Uruchom worker harmonogramu 
```php artisan schedule:work```

### Uruchom server

```php artisan serve```

### Uruchamiania proces kompilacji assetów frontendowych w trybie deweloperskim

```npm run dev```
