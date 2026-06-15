# 📘 API Guide: Order

This documentation is auto-generated for the **orders** table.

### 🚀 Endpoints
| Action | Method | Endpoint | Auth |
| :--- | :--- | :--- | :--- |
| List All | `GET` | `/orders` | Bearer |
| View One | `GET` | `/orders/{id}` | Bearer |
| Create | `POST` | `/orders` | Bearer |
| Update | `PUT` | `/orders/{id}` | Bearer |
| Delete | `DELETE` | `/orders/{id}` | Bearer |

### 📋 Database Schema
| Column | Type | Description |
| :--- | :--- | :--- |
| `id` | *bigint* | Field from database |
| `user_id` | *bigint* | Field from database |
| `driver_id` | *bigint* | Field from database |
| `station_id` | *bigint* | Field from database |
| `departure_time` | *time* | Field from database |
| `total_seats` | *int* | Field from database |
| `available_seats` | *int* | Field from database |
| `seat_price` | *decimal* | Field from database |
| `status` | *enum* | Field from database |
| `notes` | *text* | Field from database |
| `created_at` | *timestamp* | Field from database |
| `updated_at` | *timestamp* | Field from database |
