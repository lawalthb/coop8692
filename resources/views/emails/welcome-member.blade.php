@component('mail::message')
# Welcome to COOP8692

Dear {{ $user->title }} {{ $user->surname }},

Thank you for registering with COOP8692. Your membership details are:


**Full Name:** {{ $user->firstname }} {{ $user->surname }}

Your registration is currently pending admin approval. You will be notified once your account has been approved.

@component('mail::button', ['url' => config('app.url')])
Visit Our Website
@endcomponent

If you have any questions, please don't hesitate to contact us.

Best regards,
COOP8692 Team
@endcomponent
