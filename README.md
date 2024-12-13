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



------------------------------------------------------------------------------------------------------
# Attacks

//SQL INJECT, Sign in without an account, tricks the system to evaluate as 'true'
' OR '1'='1



//Cross-Site Scripting XSS attack
injecting  javascript into a field, since it manipulates the page content through script injection

<script>alert('Prone to XSS attack');</script>

<script>
    window.location.href = 'http://old-web-shop.local/remote.php';
</script>

this means it can redirect users to a malicious website
leads to data theft, account stealing, spreading malware 



//Cross-Site Request Forgery (CSRF)
attack.html file
that automatically submits a request to the website to remove items from the basket

add item 'Hoodie' to basket
run:

old-web-shop.local/attack.html

hidden in fake adverts/popups
a hacker can also force the user to make an accidental purchase, log out of account, steal and change account information
and on weak websites hackers can just redirect the users to an attack page