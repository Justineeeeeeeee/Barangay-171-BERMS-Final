# BERMS Deployment Guide - Vercel & Alternatives

## ⚠️ **IMPORTANT: Vercel Limitation**

**Vercel does NOT natively support PHP applications.**

Vercel is designed for:
- Node.js applications
- Static sites (HTML, CSS, JS)
- Serverless functions (JavaScript/Python)

BERMS is a **PHP application** and requires a PHP-compatible host.

---

## ✅ **RECOMMENDED: Use PHP-Compatible Hosting**

### **Option 1: Hostinger (⭐ Best Value)**
- **Cost**: $2.99/month (promotional)
- **Features**: PHP 8.2, MySQL, SSL, Email, cPanel
- **Steps**:
  1. Go to hostinger.com
  2. Choose "Business" or "Premium" plan
  3. Upload files via File Manager or FTP
  4. Import database from `database/incident_system.sql`
  5. Update `.env` with Hostinger credentials
  6. Done!

### **Option 2: SiteGround (⭐ Excellent Support)**
- **Cost**: $2.99/month (first year)
- **Features**: PHP 8.2+, MySQL, Let's Encrypt SSL, Staging
- **Good for**: Beginners, reliable hosting

### **Option 3: Heroku (⭐ Easy Deployment)**
- **Cost**: Free tier available (with limitations)
- **Features**: Automatic deploys from GitHub, PHP support
- **Steps**:
  1. `brew install heroku-cli`
  2. `heroku login`
  3. `heroku create your-app-name`
  4. `git push heroku main`

### **Option 4: Railway (⭐ Modern Platform)**
- **Cost**: Pay-as-you-go (free tier included)
- **Features**: PHP, MySQL, Git integration
- **Steps**:
  1. Sign up at railway.app
  2. Connect GitHub repository
  3. Set environment variables
  4. Auto-deployments on push

---

## ❌ **Why Vercel Won't Work**

1. **No PHP Runtime**: Vercel can't execute PHP code
2. **No Database**: Vercel is serverless (stateless)
3. **File Storage**: No persistent file system for uploads
4. **Sessions**: Can't maintain PHP sessions

---

## 🔄 **IF YOU MUST Use Vercel (Not Recommended)**

### **Option A: Rewrite to Node.js**
This would require completely rewriting the application using Express.js or similar framework. This is the most time-consuming option.

### **Option B: Use Serverless PHP**
Deploy PHP functions to AWS Lambda via Vercel, but this is complex and costly.

### **Option C: Static Site Generator**
Convert BERMS to a static site (not practical for a dynamic emergency system).

---

## 📋 **Quick Deployment Steps - Using Hostinger**

### **Step 1: Prepare Files**
```bash
# Remove Vercel files (not needed)
rm vercel.json

# Keep only needed database file
# Make sure .env is configured
```

### **Step 2: Create Hostinger Account**
- Go to hostinger.com
- Select hosting plan
- Register domain or use subdomain

### **Step 3: Upload Files via File Manager**
1. Login to Hostinger cPanel
2. Go to File Manager
3. Upload your BERMS files to `public_html/`
4. Create database for BERMS
5. Import `database/incident_system.sql`

### **Step 4: Configure Environment**
1. Edit `.env` with Hostinger database credentials
2. Set permissions:
   ```bash
   chmod 755 uploads/
   chmod 755 report_uploads/
   chmod 755 admin_uploads/
   ```

### **Step 5: Access Application**
- Visit `yourdomain.com`
- Login with admin credentials
- Start using BERMS!

---

## 📊 **Hosting Comparison**

| Hosting | PHP Support | MySQL | Price | Setup Difficulty | Recommendation |
|---------|-------------|-------|-------|-------------------|-----------------|
| Hostinger | ✅ | ✅ | $2.99/mo | Easy | ⭐⭐⭐⭐⭐ |
| SiteGround | ✅ | ✅ | $2.99/mo | Easy | ⭐⭐⭐⭐⭐ |
| Heroku | ✅ | ✅ | Free/Paid | Medium | ⭐⭐⭐⭐ |
| Railway | ✅ | ✅ | Pay-as-go | Easy | ⭐⭐⭐⭐ |
| Vercel | ❌ | ❌ | Free | N/A | ❌ Not Suitable |

---

## 🎯 **My Recommendation**

**Use Hostinger** because:
- ✅ Affordable ($2.99/month)
- ✅ Perfect for PHP applications
- ✅ Includes MySQL database
- ✅ Easy one-click installation
- ✅ Good customer support
- ✅ SSL certificate included

---

## 📝 **Files Prepared for Deployment**

✅ `config/paths.php` - Dynamic path handling  
✅ `config/env.php` - Environment configuration  
✅ `.env.example` - Copy this to `.env` on your host  
✅ `.gitignore` - Git configuration  
✅ All pages with dynamic paths  

---

## 🚀 **Next Steps**

1. **Choose a hosting provider** (I recommend Hostinger)
2. **Sign up for an account**
3. **Upload BERMS files**
4. **Configure `.env` with hosting credentials**
5. **Import database**
6. **Test your application**

---

## ⚡ **Quick Links**

- **Hostinger**: https://hostinger.com
- **SiteGround**: https://siteground.com
- **Heroku**: https://heroku.com
- **Railway**: https://railway.app
- **Your Repository**: https://github.com/Justineeeeeeeee/Barangay-171-BERMS-Final

---

## 💬 **Questions?**

If you have questions about deployment, feel free to ask! I'm here to help you get BERMS running on a production server. 🚀