<?php

namespace App\Support\Csp\Traits;

use Spatie\Csp\Directive;

trait HasDribbble
{
	protected function configureDribbble(): void
	{
		$this
			->add(Directive::SCRIPT, [
				'https://dribbble.com',            // Skrypty dla osadzonych elementów i oEmbed
				'https://*.dribbble.com',          // Dynamiczne subdomeny skryptowe
			])
			->add(Directive::IMG, [
				'https://dribbble.com',
				'https://*.dribbble.com',          // Awatary i grafiki interfejsu
				'https://*.cdn.dribbble.com',       // KLUCZOWE: CDN przechowujący główne grafiki projektów (shots)
				'data:',                           // Placeholderowe szare kwadraty/obrazy generowane w base64
			])
			->add(Directive::MEDIA, [
				'https://*.dribbble.com',          // KLUCZOWE: Filmy wideo, animacje i podglądy projektów (MP4/WebM)
			])
			->add(Directive::FRAME, [
				'https://dribbble.com',            // iFrame dla osadzonych portfolio/widgetów profilu
				'https://*.dribbble.com',
			]);
	}
}
