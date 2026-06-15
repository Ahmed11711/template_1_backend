# 📘 API Guide: User

This documentation is auto-generated for the **users** table.

### 🚀 Endpoints
| Action | Method | Endpoint | Auth |
| :--- | :--- | :--- | :--- |
| List All | `GET` | `/users` | Bearer |
| View One | `GET` | `/users/{id}` | Bearer |
| Create | `POST` | `/users` | Bearer |
| Update | `PUT` | `/users/{id}` | Bearer |
| Delete | `DELETE` | `/users/{id}` | Bearer |

### 📋 Database Schema
| Column | Type | Description |
| :--- | :--- | :--- |
| `id` | *bigint* | Field from database |
| `name` | *varchar* | Field from database |
| `email` | *varchar* | Field from database |
| `password` | *varchar* | Field from database |
| `phone` | *varchar* | Field from database |
| `avatar` | *varchar* | Field from database |
| `role` | *varchar* | Field from database |
| `is_active` | *tinyint* | Field from database |
| `email_verified_at` | *timestamp* | Field from database |
| `remember_token` | *varchar* | Field from database |
| `created_at` | *timestamp* | Field from database |
| `updated_at` | *timestamp* | Field from database |
| `deleted_at` | *timestamp* | Field from database |
