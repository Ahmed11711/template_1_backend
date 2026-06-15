# 📘 API Guide: Categories

This documentation is auto-generated for the **categories** table.

### 🚀 Endpoints
| Action | Method | Endpoint | Auth |
| :--- | :--- | :--- | :--- |
| List All | `GET` | `/categories` | Bearer |
| View One | `GET` | `/categories/{id}` | Bearer |
| Create | `POST` | `/categories` | Bearer |
| Update | `PUT` | `/categories/{id}` | Bearer |
| Delete | `DELETE` | `/categories/{id}` | Bearer |

### 📋 Database Schema
| Column | Type | Description |
| :--- | :--- | :--- |
| `id` | *bigint* | Field from database |
| `name` | *varchar* | Field from database |
| `slug` | *varchar* | Field from database |
| `description` | *text* | Field from database |
| `is_featured` | *tinyint* | Field from database |
| `image` | *varchar* | Field from database |
| `sort_order` | *int* | Field from database |
| `is_active` | *tinyint* | Field from database |
| `meta_title` | *varchar* | Field from database |
| `meta_description` | *varchar* | Field from database |
| `promotional_text` | *varchar* | Field from database |
| `created_at` | *timestamp* | Field from database |
| `updated_at` | *timestamp* | Field from database |
