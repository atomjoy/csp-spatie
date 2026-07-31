<?php

namespace App\Support\Csp;

use Spatie\Csp\Directive;
use Spatie\Csp\Keyword;
use Spatie\Csp\Policy;
use Spatie\Csp\Preset;

// Dont touch works here !!!
class AppPolicy implements Preset
{
	public function configure(Policy $policy): void
	{
		$policy
			->add(Directive::BASE, Keyword::SELF)
			->add(Directive::CONNECT, Keyword::SELF)
			->add(Directive::DEFAULT, Keyword::SELF)
			->add(Directive::FONT, Keyword::SELF)
			->add(Directive::FORM_ACTION, Keyword::SELF)
			->add(Directive::FRAME, Keyword::NONE)
			->add(Directive::IMG, [Keyword::SELF, 'data:', 'blob:'])
			->add(Directive::MEDIA, Keyword::SELF)
			->add(Directive::OBJECT, Keyword::NONE)
			->add(Directive::SCRIPT, [Keyword::SELF])
			->add(Directive::STYLE, [Keyword::SELF])
			->addNonce(Directive::SCRIPT)
			->addNonce(Directive::STYLE)
			->add(Directive::SCRIPT_ATTR, [
				Keyword::SELF,
				Keyword::UNSAFE_INLINE,
			])
			->add(Directive::STYLE_ATTR, [
				Keyword::SELF,
				Keyword::UNSAFE_INLINE,
				// Musi być w apostrofach jako string
				// '\'unsafe-hashes\'',
				// Tylko dla Hash z consoli przeglądarki
				// 'sha256-st7hlhV5Qxh0dWKCDSzLbS3D38bltd7t03hR8tHlFpI=',
				// 'sha256-Mvsp77heuEPm7zRATyUk/qLvOCN0lwgUfh8tzx/2ync=',
				// 'sha256-gh3csyfE/gFHPO7Q1ovD3nZaFE5j2ETfcPHh0J/gEPo='
			])
			->add(Directive::STYLE_ELEM, [
				Keyword::SELF,
				Keyword::UNSAFE_INLINE
			])
			->add(Directive::SCRIPT_ELEM, [
				Keyword::SELF,
				Keyword::UNSAFE_INLINE,
				'https://google-analytics.com',
				'https://www.googletagmanager.com'
			])
			->add([Directive::STYLE_ELEM, Directive::STYLE, Directive::SCRIPT, Directive::FONT], [
				'https://cdnjs.cloudflare.com',
			])->add([Directive::STYLE_ELEM, Directive::FONT], [
				Keyword::SELF,
				Keyword::UNSAFE_INLINE,
				'https://fonts.gstatic.com',
				'https://fonts.googleapis.com',
				'https://cdnjs.cloudflare.com'
			]);
	}
}
