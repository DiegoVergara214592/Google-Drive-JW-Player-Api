<?php 
    //You can change this gKey with your own (32 characters).
    $gKey = 'welcometoapicodesdotcomthisiskey';
    
    function decode($pData)
    {
        global $gKey;
        
        $lData = str_replace(' ','+', $pData);
        
        $lBase64Decoded_Payload = base64_decode($lData);
        
        $lEncrypted_PlainText = substr($lBase64Decoded_Payload, 16); 
        
        $lIV = substr($lBase64Decoded_Payload, 0, 16);
        
        $lDecrypted_PlainText = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $gKey, $lEncrypted_PlainText, MCRYPT_MODE_CBC, $lIV);
        
        $lBase64Decoded_PlainText = base64_decode($lDecrypted_PlainText);

        return $lBase64Decoded_PlainText;
    }

    function encode($pData)
    {
        global $gKey;
        
        $lBase64Encoded_PlainText = base64_encode($pData);
        
        $lIV = GenerateIV();

        $lEncrypted_PlainText = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $gKey, $lBase64Encoded_PlainText, MCRYPT_MODE_CBC, $lIV);
        
        $lPayload = $lIV.$lEncrypted_PlainText;
        
        $lBase64Encoded_Payload = base64_encode($lPayload);

        return $lBase64Encoded_Payload;
    }
    
    function GenerateIV()
    {
        $lIV = mcrypt_create_iv(16, MCRYPT_DEV_URANDOM);
        while(strlen($lIV) < 16)
        {
            $lIV .= "\0";
        }
        return $lIV;
    }

?>