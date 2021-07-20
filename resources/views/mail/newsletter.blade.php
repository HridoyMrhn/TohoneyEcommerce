@component('mail::message')
# Hi

Your order has been shipped!

@component('mail::button', ['url' => ('https://www.youtube.com/playlist?list=PLQ68mHW2_7KEWYmWngfJatscPqAAm9VXL')])
View Order
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
