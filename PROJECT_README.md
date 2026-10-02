# Product Management System

A full-stack CRUD application built with React.js (frontend) and LavaLust PHP Framework (backend) with MySQL database.

## Project Structure

```
LavaLust-dev-v4/
├── app/                          # LavaLust backend
│   ├── controllers/
│   │   ├── ApiAuthController.php
│   │   ├── ApiProductController.php
│   │   ├── AuthController.php
│   │   └── ProductController.php
│   ├── models/
│   │   └── ProductModel.php
│   ├── config/
│   │   ├── routes.php
│   │   ├── api.php
│   │   └── middleware.php
│   ├── middlewares/
│   │   └── AuthMiddleware.php
│   └── sql/
│       └── create_products_table.sql
├── product-management-frontend/   # React frontend
│   ├── src/
│   │   ├── components/
│   │   │   ├── Login.js
│   │   │   ├── ProductList.js
│   │   │   └── ProductForm.js
│   │   ├── api.js
│   │   └── App.js
│   └── package.json
└── .env                          # Environment variables (not in git)
```

## Features

- **Authentication**: JWT token-based authentication
- **Product Management**: Full CRUD operations for products
- **Responsive UI**: Clean, modern React interface
- **REST API**: LavaLust API with JSON responses
- **Database**: MySQL with support for local or Aiven

## Setup Instructions

### Backend (LavaLust API)

1. **Configure Database**
   - Copy `.env.example` to `.env`
   - Update database credentials:
   ```env
   DB_DRIVER=mysql
   DB_HOST=localhost
   DB_PORT=3306
   DB_DATABASE=mydb
   DB_USERNAME=root
   DB_PASSWORD=
   ```

2. **Generate Application Key**
   ```bash
   php lava key:generate
   ```

3. **Create Database Table**
   ```bash
   mysql -u your_username -p your_database < app/sql/create_products_table.sql
   ```

4. **Enable API Helper**
   - Already enabled in `app/config/api.php`

5. **Run the API**
   - Point your web server to the `public` directory
   - Access at: `http://localhost/LavaLust-dev-v4/public`

### Frontend (React.js)

1. **Install Dependencies**
   ```bash
   cd product-management-frontend
   npm install
   ```

2. **Configure API URL**
   - Create `.env` file from `.env.example`
   - Set: `REACT_APP_API_URL=http://localhost/LavaLust-dev-v4/public`

3. **Start Development Server**
   ```bash
   npm start
   ```

4. **Access the Application**
   - Open: `http://localhost:3000`

## API Endpoints

### Authentication
- `POST /api/auth/login` - Login and get JWT token
- `GET /api/auth/verify` - Verify JWT token

### Products (requires authentication)
- `GET /api/products` - Get all products
- `GET /api/products/{id}` - Get single product
- `POST /api/products` - Create new product
- `POST /api/products/{id}` - Update product
- `GET /api/products/{id}/delete` - Delete product

## Demo Credentials

- **Username**: `admin`
- **Password**: `admin123`

## Deployment

### Backend to Render

1. Push backend code to GitHub
2. Create new web service on Render
3. Connect GitHub repository
4. Configure environment variables (DB credentials, APP_KEY)
5. Deploy
6. Update frontend `.env` with Render API URL

### Frontend to Vercel/Netlify

1. Push frontend code to GitHub
2. Connect to Vercel/Netlify
3. Configure `REACT_APP_API_URL` environment variable
4. Deploy

## Database Schema

```sql
CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_name VARCHAR(100) NOT NULL,
    description TEXT,
    price DECIMAL(10,2) NOT NULL,
    quantity INT NOT NULL DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

## Security Notes

⚠️ **Important for Production:**

- Use proper password hashing (bcrypt)
- Implement database-based authentication
- Change JWT secret keys in `app/config/api.php`
- Use HTTPS only
- Never commit `.env` files
- Implement rate limiting
- Add input validation and sanitization
- Use prepared statements (LavaLust handles this)

## Required Submissions

1. ✅ GitHub repository of the LavaLust API
2. ✅ GitHub repository of the React application
3. ⏳ Render API URL (after deployment)
4. ⏳ Frontend URL (after deployment)
5. ⏳ Screenshots of:
   - Login
   - Product list
   - Add product
   - Edit product
   - Delete product
   - Aiven database
6. ⏳ Working demonstration

## Technology Stack

- **Frontend**: React.js, Axios
- **Backend**: LavaLust PHP Framework
- **Database**: MySQL (local or Aiven)
- **Authentication**: JWT tokens
- **Deployment**: Render (backend), Vercel/Netlify (frontend)

## Troubleshooting

### CORS Issues
- Ensure `allow_origin` in `app/config/api.php` is set to `*` or your frontend domain

### Database Connection
- Verify database credentials in `.env`
- Check if MySQL server is running
- For Aiven, ensure TLS certificate path is correct

### JWT Errors
- Ensure `api_helper_enabled` is set to `TRUE` in `app/config/api.php`
- Check JWT secret keys are configured

## License

MIT License
