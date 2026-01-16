# MaryUI Starter Kit

A lightweight Laravel starter kit with authentication and basic functionality, built with [MaryUI](https://mary-ui.com) and [Livewire](https://livewire.laravel.com). Similar to official Laravel starter kits (Breeze with Vue, React, or Livewire), but designed specifically for MaryUI.

> Personally, I clone this repository when I need to create a lightweight app. 

## Features

This starter kit provides a complete authentication system and user profile management, all built with MaryUI components and Livewire.

### ✅ Implemented

- **User Registration** - Register new users with name, email, and password
- **User Login** - Authentication with email and password
- **Logout** - Secure logout functionality
- **Forgot Password** - Request password reset via email
- **Reset Password** - Token-based password reset
- **Profile Management**
  - Update name and email
  - Change password (with current password verification)
  - Delete account (with password confirmation)
- **Responsive UI** - Built with MaryUI components and Tailwind CSS
- **Clean Navigation** - Sidebar menu with collapsible sections

### 🚧 Pending Tasks

- [ ] Email Verification
- [ ] Two-Factor Authentication (2FA) using Laravel Fortify

## Tech Stack

- **PHP** 8.4
- **Laravel** 12
- **Livewire** 4
- **MaryUI** - Modern UI components for Livewire
- **Tailwind CSS** 4
- **SQLite** (default, easily swappable)

## Installation

1. Clone the repository:
```bash
git clone <repository-url>
cd mary-starter-kit
```

2. Install dependencies:
```bash
composer install
npm install
```

3. Set up environment:
```bash
cp .env.example .env
php artisan key:generate
```

4. Run migrations:
```bash
php artisan migrate
```

5. Build assets:
```bash
npm run dev
```

6. Start the development server:
```bash
php artisan serve
```

Visit `http://localhost:8000` to see your application.

## Project Structure

### Authentication Pages

- `/login` - User login
- `/register` - User registration
- `/forgot-password` - Request password reset
- `/reset-password/{token}` - Reset password with token

### Authenticated Pages

- `/` - Dashboard (home page)
- `/profile` - User profile management

### Routes

All authentication and profile routes are defined in `routes/auth.php`:
- Guest routes (login, register, forgot password, reset password)
- Authenticated routes (dashboard, profile, logout)

### Livewire Components

This starter uses Laravel's functional Livewire components (pages):
- `resources/views/pages/⚡login.blade.php`
- `resources/views/pages/⚡register.blade.php`
- `resources/views/pages/⚡forgot-password.blade.php`
- `resources/views/pages/⚡reset-password.blade.php`
- `resources/views/pages/⚡profile.blade.php`
- `resources/views/pages/⚡dashboard.blade.php`

### Layouts

- `resources/views/layouts/app.blade.php` - Main authenticated layout with sidebar
- `resources/views/layouts/guest.blade.php` - Guest layout for login/register

## Customization

This starter kit is designed to be a foundation for your Laravel application. Feel free to:
- Modify the sidebar menu in `resources/views/layouts/app.blade.php`
- Add new Livewire components and routes
- Customize the MaryUI theme in your Tailwind configuration
- Extend the User model with additional fields

## MaryUI Components

This starter kit uses various MaryUI components:
- `x-form` - Form wrapper with actions
- `x-input` - Text inputs with icons
- `x-password` - Password inputs with visibility toggle
- `x-button` - Buttons with icons and loading states
- `x-card` - Card containers
- `x-alert` - Alert messages
- `x-modal` - Modal dialogs
- `x-nav` - Navigation bar
- `x-menu` - Sidebar menu
- And more...

Check the [MaryUI documentation](https://mary-ui.com/docs) for all available components.

## Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

## License

This starter kit is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Credits

- Built with [Laravel](https://laravel.com)
- UI components by [MaryUI](https://mary-ui.com)
- Powered by [Livewire](https://livewire.laravel.com)
- Styled with [Tailwind CSS](https://tailwindcss.com)
