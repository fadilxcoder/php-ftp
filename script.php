<?php

$host       = "ftp-fadilxcoder.alwaysdata.net";
$user       = "fadilxcoder";
$password   = "xQEJkDS5pPgQ";
$local      = "downloaded/local.txt";
$server     = "www/server.txt";

# Connect to HOST
try {
    $ftp = ftp_connect($host);
} catch (\Exception $e) {
    die("Failed to connect " + $e->getMessage());
}

# Authenticate to HOST
try {
    ftp_login($ftp, $user, $password);

    ftp_pasv($ftp, true); // turn passive mode on

    $file_list = ftp_nlist($ftp, ".");
    var_dump($file_list);

    echo ftp_get($ftp, $local, $server, FTP_ASCII) ? "Saved file : $local" : "Error in downloading : $server" ;
} catch (\Exception $e) {
    die("Failed ! " + $e->getMessage());
}

# Close connection
ftp_close($ftp);