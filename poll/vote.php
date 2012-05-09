<?php
/**
 * @link: http://www.Awcore.com/dev/2/2/jquery-dynamic-poll-with-animated-colors_en
 */
    include_once ('db_connect.php');
	include_once ('functions.php');
    
        if ( isset($_POST['poll']) and isset($_POST['option'])){
            
            $poll_id = intval($_POST['poll']);
            $option_id = intval($_POST['option']);
            
                add_vote( $option_id,$poll_id );
                setcookie('poll_'.$poll_id, 1, time() * (60 * 60 * 5),'/');
                
            exit( json_encode(array('results' => results($poll_id))) );
        }	
?>