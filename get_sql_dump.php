<?php
/**
* This is a simple function to grab a dump of a remote MySql database
*
*
* @param $options
*    Takes an options param with the following options:
*        Required:
*            'user' - database user name
*            'password' - user password
*            'host' - database host
*            'database' - database name
*        Optional:
*            'mysqldump' - the pull path to "mysqldump" or the program name
*                to excute, will default to "mysqldump"
*            'storage' - the path to to the storage director, defaults to
*                data folder
*            'filename' - database name +  defaults to date
*    
*    Example:
*
*       get_sql_dump(array(
*           'user'      => "my_user`",
*           'password'  => "thuperthecret",
*           'host'      => "77.7.777.777",
*           'database'  => "db_name",
*           'mysqldump' => '/Applications/MAMP/Library/bin/mysqldump',
*           'storage'   => NULL,
*           'filename'  => NULL
*       ));    
*/
function get_sql_dump($options){

    if( !isset($options['storage']) ){
        $storage = dirname(__FILE__). '/data';
    } else {
        $storage = $options['storage'];
    }

    if( !isset($options['filename']) ){
        // $filename = time(). '_'. $options['database'];
        $filename = $options['database']. '_'. date('Y-m-d_H-i-s');
    } else {
        $filename = $options['filename'];
    }

    $filename = $storage .'/'. $filename;

    if( !isset($options['mysqldump']) ){
        $command = 'mysqldump ';
    } else {
        $command = $options['mysqldump']. ' ';
    }

    $command .= '--user="'. $options['user']. '" '.
                '--password="'. $options['password']. '" '.
                '--host="'. $options['host']. '" '.
                $options['database']. ' '.
                '> '. $filename;

    exec($command);

    if( !file_exists($filename) || filesize($filename) === 0 ){
        throw new Exception("Unable to save database dump. Check file permissions and parameters passed to `get_sql_dump`", 1);
    }

    return TRUE;

}

var_dump(

get_sql_dump(array(
    'user'      => "593345_access_dbZZZ",
    'password'  => ">Y%nL76<2S6uEYp",
    'host'      => "72.3.204.146",
    'database'  => "593345_allure_access_stag",
    'mysqldump' => '/Applications/MAMP/Library/bin/mysqldump',
    'storage'   => NULL,
    'filename'  => NULL
))

);