<?php
namespace Kir\Logging\Essentials\CaptionRenderers;

use Kir\Logging\Essentials\CaptionRenderer;

class CommonCaptionRenderer implements CaptionRenderer {
	/**
	 * @param array $captions
	 * @param string $level
	 * @param string $message
	 * @param array $context
	 * @return string
	 */
	public function renderCaptionPath(array $captions, $level, $message, array $context) {
		$captions = array_filter($captions);
		$caption = join(' / ', $captions);
		return join(': ', array($caption, $message));
	}
}