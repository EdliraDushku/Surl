<?php
require_once( __DIR__ . '/../../maintenance/Maintenance.php' );
require_once( __DIR__ . '/ShortURLs.php' );

class ShortURLLister extends Maintenance {
	public function __construct() {
		parent::__construct();
		$this->mDescription = "List out ShortURLs";
	}

    static function str_putcsv($array, $delimiter = ',', $enclosure = '"', $terminator = "\n") {
        # First convert associative array to numeric indexed array
        foreach ($array as $key => $value) $workArray[] = $value;

        $returnString = '';                 # Initialize return string
        $arraySize = count($workArray);     # Get size of array

        for ($i=0; $i<$arraySize; $i++) {
            # Nested array, process nest item
            if (is_array($workArray[$i])) {
                $returnString .= str_putcsv($workArray[$i], $delimiter, $enclosure, $terminator);
            } else {
                switch (gettype($workArray[$i])) {
                    # Manually set some strings
                    case "NULL":     $_spFormat = ''; break;
                    case "boolean":  $_spFormat = ($workArray[$i] == true) ? 'true': 'false'; break;
                    # Make sure sprintf has a good datatype to work with
                    case "integer":  $_spFormat = '%i'; break;
                    case "double":   $_spFormat = '%0.2f'; break;
                    case "string":   $_spFormat = '%s'; break;
                    # Unknown or invalid items for a csv - note: the datatype of array is already handled above, assuming the data is nested
                    case "object":
                    case "resource":
                    default:         $_spFormat = ''; break;
                }
                                $returnString .= sprintf('%2$s'.$_spFormat.'%2$s', $workArray[$i], $enclosure);
$returnString .= ($i < ($arraySize-1)) ? $delimiter : $terminator;
            }
        }
        # Done the workload, return the output information
        return $returnString;
    }



	public function execute() {
             global $wgSurl;
		$shorts = ShortURLs::getList();

		foreach( $shorts as $short => $page ) {

			foreach( $page as $p ) {
				# don't want slashes encoded, so...
				$encURL = $wgSurl .implode( "/", array_map( "urlencode", explode( "/", $p ) ) );
				print self::str_putcsv( array( $short, $encURL ), ",", "\\'" );
			}
		}
	}
}
#insert into yourls_url (keyword, url, ip, clicks) values ('g00g', 'http://google.com/', '0.0.0.0', 0);
$maintClass = 'ShortURLLister';
require_once( RUN_MAINTENANCE_IF_MAIN );
