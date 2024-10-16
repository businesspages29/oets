
# Online Event Ticketing System

You are tasked with building an online event ticketing system that allows users to create,
manage, and attend events. The system should handle event creation, ticket sales, attendee
management, and payment integration.


## Run Locally

Clone the project

```bash
  git clone https://github.com/businesspages29/oets
```

Go to the project directory

```bash
  cd oets
```
Install dependencies using composer 

```bash
  composer install
```

Install dependencies

```bash
  npm install
```

Start the server

```bash
  npm build
```

Setup Migrations with seeder

```bash
  php artisan migrate --seed
```

Queues Running for Mail testing 

```bash
  php artisan queue:work
```

# Login Credentials


```bash
  email: admin@admin.com
  passowrd: password
```

```bash
  email: organizer@organizer.com
  passowrd: password
```

```bash
  email: attendee@attendee.com
  passowrd: password
```


# Debugging 

```bash
http://127.0.0.1:8000/telescope/requests
```

## Lessons Learned (Blog)

- https://raviyatechnical.medium.com/laravel-11-efficient-enum-creation-command-database-migrations-and-seeding-strategies-b8690eb4ca09
- https://raviyatechnical.medium.com/laravel-11-with-yajra-datatables-export-features-for-csv-excel-pdf-and-print-3bc28bae4af6
- https://raviyatechnical.medium.com/how-to-install-jquery-in-laravel-11-vite-66a175bfc88d

Refer Docs
- https://laravel.com/docs/11.x/authentication#authenticating-users
- https://yajrabox.com/docs/laravel-datatables/11.0 



## Tech Stack

**Client:** Boostrap 5, Datatables, Bootstrap Icons

**Server:** Laravel 11, Yajra Datatables

## Authors

- [@bhargavraviya](https://www.github.com/bhargavraviya)