# POLA — Project Management for Freelance

A SaaS-based project management application built as an internship assignment at **Techarea**.

## Authors

- [@attaf-riski](https://github.com/attaf-riski/)
- [@heydaristo](https://github.com/heydaristo/)

---

## Requirements

- PHP & Composer
- MySQL
- Apache (e.g. via XAMPP/Laragon)
- [Mailtrap](https://mailtrap.io/) account (for email)
- [Midtrans](https://midtrans.com/) account (for payment)

---

## Installation

### 1. Clone the Repository

```bash
git clone https://github.com/heydaristo/SAAS-Project-Management
cd SAAS-Project-Management/
```

### 2. Configure Environment

Create a `.env` file in the project root. You can use the template below as a starting point:

```env
APP_NAME=Laravel
APP_ENV=local
APP_KEY=base64:5DuG5IHNaUea8nc44q9E4h7TBD1ztWfvhu8HPDnKtQA=
APP_DEBUG=true
APP_URL=http://localhost

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=SAASFreelanceProjectManagement
DB_USERNAME=root
DB_PASSWORD=

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

MEMCACHED_HOST=127.0.0.1

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_HOST=
PUSHER_PORT=443
PUSHER_SCHEME=https
PUSHER_APP_CLUSTER=mt1

VITE_APP_NAME="${APP_NAME}"
VITE_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
VITE_PUSHER_HOST="${PUSHER_HOST}"
VITE_PUSHER_PORT="${PUSHER_PORT}"
VITE_PUSHER_SCHEME="${PUSHER_SCHEME}"
VITE_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"

MIDTRANS_SERVER_KEY=
MIDTRANS_CLIENT_KEY=
MIDTRANS_IS_PRODUCTION=false
MIDTRANS_IS_SANDBOX=true
MIDTRANS_IS_3DS=true
```

> **Note:** Fill in your Mailtrap credentials (`MAIL_USERNAME`, `MAIL_PASSWORD`) and Midtrans keys (`MIDTRANS_SERVER_KEY`, `MIDTRANS_CLIENT_KEY`) before proceeding.

### 3. Install Dependencies

```bash
composer update
```

### 4. Set Up the Database

> Make sure your **Apache** and **MySQL** services are running before this step.

```bash
php artisan migrate
```

### 5. Run Database Seeders

```bash
php artisan db:seed Role
php artisan db:seed AllSeeder
```

### 6. Start the Application

```bash
php artisan serve
```

The application will be available at `http://localhost:8000`. Enjoy! 🚀

---

## License

This project is for educational purposes as part of an internship program at Techarea.
