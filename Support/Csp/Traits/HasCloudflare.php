<?php

namespace App\Support\Csp\Traits;

use Spatie\Csp\Directive;

trait HasCloudflare
{
	protected function configureCloudflare(): void
	{
		$this
			->add(Directive::SCRIPT, [
				'https://cloudflareinsights.com',  // Skrypt Cloudflare Web Analytics
				'https://cloudflare.com',          // Skrypt dla Cloudflare Turnstile (alternatywa reCAPTCHA)
			])
			->add(Directive::CONNECT, [
				'https://cloudflareinsights.com',  // Wysyłanie danych analitycznych
			])
			->add(Directive::IMG, [
				'https://cloudflare.com',          // Zasoby graficzne dla wyzwań Turnstile
			])
			->add(Directive::FRAME, [
				'https://cloudflare.com',          // Bezpieczny iFrame dla widgetu Turnstile
			])
			->add([
				Directive::STYLE,
				Directive::STYLE_ATTR
			], [
				Keyword::SELF,
				Keyword::UNSAFE_INLINE,
			]);
	}
}
