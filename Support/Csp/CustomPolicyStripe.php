<?php

namespace App\Support\Csp;

use Spatie\Csp\Directive;
use Spatie\Csp\Policies\Policy;

// <script nonce="{{ csp_nonce() }}"> GTM </script>
class CustomPolicyStripe extends Policy
{
	public function configure(): void
	{
		$this
			->add(Directive::DEFAULT, 'self')

			// SKRYPTY (Inicjalizacja narzędzi i systemy antyfraudowe)
			->add(Directive::SCRIPT, [
				'self',
				'https://*.facebook.net',
				'https://*.facebook.com',
				'https://googletagmanager.com',
				'https://*.google-analytics.com',
				'https://*.googleapis.com',       // Google Maps API
				'https://gstatic.com',        // Wsparcie Google Maps
				'https://stripe.com',           // Główny skrypt Stripe.js
				'https://*.stripe.network',        // Wykrywanie oszustw Stripe (Radar)
			])
			->addNonce(Directive::SCRIPT) // Wymagane dla kodów inline (GTM / Pixel / Maps)

			// STYLE (CSS)
			->add(Directive::STYLE, [
				'self',
				'https://googleapis.com',    // Style dla Google Fonts
			])
			->addNonce(Directive::STYLE) // Wymagane, jeśli biblioteki wstrzykują style inline

			// CZCIONKI
			->add(Directive::FONT, [
				'self',
				'https://gstatic.com',       // Pliki czcionek Google (.woff2)
				'data:',
			])

			// POŁĄCZENIA (Wysyłanie analityki XHR/Fetch i autoryzacja płatności)
			->add(Directive::CONNECT, [
				'self',
				'https://*.facebook.com',          // Meta Pixel endpoints
				'https://*.google-analytics.com',  // GA4 data stream
				'https://*.analytics.google.com',
				'https://*.googletagmanager.com',
				'https://stripe.com',          // Procesowanie płatności Stripe
				'https://*.stripe.network',        // Telemetria bezpieczeństwa Stripe
			])

			// OBRAZY (Kafle map, logotypy banków i piksele śledzące)
			->add(Directive::IMG, [
				'self',
				'https://*.facebook.com',          // Alternatywny piksel śledzący <noscript>
				'https://*.google-analytics.com',
				'https://*.googletagmanager.com',
				'https://*.googleapis.com',        // Kafelki i warstwy Google Maps
				'https://gstatic.com',
				'https://*.stripe.com',            // Loga kart płatności i metod BLIK/P24
				'data:',
				'blob:',                           // Renderowanie zaawansowanych grafik w Google Maps
			])

			// RAMKI (Bezpieczne formularze kartowe i weryfikacja bankowa)
			->add(Directive::FRAME, [
				'self',
				'https://stripe.com',             // iFrame dla bezpiecznych pól iFrame (Stripe Elements)
				'https://stripe.com',             // iFrame dla autoryzacji 3D Secure / aplikacji bankowych
			]);
	}
}
