# Directory Path Fix - Quick Reference

## What Was Changed

Your application now uses **dynamic file paths** instead of hardcoded paths. This fixes the issue where links and includes were broken after deployment.

## Before (Broken on Deployment)
```php
// These hardcoded paths break when deployed to different servers
<a href="../index.php">Home</a>
<img src="images/logo.png" alt="Logo">
<img src="../images/logo.jpg" alt="Logo">
header("Location: ./reportform.php");
```

## After (Works Everywhere)
```php
// These dynamic paths work on any server
<a href="<?php echo baseUrl(); ?>">Home</a>
<img src="<?php echo imageUrl('logo.png'); ?>" alt="Logo">
<img src="<?php echo imageUrl('logo.jpg'); ?>" alt="Logo">
header("Location: " . pageUrl('reportform.php'));
```

## New Path Helper Functions

| Function | Usage | Example |
|----------|-------|---------|
| `baseUrl()` | Get app base URL | `<?php echo baseUrl(); ?>` |
| `imageUrl($file)` | Get image URL | `<?php echo imageUrl('logo.png'); ?>` |
| `pageUrl($file)` | Get page URL | `<?php echo pageUrl('login.php'); ?>` |
| `adminUrl($file)` | Get admin page URL | `<?php echo adminUrl('adminlogin.php'); ?>` |
| `assetUrl($path)` | Get asset URL | `<?php echo assetUrl('css/main.css'); ?>` |
| `uploadUrl($path)` | Get upload file URL | `<?php echo uploadUrl('reports/file.jpg'); ?>` |

## How It Works

1. **Auto-Detection**: The system automatically detects your application's location on the server
2. **Generates Correct URLs**: Creates proper URLs based on server configuration
3. **Works Everywhere**: Changes nothing in your code logic, just path handling

## Files Updated

✅ `config/paths.php` - **NEW** - Contains all path helper functions  
✅ `config/connect.php` - Now includes path helpers  
✅ `index.php` - Updated to use dynamic paths  
✅ `pages/reportform.php` - Updated links  
✅ `pages/login.php` - Updated links  
✅ `pages/userpage1.php` - Updated image paths  
✅ `admin/adminlogin.php` - Updated links  
✅ `admin/registeradmin.php` - Updated links  

## For Developers

When creating new pages or links:

### HTML Links
```php
// ✅ GOOD - Uses path helper
<a href="<?php echo pageUrl('reportform.php'); ?>">Report Emergency</a>
<a href="<?php echo adminUrl('admin_dashboard.php'); ?>">Dashboard</a>
<a href="<?php echo baseUrl(); ?>">Home</a>

// ❌ AVOID - Hardcoded paths
<a href="../pages/reportform.php">Report Emergency</a>
<a href="admin_dashboard.php">Dashboard</a>
<a href="../index.php">Home</a>
```

### Images
```php
// ✅ GOOD
<img src="<?php echo imageUrl('logo.png'); ?>">

// ❌ AVOID
<img src="images/logo.png">
<img src="../images/logo.jpg">
```

### JavaScript Redirects
```php
// ✅ GOOD
<script>
    window.location = '<?php echo pageUrl('reportform.php'); ?>';
</script>

// ❌ AVOID
<script>
    window.location = './reportform.php';
</script>
```

### PHP Includes (usually not needed)
```php
// The path system is used in config/connect.php which you already include
include("../config/connect.php");
// After this, all path functions are available
```

## Deployment Benefits

After deployment, your application will work correctly regardless of:
- ✅ Server location (root, subdirectory, subdomain)
- ✅ Domain changes
- ✅ Port changes
- ✅ SSL/HTTPS vs HTTP
- ✅ Moving between test/staging/production environments

## Testing

To verify paths are working:

1. Visit your homepage - all links should be clickable
2. Try the "Report Emergency" button - should go to report form
3. Try "Admin Login" - should go to admin login page
4. Upload an image - should store and serve correctly
5. Login and logout - redirects should work

If any links are broken, check:
1. Is `config/paths.php` being loaded?
2. Are you using `echo baseUrl()` syntax?
3. Check PHP error logs for issues