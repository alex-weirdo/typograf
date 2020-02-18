<?php
/**
 * Created by PhpStorm.
 * User: Алексей
 * Date: 5/30/19
 * Time: 3:00 PM
 * Plugin Name: Typograph
 * Description: Приводит текст к приемлемому для веб-отображения виду
 * Version: 1.0
 * Author: 101media
 */

//include "remotetypograf.php";

add_filter( 'typographerEditContent', 'typographerEditContent_callback', 10, 1 );
function typographerEditContent_callback( $content )
{
	// замены контента со старого сайта
	$content = str_ireplace('● ● ●', '<p style="text-align: center;border-top: 2px solid red;padding: 0% 20px;width: 10px;height: 50px;margin: 0 auto;color: transparent;margin-left: 220px;" class="empty_p"></p>', $content);
	$content = str_ireplace('назад к&nbsp;тексту', '', $content);

	$content = str_ireplace('<sup class="footnote">', ' <sup class="footnote">', $content);
	$content = str_ireplace(['<...>', '‹…›'], '<something>', $content);

	$ignore_html = true;
	$content = do_shortcode($content, $ignore_html);
	$remoteTypograf = new \inbuilt\RemoteTypograf('UTF-8');

	$remoteTypograf->htmlEntities();
	$remoteTypograf->br(false);
	$remoteTypograf->p(false);
	$remoteTypograf->nobr(3);
	$remoteTypograf->quotA('laquo raquo');
	$remoteTypograf->quotB('bdquo ldquo');

	$result = $remoteTypograf->processText(html_entity_decode($content));

	$content = str_ireplace([' <sup class="footnote">', '&nbsp;<sup class="footnote">'], '<sup class="footnote">', $content);
	$content = str_ireplace('<something>', '‹…›', $content);
	$content = str_ireplace('»..."', '‹…›', $content);
	$result = str_ireplace([' <sup class="footnote">', '&nbsp;<sup class="footnote">'], '<sup class="footnote">', $result);
	$result = str_ireplace('<something>', '‹…›', $result);
	$result = str_ireplace('»..."', '‹…›', $result);
	if (strpos($result, 'Размер текста ограничен 32 К') !== false) {
		return $content;
	} else {
		return $result;
	}
//	return html_entity_decode($content);
}

add_filter( 'the_content', 'typographerGetContent' );
add_filter( 'the_title', 'typographerGetContent' );
function typographerGetContent( $content ) {
	if ( ! is_single() ) {
		return $content;
	}
	return apply_filters( 'typographerEditContent', apply_filters( 'typographerEditContent', $content ));
}