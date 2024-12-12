//proving SSL, self signed
openssl s_client -connect web-security-shop.local:443
ssl openssl s_client -connect web-security-shop.local:443
https://web-security-shop.local/login.php


//password policy 
Password shall be at least 12 characters long 
Password must contain at least one capital letter 
Password must contain at least one symbol 
Password cannot contain one of the whitelisted common passwords, Etc (Abc123, ILoveYou, Password123)


//blacklist 
top1000