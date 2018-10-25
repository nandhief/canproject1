@component('mail::layout')
    @slot('header')
        @component('mail::header', ['url' => 'http://bprmaa.com'])
            {{ config('app.name') }}
        @endcomponent
    @endslot

# BPR MAA MOBILE

## Hallo {{ $data['name'] }}

Anda menerima email ini karena kami menerima permintaan mereset password untuk akun *Mobile App **BPR MAA***.

Untuk mereset password dengan membuka tombol dibawah ini:

@component('mail::button', ['url' => $data['reset_link']])
Reset Password
@endcomponent

    Atau dengan membuka link berikut
<a href="{{ $data['reset_link'] }}">{{ $data['reset_link'] }}</a>

Best Regards,<br>
From admin - {{ config('app.name') }}

    @slot('footer')
        @component('mail::footer')
            © {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
        @endcomponent
    @endslot
@endcomponent
