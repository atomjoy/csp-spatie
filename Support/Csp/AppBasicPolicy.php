<?php

namespace App\Support\Csp;

use Spatie\Csp\Directive;
use Spatie\Csp\Keyword;
use Spatie\Csp\Policy;
use Spatie\Csp\Preset;

class AppBasicPolicy implements Preset
{
	public function configure(Policy $policy): void
	{
		$policy
			->add(Directive::BASE, Keyword::SELF)
			->add(Directive::DEFAULT, Keyword::SELF)
			->add(Directive::FORM_ACTION, Keyword::SELF)
			->add(Directive::FRAME, Keyword::NONE)
			->add(Directive::IMG, [Keyword::SELF, 'data:', 'blob:'])
			->add(Directive::MEDIA, Keyword::SELF)
			->add(Directive::OBJECT, Keyword::NONE)
			->add(Directive::SCRIPT, [Keyword::SELF, Keyword::UNSAFE_INLINE])
			->add(Directive::STYLE, [Keyword::SELF, Keyword::UNSAFE_INLINE])
			->add(Directive::CONNECT, [
				Keyword::SELF,
				'https://google-analytics.com',
				'https://www.google-analytics.com',
				'https://region1.google-analytics.com' // Nowy format podwójnego śledzenia GA4
			])
			->add(Directive::FONT, [
				Keyword::SELF,
				'https://fonts.gstatic.com',
				'https://cdnjs.cloudflare.com'
			])
			->add(Directive::SCRIPT, [
				Keyword::SELF,
				Keyword::UNSAFE_INLINE,
				'https://cdnjs.cloudflare.com',
				'https://www.googletagmanager.com',
				'https://google-analytics.com',
				'https://www.google-analytics.com',
			])
			->add(Directive::STYLE, [
				Keyword::SELF,
				Keyword::UNSAFE_INLINE,
				'https://cdnjs.cloudflare.com',
				'https://fonts.googleapis.com'
			]);
		// ->addNonce(Directive::SCRIPT);
		// ->addNonce(Directive::STYLE);
	}
}
