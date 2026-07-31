# csp-spatie
Co to jest CSP - Content Security Policy w Laravel, przyklady laravel-spatie.

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


