<?php

namespace App\Support\Csp\Traits;

use Spatie\Csp\Directive;

trait HasPinterest
{
	protected function configurePinterest(): void
	{
		$this
			->add(Directive::SCRIPT, [
				'https://s.pinimg.com',            // Główny skrypt analityczny i widgetowy (pinit.js)
				'https://*.pinterest.com',         // Wsparcie dla dodatkowych skryptów dynamicznych
			])
			->add(Directive::CONNECT, [
				'https://ct.pinterest.com',        // Endpointy zbierania danych konwersji (Pinterest Tag)
				'https://*.pinterest.com',         // API widgetów społecznościowych
			])
			->add(Directive::IMG, [
				'https://*.pinimg.com',            // Serwery grafik i pinów
				'https://ct.pinterest.com',        // Piksel śledzący fallback (<noscript>)
				'https://*.pinterest.com',
				'data:',                           // KLUCZOWE: Pinterest wstrzykuje logo jako base64!
			])
			->add(Directive::FRAME, [
				'https://*.pinterest.com',         // Osadzane ramki i iFrame przycisków "Zapisz"
			]);
	}
}
