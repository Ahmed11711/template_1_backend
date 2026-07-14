# 📘 API Guide: ShippingGovernorate

This documentation is auto-generated for the **shipping_governorates** table.

### 🚀 Endpoints
| Action | Method | Endpoint | Auth |
| :--- | :--- | :--- | :--- |
| List All | `GET` | `/shipping-governorates` | Bearer |
| View One | `GET` | `/shipping-governorates/{id}` | Bearer |
| Create | `POST` | `/shipping-governorates` | Bearer |
| Update | `PUT` | `/shipping-governorates/{id}` | Bearer |
| Delete | `DELETE` | `/shipping-governorates/{id}` | Bearer |

### 📋 Database Schema
| Column | Type | Description |
| :--- | :--- | :--- |
| `id` | *bigint* | Field from database |
| `name` | *varchar* | Field from database |
| `price` | *decimal* | Field from database |
| `is_active` | *tinyint* | Field from database |
| `created_at` | *timestamp* | Field from database |
| `updated_at` | *timestamp* | Field from database |
