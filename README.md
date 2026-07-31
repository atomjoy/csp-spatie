# csp-spatie
CSP - Content Security Policy w Laravel, przyklady spatie/laravel-csp.

## Install

```sh
composer require spatie/laravel-csp
```

### AppSmartPolicy

```php
<?php

namespace App\Support\Csp;

use Spatie\Csp\Directive;
use Spatie\Csp\Keyword;
use Spatie\Csp\Policy;
use Spatie\Csp\Preset;

class AppSmartPolicy implements Preset
{
	public function configure(Policy $policy): void
	{
		$policy
			->add(Directive::BASE, Keyword::SELF)
			->add(Directive::DEFAULT, Keyword::SELF)
			->add(Directive::MEDIA, Keyword::SELF)
			->add(Directive::OBJECT, Keyword::NONE)
			->add(Directive::FRAME, Keyword::NONE)

			// Podstawowe reguły dla skryptów i stylów inline
			->add(Directive::SCRIPT, [Keyword::SELF, Keyword::UNSAFE_INLINE])
			->add(Directive::STYLE, [Keyword::SELF, Keyword::UNSAFE_INLINE])

			// CONNECT - kontrola fetch lub XHR
			->add(Directive::CONNECT, [
				Keyword::SELF,
				'https://*.google-analytics.com',
				'https://*.analytics.google.com',
				'https://*.g.doubleclick.net',
				'https://*.google.com',
				'https://googlesyndication.com',
				'https://*.spotifycdn.com',
			])

			// IMG
			->add(Directive::IMG, [
				Keyword::SELF,
				'data:',
				'blob:',
				'https://*.google-analytics.com',
				'https://*.g.doubleclick.net',
				'https://*.google.com',
				'https://*.spotifycdn.com',
			])

			// FONT
			->add(Directive::FONT, [
				Keyword::SELF,
				'https://gstatic.com',
				'https://cdnjs.cloudflare.com'
			])

			// SCRIPT
			->add(Directive::SCRIPT, [
				Keyword::SELF,
				Keyword::UNSAFE_INLINE,
				'https://cdnjs.cloudflare.com',
				'https://www.googletagmanager.com',
				'https://*.google-analytics.com',
				'https://*.analytics.google.com',
				'https://*.g.doubleclick.net',
				'https://*.google.com',
				'https://googlesyndication.com',
			])

			// STYLE - Dokładnie według Twoich logów z błędów
			->add(Directive::STYLE, [
				Keyword::SELF,
				Keyword::UNSAFE_INLINE,
				'https://cdnjs.cloudflare.com',
				'https://googleapis.com',
				'https://fonts.googleapis.com'
			])

			// Form payments
			->add(Directive::FORM_ACTION, [
				Keyword::SELF,
				'https://*.stripe.com',
				'https://*.payu.com',
				'https://*.paypal.com',
				'https://*.przelewy24.pl',
			])

			// Odblokowane odtwarzacze wideo, music (YouTube, Vimeo itp.) w iframe
			->add(Directive::FRAME, [
				Keyword::SELF,
				'https://*.youtube.com',
				'https://*.youtube-nocookie.com',
				'https://player.vimeo.com',
				'https://spotify.com'
			]);
	}
}
```

## Jaki to ma sens bez nonce?

Nawet bez użycia klucza nonce i z włączonym 'unsafe-inline', Twoja polityka CSP nadal pełni bardzo ważną rolę ochronną i kontrolną.
Oto konkretne powody, dlaczego warto zostawić tę konfigurację:

- Pełna kontrola nad tym, skąd pobierane są pliki

Twoja polityka CSP w obecnej formie nadal surowo kontroluje zewnętrzne zasoby. Jeśli cyberprzestępca zdoła wstrzyknąć złośliwy skrypt na Twoją stronę (np. poprzez lukę w bazie danych), przeglądarka całkowicie zablokuje próbę pobrania pliku .js z nieznanego serwera. Skrypt zadziała tylko wtedy, gdyby napastnik umieścił cały kod bezpośrednio w bazie (inline), co w przypadku skomplikowanych ataków jest znacznie trudniejsze.

- Ochrona przed kradzieżą danych i "Clickjackingiem"

Twoja dyrektywa Directive::FRAME, Keyword::NONE (przed dodaniem YouTube/Spotify) lub restrykcyjne reguły uniemożliwiają osadzanie Twojej strony wewnątrz obcych serwisów. Chroni to użytkowników przed atakami typu Clickjacking (nakładanie niewidzialnych ramek w celu wyłudzenia kliknięć).

- Kontrola nad wyciekiem danych (CONNECT)

Dzięki blokadzie w Directive::CONNECT, wbudowany złośliwy kod nie będzie mógł po cichu wysłać wykradzionych danych (np. haseł czy numerów kart) na obcy serwer za pomocą fetch lub XHR. Przeglądarka pozwoli na komunikację wyłącznie z Twoją domeną oraz zaufanymi serwerami Google/Spotify.

- Ochrona przed złośliwymi formularzami (FORM_ACTION)

Reguła Directive::FORM_ACTION, Keyword::SELF gwarantuje, że żaden formularz na stronie nie zostanie podmieniony tak, aby wysyłał wpisane przez użytkownika dane logowania na zewnętrzny, podrobiony serwer.

- Podsumowanie

Wprowadzenie nonce podnosi bezpieczeństwo strony na najwyższy poziom (blokuje absolutnie każdy kod inline), ale wiąże się z trudniejszym utrzymaniem aplikacji. Pozostawienie CSP z 'unsafe-inline' to bardzo rozsądny kompromis między bezpieczeństwem a wygodą programowania – strona wciąż jest o wiele bezpieczniejsza niż witryna, która w ogóle nie posiada nagłówka Content-Security-Policy.
Jeśli chcesz, możemy sprawdzić, jak za pomocą dyrektywy upgrade-insecure-requests automatycznie zabezpieczyć wszystkie połączenia HTTP na Twojej stronie. Interesuje Cię ten temat?

