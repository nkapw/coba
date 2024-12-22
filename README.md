# API SPECS

## Invoices

### Create Invoice
- Method : `POST`
- Endpoint : `/api/invoices`
- Headers : `Content-Type: application/json`
- Request Body : 
```json
{
    "tanggal": "2024-12-10",
    "pemeriksa": "Drh. mukmin",
    "status": "paid",
    "user_id": 1,
    "details": [
        {
            "description": "Vaccination",
            "price": 75000,
            "quantity": 2,
            "total": 150000
        }
    ]
}
```

### Get All Invoice
- Method : `GET`
- Endpoint : `/api/invoices`
- Headers : `Content-Type: application/json`
- Response Body : 
```json
[
    {
        "id": 1,
        "user_id": 1,
        "tanggal": "2024-12-09",
        "pemeriksa": "Drh. Ahmad Fadhil",
        "status": "unpaid",
        "created_at": "2024-12-21T07:22:25.000000Z",
        "updated_at": "2024-12-21T07:22:25.000000Z",
        "details": [
            {
                "id": 1,
                "invoice_id": 1,
                "description": "Vaccination",
                "price": "75000.00",
                "quantity": 2,
                "total": "150000.00",
                "created_at": "2024-12-21T07:22:25.000000Z",
                "updated_at": "2024-12-21T07:22:25.000000Z"
            },
            {
                "id": 2,
                "invoice_id": 1,
                "description": "Health Check",
                "price": "120000.00",
                "quantity": 1,
                "total": "240000.00",
                "created_at": "2024-12-21T07:22:25.000000Z",
                "updated_at": "2024-12-21T07:22:25.000000Z"
            }
        ]
    },
    ...
]
```

### Get Invoice By ID
- Method : `GET`
- Endpoint : `/api/invoices/{id}`
- Headers : `Content-Type: application/json`
- Response Body : 
```json
{
    "id": 1,
    "user_id": 1,
    "tanggal": "2024-12-10",
    "pemeriksa": "Drh. jamal",
    "status": "paid",
    "created_at": "2024-12-21T07:22:25.000000Z",
    "updated_at": "2024-12-21T08:12:54.000000Z",
    "details": [
        {
            "id": 7,
            "invoice_id": 1,
            "description": "Vaccination",
            "price": "75000.00",
            "quantity": 2,
            "total": "150000.00",
            "created_at": "2024-12-21T08:12:54.000000Z",
            "updated_at": "2024-12-21T08:12:54.000000Z"
        }
    ]
}
```

### Get Invoice By UserID
- Method : `GET`
- Endpoint : `/api/invoices/users/{userid}`
- Headers : `Content-Type: application/json`
- Response Body : 
```json
[
    {
        "id": 1,
        "user_id": 1,
        "tanggal": "2024-12-10",
        "pemeriksa": "Drh. jamal",
        "status": "paid",
        "created_at": "2024-12-21T07:22:25.000000Z",
        "updated_at": "2024-12-21T08:12:54.000000Z",
        "details": [
            {
                "id": 7,
                "invoice_id": 1,
                "description": "Vaccination",
                "price": "75000.00",
                "quantity": 2,
                "total": "150000.00",
                "created_at": "2024-12-21T08:12:54.000000Z",
                "updated_at": "2024-12-21T08:12:54.000000Z"
            }
        ]
    }
]
```

### Update Invoice
- Method : `POST`
- Endpoint : `/api/invoices/{invoiceid}`
- Headers : `Content-Type: application/json`
- Request Body : 
```json
{
    "tanggal": "2024-12-10",
    "pemeriksa": "Drh. jamal",
    "status": "paid",
    "details": [
        {
            "description": "Vaccination",
            "price": 75000,
            "quantity": 2,
            "total": 150000
        }
    ]
}
```

## Auth

### Register
- Method : `POST`
- Endpoint : `/api/register`
- Headers : `Content-Type: application/json`
- Request Body : 
```json
{
    "name": "fulan",
    "email": "fulan@example.com",
    "password": "password123"
}
```

### Login
- Method : `POST`
- Endpoint : `/api/login`
- Headers : `Content-Type: application/json`
- Request Body : 
```json
{
    "email": "fulan@example.com",
    "password": "password123"
}
