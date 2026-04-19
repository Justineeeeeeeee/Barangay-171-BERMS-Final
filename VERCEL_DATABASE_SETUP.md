# Setting Up MySQL Database for BERMS on Vercel

## Issue Fixed
✅ PHP files are now executing (not downloading)
✅ Session headers issue resolved

## Next Step: Connect to External MySQL Database

Vercel does **NOT** provide MySQL. You must set up an external database and add credentials to Vercel.

### Option 1: JawsDB (Easiest)

1. **Sign up**: https://www.jawsdb.com (free tier available)
2. **Create a database**
3. **Copy credentials** from JawsDB dashboard:
   - Host
   - User
   - Password
   - Database name
4. **Add to Vercel**:
   - Go to your Vercel project dashboard
   - Click **Settings** → **Environment Variables**
   - Add these variables:

```
DB_HOST=<your-jawsdb-host>
DB_USER=<your-jawsdb-user>
DB_PASSWORD=<your-jawsdb-password>
DB_NAME=<your-jawsdb-database-name>
```

5. **Redeploy**: Go to **Deployments** and click **Redeploy** on the latest deployment

### Option 2: Hostinger Remote MySQL

If you have Hostinger hosting:

1. **Create Remote Database** in Hostinger cPanel
2. **Get connection details**
3. **Add to Vercel Environment Variables** (same as above)

### Option 3: AWS RDS

For production:

1. Create MySQL RDS instance on AWS
2. Configure security groups to allow Vercel IPs
3. Add connection details to Vercel Environment Variables

## Verify Connection

After adding environment variables and redeploying:

1. Visit your Vercel app URL
2. If you see a database error message, check variables are correct
3. If page loads, database is connected! ✅

## Troubleshooting

**Still seeing database error?**
- Verify environment variables in Vercel dashboard
- Check database credentials are correct
- Ensure database host is accessible from internet
- Redeploy after adding variables (wait ~2 minutes)

**Need help?**
- JawsDB docs: https://docs.jawsdb.com
- Vercel Environment Vars: https://vercel.com/docs/environment-variables

## Test Your Database Connection

Once connected, test by:
1. Going to the report form page
2. Submitting a test report
3. Check if it appears in the admin dashboard

If all works, BERMS is fully deployed on Vercel! 🚀
