<?php

/**
 * A special page to reveal any duplicate short urls.
 */

class ShortURLList extends SpecialPage {

	function __construct( $empty = null ) {
		parent::__construct( "ShortURLList" );
	}

	function execute( $par ) {
		global $wgOut;

		$wgOut->setPagetitle( wfMsg( "shorturllist" ) );

		$wgOut->addWikiText( wfMsg( "wt-shorturllist-documentation" ) );

		$shorts = ShortURLs::getList();

                $out = "{|\n! ". wfMsg("wt-shorturl") . " !! " . wfMsg("wt-shorturl-dest") ."\n";
		foreach( $shorts as $short => $page ) {
                    $out .= "|-\n| [http://w-t.me/$short $short] ";
                    foreach( $page as $p ) {
                        $out .= "|| [[$p]]\n";
                    }
		}

                $wgOut->addWikiText( "$out\n|}\n" );
	}
}
