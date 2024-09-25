<?php 

   function encryptHelper($string){
        $encrypted_string = openssl_encrypt($string,'AES-128-ECB',"per_hast_Cehck");
        return $encrypted_string;
   }

   function decryptHelper($string){ // Decrypt 
        $table_id_2 = str_replace(' ','+',$string);
        $decrypted_string = openssl_decrypt($table_id_2,'AES-128-ECB',"per_hast_Cehck");
        return $decrypted_string;
   }

   function createHeaderTitle($string){ // This function use for replace specail charactor to space 
          $clear_spc = str_replace('_',' ' ,$string) ;
          $new_string = ucfirst($clear_spc);
          return $new_string ;

   }

 