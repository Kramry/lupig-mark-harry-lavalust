# Product Management Frontend

A React.js frontend for the Product Management System.

## Prerequisites

- Node.js and npm installed
- LavaLust API backend running

## Installation

1. Install dependencies:
```bash
npm install
```

2. Create a `.env` file in the root directory:
```bash
cp .env.example .env
```

3. Configure the API URL in `.env`:
```
REACT_APP_API_URL=http://localhost/LavaLust-dev-v4/public
```

## Running the Application

Start the development server:
```bash
npm start
```

The application will open at http://localhost:3000

## Building for Production

```bash
npm run build
```

## Features

- User authentication (login/logout)
- Product CRUD operations
- Responsive design
- JWT token-based authentication

## Demo Credentials

- Username: `admin`
- Password: `admin123`
