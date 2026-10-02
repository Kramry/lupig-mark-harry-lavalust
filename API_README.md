# Product Management API - LavaLust Backend

A REST API built with LavaLust PHP Framework for managing products.

## Prerequisites

- PHP 7.4 or higher
- MySQL database (local or Aiven)
- Web server (Apache/Nginx) with URL rewriting

## Installation

1. Configure your database in `.env`:
```env
DB_DRIVER=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=mydb
DB_USERNAME=root
DB_PASSWORD=
DB_CHARSET=utf8mb4
```

For Aiven MySQL, use the connection details from your Aiven service page.

2. Generate application key:
```bash
php lava key:generate
```

3. Create the products table by running the SQL file:
```bash
mysql -u your_username -p your_database < app/sql/create_products_table.sql
```

Or run the SQL manually:
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

## API Endpoints

### Authentication

#### Login
- **POST** `/api/auth/login`
- Body: `{ "username": "admin", "password": "admin123" }`
- Response: `{ "status": "success", "data": { "token": "jwt_token", "username": "admin" } }`

#### Verify Token
- **GET** `/api/auth/verify`
- Headers: `Authorization: Bearer {token}`
- Response: `{ "status": "success", "data": { "username": "admin" } }`

### Products

All product endpoints require JWT authentication via `Authorization: Bearer {token}` header.

#### Get All Products
- **GET** `/api/products`
- Response: `{ "status": "success", "data": [...] }`

#### Get Single Product
- **GET** `/api/products/{id}`
- Response: `{ "status": "success", "data": {...} }`

#### Create Product
- **POST** `/api/products`
- Body: `{ "product_name": "...", "description": "...", "price": 99.99, "quantity": 10 }`
- Response: `{ "status": "success", "message": "Product created successfully", "data": { "id": 1 } }`

#### Update Product
- **POST** `/api/products/{id}`
- Body: `{ "product_name": "...", "description": "...", "price": 99.99, "quantity": 10 }`
- Response: `{ "status": "success", "message": "Product updated successfully" }`

#### Delete Product
- **GET** `/api/products/{id}/delete`
- Response: `{ "status": "success", "message": "Product deleted successfully" }`

## Demo Credentials

- Username: `admin`
- Password: `admin123`

## Security Notes

- In production, use proper password hashing and database authentication
- Store sensitive credentials in environment variables
- Never commit `.env` file to version control
- Use HTTPS in production
- Change JWT secret keys in `app/config/api.php`

## Deployment to Render

1. Push your code to GitHub
2. Connect your GitHub repository to Render
3. Configure environment variables in Render dashboard
4. Deploy
5. Update the API URL in the React frontend `.env` file

## Aiven MySQL Configuration

For Aiven MySQL with TLS:
1. Download the CA certificate from Aiven
2. Save it to your project (e.g., `certs/ca.pem`)
3. Configure in `.env`:
```env
DB_SSL_CA=C:\laragon\www\LavaLust-dev-v4\certs\ca.pem
```
