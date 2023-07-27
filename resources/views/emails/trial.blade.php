<x-mail::message>
# Introduction

Hi, <b>{{ $name }}</b>
Your trial has ended today. To continue using our service, please click the button link below to reactivate your membership.

<x-mail::button url="{{ route('subscribe') }}">
Reactivate membership
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
