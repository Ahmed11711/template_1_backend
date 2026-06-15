# 📘 API Guide: HomeSection

This documentation is auto-generated for the **home_sections** table.

### 🚀 Endpoints
| Action | Method | Endpoint | Auth |
| :--- | :--- | :--- | :--- |
| List All | `GET` | `/home-sections` | Bearer |
| View One | `GET` | `/home-sections/{id}` | Bearer |
| Create | `POST` | `/home-sections` | Bearer |
| Update | `PUT` | `/home-sections/{id}` | Bearer |
| Delete | `DELETE` | `/home-sections/{id}` | Bearer |

### 📋 Database Schema
| Column | Type | Description |
| :--- | :--- | :--- |
| `id` | *bigint* | Field from database |
| `title` | *varchar* | Field from database |
| `color` | *varchar* | Field from database |
| `sort_order` | *int* | Field from database |
| `is_active` | *tinyint* | Field from database |
| `created_at` | *timestamp* | Field from database |
| `updated_at` | *timestamp* | Field from database |
