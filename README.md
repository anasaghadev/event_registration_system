# Laravel Project Setup Guide

## 1. Install Dependencies

````bash
composer install
npm install

# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate


# Email Configuration (Example for Mailtrap)
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_mailtrap_user
MAIL_PASSWORD=your_mailtrap_pass
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"

# Run migrations
php artisan migrate

# Run seeders
php artisan db:seed

# Optional: Run migrations and seeders together
php artisan migrate --seed

php artisan storage:link

# Start Laravel server
php artisan serve

# Start frontend build (in separate terminal)
npm run build
# Clear cache
php artisan optimize:clear
# run the queue for email send to work
php artisan queue:work




### Important Notes:
1. **Email Setup**:
   - For production, use real SMTP credentials (Mailgun, SendGrid, etc.)
   - For testing, create a free account at [Mailtrap.io](https://mailtrap.io) and use their sandbox credentials

2. **Environment Variables**:
   - Update all `your_*` placeholders with your actual values
   - For file storage (if used), configure `FILESYSTEM_DISK` in `.env`

3. **Database**:
   - Create the database first before running migrations
   - Seeders will populate initial data (users, etc.)

4. **Troubleshooting**:
   ```bash
   # If you get permission errors:
   chmod -R 775 storage bootstrap/cache

   # If you change .env values:
   php artisan config:clear
````
