<?php

class ShortURLs {

	static function getList() {
		global $wgContLang;
		$store = smwfGetStore();
		$options = new SMWRequestOptions();
		$options->sort = true;
		$options->ascending = true;
		$prop = SMWDIProperty::newFromUserLabel( "Surl" );
		$pages = $store->getAllPropertySubjects( $prop, $options );
		$used = array();

		foreach( $pages as $p ) {
			//$url = $p->getDBKey();
                        //$pageTitle = str_replace( '_', ' ', $p->getDBkey() );
                         $pageTitle=$p->getDBkey();
if ( $p->getNamespace() !== 0 ) {
                                 $prefixedSubjectTitle = $wgContLang->getNsText($p->getNamespace()) . ":" . $pageTitle;
                        } else {
                                 $prefixedSubjectTitle = $pageTitle;
                        }
                        // $url =wfUrlencode( str_replace( ' ', '_', $prefixedSubjectTitle ));
                        $url=$prefixedSubjectTitle;
			$values = $store->getPropertyValues( $p, $prop, $options );
			foreach( $values as $v ) {
				$short = $v->getString();
				$used[ $short ][] = $url;
			}
		}

		return $used;
	}

	static function getDupes() {
		return array_filter( self::getList(), function ( $arr ) { return count( $arr ) > 1; } );
	}
}
