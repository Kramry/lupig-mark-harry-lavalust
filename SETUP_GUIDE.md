# Product Management System - Setup Guide

## Current Status

✅ **Backend API**: Running at `http://localhost/LavaLust-dev-v4/public`
✅ **Frontend**: Running at `http://localhost:3000`
✅ **Login API**: Working (tested successfully)
⚠️ **Database**: Products table not created in Aiven MySQL

## Quick Start (Demo Mode)

The application is currently in **demo mode** with in-memory storage. This allows you to test the UI without setting up the database.

### Testing the Application

1. **Open the frontend**: http://localhost:3000
2. **Login with**: 
   - Username: `admin`
   - Password: `admin123`
3. **Test CRUD operations**: Add, edit, and delete products (data stored in memory)

## Setting Up Aiven MySQL (For Production)

To use a real database with Aiven MySQL:

### 1. Create the Products Table

Connect to your Aiven MySQL database and run:

```sql
CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_name VARCHAR(100) NOT NULL,
    description TEXT,
    price DECIMAL(10,2) NOT NULL,
    quantity INT NOT NULL DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

### 2. Update Database Configuration

Set the Aiven connection values in your `.env` file with your own credentials:
```env
DB_DRIVER=mysql
DB_HOST=your_aiven_host
DB_PORT=your_aiven_port
DB_DATABASE=your_database_name
DB_USERNAME=your_db_user
DB_PASSWORD=your_db_password
DB_SSL_CA=app/certs/ca.pem
```

### 3. Download Aiven CA Certificate

1. Go to your Aiven service dashboard
2. Download the CA certificate
3. Save it to: `app/certs/ca.pem`

### 4. Remove Demo Mode

After setting up the database, remove the mock data code from `app/models/ProductModel.php` to use the real database.

## API Endpoints

### Authentication
- `POST /api/auth/login` - Login and get token
- `GET /api/auth/verify` - Verify token

### Products (requires Bearer token)
- `GET /api/products` - Get all products
- `GET /api/products/{id}` - Get single product
- `POST /api/products` - Create product
- `POST /api/products/{id}` - Update product
- `GET /api/products/{id}/delete` - Delete product

## Deployment

### Backend to Render

1. Push code to GitHub
2. Create new web service on Render
3. Configure environment variables (DB credentials, APP_KEY)
4. Deploy

### Frontend to Vercel/Netlify

1. Push frontend to separate GitHub repo
2. Deploy to Vercel/Netlify
3. Set `REACT_APP_API_URL` to your Render API URL

## Files Modified

### Backend
- `app/controllers/ApiAuthController.php` - Authentication API
- `app/controllers/ApiProductController.php` - Products API
- `app/models/ProductModel.php` - Product model with demo mode
- `app/config/routes.php` - API routes
- `app/config/api.php` - API configuration enabled

### Frontend
- `product-management-frontend/src/App.js` - Main app component
- `product-management-frontend/src/api.js` - API client
- `product-management-frontend/src/components/Login.js` - Login component
- `product-management-frontend/src/components/ProductList.js` - Product list
- `product-management-frontend/src/components/ProductForm.js` - Product form

## Next Steps

1. ✅ Test the demo mode with the frontend
2. ⏳ Set up Aiven MySQL database (create products table)
3. ⏳ Remove demo mode from ProductModel
4. ⏳ Deploy to Render
5. ⏳ Deploy frontend to Vercel/Netlify
6. ⏳ Take screenshots for submission
