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
				'https://googletagmanager.com',
				'https://*.googletagmanager.com',
				'https://*.googleadservices.com',
				'https://googlesyndication.com',
				'https://*.google-analytics.com',
				'https://*.analytics.google.com',
				'https://*.g.doubleclick.net',
				'https://*.google.com',
				'https://*.spotifycdn.com',
			])

			// IMG
			->add(Directive::IMG, [
				Keyword::SELF,
				'data:',
				'blob:',
				'https://googletagmanager.com',
				'https://*.googletagmanager.com',
				'https://*.googleadservices.com',
				'https://*.google-analytics.com',
				'https://*.g.doubleclick.net',
				'https://*.google.com',
				'https://*.spotifycdn.com',
				'https://ssl.gstatic.com',
				'https://www.gstatic.com',
				'https://raw.githubusercontent.com',
			])

			// FONT
			->add(Directive::FONT, [
				Keyword::SELF,
				'data:',
				'https://gstatic.com',
				'https://cdnjs.cloudflare.com'
			])

			// SCRIPT
			->add(Directive::SCRIPT, [
				Keyword::SELF,
				'https://googletagmanager.com',
				'https://*.googletagmanager.com',
				'https://*.googleadservices.com',
				'https://*.google-analytics.com',
				'https://*.analytics.google.com',
				'https://*.g.doubleclick.net',
				'https://*.google.com',
				'https://googlesyndication.com',
				'https://cdnjs.cloudflare.com',
			])

			// STYLE - Dokładnie według Twoich logów z błędów
			->add(Directive::STYLE, [
				Keyword::SELF,
				'https://googletagmanager.com',
				'https://*.googletagmanager.com',
				'https://*.googleadservices.com',
				'https://googleapis.com',
				'https://fonts.googleapis.com',
				'https://tagmanager.google.com',
				'https://cdnjs.cloudflare.com',
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
				'https://td.doubleclick.net',
				'https://googletagmanager.com',
				'https://*.googletagmanager.com',
				'https://*.googleadservices.com',
				'https://youtube.com',
				'https://youtube-nocookie.com',
				'https://*.youtube.com',
				'https://*.youtube-nocookie.com',
				'https://player.vimeo.com',
				'https://spotify.com'
			]);

		// (Disabled sample only) Włączenie Nonce dla skryptów oraz stylów inline (niepotrzebne)!!!
		// $this->addNonce(Directive::SCRIPT)->addNonce(Directive::STYLE);
		// Przykład z włączonym nonce i unsafe-inline: Support/Csp/AppPolicy.php
	}
}
