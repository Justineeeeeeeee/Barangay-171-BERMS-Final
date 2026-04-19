# Add These Environment Variables to Vercel

Follow these exact steps to add your InfinityFree database credentials to Vercel:

## Step-by-Step Instructions:

1. **Go to your Vercel project dashboard**
   - URL: https://vercel.com/dashboard
   - Find "Barangay-171-BERMS-Final" project

2. **Click on the project name**

3. **Go to Settings**
   - Click the **Settings** tab at the top

4. **Click Environment Variables**
   - In the left sidebar, find **Environment Variables**

5. **Add Each Variable** (click "Add" for each one):

   First variable:
   - **Name**: `DB_HOST`
   - **Value**: `sql105.infinityfree.com`
   - Click "Add"

   Second variable:
   - **Name**: `DB_USER`
   - **Value**: `if0_41697896`
   - Click "Add"

   Third variable:
   - **Name**: `DB_PASSWORD`
   - **Value**: `DF3ArYxTbL9d`
   - Click "Add"

   Fourth variable:
   - **Name**: `DB_NAME`
   - **Value**: `if0_41697896_barangay171_monitoring_system`
   - Click "Add"

6. **Redeploy Your Project**
   - Go to **Deployments** tab
   - Find the latest deployment
   - Click **Redeploy** button
   - Wait 1-2 minutes for it to build and deploy

7. **Test Your App**
   - Visit your Vercel app URL (https://your-project-name.vercel.app)
   - You should see your BERMS app load without database errors
   - Try submitting a report to verify database is working

## If You Don't Know Your Vercel Project URL:

1. In Vercel dashboard, look for the project name "Barangay-171-BERMS-Final"
2. It will show as a link like: `barangay-171-berms-final.vercel.app`
3. That's your live URL!

## Testing the Connection:

After redeploying:
1. Visit your Vercel app URL
2. If you see the BERMS homepage (no error), database is connected ✅
3. If you see a database error, check that all 4 environment variables are added correctly
4. You may need to wait a few extra minutes for variables to take effect

## Troubleshooting:

**Error still showing?**
- Make sure all 4 variables are added (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
- Check spelling carefully (credentials are case-sensitive)
- Click **Redeploy** again
- Wait 2-3 minutes and refresh the page

**Database working but reports not showing?**
- Your InfinityFree database may not have the tables yet
- You'll need to run the SQL schema
- See `DATABASE_SCHEMA_SETUP.md` for instructions

Done! Your BERMS is now connected to InfinityFree database on Vercel. 🚀
