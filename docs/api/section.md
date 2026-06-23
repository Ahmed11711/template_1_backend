# 📘 API Guide: Section

This documentation is auto-generated for the **sections** table.

### 🚀 Endpoints
| Action | Method | Endpoint | Auth |
| :--- | :--- | :--- | :--- |
| List All | `GET` | `/api/v1/home_sections` | Bearer |
| View One | `GET` | `/api/v1/home_sections/{id}` | Bearer |
| Create | `POST` | `/api/v1/home_sections` | Bearer |
| Update | `PUT` | `/api/v1/home_sections/{id}` | Bearer |
| Delete | `DELETE` | `/api/v1/home_sections/{id}` | Bearer |

### 📋 Database Schema
| Column | Type | Description |
| :--- | :--- | :--- |
| `id` | *bigint* | Field from database |
| `page_id` | *bigint* | Field from database |
| `type` | *varchar* | Field from database |
| `order` | *int* | Field from database |
| `props` | *longtext* | Field from database |
| `created_at` | *timestamp* | Field from database |
| `updated_at` | *timestamp* | Field from database |
