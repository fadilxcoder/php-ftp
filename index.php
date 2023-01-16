<?php

require 'vendor/autoload.php';

use League\Flysystem\Ftp\FtpAdapter;
use League\Flysystem\Ftp\FtpConnectionOptions;
use League\Flysystem\Local\LocalFilesystemAdapter;
use League\Flysystem\Filesystem;

# credentials.txt
$host       = "";
$user       = "";
$password   = "";

$getLocal   = "downloaded/local.txt";
$getServer  = "www/server.txt";

$fputLocalFile = "downloaded/to-be-uploaded.txt";
$fputLocal  = fopen($fputLocalFile,"r");
$fputServer = "www/uploaded.txt";

$adapter = new LocalFilesystemAdapter(
    // Determine root directory
    __DIR__.'/local/'
);

// The FilesystemOperator
$filesystem = new Filesystem($adapter);
$content = $filesystem->read('self.txt');
var_dump($content);

$adapter = new FtpAdapter(
    // Connection options
    FtpConnectionOptions::fromArray([
        'host' => $host, // required
        'root' => '/www/', // required
        'username' => $user, // required
        'password' => $password, // required
        'port' => 21,
        /*
        'ssl' => false,
        'timeout' => 90,
        'utf8' => false,
        'passive' => false,
        'transferMode' => FTP_BINARY,
        'systemType' => null, // 'windows' or 'unix'
        'ignorePassiveAddress' => null, // true or false
        'timestampsOnUnixListingsEnabled' => false, // true or false
        'recurseManually' => true // true 
        */
    ])
);

var_dump($adapter->read('uploaded.txt'));

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

    # Downloading from server to local
    echo ftp_get($ftp, $getLocal, $getServer, FTP_ASCII) ? "Saved file : $getLocal" : "Error in downloading : $getServer";

    echo "<br><br>";

    # Uploading from local to server
    echo ftp_fput($ftp, $fputServer, $fputLocal, FTP_ASCII) ? "Successfully uploaded : $fputLocal" : "Error in uploading : $fputServer" ;
} catch (\Exception $e) {
    die("Failed ! " + $e->getMessage());
}

# Close connection
ftp_close($ftp);