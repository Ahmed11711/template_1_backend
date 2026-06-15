# 📘 API Guide: UserOrder

This documentation is auto-generated for the **user_orders** table.

### 🚀 Endpoints
| Action | Method | Endpoint | Auth |
| :--- | :--- | :--- | :--- |
| List All | `GET` | `/user-orders` | Bearer |
| View One | `GET` | `/user-orders/{id}` | Bearer |
| Create | `POST` | `/user-orders` | Bearer |
| Update | `PUT` | `/user-orders/{id}` | Bearer |
| Delete | `DELETE` | `/user-orders/{id}` | Bearer |

### 📋 Database Schema
| Column | Type | Description |
| :--- | :--- | :--- |
| `id` | *bigint* | Field from database |
| `user_id` | *bigint* | Field from database |
| `order_id` | *bigint* | Field from database |
| `seats_count` | *int* | Field from database |
| `price` | *decimal* | Field from database |
| `payment_status` | *enum* | Field from database |
| `payment_method` | *varchar* | Field from database |
| `transaction_id` | *varchar* | Field from database |
| `status` | *enum* | Field from database |
| `created_at` | *timestamp* | Field from database |
| `updated_at` | *timestamp* | Field from database |
