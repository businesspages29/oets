
# Online Event Ticketing System

You are tasked with building an online event ticketing system that allows users to create,
manage, and attend events. The system should handle event creation, ticket sales, attendee
management, and payment integration.


## Run Locally

Clone the project

```bash
  git clone https://link-to-project
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
  npm run start
```

Setup Migrations with seeder

```bash
  php artisan migrate --seed
```

# Login Credentials

```bash
  email :organizer@organizer.com
  passowrd: password
```

# Database Schema

users
- name
- email
- password

events
- organizer_id (R: users)
- title
- description
- date
- location
- ticket_availability


tickets
- event_id
- type -> types  enum
- price
- quantity

attendees
- user_id
- event_id


Explain In Blogs
- https://raviyatechnical.medium.com/laravel-11-efficient-enum-creation-command-database-migrations-and-seeding-strategies-b8690eb4ca09


Refer Docs
- https://yajrabox.com/docs/laravel-datatables/11.0


## Tech Stack

**Client:** React, Redux, TailwindCSS

**Server:** Laravel 11


## Authors

- [@bhargavraviya](https://www.github.com/bhargavraviya)