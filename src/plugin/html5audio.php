<?php
defined ('_JEXEC') or die ('Restricted access');

class plgContentHtml5audio extends JPlugin {
	protected $autoloadLanguage = true;

	public function onContentPrepare($context, &$article, &$params, $page = 0) {
		$pattern = '/{audio}(.*){\/audio}/';
		$matches = array();

		$ok = preg_match_all($pattern, $article->text, $matches, PREG_SET_ORDER);
		if (!$ok) {
			return;
		}

		foreach($matches as $match) {
			$filepath = htmlspecialchars($match[1]); // prevents XSS

			$replacement = sprintf('<audio controls src="%s">%s</audio>', $filepath, JText::_('PLG_CONTENT_HTML5AUDIO_NOT_SUPPORTED'));
			$article->text = str_replace($match[0], $replacement, $article->text);
		}
	}
}
