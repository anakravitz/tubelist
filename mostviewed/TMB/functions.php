<?php

/*
 * Gets  published after date from GET, or default
 */
function getPublishAfterDAte($date_format = DATE_ATOM) {
    if ( ( isset( $_GET['txtFromDate'] ) ) && ( validDate( $_GET['txtFromDate'] ) ) ) {
		$d = new Datetime($_GET['txtFromDate']); 
		$publishAfterDate = $d->format($date_format);
	} else { //default
		$d = new Datetime("2005-04-24"); //youtube's first video
		$publishAfterDate = $d->format($date_format);
    }
	return $publishAfterDate;
}

/*
 * Gets  published before date from GET, or default
 */
function getPublishBeforeDate($date_format = DATE_ATOM) {
    if ( ( isset( $_GET['txtToDate'] ) ) && ( validDate( $_GET['txtToDate'] ) ) ) {
		$d = new Datetime($_GET['txtToDate']); 
        $publishBeforeDate = $d->format($date_format);
	} else {
		$d = new Datetime('tomorrow'); //gets tomorrow's date;
		$publishBeforeDate = $d->format($date_format);
    }
    return $publishBeforeDate;
}



/*
 * Verifies valid date
 * Source: http://stackoverflow.com/questions/14504913/verify-valid-date-using-phps-datetime-class
 */
function validDate($date, $strict = true) {
    $dateTime = DateTime::createFromFormat('Y-m-d', $date);
    if ($strict) {
        $errors = DateTime::getLastErrors();
        if (!empty($errors['warning_count'])) {
            return false;
        }
    }
    return $dateTime !== false;
}


/*
 * Source: http://stackoverflow.com/questions/11813498/make-twitter-bootstrap-navbar-link-active
 */
function echoActiveClassIfRequestMatches($requestUri)
{
    $current_file_name = basename($_SERVER['PHP_SELF'], ".php");

    if ($current_file_name == $requestUri)
        echo 'class="active"';
}





?>