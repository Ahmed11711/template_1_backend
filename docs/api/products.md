# 📘 API Guide: Products

This documentation is auto-generated for the **products** table.

### 🚀 Endpoints
| Action | Method | Endpoint | Auth |
| :--- | :--- | :--- | :--- |
| List All | `GET` | `/products` | Bearer |
| View One | `GET` | `/products/{id}` | Bearer |
| Create | `POST` | `/products` | Bearer |
| Update | `PUT` | `/products/{id}` | Bearer |
| Delete | `DELETE` | `/products/{id}` | Bearer |

### 📋 Database Schema
| Column | Type | Description |
| :--- | :--- | :--- |
| `id` | *bigint* | Field from database |
| `category_id` | *bigint* | Field from database |
| `name` | *varchar* | Field from database |
| `slug` | *varchar* | Field from database |
| `short_description` | *text* | Field from database |
| `description` | *longtext* | Field from database |
| `sku` | *varchar* | Field from database |
| `price` | *decimal* | Field from database |
| `compare_price` | *decimal* | Field from database |
| `cost_price` | *decimal* | Field from database |
| `track_stock` | *tinyint* | Field from database |
| `stock_quantity` | *int* | Field from database |
| `low_stock_threshold` | *int* | Field from database |
| `is_active` | *tinyint* | Field from database |
| `is_featured` | *tinyint* | Field from database |
| `sort_order` | *int* | Field from database |
| `meta_title` | *varchar* | Field from database |
| `meta_description` | *varchar* | Field from database |
| `views_count` | *int* | Field from database |
| `average_rating` | *decimal* | Field from database |
| `reviews_count` | *int* | Field from database |
| `created_at` | *timestamp* | Field from database |
| `updated_at` | *timestamp* | Field from database |
| `deleted_at` | *timestamp* | Field from database |
