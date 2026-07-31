<?php

namespace App\Support\Csp\Traits;

use Spatie\Csp\Directive;

trait HasGoogleFonts
{
	protected function configureGoogleFonts(): void
	{
		$this
			->add(Directive::STYLE, [
				'https://googleapis.com',
			])
			->add(Directive::FONT, [
				'https://gstatic.com',
				'data:',
			]);
	}
}
