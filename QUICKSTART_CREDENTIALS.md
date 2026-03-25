# Quick Start - Credentials Setup

## Step-by-Step Setup

### 1. First Time Setup
```bash
# Copy the example file
cp .env.example .env

# Edit .env and add your credentials
code .env  # or your editor

# Generate application key
php artisan key:generate
```

### 2. Required Credentials to Fill In

**Database**
- DB_HOST: `127.0.0.1`
- DB_PORT: `3306`
- DB_DATABASE: `yafa_relief`
- DB_USERNAME: `root`
- DB_PASSWORD: Leave empty or your MySQL password

**Email (Mailtrap)**
- MAIL_MAILER: `smtp`
- MAIL_HOST: `sandbox.smtp.mailtrap.io`
- MAIL_USERNAME: Get from [mailtrap.io](https://mailtrap.io)
- MAIL_PASSWORD: Get from [mailtrap.io](https://mailtrap.io)
- MAIL_FROM_ADDRESS: Valid email
- ADMIN_EMAIL: Your email

**Stripe** (Optional for testing)
- STRIPE_KEY: Get from [stripe.com](https://dashboard.stripe.com) - starts with `pk_test_`
- STRIPE_SECRET: Get from [stripe.com](https://dashboard.stripe.com) - starts with `sk_test_`
- STRIPE_WEBHOOK_SECRET: Get from Stripe → Webhooks - starts with `whsec_`

**Cloudflare Turnstile** (Optional for CAPTCHA)
- TURNSTILE_SITEKEY: Get from [Cloudflare](https://dash.cloudflare.com)
- TURNSTILE_SECRET: Get from [Cloudflare](https://dash.cloudflare.com)

### 3. Verify Setup
```bash
# Check that .env is ignored by Git
grep ".env" .gitignore

# Should output: .env

# Run tests to ensure everything works
php artisan tinker
```

### 4. Important Reminders
- ✅ Copy `.env.example` to `.env`
- ✅ Fill in your credentials in `.env`
- ✅ Never commit `.env` to Git
- ✅ Use test credentials for development
- ✅ Keep `.env.example` without actual values

## Common Issues

### "ERROR: No application key has been set"
```bash
php artisan key:generate
```

### "SQLSTATE: Connection refused"
- Check `DB_HOST` is correct (usually `127.0.0.1`)
- Check `DB_PORT` is correct (usually `3306`)
- Verify MySQL is running
- Check username and password

### "Mailtrap Error"
- Sign up at [mailtrap.io](https://mailtrap.io)
- Copy credentials from Dashboard
- Use `sandbox.smtp.mailtrap.io` as host

### "STRIPE_KEY is missing"
- For development, this is optional
- Get test keys from [Stripe Dashboard](https://dashboard.stripe.com)
- Ensure keys start with `pk_test_` and `sk_test_`

## Production Deployment

1. Set environment variables on your server:
   ```bash
   # Via hosting control panel or:
   export STRIPE_KEY="sk_live_xxx"
   export MAIL_PASSWORD="real_password"
   ```

2. Never use `.env` file in production
3. Use proper secrets management
4. Use live (not test) API keys
5. Set `APP_ENV=production`
6. Set `APP_DEBUG=false`

## Security Command Checklist
```bash
# Verify .env is in .gitignore
grep -E "\.env|secrets" .gitignore

# Check if .env was accidentally committed
git log --all --full-history -- ".env"

# If accidentally committed, remove it permanently
git rm --cached .env
git commit -m "Remove .env from version control"
```

## File Permissions
```bash
# Ensure .env is readable only by application
chmod 600 .env

# Ensure storage is writable
chmod 775 storage/
```

## Next Steps
- Read [CREDENTIALS_SECURITY.md](./CREDENTIALS_SECURITY.md) for detailed setup
- Read [GIT_SECURITY.md](./GIT_SECURITY.md) for security rules
- Read [SECURITY_CHECKLIST.md](./SECURITY_CHECKLIST.md) for full checklist
