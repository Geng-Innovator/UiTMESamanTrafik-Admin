# System Pre-requisite

1. `MySQL v8` and above
2. `PHP v7.3` and above
3. `Composer v1.10.21` (keep it below v2)

# Installation

1. Duplicate `.env.example`file, rename it to `.env` & setup the necessary variables depending on your environment (`if you don't need other variables, just leave it as default value & don't remove them`):
   1. `DB_CONNECTION` -> SQL DB driver (set it as `mysql`)
   2. `DB_HOST` -> hosted DB URL (if you're hosting in your local environment, set it as `127.0.0.1`)
   3. `DB_PORT` -> hosted DB port (by default, it's `3306`)
   4. `DB_DATABASE` -> DB name
   5. `DB_USERNAME` -> DB user (by default it's `root`)
   6. `DB_PASSWORD` -> DB password
2. Run `php artisan migrate` to do DB migration
3. Run `php artisan db:seed` to seed default data to DB

# Running Application

1. Run `php -S localhost:8080 -t public/` to run application
2. Open web browser & go to `http://localhost:8080` URL
3. If you're able to see the website login page, this application has been successfully installed & running.

# Exposing Localhost as HTTPS service
If you need to connect the Android app with your localhost, you need to expose it to a HTTP service by using an application celled [ngrok](https://ngrok.com/). You may check their documentation at their website.

Below are the steps on how you can expose your localhost for this application.

1. Download ngrok [here](https://ngrok.com/download) & install it (refer to their documentation on how to install).
2. Once installed, run `ngrok http 8080`.
3. Once ngrok is running, you may browse this application using the URL that ngrok has generated.

# About Default Data

Upon running the seed migration command in [Installation (3)](#installation), a collection of default data will be created in the DB as specified below:

## User Data
All default user account data will be seeded as shown below:

1. Admin
   * username: `K1`
   * password: `1`
2. Polis
   * username: `K2`
   * password: `2`
3. Staf
   * username: `K3`
   * password: `3`

## Lookup Data
Mostly these data are used as pointer in the DB & also to populate dropdown in the system. It is not as significant as `User Data`.
