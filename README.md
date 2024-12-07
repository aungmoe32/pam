# **PAM** - Tiny PHP MVC Framework

A lightweight PHP MVC framework inspired by Laravel, **PAM** simplifies web development by integrating Illuminate components for powerful features.

## **Overview**

PAM was designed to implement clean MVC principles while providing essential tools for modern PHP development. A **Todo List App** built with PAM demonstrates its capabilities.

- Demo : [YouTube](https://youtu.be/sj7AaQjmhCY?si=4nTvnt8kY7Mc5WtL)

## **Features**

- **Database**: Eloquent ORM for database management.
- **Routing**: Define routes similar to Laravel.
- **File System**: Manage file storage effortlessly.
- **Requests**: Capture and process HTTP requests.
- **Session Management**: Secure session handling.
- **Middlewares**: For request filtering and validation.
- **Config Management**: Centralized configuration files.
- **Blade Templating**: Use Blade templates for views.
- **Helper Functions**: Utility functions to speed up development.

## **Implementation Details**

### **1. Bootstrap**

- The entry point is `bootstrap/app.php`, which:
  - Loads `autoload.php` and `.env` files.
  - Initializes instances located in `App/Classes` sequentially.

### **2. File Storage**

- When `new App\Classes\File` is instantiated:
  - Configurations from `/config/file.php` are loaded.
  - A global `FilesystemManager` instance is created, accessible via the `storage()` helper function.

### **3. Models and Database**

- When the `Database` class (`new App\Classes\Database`) is instantiated:
  - Configurations are loaded from `/config/database.php`.
  - The Illuminate database manager is initialized, and Eloquent ORM is booted.
  - This enables database querying and the use of Eloquent models in controllers and `routes.php`.

### **4. Routing**

- When `new App\Classes\Router` is instantiated:
  - Requests are captured by `App\Classes\Request`.
  - Routes are loaded from `/App/routing/routes.php`.
  - Middlewares from `/App/routing/middleware.php` are applied.
  - The `dispatch()` function processes the request through middleware and routes, calling controller methods and returning a response.

### **5. Config Management**

- Configurations are stored in the `/config` folder.
  - **Available Configs**:
    - `database.php`
    - `session.php`
    - `file.php`
  - Fields are self-documented in the respective files.

### **6. Environment Variables**

- Environment-specific configurations can be defined in the `.env` file at the project root.

### **7. Helper Functions**

Located in `bootstrap/helper.php`, these utility functions simplify development:

- `view()`
- `storage()`
- `request()`
- `session()`
- `redirect()`
- `router()`
- `user()`
- `validator()`
- `asset()`
- `beautify()`

## **Usage**

### **Routing**

- Define routes in `App/routing/routes.php`.
- Syntax is Laravel-inspired.

```php
// Simple GET route
router()->get('/', function () {
    return view('pages.home');
});
```

- Example routes can be found in `App/routing/example_routes.php`.

### **Controllers**

- Controllers are stored in the `App/Controllers` directory.

```php
use App\Controllers\TodoController;

// Define a route with a controller
router()->get('/', [TodoController::class, 'show']);
```

### **Middleware**

- Middlewares are defined in `App/routing/middleware.php`:

  - **Global Middlewares**: e.g., `StartSession`, `VerifyCSRF`.
  - **Route-specific Middlewares**: e.g., `Auth`.

- Custom middleware classes can be created in the `App/Middleware` folder.

```php
// Apply middleware
router()->get('/protected', function () {
	return 'protected';
})->middleware('auth');
```

### **Views**

- Supports Blade templating.
- Blade files are stored in `/resources/views`.
- Use the `view()` helper function to render templates.

```php
// Pass data to Blade template
$name = 'John';
return view('app', compact('name'));
```

### **Models**

- Define Eloquent models in the `App/Models` directory.
- Models support relationships and events, just like in Laravel.

## Usage

### Requirements

- PHP 8.^

### Installation

- Copy env file

```
cp .env.example .env
```

- Setup database in .env file

- Go to root dir
- run :

```
php -S localhost:8000 -t public
```

- Go to http://localhost:8000

- Run migration.sql file by going `http://localhost:8000/migrate`
