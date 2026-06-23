# 📘 API Guide: setting

This documentation is auto-generated for the **settings** table.

### 🚀 Endpoints
| Action | Method | Endpoint | Auth |
| :--- | :--- | :--- | :--- |
| List All | `GET` | `/settings` | Bearer |
| View One | `GET` | `/settings/{id}` | Bearer |
| Create | `POST` | `/settings` | Bearer |
| Update | `PUT` | `/settings/{id}` | Bearer |
| Delete | `DELETE` | `/settings/{id}` | Bearer |

### 📋 Database Schema
| Column | Type | Description |
| :--- | :--- | :--- |
| `id` | *bigint* | Field from database |
| `key` | *varchar* | Field from database |
| `value` | *varchar* | Field from database |
| `type` | *varchar* | Field from database |
| `created_at` | *timestamp* | Field from database |
| `updated_at` | *timestamp* | Field from database |
