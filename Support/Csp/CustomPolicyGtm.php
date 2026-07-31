<?php

namespace App\Support\Csp;

use Spatie\Csp\Directive;
use Spatie\Csp\Policies\Policy;

// <script nonce="{{ csp_nonce() }}"> GTM </script>
class CustomPolicyGtm extends Policy
{
	public function configure(): void
	{
		$this
			->add(Directive::DEFAULT, 'self')

			// SKRYPTY: GTM wymaga nonce dla kodu wstrzykiwanego i zewnętrznych domen
			->add(Directive::SCRIPT, [
				'self',
				'https://*.facebook.net',
				'https://*.facebook.com',
				'https://googletagmanager.com',
				'https://*.google-analytics.com',
			])
			->addNonce(Directive::SCRIPT) // Automatyczne nonce dla skryptów inline

			// POŁĄCZENIA: GA4 i Pixel wysyłają tu dane analityczne
			->add(Directive::CONNECT, [
				'self',
				'https://*.facebook.com',
				'https://*.google-analytics.com',
				'https://*.analytics.google.com',
				'https://*.googletagmanager.com',
			])

			// OBRAZY: Piksele śledzące i ikony GTM
			->add(Directive::IMG, [
				'self',
				'https://*.facebook.com',
				'https://*.google-analytics.com',
				'https://*.googletagmanager.com',
				'data:',
			]);
	}
}
