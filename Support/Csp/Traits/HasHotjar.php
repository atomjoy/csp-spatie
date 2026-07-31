<?php

namespace App\Support\Csp\Traits;

use Spatie\Csp\Directive;

trait HasHotjar
{
	protected function configureHotjar(): void
	{
		$this
			->add(Directive::SCRIPT, [
				'https://hotjar.com',       // Skrypt główny (kod śledzący)
				'https://hotjar.com',       // Skrypty funkcjonalne i nagrywające
			])
			->add(Directive::FONT, [
				'https://hotjar.com',       // Czcionki interfejsu Hotjar (np. widget feedbacku)
			])
			->add(Directive::CONNECT, [
				'https://*.hotjar.com',            // Endpointy do wysyłania heatmap i nagrań
				'https://*.hotjar.io',             // Endpointy zapasowe dla API
				'wss://*.hotjar.com',              // WebSockets do streamowania nagrań w tle
				'wss://*.hotjar.io',               // Zapasowe połączenia WebSockets
			])
			->add(Directive::IMG, [
				'https://*.hotjar.com',            // Elementy graficzne oraz analityczne
			])
			->add(Directive::FRAME, [
				'https://hotjar.com',         // Ukryty iframe do synchronizacji sesji i ciasteczek
			]);
	}
}
