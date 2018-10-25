@component('mail::layout')
    @slot('header')
        @component('mail::header', ['url' => 'http://bprmaa.com'])
            {{ config('app.name') }}
        @endcomponent
    @endslot

# BPR MAA MOBILE

Terima kasih ***{{ strtoupper($data['name']) }}*** sudah mendaftar di *Mobile App **BPR MAA***, dengan adanya Mobile App ini semoga lebih mempermudah untuk mendapatkan informasi tentang produk-produk perusahaan kami.

Untuk itu dimohon untuk melakukan aktivasi akun yang didaftarkan di Mobile App dengan membuka tombol **aktivasi** berikut

@component('mail::button', ['url' => $data['url_activation']])
Aktivasi
@endcomponent

    Atau dengan membuka link berikut 
<a href="{{ $data['url_activation'] }}" target="_blank">{{ $data['url_activation'] }}</a>

Best Regards,<br>
From admin - {{ config('app.name') }}

    @isset($subcopy)
        @slot('subcopy')
            @component('mail::subcopy')
                {{ $subcopy }}
            @endcomponent
        @endslot
    @endisset

    @slot('footer')
        @component('mail::footer')
            © {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
        @endcomponent
    @endslot
@endcomponent
