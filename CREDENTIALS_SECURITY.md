# Credentials Security Guide

## Overview
This project uses environment variables to manage sensitive credentials. Never commit actual credentials to the repository.

## Setup Instructions

### 1. Environment File Setup

**Copy the example file to create your local `.env` file:**
```bash
cp .env.example .env
```

### 2. Required Credentials

Add these credentials to your `.env` file based on the service:

#### Database
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=yafa_relief
DB_USERNAME=root
DB_PASSWORD=your_database_password
```

#### Mail (Mailtrap)
```
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_mailtrap_username
MAIL_PASSWORD=your_mailtrap_password
MAIL_FROM_ADDRESS=noreply@example.com
MAIL_FROM_NAME="Yafa Relief"
ADMIN_EMAIL=admin@example.com
```

#### Stripe
```
STRIPE_KEY=pk_test_your_publishable_key
STRIPE_SECRET=sk_test_your_secret_key
STRIPE_WEBHOOK_SECRET=whsec_your_webhook_secret
```

#### Cloudflare Turnstile
```
TURNSTILE_SITEKEY=your_site_key
TURNSTILE_SECRET=your_secret_key
```

#### AWS (Optional)
```
AWS_ACCESS_KEY_ID=your_access_key
AWS_SECRET_ACCESS_KEY=your_secret_key
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=your_bucket_name
```

### 3. Getting Credentials

- **Mailtrap**: Sign up at [mailtrap.io](https://mailtrap.io) and get credentials from Dashboard
- **Stripe**: Get keys from [Stripe Dashboard](https://dashboard.stripe.com)
- **Cloudflare Turnstile**: Configure at [Cloudflare](https://dash.cloudflare.com)

### 4. Local Development

For local development, test credentials are acceptable:
- Use Stripe test keys (starting with `pk_test_` or `sk_test_`)
- Use Turnstile test credentials
- Use a test email service account

### 5. Production Deployment

1. **Never commit `.env` file** to version control
2. **Set environment variables** on your production server:
   - Via hosting control panel
   - Via `.env` file on the server (not in repository)
   - Via environment variable manager (Docker, Kubernetes, etc.)
3. **Rotate credentials** periodically
4. **Use environment-specific secrets** for different environments (dev, staging, production)

### 6. Security Best Practices

- ✓ `.env` is in `.gitignore`
- ✓ Use `env()` function to access environment variables
- ✓ Use `config()` function to access configuration
- ✓ Never log sensitive credentials
- ✓ Rotate API keys and secrets regularly
- ✓ Use strong, unique passwords
- ✓ Enable API restrictions on Stripe and other services
- ✓ Use webhook signatures to verify external API calls

### 7. Code Access Patterns

**Correct:**
```php
// Using env() function
$mailtrapPassword = env('MAIL_PASSWORD');

// Using config() function
$stripeSecret = config('services.stripe.secret');
```

**Incorrect:**
```php
// NEVER hardcode credentials
$password = 'actual_password_123';
$key = 'sk_test_hardcoded_key';
```

### 8. CI/CD Pipeline

When deploying:
1. Use secret management tools (GitHub Secrets, GitLab Variables, etc.)
2. Never expose credentials in build logs
3. Use masked variables in CI/CD configurations
4. Test with dummy/mock credentials before production deployment

## Emergency: Compromised Credentials

If credentials are exposed:
1. **Immediately revoke** the exposed key/credential
2. **Generate new credentials** from the service
3. **Update** the `.env` file
4. **Monitor** the service for unauthorized usage
5. **Audit** logs for any unauthorized access

## References

- [Laravel Environment Variables](https://laravel.com/docs/configuration#environment-variable-types)
- [Stripe Security](https://stripe.com/docs/security)
- [Cloudflare Turnstile Docs](https://developers.cloudflare.com/turnstile/)
