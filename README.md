//proving SSL, self signed
openssl s_client -connect web-security-shop.local:443
https://web-security-shop.local/login.php


//password policy 
Password shall be at least 12 characters long 
Password must contain at least one capital letter 
Password must contain at least one symbol 
Password cannot contain one of the whitelisted common passwords, Etc (Abc123, ILoveYou, Password123)


//blacklist 
top1000


//sql injection prevention
data being sanitized
validated through prepare statements
hashing passwords using bcrypt


//Protection Against TMTO/Rainbow Table Attacks
Salting, adds another string at the end of a password, so the hashed passwords are different
Strong hash algorithm bcrpyt prevents the attack
Thats why we swtiched from SHA256 to Bcrypt because the passwords will be vulnerable


//Sessions