<?php

namespace App\Support\Csp\Traits;

use Spatie\Csp\Directive;

trait HasFacebookPixel
{
	protected function configureFacebookPixel(): void
	{
		$this
			->add(Directive::SCRIPT, [
				'https://*.facebook.net',
				'https://*.facebook.com',
			])
			->add(Directive::CONNECT, [
				'https://*.facebook.com',
			])
			->add(Directive::IMG, [
				'https://*.facebook.com',
			]);
	}
}
