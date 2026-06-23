# 📘 API Guide: Pages

This documentation is auto-generated for the **pages** table.

### 🚀 Endpoints
| Action | Method | Endpoint | Auth |
| :--- | :--- | :--- | :--- |
| List All | `GET` | `/pages` | Bearer |
| View One | `GET` | `/pages/{id}` | Bearer |
| Create | `POST` | `/pages` | Bearer |
| Update | `PUT` | `/pages/{id}` | Bearer |
| Delete | `DELETE` | `/pages/{id}` | Bearer |

### 📋 Database Schema
| Column | Type | Description |
| :--- | :--- | :--- |
| `id` | *bigint* | Field from database |
| `title` | *varchar* | Field from database |
| `slug` | *varchar* | Field from database |
| `status` | *varchar* | Field from database |
| `is_active` | *tinyint* | Field from database |
| `created_at` | *timestamp* | Field from database |
| `updated_at` | *timestamp* | Field from database |
