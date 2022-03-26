<?php

namespace App\Http\Controllers\Admin\System;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class QuikapiController extends Controller
{
    public function getPositions()
    {
        $query = "SELECT * FROM positions ORDER BY id DESC LIMIT 1";
        $result = mysqli_query($mysql_link, $query) or die(error_function(mysql_error()));
        if ($result) {
            while ($row = mysqli_fetch_array($result)) {
                foreach ($row as $k => $v) {
                    if (!is_int($k)) {
                        print trim($k) . "=";
                        if (trim($k) == "ticker" && $v == "SI") {
                            print trim('Si') . ";";
                        } elseif (trim($k) == "pos_size" && $v >= 1) {
                            print trim($v) . ";";
                        } elseif (trim($k) == "pos_size" && $v <= -1) {
                            print trim($v) . ";";
                        } else {
                            print trim($v) . ";";
                        }
                    }
                }
                print "|||";
            }
        }
    }

    public function getPositonsResult()
    {
        $query = "SELECT * FROM positions WHERE ticker='" . $_GET['ticker'] . "' ORDER BY id";
        $result = mysqli_query($mysql_link, $query) or die(error_function(mysql_error()));
        $prev_price = 0;
        $res = 0;

        if ($result) {
            while ($row = mysqli_fetch_array($result)) {

                $pos = $row['pos_size'];
                $close = $row['close'];

                if ($prev_price > 0) {
                    if ($pos > 1) {
                        $temp = $prev_price - $close;
                        $res += $temp;
                        print ($temp) . "<br />";
                    } else {
                        $temp = $close - $prev_price;
                        $res += $temp;
                        print ($temp) . "<br />";
                    }
                }

                $prev_price = $close;
            }
        }

        print "<hr />Itogo: " . $res;
    }

    public function writePosition()
    {
        /*
        $str = "strategy: Простая;
        strategyinterval: 1;
        ticker: GZ1!;
        timenow: 2021-12-17T19:33:00Z;
        pos_size: -1;
        pos_m: short;
        close: 33459;
        volume: 1;
        stop: 100;
        stop_k_take: 2;
        quantity: 1;
        ----------
        ";
        */

        $str = $GLOBALS['HTTP_RAW_POST_DATA'];

        $query = "INSERT INTO `positions`";
        $fields = [];
        $values = [];

        preg_match_all("/([^:]*):([^;]*);/is", $str, $matches);
        foreach ($matches[1] as $k => $field) {
            $fields[] = trim($field);
            if (trim($field) == "ticker") {
                $values[] = "'" . trim(substr($matches[2][$k], 1, 2)) . "'";
            } else {
                $values[] = "'" . trim($matches[2][$k]) . "'";
            }
        }

        $result = mysqli_query($mysql_link,
            "INSERT INTO positions (" . implode(",", $fields) . ") VALUES (" . implode(",",
                $values) . ");") or die(error_function(mysql_error()));
        file_put_contents('log-hook.txt', $GLOBALS['HTTP_RAW_POST_DATA'] . "\n----------\n");
    }

    public function readMail()
    {
        $host        = 'imap.mail.ru';
        $port        =  993;
        $login       = 'iv-litovchenko@mail.ru';
        $pass        = '***';
        $param       = '/imap/ssl/novalidate-cert';
        $folder      = 'INBOX/Tradingview';

        if($stream = imap_open("{"."{$host}:{$port}{$param}"."}$folder",$login,$pass)){
            # echo "Connectedn";
        } else {
            exit ("Can't connect: " . imap_last_error() ."n");
        };


        /*
        $list = imap_list($stream, "{imap.mail.ru}", "*");
    if (is_array($list)) {
        foreach ($list as $val) {
            echo imap_utf7_decode($val) . "<br />";
        }
    } else {
        echo "вызов imap_list завершился с ошибкой: " . imap_last_error() . "\n";
    }
    */

        $mails_id = imap_search($stream, 'ALL');
        foreach ($mails_id as $num) {
            // Заголовок письма
            // $header = imap_header($stream, $num);
            // echo mb_decode_mimeheader($header->subject.'<br />');

            // Тело письма
            $body = imap_body($stream, $num);
            // echo quoted_printable_decode($body);
            // preg_match("/Новая позиция стратегии ([-0-9]{1,2})/is", quoted_printable_decode($body), $match);

            preg_match("/@@@(.*?)@@@/is", quoted_printable_decode($body), $match);
            $currentPos = $match[1];
        }

        print $currentPos;

        exit();
    }
}
