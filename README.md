# Getting Started

Welcome! This guide will walk you through the steps to get the application up and running on your local machine.

## Prerequisites

Before you begin, you should have the following installed on your local machine:

- PHP 7.4 or higher
- Composer
- Node.js
- NPM or Yarn

## Installation

To get started, follow these steps:

1. Clone the repository from Github:

```
git clone https://github.com/Mindsize/craigcoston-developer-test.git
```

2. Navigate into the project directory:

```
cd your-repo-name
```

3. Install the project dependencies using Composer:

```
composer install
```

4. Copy the `.env.example` file to `.env`:

```
cp .env.example .env
```

5. Generate a new application key:

```
php artisan key:generate
```

6. Set up your database in the `.env` file.  MySQL is strongly recommended.


7. Run database migrations and seeders:

```
php artisan migrate --seed
```

8. Compile the front-end assets:

```
npm install && npm run dev
```

## Serve the application

You can serve the application using Laravel Valet. If you don't have Valet installed, you can follow the installation instructions [here](https://laravel.com/docs/10.x/valet#installation).

Once Valet is installed, navigate to the project directory and run the following command to create a Valet link:

```
valet link [insert desired domain name here]
```
For example, to run the application using the domain *mindsize.test*, run the following command:
```
valet link mindsize
```
You should now be able to navigate to the application via http://mindsize.test (or whichever domain you chose).

Upon navigation, you will be presented with a login screen.  Use the credentials you created during seeding to log in.

You should now be able to navigate the application.
