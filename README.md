<h1 align="center">InertiaJS playground ⚽️</h1>

<p align="center">Started with the <a href="https://laracasts.com/series/build-modern-laravel-apps-using-inertia-js">Laracasts: Build Modern Laravel Apps Using Inertia.js</a> course and decided to share all my code here, I'll be adding my own features such as editing users which was a challenge given after finishing the course.</p>

## Installation

1. Clone the repository
   ```sh
   git clone https://github.com/KasperRL/inertia-playground
   ```
2. Install Composer packages
   ```sh
   composer install
   ```
3. Install NPM packages
   ```sh
   npm install
   ```
4. Create a `database.sqlite` file in your `database` directory
5. Rename `.env.example` to `.env`
6. Edit your database connection in your `.env` file
    <br>Replace
    ```
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=demo
    DB_USERNAME=root
    DB_PASSWORD=
    ```
    with
    ```
    DB_CONNECTION=sqlite
    ```
7. Run migrations (creates 100 random users)
    ```sh
    php artisan migrate:fresh --seed
    ```
7. Start server
    ```sh
    php artisan serve
    ```

## Build with

<span>
  <img src="https://tailwindcss.com/_next/static/media/tailwindcss-mark.cb8046c163f77190406dfbf4dec89848.svg" width="35">
  <img src="https://user-images.githubusercontent.com/70808417/142496950-61cebef9-db2b-495e-9beb-c2e578393656.png" width="25">
  <img src="https://v3.vuejs.org/logo.png" width="25">
</span>

## License

Distributed under the MIT License.

## Reach me

<span>
  <a href="https://www.linkedin.com/in/kasper-ligthart/">
    <img src="https://user-images.githubusercontent.com/70808417/142434323-df22212a-d2a2-4c3f-a8b8-cb71003641d9.png" width="30">
  </a>
  <a href="https://github.com/KasperRL">
    <img src="https://user-images.githubusercontent.com/70808417/142432587-1ff09d3b-676c-4765-ba31-4eb7aace4615.png" width="35">
  </a>
</span>

#### Or kasper.ligthart@icloud.com
