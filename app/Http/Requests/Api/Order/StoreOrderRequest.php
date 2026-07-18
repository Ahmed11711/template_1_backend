<?php

namespace App\Http\Requests\Api\Order;

use App\Http\Requests\BaseRequest\BaseRequest;

class StoreOrderRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'customer.name' => ['required', 'string', 'max:255'],
            'customer.email' => ['required', 'email', 'max:255'],
            'customer.phone' => ['required', 'string', 'min:8', 'max:30'],
            'customer.phone2' => ['nullable', 'string', 'max:30'],

            'shipping.address' => ['required', 'string', 'max:1000'],
            'shipping.shipping_method_id' => ['nullable', 'integer', 'exists:shipping_methods,id'],
            'shipping.shipping_method_type' => ['nullable', 'string', 'in:free,flat,percentage,governorate'],
            'shipping.governorate_id' => ['required', 'integer', 'exists:shipping_governorates,id'],
            'shipping.governorate_name' => ['nullable', 'string'],
            'shipping.branch_id' => ['nullable', 'integer', 'exists:shipping_governorate_branches,id'],
            'shipping.branch_name' => ['nullable', 'string'],
            'shipping.shipping_cost' => ['required', 'numeric', 'min:0'],

            'payment.gateway_id' => ['required', 'integer', 'exists:payment_gateways,id'],
            'payment.gateway_name' => ['nullable', 'string'],
            'payment.requires_receipt' => ['boolean'],

            'items' => ['required', 'array', 'min:1'],
            'items.*.product_id' => ['required'],
            'items.*.name' => ['required', 'string'],
            'items.*.price' => ['required', 'numeric', 'min:0'],
            'items.*.quantity' => ['required', 'integer', 'min:1'],
            'items.*.size' => ['nullable', 'string'],
            'items.*.line_total' => ['required', 'numeric', 'min:0'],

            'totals.subtotal' => ['required', 'numeric', 'min:0'],
            'totals.shipping' => ['required', 'numeric', 'min:0'],
            'totals.total' => ['required', 'numeric', 'min:0'],

            // ملف الإيصال بيتبعت منفصل (multipart) لو الجيتواي محتاج إيصال
            'receipt' => ['nullable', 'image', 'max:10240'], // 10MB
        ];
    }
}
