## Real-Time Product Listing - Setup Process

This guide walks you through setting up a Laravel project with real-time product updates using Pusher and Fake Store API.

- Clone the Repository
```bash
   git clone https://github.com/MuhammadMahediHasan/real-time-product-listing.git
   cd real-time-product-listing
```

- Install Dependencies
```bash
    composer install
    npm install
```

- Configure Environment Variables

```bash
    cp .env.example .env
```
Update the database credentials in .env:
```bash
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=your_database
    DB_USERNAME=your_username
    DB_PASSWORD=your_password
```
Set up Pusher credentials in .env:

```bash
    PUSHER_APP_ID=your_pusher_app_id
    PUSHER_APP_KEY=your_pusher_app_key
    PUSHER_APP_SECRET=your_pusher_app_secret
    PUSHER_APP_CLUSTER=mt1
```
- Run Migrations & build js file
```bash
  php artisan migrate && npm run build
```

### Testing Real-Time Updates

- Visit `/products` in your browser.
- Run `php artisan fetch:products` or use `/fetch-products` api to store database.
- Products should appear in real-time on the page.

