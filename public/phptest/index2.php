<?php
/**
 * @author        Ivan Litovchenko (i-litovan@yandex.ru)
 * @subpackage    tx_spiderindexing_output
 *
 * This package includes all hook implementations.
 */

ini_set('max_execution_time', 0);
class tx_spiderindexing
{

    public $content = "";
    public $allListUrl = [];
    public $allListUrlWithParent;
    public $allListUrlInfo; // mime_type, http_code
    public $allListUrlDeleted;

    public $startUrlScheme;
    public $startUrlHost;

    public $scriptStartTime;
    public $scriptEndTime;
    public $scriptmomoryGetUsageEnd;

    /**
     * Function executed from the Scheduler.
     * Hides all content elements of a page
     *
     * @return    boolean    TRUE if success, otherwise FALSE
     */
    public function execute($startUrlHost = '')
    {
        $success = false;
        $data = array();

        $this->sitestartpage = $startUrlHost;


        $parseStartUrl = parse_url($this->sitestartpage);
        $this->startUrlScheme = $parseStartUrl['scheme'];
        $this->startUrlHost = $parseStartUrl['host'];


        #if ($parseStartUrl['port'] != 0) {
        #    $this->startUrlHost .= ":" . $parseStartUrl['port'];
        #} // также добавляем порт

        $content = $this->crawler_getContent($this->sitestartpage);
        $this->crawler_get_links($content);
        print "<pre>";
        print_r($this->allListUrl);

    }

    public function crawler_getContent($url)
    {
        #if (count($this->allListUrl) > 3) {
        #    print "<pre>";
        #    print_r($this->allListUrl);
        #    exit();
        #}

        # $this->removeUrlIndexFromDatabseOnMd5($url); // удаляем url из БД
        # return file_get_contents($url);

        $content = $this->file_get_contents_curl($url);
        return $content;
    }

    public function crawler_get_links($content, $parentUrl = false)
    {
        if (!empty($content)) {
            preg_match_all('~<a.*?href="(.*?)".*?>~', $content, $links);
            foreach ($links[1] as $key => $newurl) {
                if (!empty($newurl)) {
                    $temp = parse_url($newurl);


                    #if ($temp['host'] == $this->startUrlHost) { // $temp['host'] == null or // $GLOBALS['_SERVER']['SERVER_NAME']){

                    # Из-за того, что нет возможности использовать $GLOBALS['_SERVER'];
                    # $urlHost = $GLOBALS['_SERVER']['HTTP_X_FORWARDED_PROTO'] ."://". $GLOBALS['_SERVER']['HTTP_HOST'] . "/";
                    $urlHost = $this->startUrlScheme . "://" . $this->startUrlHost . "/";
                    $resultUrl = $urlHost . preg_replace('/^\//', "", $temp['path']);

                    if ($this->allListUrl[md5($resultUrl)] == null) {
                        $this->allListUrl[md5($resultUrl)] = $resultUrl;
                        $content = $this->crawler_getContent($resultUrl);
                        $this->crawler_get_links($content);
                    }
                }
            }
        }
    }

    public function file_get_contents_curl($url)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_AUTOREFERER, true);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false); // запрещяем 301/302-редиректы
        curl_setopt($ch, CURLOPT_TIMEOUT, 10); // times out after 4s
        curl_setopt($ch, CURLOPT_USERAGENT, "TYPO3 Spider Bot"); // who am i

        // curl_setopt($ch, CURLOPT_POST, 1); // set POST method
        // curl_setopt($ch, CURLOPT_POSTFIELDS, "url=index%3Dbooks&field-keywords=PHP+MYSQL"); // add POST fields
        // curl_setopt($curl, CURLOPT_USERAGENT, 'Opera 10.00'); //представляемся серверу браузером Opera версии 10.00

        $data = curl_exec($ch);
        curl_close($ch);

        return $data;
    }

    // на 404-ошибку не проверяем!, т.к. исключение пойдет в output!
    /*
    public function get_url_info($url){
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, FALSE); // запрещяем 301/302-редиректы
        curl_setopt($ch, CURLOPT_HEADER, 1);
        curl_setopt($ch, CURLOPT_NOBODY, 1);
        curl_setopt($ch, CURLOPT_USERAGENT, "TYPO3 Spider Bot"); // who am i
        curl_exec($ch);
        return array(
            'http_code' => curl_getinfo($ch, CURLINFO_HTTP_CODE),
            'mime_type' => curl_getinfo($ch, CURLINFO_CONTENT_TYPE)
        );
    }
    */

    public function crawler_get_AllListUrl()
    {
        return $this->allListUrl;
    }

    public function crawler_get_AllListUrlWithParent()
    {
        return $this->allListUrlWithParent;
    }


}


$a = new tx_spiderindexing;
$a->execute('http://arclg.iv-litovchenko.ru/home.html');


?>
