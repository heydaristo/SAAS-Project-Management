
# POLA (Project Management For Freelance)

This project is one of the internship / pkl assignments at Techarea


## Authors

- [@attaf-riski](https://github.com/attaf-riski/)
- [@heydaristo](https://github.com/heydaristo/)

## .env File

You can use the basic .env from Laravel and don't forget to add mailtrap and mitrans

## Installation

Clone the project to u pc or laptop

```bash
git clone https://github.com/heydaristo/SAAS-Project-Management
cd SAAS-Project-Management/
```

Make your .env file in text editor
```bash
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

MIDTRANS_SERVER_KEY=""
MIDTRANS_CLIENT_KEY=""
MIDTRANS_IS_PRODUCTION=false
MIDTRANS_IS_SANDBOX=true
MIDTRANS_IS_3DS=true

DEFAULT_TERM="<strong>Acceptances</strong>

<p>The undersigned representative of Client has the authority to enter into this Agreement on behalf of Client. Client agrees to cooperate and to provide Contractor with everything needed to complete the Services as, when and in the format requested by Contractor.

Contractor has the experience and ability to do everything Contractor agreed to for Client and will do it all in a professional and timely manner. Contractor will endeavor to meet every deadline that’s set and to meet the expectation for Services to the best of its abilities.<p>
"


```

Next, do a composer update using this method

```bash
composer update
```
If you have done the composer update, the next step is to prepare the database

note: don't forget to turn on apache and mysql services

```bash
php artisan migrate
```

Next, run the seeder to add the required data
```bash
php artisan db:seed Role
php artisan db:seed AllSeeder
```

When everything is done, then run this application as follows
```bash
php artisan serve
```
the application is running successfully, enjoy it!
