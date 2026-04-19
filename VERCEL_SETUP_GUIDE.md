## Vercel Deployment Guide for BERMS

### ⚠️ **IMPORTANT LIMITATIONS**

Vercel's PHP support is **limited** and has the following constraints:

1. **Serverless Execution** - No persistent background processes
2. **No File System Persistence** - Uploads may not survive between deployments
3. **30-second timeout** - Long operations will fail
4. **Cold starts** - First request may be slow
5. **Limited database access** - Requires external database
6. **No session persistence** - Sessions stored in memory only

### ✅ **What Still Works**

- ✅ Basic routing and page serving
- ✅ Login/logout functionality
- ✅ Database read/write operations
- ✅ Report submission (with caveats)
- ✅ Admin dashboard
- ✅ Dynamic paths

### ❌ **What May Not Work**

- ❌ **File uploads** - Storage will be lost on redeployment
- ❌ **Sessions** - May reset between requests
- ❌ **Long operations** - >30 seconds will timeout
- ❌ **Background jobs** - Not supported
- ❌ **Local caching** - Memory-only storage

---

## Deployment Steps

### **Step 1: Prerequisites**

You need:
- ✅ Vercel account (vercel.com)
- ✅ GitHub repository (already have this!)
- ✅ External MySQL database (not provided by Vercel)
- ✅ File storage solution for uploads (optional)

### **Step 2: Set Up External Database**

Since Vercel doesn't provide MySQL:

**Option A: Use JawsDB (MySQL as a Service)**
1. Go to https://www.jawsdb.com/
2. Create an account
3. Create a new database
4. Get connection string
5. Save credentials for next step

**Option B: Use Hostinger's Remote Database**
1. Get database credentials from Hostinger/SiteGround
2. Make sure remote access is enabled
3. Save credentials

### **Step 3: Deploy on Vercel**

1. Go to https://vercel.com/new
2. Click "Import Project"
3. Select "GitHub" and choose your repository
4. Choose "Barangay-171-BERMS-Final"
5. Click "Import"
6. Set environment variables:
   ```
   DB_HOST=your-database-host
   DB_USER=your-database-user
   DB_PASSWORD=your-database-password
   DB_NAME=your-database-name
   APP_ENV=production
   APP_URL=https://your-vercel-domain.vercel.app
   ```
7. Click "Deploy"

### **Step 4: Test Your Deployment**

Visit: `https://your-project.vercel.app`

Test:
- ✅ Homepage loads
- ✅ Login page works
- ✅ Can perform database operations
- ✅ Admin dashboard accessible

### **Step 5: Configure File Uploads (Optional)**

For file uploads to persist, use a service like:

**Option A: Vercel Blob Storage**
```bash
npm install @vercel/blob
```

**Option B: AWS S3**
- Create S3 bucket
- Add credentials to environment variables
- Modify upload code

**Option C: Cloudinary**
- Create account
- Add credentials
- Modify upload code

---

## Configuration Details

The `vercel.json` file:
- ✅ Sets PHP 8.2 runtime
- ✅ Configures routing for all pages
- ✅ Sets up environment variables
- ✅ Enables 30-second timeouts
- ✅ Handles static file serving

---

## Environment Variables to Set

In Vercel dashboard, add these:

```
DB_HOST = your-mysql-host
DB_USER = your-mysql-user
DB_PASSWORD = your-mysql-password
DB_NAME = incident_system
APP_ENV = production
APP_DEBUG = false
APP_NAME = BERMS
SESSION_LIFETIME = 7200
```

---

## Troubleshooting

### **Database Connection Failed**
- Check credentials in environment variables
- Verify remote database access is enabled
- Test credentials locally first

### **Blank Page**
- Check Vercel logs: `vercel logs`
- Verify all environment variables are set
- Check PHP errors in logs

### **Timeouts**
- Vercel has 30-second limit
- Optimize database queries
- Avoid large file operations

### **Uploads Not Working**
- Vercel's filesystem is temporary
- Use external storage (S3, Blob, etc.)
- Or use external upload service

---

## Better Alternative: Hostinger

For better BERMS experience, consider **Hostinger**:

**Why Hostinger is better:**
- ✅ Full PHP support
- ✅ Persistent file storage
- ✅ Unlimited execution time
- ✅ MySQL included
- ✅ No cold starts
- ✅ $2.99/month introductory price

**Hostinger deployment:**
1. Sign up at hostinger.com
2. Upload files via FTP
3. Create database
4. Import SQL file
5. Edit `.env`
6. Done!

---

## Vercel CLI Alternative

Deploy from command line:

```bash
# Install Vercel CLI
npm i -g vercel

# Login
vercel login

# Deploy
vercel

# View logs
vercel logs
```

---

## FAQ

**Q: Will my app work perfectly on Vercel?**
A: Mostly yes, but file uploads may not persist between deployments.

**Q: Can I use Vercel for production?**
A: Yes, for basic BERMS needs. Use external database + storage.

**Q: How much does Vercel cost?**
A: Free tier available with limitations. Pro: $20/month.

**Q: What's the best hosting for BERMS?**
A: Traditional hosting (Hostinger, SiteGround) is recommended.

---

## Next Steps

1. ✅ Create Vercel account
2. ✅ Set up external MySQL database
3. ✅ Connect GitHub repository
4. ✅ Set environment variables
5. ✅ Deploy
6. ✅ Test your application

Your BERMS is ready for Vercel! 🚀