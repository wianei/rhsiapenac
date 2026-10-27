@component('mail::message')
{{-- Greeting --}}
@if (! empty($greeting))
# {{ $greeting }}
@else
@if ($level == 'error')
# Um erro ocorreu!
@else
# Olá!
@endif
@endif

{{-- Intro Lines --}}
@foreach ($introLines as $line)
{{ $line }}

@endforeach

{{-- Action Button --}}
@isset($actionText)
<?php
    switch ($level) {
        case 'success':
            $color = 'green';
            break;
        case 'error':
            $color = 'red';
            break;
        default:
            $color = 'blue';
    }
?>
@component('mail::button', ['url' => str_replace("hml.","",$actionUrl), 'color' => $color])
{{ $actionText }}
@endcomponent
@endisset

{{-- Outro Lines --}}
@foreach ($outroLines as $line)
{{ $line }}

@endforeach

{{-- Salutation --}}
@if (! empty($salutation))
{{ $salutation }}
@else
Atenciosamente,<br>SIAPEN IAPEN AC.
@endif

{{-- Subcopy --}}
@isset($actionText)
@component('mail::subcopy')
Se estiver com problemas para clicar no botão acima, acesse este link: [{{ str_replace("hml.","",$actionUrl) }}]({{ str_replace("hml.","",$actionUrl) }})
@endcomponent
@endisset
@endcomponent
