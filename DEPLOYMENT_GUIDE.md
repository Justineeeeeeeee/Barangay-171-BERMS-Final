# BERMS Deployment Guide - Directory Paths

## Overview

The BERMS application now uses a dynamic path system that works correctly regardless of where the application is deployed on the server. This guide explains the system and how to deploy your application.

## Dynamic Path System

### How It Works

All file paths are now managed through a centralized path helper system located in `config/paths.php`. This system:

1. **Detects the application root** automatically
2. **Generates correct URLs** based on the server configuration
3. **Works with any deployment structure** (subdirectories, different servers, etc.)

### Path Helper Functions

The following functions are available in all files that include `config/connect.php`:

#### Base URL Functions
```php
baseUrl()           // Get the base URL of application (e.g., http://example.com/berms)
assetUrl($path)     // Get URL for assets (CSS, JS, fonts)
imageUrl($name)     // Get URL for images folder
pageUrl($name)      // Get URL for pages folder
adminUrl($page)     // Get URL for admin folder
uploadUrl($path)    // Get URL for uploaded files
```

#### Usage Examples

**HTML Links:**
```php
<a href="<?php echo baseUrl(); ?>">Home</a>
<a href="<?php echo adminUrl('adminlogin.php'); ?>">Admin Login</a>
<a href="<?php echo pageUrl('reportform.php'); ?>">Report</a>
```

**Image Sources:**
```php
<img src="<?php echo imageUrl('logo.png'); ?>" alt="Logo">
```

**JavaScript Redirects:**
```php
<script>
    function goHome() {
        window.location = '<?php echo baseUrl(); ?>';
    }
</script>
```

## Deployment Scenarios

### Scenario 1: Root Domain
```
Domain: example.com
Files deployed to: /public_html/
URL: http://example.com
```
✅ Works automatically - no configuration needed

### Scenario 2: Subdirectory Deployment
```
Domain: example.com
Files deployed to: /public_html/berms/
URL: http://example.com/berms
```
✅ Works automatically - system detects subdirectory

### Scenario 3: Subdomain Deployment
```
Domain: berms.example.com
Files deployed to: /public_html/
URL: http://berms.example.com
```
✅ Works automatically - system detects domain

### Scenario 4: Different Server/Port
```
Domain: example.com:8080
Files deployed to: /var/www/berms/
URL: http://example.com:8080/berms
```
✅ Works automatically

## Deployment Steps

### 1. Upload Files
Upload all files to your server, maintaining the directory structure:
```
htdocs/
├── .env
├── .env.example
├── .htaccess
├── .gitignore
├── index.php
├── config/
│   ├── connect.php
│   ├── env.php
│   ├── paths.php
├── pages/
│   ├── login.php
│   ├── register.php
│   ├── reportform.php
│   └── ...
├── admin/
│   ├── adminlogin.php
│   ├── admin_dashboard.php
│   └── ...
├── uploads/
├── report_uploads/
├── images/
├── assets/
└── ...
```

### 2. Configure Environment
```bash
# Copy environment template
cp .env.example .env

# Edit .env with your production settings
nano .env
```

Update in `.env`:
- Database credentials
- App URL (optional - auto-detected if not set)
- Upload limits
- Email settings
- Emergency contacts

### 3. Set File Permissions
```bash
# Make uploads writable
chmod 755 uploads/
chmod 755 uploads/reports/
chmod 755 uploads/admins/
chmod 755 report_uploads/
chmod 755 admin_uploads/

# Protect config files
chmod 644 config/*.php
chmod 644 .env
```

### 4. Verify .htaccess
The `.htaccess` file includes protection for `.env` and other sensitive files. Verify it's in the root directory of your application.

### 5. Test URLs
Once deployed, test these URLs:
- `http://yourdomain.com/` - Should load homepage
- `http://yourdomain.com/pages/login.php` - Should load login
- `http://yourdomain.com/admin/adminlogin.php` - Should load admin login
- All links should work correctly without 404 errors

## Troubleshooting

### Issue: Links are broken (404 errors)
**Solution:** 
- Clear browser cache
- Check if `.htaccess` is present
- Verify server supports URL rewriting
- Check file permissions

### Issue: Images not loading
**Solution:**
- Verify `images/` directory exists
- Check `imageUrl()` function is being used
- Verify image file names match

### Issue: Database connection fails
**Solution:**
- Verify `.env` has correct credentials
- Test MySQL connection manually
- Check user permissions on database

### Issue: Uploads not working
**Solution:**
- Verify `uploads/` directory exists and is writable
- Check file permissions (755)
- Check PHP upload limits in `.env`

## Files Changed for Path System

The following files were updated to use the dynamic path system:

1. **config/paths.php** - ✨ NEW - Path helper functions
2. **config/connect.php** - Updated to include paths.php
3. **index.php** - Updated to use dynamic URLs
4. **pages/reportform.php** - Updated links and redirects
5. **pages/login.php** - Updated links
6. **pages/userpage1.php** - Updated image paths
7. **admin/adminlogin.php** - Updated links
8. **admin/registeradmin.php** - Updated links

## Environment Variables Reference

```env
# Basic Settings
APP_URL=http://localhost/berms    # (Optional) Override auto-detected URL
APP_NAME=BERMS
APP_ENV=development               # development or production

# Database
DB_HOST=localhost
DB_USER=root
DB_PASSWORD=
DB_NAME=incident_system

# Upload Settings
UPLOAD_MAX_SIZE=10485760
ALLOWED_FILE_TYPES=jpg,jpeg,png,gif,mp4,avi
```

## Best Practices

✅ **DO:**
- Use the path helper functions for all URLs
- Keep directory structure intact
- Use relative paths in PHP includes
- Update `.env` for each environment
- Test all links after deployment

❌ **DON'T:**
- Hardcode URLs in PHP files
- Mix path systems (helpers + hardcoded paths)
- Use `../../../` paths in HTML/JavaScript
- Deploy without configuring `.env`
- Commit `.env` to version control

## Support

For issues with deployment, check:
1. Server logs in `php_error.log`
2. `.env` file configuration
3. File permissions on upload directories
4. Apache `.htaccess` support enabled
5. PHP session handling is working