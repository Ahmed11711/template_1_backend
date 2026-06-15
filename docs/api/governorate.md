# 📘 API Guide: Governorate

This documentation is auto-generated for the **governorates** table.

### 🚀 Endpoints
| Action | Method | Endpoint | Auth |
| :--- | :--- | :--- | :--- |
| List All | `GET` | `/governorates` | Bearer |
| View One | `GET` | `/governorates/{id}` | Bearer |
| Create | `POST` | `/governorates` | Bearer |
| Update | `PUT` | `/governorates/{id}` | Bearer |
| Delete | `DELETE` | `/governorates/{id}` | Bearer |

### 📋 Database Schema
| Column | Type | Description |
| :--- | :--- | :--- |
| `id` | *bigint* | Field from database |
| `name` | *varchar* | Field from database |
| `code` | *varchar* | Field from database |
| `is_active` | *tinyint* | Field from database |
| `created_at` | *timestamp* | Field from database |
| `updated_at` | *timestamp* | Field from database |
