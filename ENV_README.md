# Barangay Emergency Response and Monitoring System (BERMS)

## Environment Configuration

This application uses environment variables for configuration to make deployment easier across different environments (development, staging, production).

### Setup

1. **Copy the environment template:**
   ```bash
   cp .env.example .env
   ```

2. **Edit the `.env` file** with your specific configuration values.

3. **Important:** Never commit the `.env` file to version control. The `.env.example` file is safe to commit.

### Configuration Options

#### Database Configuration
```env
DB_HOST=localhost          # Database server hostname
DB_USER=root              # Database username
DB_PASSWORD=              # Database password
DB_NAME=incident_system   # Database name
```

#### Application Settings
```env
APP_NAME=BERMS                    # Application name
APP_ENV=development              # Environment (development/production)
APP_DEBUG=true                   # Enable debug mode
APP_URL=http://localhost/path    # Base URL of the application
```

#### File Upload Settings
```env
UPLOAD_MAX_SIZE=10485760          # Max file size in bytes (10MB)
ALLOWED_FILE_TYPES=jpg,jpeg,png,gif,mp4,avi  # Comma-separated allowed extensions
```

#### Email Configuration (Future Use)
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@berms.gov.ph
MAIL_FROM_NAME=BERMS System
```

#### Barangay Information
```env
BARANGAY_NAME=Barangay 171
BARANGAY_CAPTAIN=John Dela Cruz
BARANGAY_CONTACT=+63 917-123-4567
```

#### Emergency Contacts
```env
EMERGENCY_FIRE=+63 917-123-4567
EMERGENCY_AMBULANCE=+63 917-234-5678
EMERGENCY_POLICE=+63 917-345-6789
```

### Deployment Checklist

- [ ] Copy `.env.example` to `.env`
- [ ] Update database credentials
- [ ] Set `APP_ENV=production` for live sites
- [ ] Set `APP_DEBUG=false` for production
- [ ] Update `APP_URL` to your domain
- [ ] Configure email settings if needed
- [ ] Update barangay information
- [ ] Set emergency contact numbers
- [ ] Test file uploads with new size limits

### Security Notes

- The `.env` file is protected by `.htaccess` and should not be accessible via web
- Never commit sensitive information like passwords or API keys
- Use strong, unique passwords for database and email accounts
- Consider using environment-specific `.env` files (`.env.production`, `.env.staging`)

### Using Environment Variables in Code

The application includes helper functions in `config/env.php`:

```php
// Get environment variable
$value = env('DB_HOST', 'localhost');

// Check if debug mode
if (isDebug()) {
    // Debug code
}

// Get upload configuration
$config = getUploadConfig();

// Get barangay info
$barangay = getBarangayInfo();

// Get emergency contacts
$contacts = getEmergencyContacts();
```

### Troubleshooting

1. **Environment variables not loading?**
   - Check if `.env` file exists in the root directory
   - Ensure file permissions allow reading
   - Check PHP error logs

2. **Database connection fails?**
   - Verify `DB_*` variables are correct
   - Check database server is running
   - Ensure user has proper permissions

3. **File uploads not working?**
   - Check `UPLOAD_MAX_SIZE` is reasonable
   - Verify `ALLOWED_FILE_TYPES` includes desired extensions
   - Check directory permissions for `uploads/` folder