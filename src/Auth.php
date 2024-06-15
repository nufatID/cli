<?php

namespace nufat\cli;

include 'vendor/zved/dbcheck.php';
class Auth extends DbCheck
{
    public function Index()
    {
        $conn = new mysqli($this->host, $this->user, $this->pass, $this->db_name);


        // query 
        $exists = mysqli_query($conn, "SELECT 1 FROM users LIMIT 0",);

        // check it exists

        $y = '' . "\n";
        $y .= '---------------------------------------------------' . "\n";
        if ($exists) {
            $y .= 'AUTH successs !!! table auth sudah dibuatkan ke database' . "\n";
            $y .= '---------------------------------------------------' . "\n";
            $y .= '' . "\n";
            $y .= 'system auth anda sudah bisa digunakan' . "\n";
        } else {
            $y .= 'AUTH BELUM TERSETTING !!!' . "\n";
            $y .= '---------------------------------------------------' . "\n";
            $y .= '' . "\n";
            $y .= 'silahkan ketik perintah' . "\n";
            $y .= 'php nu auth sett' . "\n";
        }
        $y .= '' . "\n";


        return $y;
    }
    public function sett()
    {
        $conn = new mysqli($this->host, $this->user, $this->pass, $this->db_name);
        $query = '';
        $sqlScript = file('vendor/zved/db.sql');
        foreach ($sqlScript as $line) {

            $startWith = substr(trim($line), 0, 2);
            $endWith = substr(trim($line), -1, 1);

            if (empty($line) || $startWith == '--' || $startWith == '/*' || $startWith == '//') {
                continue;
            }

            $query = $query . $line;
            if ($endWith == ';') {
                mysqli_query($conn, $query) or die('<div class="error-response sql-import-response">Problem in executing the SQL query <b>' . $query . '</b></div>');
                $query = '';
            }
        }
        $y = '' . "\n";
        $y .= '---------------------------------------------------' . "\n";
        $y .= 'success !!! table auth sudah dibuatkan ke database' . "\n";
        $y .= '---------------------------------------------------' . "\n";
        $y .= '' . "\n";
        $y .= 'system auth anda sudah bisa digunakan' . "\n";
        $y .= '' . "\n";


        return $y;
    }
}
