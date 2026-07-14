# 📘 API Guide: Reviews

This documentation is auto-generated for the **reviews** table.

### 🚀 Endpoints
| Action | Method | Endpoint | Auth |
| :--- | :--- | :--- | :--- |
| List All | `GET` | `/api/v1/reviews` | Bearer |
| View One | `GET` | `/api/v1/reviews/{id}` | Bearer |
| Create | `POST` | `/api/v1/reviews` | Bearer |
| Update | `PUT` | `/api/v1/reviews/{id}` | Bearer |
| Delete | `DELETE` | `/api/v1/reviews/{id}` | Bearer |

### 📋 Database Schema
| Column | Type | Description |
| :--- | :--- | :--- |
| `id` | *bigint* | Field from database |
| `product_id` | *bigint* | Field from database |
| `user_id` | *bigint* | Field from database |
| `guest_name` | *varchar* | Field from database |
| `rating` | *tinyint* | Field from database |
| `comment` | *text* | Field from database |
| `emoji` | *varchar* | Field from database |
| `is_approved` | *tinyint* | Field from database |
| `created_at` | *timestamp* | Field from database |
| `updated_at` | *timestamp* | Field from database |
