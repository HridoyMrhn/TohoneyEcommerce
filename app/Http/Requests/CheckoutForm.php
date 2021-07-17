<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutForm extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'billing_name' => 'required',
            'billing_email' => ['required', 'email'],
            'billing_number' => 'required',
            'billing_city_id' => 'required',
            'billing_country_id' => 'required',
            'billing_postal_code' => 'required',
            'billing_address' => 'required',

            // 'shipping_name' => 'required',
            // 'shipping_email' => ['required', 'email'],
            // 'shipping_number' => 'required',
            // 'shipping_city_id' => 'required',
            // 'shipping_country_id' => 'required',
            // 'shipping_postal_code' => 'required',
            // 'shipping_address' => 'required',

            // 'user_id' => 'required',
            // 'billing_id' => 'required',
            'payment_gateway' => 'required',
            // 'subtotal' => 'required',
            // 'total' => 'required',

            // 'order_id' => 'required',
            // 'product_id' => 'required',
            // 'product_price' => 'required',
            // 'product_quantity' => 'required',
        ];
    }
}
