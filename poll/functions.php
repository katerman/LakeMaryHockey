<?php
/**
 * @link: http://www.Awcore.com/dev/2/2/jquery-dynamic-poll-with-animated-colors_en
 */	
    function get_poll($id){
        $query = mysql_query("SELECT * FROM `polls` WHERE `poll_id` = '$id'");    
            return mysql_fetch_array($query, MYSQL_ASSOC ); 	
    }

    function poll_options($poll_id){
        $query = mysql_query("SELECT x . * , z.rates 
                                FROM poll_options x
                                    LEFT JOIN (SELECT option_id, COUNT( id ) AS `rates`
                                            FROM poll_votes 
                                                GROUP BY option_id) z 
                                                    ON x.id = z.option_id
                              where x.poll_id = '$poll_id' ORDER BY x.id asc");   
        $total =  total_votes($poll_id);
            while( $row = mysql_fetch_array( $query, MYSQL_ASSOC ) ){   
                $row['percent'] = @round((($row['rates'] / $total) * 100),1);
                $list[] = $row;
            }
       return $list;     
    }

    function results($poll_id){
        foreach (poll_options($poll_id) as $value) {
        	$list[$value['id']] = $value['percent'];
        }
            return $list;
    } 
 

    function total_votes($poll_id){
    	$query = mysql_query("SELECT sum(z.rates) as total
                                FROM poll_options x
                                    JOIN (SELECT option_id, COUNT( id ) AS `rates`
                                            FROM poll_votes 
                                                GROUP BY option_id) z 
                                                    ON x.id = z.option_id
                              where x.poll_id = '$poll_id'");
            $row = mysql_fetch_array( $query, MYSQL_ASSOC );
                return $row['total'];
    }

    function get_votes($poll_id){
        $query = mysql_query("SELECT * FROM `poll_votes` where `poll_id` = '$poll_id' and `ip` = '{$_SERVER["REMOTE_ADDR"]}'");
           $row = mysql_fetch_array( $query );
           if($row or isset($_COOKIE['p_'.$poll_id])){
                return $row;
           }else{
                return false;
           }    
    } 

    function add_vote($option_id,$poll_id){
        $row = get_votes($poll_id);
            if(!$row){
                mysql_query("INSERT INTO `poll_votes` (`poll_id` ,`option_id` ,`ip`) VALUES ( '$poll_id','$option_id', '{$_SERVER["REMOTE_ADDR"]}')");      
            }else{
                mysql_query("UPDATE `poll_votes` set `option_id` = '$option_id' where `id` = '{$row['id']}'");                               
            }    	
    }     
?>