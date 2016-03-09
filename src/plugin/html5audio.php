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
			$replacement = sprintf('<audio controls src="%s">%s</audio>', $match[1], JText::_('PLG_CONTENT_HTML5AUDIO_NOT_SUPPORTED'));
			$article->text = str_replace($match[0], $replacement, $article->text);
		}
	}
}
