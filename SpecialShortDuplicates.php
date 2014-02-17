<?php

/**
 * A special page to reveal any duplicate short urls.
 */

class ShortURLDupes extends SpecialPage {

	function __construct( $empty = null ) {
		parent::__construct( "ShortURLDupes" );
	}

	function execute( $par ) {
		global $wgOut;

		$wgOut->setPagetitle( wfMsg( "shorturldupes" ) );

		$wgOut->addWikiText( wfMsg( "wt-shorturldupe-documentation" ) );

		$shorts = ShortURLs::getDupes();

		foreach( $shorts as $short => $page ) {
			$wgOut->addWikiText( "; [http://w-t.me/$short $short]\n" );
			foreach( $page as $p ) {
				$wgOut->addWikiText( ":* [[$p]]\n" );
			}
			$wgOut->addWikiText( "----\n" );
		}
	}
}
