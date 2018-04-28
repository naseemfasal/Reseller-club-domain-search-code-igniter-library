<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Resellerclub{
  
  
    function check_domain($domain_name,$domain_ext){
        $key='';  //your key
        $reseller_id='';   //your id
        $url="https://httpapi.com/api/domains/available.json?auth-userid=$reseller_id&api-key=$key&domain-name=$domain_name&tlds=$domain_ext";
        $ch = curl_init();
        $timeout = 5;
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);

        $data = curl_exec($ch);

        curl_close($ch);

        $data_response=json_decode($data,true);
       
        $domain_response=$data_response["$domain_name.$domain_ext"];
        //  print_r($domain_response);
        if($domain_response['status']=='available'){
         
            $resp=array(
            'status'=>'available',
            'domain_name'=>$domain_name.'.'.$domain_ext,
            'price'=>''
             
            );
              
            return $resp;
        }
        else{
          
            $resp=array(
            'status'=>'not_available'
             
            );
              
            return $resp;         
        }

      
    }
  
}
