<?php

return [
    'email'=>['pattern'=>'/^[a-zA-Z1-9\.\-\_]{1,}\@[a-z]{1,}'.preg_quote('.com').'$/','message'=>'this is not correct email' ],
    'alpha'=>['pattern'=>'/^[a-zA-Z]{2,20}$/','message'=>'just letters allowed and length between 2 and 20 .' ],
    'digit'=>['pattern'=>'/^[0-9]{1,}$/','message'=>'just digits allowed.' ],
    'phone'=>['pattern'=>'/^962[0-9]{9}$/','message'=>'phone number is not correct' ],

];