<?php

namespace App\Support\Csp\Traits;

use Spatie\Csp\Directive;

trait HasGoogleMaps
{
	protected function configureGoogleMaps(): void
	{
		$this
			->add(Directive::SCRIPT, [
				'https://*.googleapis.com',        // Inicjalizacja biblioteki Maps API
				'https://maps.gstatic.com',        // Statyczne zasoby skryptów
			])
			->add(Directive::IMG, [
				'https://*.googleapis.com',        // Kafelki (warstwy) mapy
				'https://maps.gstatic.com',        // Znaczniki i ikony systemowe
				'https://*.ggpht.com',             // ZDJĘCIA: Miniatury Street View i zdjęcia miejsc (często blokowane)
				'https://*.googleusercontent.com', // ZDJĘCIA: Niestandardowe grafiki użytkowników i obiektów
				'blob:',                           // Renderowanie wektorowe WebGL
			])
			->add(Directive::CONNECT, [
				'https://*.googleapis.com',        // Zapytania XHR/Fetch do API (np. Autocomplete, Geocoding)
			]);
	}
}
