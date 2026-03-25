# Git Security Rules

This file documents what should NEVER be committed to the repository.

## Files Protected by .gitignore

The following files/directories are already protected and should NOT be committed:

### Environment & Secrets
- `.env` - Contains all local environment variables and credentials
- `.env.production` - Production environment variables
- `.env.backup` - Backup of environment file

### Build & Dependencies
- `/vendor` - Composer dependencies
- `/node_modules` - NPM packages
- `/public/build` - Vite/build output
- `/public/hot` - Hot reload file

### Sensitive Data
- `/storage/*.key` - Encryption keys
- `/storage/logs` - Application logs
- `/storage/pail` - Pail logs

### IDE/Editor Files
- `/.idea` - PHPStorm
- `/.vscode` - VS Code
- `/.phpactor.json` - PHPActor
- `.nova` - Laravel Nova
- `.zed` - Zed editor
- `.fleet` - Fleet IDE

### Files to Never Commit

1. **Environment Variables**
   ```
   .env          # Local configuration with credentials
   .env.local    # Local overrides
   .env.*.local  # Environment-specific local overrides
   ```

2. **Credentials & Secrets**
   ```
   STRIPE_KEY=sk_test_xyz...
   MAIL_PASSWORD=actual_password
   API_SECRET=secret_key
   JWT_SECRET=secret
   ```

3. **API Keys**
   ```
   AWS_ACCESS_KEY_ID=AKIA...
   AWS_SECRET_ACCESS_KEY=...
   POSTMARK_API_KEY=...
   TURNSTILE_SECRET=...
   ```

4. **Database Credentials**
   ```
   DB_USERNAME=root
   DB_PASSWORD=password123
   ```

5. **Encryption Keys**
   ```
   APP_KEY=base64:xyz...
   storage/app/keys/
   ```

6. **Authentication Tokens**
   ```
   AUTH_TOKEN=...
   GITHUB_TOKEN=...
   GITLAB_TOKEN=...
   ```

## What SHOULD Be Committed

1. **Configuration Templates**
   - `.env.example` - Example environment variables (NO actual values)
   - `config/*.php` - Configuration files using `env()` calls

2. **Code & Documentation**
   - `app/` - Application code
   - `routes/` - Route definitions
   - `resources/` - Views and assets
   - `database/` - Migrations and seeders
   - `README.md` - Documentation
   - `CREDENTIALS_SECURITY.md` - This guide!

3. **Git & Project Files**
   - `.gitignore` - Git ignore rules
   - `composer.json` - Package definitions
   - `composer.lock` - Lock file (handle carefully)
   - `package.json` - NPM packages
   - `phpunit.xml` - Test configuration

## Best Practices

### 1. Never Commit Credentials
```bash
# BAD - Commits credentials
git add .env
git commit -m "Add environment"

# GOOD - Use .env.example instead
cp .env.example .env  # Local only
# .env is in .gitignore, not committed
```

### 2. Use Environment Variables
```php
// BAD
$apiKey = 'sk_test_51OEpKNSHfg0UcB9mz...';

// GOOD
$apiKey = env('STRIPE_SECRET');
// or
$apiKey = config('services.stripe.secret');
```

### 3. Check Before Committing
```bash
# Review what will be committed
git status

# Check for .env or secret files
git ls-files | grep -E "\.env|secrets|credential"

# If accidentally added, remove it
git rm --cached .env
git commit -m "Remove .env from tracking"

# Rotate the exposed credentials immediately!
```

### 4. Rotate Compromised Credentials

If credentials are exposed:
1. **Revoke** the exposed key/token immediately
2. **Generate** new credentials
3. **Update** `.env` file
4. **Monitor** the service for unauthorized usage
5. **Inform** the team and relevant parties
6. **Document** the incident

## Setup Process for New Developers

1. Clone the repository
   ```bash
   git clone <repository>
   cd project
   ```

2. Copy environment template
   ```bash
   cp .env.example .env
   ```

3. Add your local credentials to `.env`
   ```
   STRIPE_KEY=pk_test_your_key
   MAIL_PASSWORD=your_password
   ```

4. Verify `.env` is in `.gitignore`
   ```bash
   cat .gitignore | grep '\.env'
   ```

5. Generate app key
   ```bash
   php artisan key:generate
   ```

## Testing Credentials

For local development, use test/sandbox credentials:
- **Stripe**: Use `pk_test_*` and `sk_test_*` keys
- **Mailgun/Postmark**: Use test domains
- **Cloudflare Turnstile**: Use test site keys
- **AWS**: Use IAM user with limited permissions for development

## CI/CD Security

### GitHub Actions
```yaml
jobs:
  deploy:
    runs-on: ubuntu-latest
    env:
      STRIPE_KEY: ${{ secrets.STRIPE_KEY }}
      MAIL_PASSWORD: ${{ secrets.MAIL_PASSWORD }}
```

### GitLab CI
```yaml
deploy:
  script:
    - STRIPE_KEY=$CI_JOB_TOKEN php artisan deploy
```

### Environment Variables
- Never echo secrets in logs
- Use masked variables in CI/CD
- Rotate credentials regularly
- Audit CI/CD logs

## Tools to Prevent Credential Leaks

1. **Pre-commit Hooks**
   Use `pre-commit` to scan before committing:
   ```bash
   # Install pre-commit hooks
   pre-commit install
   
   # Scans for secrets before commit
   ```

2. **Git Guardian**
   Scans repositories for exposed credentials

3. **TruffleHog**
   ```bash
   trufflehog filesystem /path/to/repo
   ```

4. **OWASP Secrets Scanning**
   Integrated in many CI/CD platforms

## References

- [OWASP: Secrets Management](https://cheatsheetseries.owasp.org/cheatsheets/Secrets_Management_Cheat_Sheet.html)
- [Gitignore Best Practices](https://git-scm.com/docs/gitignore)
- [Laravel Security](https://laravel.com/docs/security)
- [12 Factor App](https://12factor.net/config)
