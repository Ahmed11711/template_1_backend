# 📘 API Guide: Station

This documentation is auto-generated for the **stations** table.

### 🚀 Endpoints
| Action | Method | Endpoint | Auth |
| :--- | :--- | :--- | :--- |
| List All | `GET` | `/stations` | Bearer |
| View One | `GET` | `/stations/{id}` | Bearer |
| Create | `POST` | `/stations` | Bearer |
| Update | `PUT` | `/stations/{id}` | Bearer |
| Delete | `DELETE` | `/stations/{id}` | Bearer |

### 📋 Database Schema
| Column | Type | Description |
| :--- | :--- | :--- |
| `id` | *bigint* | Field from database |
| `user_id` | *bigint* | Field from database |
| `title` | *varchar* | Field from database |
| `rating` | *varchar* | Field from database |
| `image` | *varchar* | Field from database |
| `address` | *text* | Field from database |
| `is_active` | *tinyint* | Field from database |
| `created_at` | *timestamp* | Field from database |
| `updated_at` | *timestamp* | Field from database |
