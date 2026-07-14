# 📘 API Guide: PaymentGateway

This documentation is auto-generated for the **payment_gateways** table.

### 🚀 Endpoints
| Action | Method | Endpoint | Auth |
| :--- | :--- | :--- | :--- |
| List All | `GET` | `/payment-gateways` | Bearer |
| View One | `GET` | `/payment-gateways/{id}` | Bearer |
| Create | `POST` | `/payment-gateways` | Bearer |
| Update | `PUT` | `/payment-gateways/{id}` | Bearer |
| Delete | `DELETE` | `/payment-gateways/{id}` | Bearer |

### 📋 Database Schema
| Column | Type | Description |
| :--- | :--- | :--- |
| `id` | *bigint* | Field from database |
| `name` | *varchar* | Field from database |
| `image` | *varchar* | Field from database |
| `value` | *varchar* | Field from database |
| `requires_receipt` | *tinyint* | Field from database |
| `is_active` | *tinyint* | Field from database |
| `created_at` | *timestamp* | Field from database |
| `updated_at` | *timestamp* | Field from database |
