<?php
    
    require_once(dirname(dirname(dirname(__FILE__))).'/config.php');
    require_once(dirname(dirname(dirname(__FILE__))).'/login/lib.php');
    
    $enabled = get_config('local_forgotpassword', 'enabled');
    
    $response = new stdClass();

    if($enabled){

        $input = $_POST["input"];

        $getUser = $DB->get_record_sql("SELECT u.* FROM mdl_user as u 
                                        INNER JOIN mdl_cohort as c on c.name LIKE 'profesores' 
                                        INNER JOIN mdl_cohort_members as cm ON cm.cohortid = c.id and cm.userid = u.id 
                                        where u.username like '".$input."' or u.email like '".$input."'");
        if($getUser){
            if(is_siteadmin($getUser)){
                $response->status = false;
                $response->message = "Can not Reset Admin Password";
            }else{
                $resetrecord = core_login_generate_password_reset($getUser);
                require_login($preventredirect = true);
                $sendresult = send_password_change_confirmation_email($getUser, $resetrecord);

                if($sendresult){
                    $response->status = true;
                    $response->message = "Message Sended";
                }else{
                    $response->status = false;
                    $response->message = "Message Not Sended";
                }
            }
        }else{
            $response->status = false;
            $response->message = "User Not Found";
        }
    }else{
        $response->status = false;
        $response->message = "Not Enabled";
    }
    echo json_encode($response);
?> 