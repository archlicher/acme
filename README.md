# How to run the application?

## First you need to clone the application

```
git clone https://github.com/archlicher/acme.git
```

## Navigate to the dir where you have cloned the project:

```
cd /path/to/project/acme
```

## Run the following commands in Terminal:

```
composer install
npm install
npm run dev
```

## How to start the server?

### Run in terminal the migrations:

```
php artisan migrate:fresh
```

### Seed the DB

```
php artisan db:seed
```

### Start your local host:

```
php artisan serve
```

## You are done!