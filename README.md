# Project Setup Guide

This guide will walk you through setting up both the frontend and backend of the project.

## Frontend (FE)

1. Install the required dependencies:

    ```bash
    npm install
    ```

2. Start the development server:

    ```bash
    npm run dev
    ```

---

## Backend (BE)

1. Copy the `.env.example` file and rename it to `.env`:

    ```bash
    cp .env.example .env
    ```

2. Open the `.env` file and update the database connection settings as follows:

    ```env
    DB_CONNECTION=sqlite
    DB_DATABASE=/Users/ridvanceylan/Downloads/publicHoliday-main/laravel  # Example full path
    ```

3. Install the backend dependencies:

    ```bash
    composer install
    ```

4. Reset and migrate the database:

    ```bash
    php artisan migrate:reset
    php artisan migrate
    ```

5. Clear and cache the configuration:

    ```bash
    php artisan config:cache
    ```

6. Start the server:

    ```bash
    php artisan serve
    ```

---

## If You Encounter a 500 Error

1. Run the following commands to regenerate the application key and refresh the cache:

    ```bash
    php artisan key:generate
    php artisan config:cache
    ```

---

Now you should be able to access the project in both development environments.
