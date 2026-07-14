# 📘 API Guide: ShippingMethod

This documentation is auto-generated for the **shipping_methods** table.

### 🚀 Endpoints
| Action | Method | Endpoint | Auth |
| :--- | :--- | :--- | :--- |
| List All | `GET` | `/shipping-methods` | Bearer |
| View One | `GET` | `/shipping-methods/{id}` | Bearer |
| Create | `POST` | `/shipping-methods` | Bearer |
| Update | `PUT` | `/shipping-methods/{id}` | Bearer |
| Delete | `DELETE` | `/shipping-methods/{id}` | Bearer |

### 📋 Database Schema
| Column | Type | Description |
| :--- | :--- | :--- |
| `id` | *bigint* | Field from database |
| `name` | *varchar* | Field from database |
| `type` | *enum* | Field from database |
| `flat_rate` | *decimal* | Field from database |
| `percentage_value` | *decimal* | Field from database |
| `is_active` | *tinyint* | Field from database |
| `created_at` | *timestamp* | Field from database |
| `updated_at` | *timestamp* | Field from database |
