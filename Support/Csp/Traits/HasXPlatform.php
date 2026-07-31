<?php

namespace App\Support\Csp\Traits;

use Spatie\Csp\Directive;

trait HasXPlatform
{
	protected function configureXPlatform(): void
	{
		$this
			->add(Directive::SCRIPT, [
				'https://twitter.com',    // Widgety i skrypty osadzania postów
				'https://*.twimg.com',             // Wsparcie dla dynamicznych skryptów X
			])
			->add(Directive::STYLE, [
				'https://twitter.com',    // Arkusze stylów dla osadzonych postów
			])
			->add(Directive::CONNECT, [
				'https://*.twitter.com',           // API analityczne i telemetryczne X
				'https://t.co',                    // Obsługa skracacza linków
			])
			->add(Directive::IMG, [
				'https://*.twitter.com',           // Elementy graficzne platformy
				'https://*.twimg.com',             // Zdjęcia, awatary i media z tweetów
				'https://t.co',                    // Piksele śledzące konwersje
			])
			->add(Directive::FRAME, [
				'https://twitter.com',    // Ramki iframe z osadzonymi wpisami
				'https://twitter.com', // Pobieranie i renderowanie zawartości postów
			]);
	}
}
