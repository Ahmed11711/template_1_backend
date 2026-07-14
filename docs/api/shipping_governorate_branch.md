# 📘 API Guide: ShippingGovernorateBranch

This documentation is auto-generated for the **shipping_governorate_branches** table.

### 🚀 Endpoints
| Action | Method | Endpoint | Auth |
| :--- | :--- | :--- | :--- |
| List All | `GET` | `/shipping-governorate-branches` | Bearer |
| View One | `GET` | `/shipping-governorate-branches/{id}` | Bearer |
| Create | `POST` | `/shipping-governorate-branches` | Bearer |
| Update | `PUT` | `/shipping-governorate-branches/{id}` | Bearer |
| Delete | `DELETE` | `/shipping-governorate-branches/{id}` | Bearer |

### 📋 Database Schema
| Column | Type | Description |
| :--- | :--- | :--- |
| `id` | *bigint* | Field from database |
| `shipping_governorate_id` | *bigint* | Field from database |
| `name` | *varchar* | Field from database |
| `price` | *decimal* | Field from database |
| `is_active` | *tinyint* | Field from database |
| `created_at` | *timestamp* | Field from database |
| `updated_at` | *timestamp* | Field from database |
