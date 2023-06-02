<?php 
use Carbon\Carbon;
/**
 * default user image icon , if it hasn't image 
 */
define ('DEFAULT_USER_IMAGE' ,'assets/image/svg/default_user_logo.svg'); 
define ('MONTHS' , [
    '1-January',
    '2-February',
    '3-March',
    '4-April',
    '5-May',
    '6-June',
    '7-July', 
    '8-Agust',
    '9-September',
    '10-october',
    '11-November',
    '12-December'
]); 
define ('CURRENT_YEAR' , Carbon::now()->year); 
define ('CURRENT_MONTH' , Carbon::now()->month); 