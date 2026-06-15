# 📘 API Guide: UserDeposite

This documentation is auto-generated for the **user_deposits** table.

### 🚀 Endpoints
| Action | Method | Endpoint | Auth |
| :--- | :--- | :--- | :--- |
| List All | `GET` | `/api/v1/user_deposites` | Bearer |
| View One | `GET` | `/api/v1/user_deposites/{id}` | Bearer |
| Create | `POST` | `/api/v1/user_deposites` | Bearer |
| Update | `PUT` | `/api/v1/user_deposites/{id}` | Bearer |
| Delete | `DELETE` | `/api/v1/user_deposites/{id}` | Bearer |

### 📋 Database Schema
| Column | Type | Description |
| :--- | :--- | :--- |
| `id` | *bigint* | Field from database |
| `user_id` | *bigint* | Field from database |
| `amount` | *decimal* | Field from database |
| `user_phone` | *varchar* | Field from database |
| `company_phone` | *varchar* | Field from database |
| `image` | *varchar* | Field from database |
| `status` | *enum* | Field from database |
| `type` | *enum* | Field from database |
| `note` | *text* | Field from database |
| `created_at` | *timestamp* | Field from database |
| `updated_at` | *timestamp* | Field from database |
