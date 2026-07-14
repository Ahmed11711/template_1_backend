# 📘 API Guide: Coupon

This documentation is auto-generated for the **coupons** table.

### 🚀 Endpoints
| Action | Method | Endpoint | Auth |
| :--- | :--- | :--- | :--- |
| List All | `GET` | `/coupons` | Bearer |
| View One | `GET` | `/coupons/{id}` | Bearer |
| Create | `POST` | `/coupons` | Bearer |
| Update | `PUT` | `/coupons/{id}` | Bearer |
| Delete | `DELETE` | `/coupons/{id}` | Bearer |

### 📋 Database Schema
| Column | Type | Description |
| :--- | :--- | :--- |
| `id` | *bigint* | Field from database |
| `code` | *varchar* | Field from database |
| `type` | *enum* | Field from database |
| `value` | *decimal* | Field from database |
| `min_order_amount` | *decimal* | Field from database |
| `max_uses` | *int* | Field from database |
| `used_count` | *int* | Field from database |
| `expires_at` | *timestamp* | Field from database |
| `is_active` | *tinyint* | Field from database |
| `created_at` | *timestamp* | Field from database |
| `updated_at` | *timestamp* | Field from database |
