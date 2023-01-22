# Notes

- RUN : `php script.php`
- Server file found on `www/server.txt` will be downloaded into `downloaded/local.txt`

# Docs
- https://www.w3schools.com/php/php_ref_ftp.asp (PHP FTP Functions)
- https://flysystem.thephpleague.com/docs/ (File Storage Abstraction for PHP)
- https://packagist.org/packages/league/flysystem-ftp (Packagist)
- - https://flysystem.thephpleague.com/docs/adapter/local/ (Local Filesystem Adapter)
- - https://flysystem.thephpleague.com/docs/adapter/ftp/ (FTP Adapter)

# Response

```
C:\wamp64\www\php-ftp\index.php:30:string 'Self local based file' (length=21)
C:\wamp64\www\php-ftp\index.php:54:string 'This file will be uploaded on server' (length=36)
C:\wamp64\www\php-ftp\index.php:70:
array (size=2)
  0 => string 'admin' (length=5)
  1 => string 'www' (length=3)
Saved file : downloaded/local.txt

Successfully uploaded : Resource id #8

```