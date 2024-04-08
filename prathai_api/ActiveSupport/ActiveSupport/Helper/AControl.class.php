<?php

abstract class AControl {

    protected $dt;
    private $m_StartExecuteTime;
    private $m_EndExecuteTime;

    function startExecuteTime() {
        $time = microtime();
        $time = explode(' ', $time);
        $time = $time[1] + $time[0];
        $this->m_StartExecuteTime = $time;
    }

    function endExecuteTime() {
        if (is_numeric($this->m_StartExecuteTime)) {
            $time = microtime();
            $time = explode(' ', $time);
            $time = $time[1] + $time[0];
            $this->m_EndExecuteTime = $time;
        } else {
            echo "Pls, Call startExecuteTime() first.";
            exit();
        }
    }

    function displayExecuteTime() {
        echo $this->getExecuteTime();
    }

    function getExecuteTime() {
        $s = "";
        if (is_numeric($this->m_StartExecuteTime) && is_numeric($this->m_EndExecuteTime)) {
            $total_time = round(($this->m_EndExecuteTime - $this->m_StartExecuteTime), 4);
            $s = $total_time;
        } else {
            echo "Pls, Call startExecuteTime() and endExecuteTime() first.";
            exit();
        }
        return $s;
    }

    function __construct() {
        $this->dt = date("dmYHis");
    }

    /**
     *
     * @param string $_module
     * @param array $_action
     * @throws Exception
     * @return string
     */
    static private function mkUrl($_module, $_action = array()) {
        $dt = date("dmYHis");
        $_s = "";
        if (is_array($_action)) {
            if (count($_action) > 0) {
                $_q = "control=" . $_module . "&";
                foreach ($_action as $_k => $_v) {
                    $_q .= $_k . "=" . $_v;
                    $_q .= "&";
                }
                $_s = "?{$_q}_dt={$dt}";
            } else {
                $_s = "?_dt=" . $dt;
            }
        } else {
            throw new Exception(
            __CLASS__ . " : " . __METHOD__
            . " : Argument is not array.");
        }
        return $_s;
    }

    /**
     *
     * @param string $_path
     * @param array $_action
     * @throws Exception
     * @return string
     */
    static private function mkCustomUrl($_path, $_action = array()) {
        $dt = date("dmYHis");
        $_s = "";
        if (is_array($_action)) {
            if (count($_action) > 0) {
                $_q = "";
                foreach ($_action as $_k => $_v) {
                    $_q .= $_k . "=" . $_v;
                    $_q .= "&";
                }
                $_s = $_path . "?{$_q}_dt={$dt}";
            } else {
                $_s = $_path . "?_dt=" . $dt;
            }
        } else {
            throw new Exception(
            __CLASS__ . " : " . __METHOD__
            . " : Argument is not array.");
        }
        return $_s;
    }

    /**
     *
     * @param string $_text
     * @param string $_path
     * @param string $_action
     * @throws Exception
     * @return string
     */
    static private function mkCustomTextLink($_text, $_path, $_action = array()) {
        $dt = date("dmYHis");
        $_s = "";
        if (is_array($_action)) {

            $_q = "";
            foreach ($_action as $_k => $_v) {
                $_q .= $_k . "=" . $_v;
                $_q .= "&";
            }

            $_s = "<a href=\"{$_path}\">" . $_text . "</a>";
        } else {
            throw new Exception(
            __CLASS__ . " : " . __METHOD__
            . " : Argument is not array.");
        }
        return $_s;
    }

    /**
     *
     * @param string $_module
     * @param string $_text
     * @param array $_action
     * @throws Exception
     * @return string
     */
    static private function mkTextLink($_module, $_text, $_action = array()) {
        $dt = date("dmYHis");
        $_s = "";
        if (is_array($_action)) {
            if (count($_action) > 0) {
                $_q = "control=" . $_module . "&";
                foreach ($_action as $_k => $_v) {
                    $_q .= $_k . "=" . $_v;
                    $_q .= "&";
                }

                $_s = "<a href=\"?{$_q}_dt={$dt}\">" . $_text . "</a>";
            } else {
                $_s = "<a href=\"?_dt={$dt}\">" . $_text . "</a>";
            }
        } else {
            throw new Exception(
            __CLASS__ . " : " . __METHOD__
            . " : Argument is not array.");
        }

        return $_s;
    }

    /**
     *
     * @param string $_path
     * @param array $_action
     * @return string
     */
    static public function customUrl($_path, $_action = array()) {
        return self::mkCustomUrl($_path, $_action);
    }

    /**
     *
     * @param string $_path
     * @param array $_action
     * @return string
     */
    static public function customTextLink($_text, $_path, $_action = array()) {
        return self::mkCustomTextLink($_text, $_path, $_action);
    }

    /**
     *
     * @param string $_module
     * @param array $_action
     * @return string
     */
    static public function url($_module, $_action = array()) {
        return self::mkUrl($_module, $_action);
    }

    /**
     *
     * @param string $_module
     * @param string $_text
     * @param array $_action
     * @return string
     */
    static public function txtLink($_module, $_text, $_action = array()) {
        return self::mkTextLink($_module, $_text, $_action);
    }

    /**
     *
     * @param string $url
     */
    static public function resticArea($url = "") {
        if (Security::getSessionKey('token_key') == ""
                or Security::getSessionKey('token_key') == null) {
            if ($url != "") {
                Security::goToURL($url);
            } else {
                Security::goToURL("/");
            }
        }
    }

    /**
     *
     * @param array $a
     * @throws Exception
     * @return string
     */
    static public function array2Option($a) {
        $_op = "";
        if (is_array($a)) {
            foreach ($a as $k => $v) {
                foreach ($v as $kk => $vv) {
                    if (array_key_exists('selected', $v) && $v['selected'] == "selected") {
                        $_op .= "\n<option selected=\"selected\" value=\""
                                . $vv . "\" >"
                                . $_z->getValue("zodiac_name") . "</option>";
                    } else {
                        
                    }
                }
            }
        } else {
            throw new Exception(
            __CLASS__ . " : " . __METHOD__ . "Pls, Input array");
        }
        return $_op;
    }

    /**
     * Build data table
     * @param DataModel $dm
     * @param string $control
     * @param string $option
     * @return string
     */
    function datatable(DataModel $dm, $control, $column = array(), $option = array()) {
        $_queryStrings = $this->getCurrentQueryString();

        $_numCurrentPage = (HttpParameter::varGet("_p", 0) == 0) ? 1 : HttpParameter::varGet("_p");
        $_endRecord = 10;
        $_startRecord = ($_numCurrentPage == 1) ? (0 * $_endRecord) : (($_numCurrentPage) - 1) * $_endRecord;

        $_tr = "";
        $intColumn = $dm->countColumn();
        $_table = "<table class='datatable panel' cellspacing=\"0\">";
        $_table .="<thead>";
        $_table .="<tr>";
        $_td = "";
        $j = 0;

        while ($j < $intColumn) {
            $order = "asc";
            if (HttpParameter::varGet("order_by") == $dm->getFieldName($j) && HttpParameter::varGet("direction") == "asc")
                $order = "desc";


            $_queryStrings['order_by'] = $dm->getFieldName($j);
            $_queryStrings['direction'] = $order;

            foreach ($column as $kk => $vv) {
                if ($kk != $dm->getFieldName($j)) {
                    continue;
                } else {
                    $_td .="<td>" . $this->txtLink(HttpParameter::varGet("control"), $vv, $_queryStrings) . "</td>";
                }
            }

            $j++;
        }

        if (count($option) > 0){
            $_td .= "<td>Action</td>";
        }

        $_table .=$_td . "</tr>";
        $_table .="</thead>";
        $_table .="<tbody>";
        $i = 0;
        while ($dm->moveNextRecord()) {
            $j = 0;
            $_tr .="<tr>";
            $_td = "";
            while ($j < $intColumn) {

                foreach ($column as $kk => $vv) {
                    if ($kk != $dm->getFieldName($j)) {
                        continue;
                    } else {
                        $_td .="<td>" . $dm->getValue($dm->getFieldName($j)) . "</td>";
                    }
                }

                $j++;
            }

            if (count($option) > 0) {
                $_td .= "<td>";
                foreach ($option as $k => $v) {
                    if ($v == "view")
                        $_td .= "<input type=\"button\" value=\"view\" onclick=\"viewData('{$dm->getValue($dm->getPkFieldName())}');\" />";

                    if ($v == "delete")
                        $_td .= "<input type=\"button\" value=\"delete\" onclick=\"deleteData('{$dm->getValue($dm->getPkFieldName())}');\" />";
                }
                $_td .= "</td>";
            }

            $_tr .=$_td . "</tr>";
            $i++;
        }

        $_table .=$_tr;
        $_table .="</tbody>";
        $_table .="<tfoot>";

        /* display number page for datatable */
        $dm->findAll();
        $_numPage = ceil($dm->countRecord() / $_endRecord);
        if (count($option) > 0)
            $_table .="<tr><td colspan=\"{($intColumn+ 1)}\"><ul>";
        else
            $_table .="<tr><td colspan=\"{$intColumn}\"><ul>";

        for ($i = 0; $i < $_numPage; $i++) {
            if (HttpParameter::varGet("_p") != $i + 1) {
                $_queryStrings['_p'] = ($i + 1);
                $_table .= "<li class=\"list-number-paginator\">" . $this->txtLink($control, ($i + 1), $_queryStrings) . "</li>";
            } else {
                $_table .= "<li class=\"list-number-paginator-selected\">" . ($i + 1) . "</li>";
            }
        }

        $_table .="</ul></td></tr>";
        $_table .="</tfoot>";
        $_table .="</table>";
        return $_table;
    }

    
    /**
     * รับค่าผ่านทาง address bar โดยใช้วิธี get
     * 
     * @return array
     */
    public function getCurrentQueryString() {
        $_queryStrings = array();
        if(count(ServerParameter::varServer('QUERY_STRING')) > 0){
        $_qTemp = explode("&", ServerParameter::varServer('QUERY_STRING'));
        
        foreach ($_qTemp as $_k => $_v) {
            $_qv = explode("=", $_v);
        
            if ($_qv[0] != "_dt")
                $_queryStrings [$_qv [0]] = $_qv [1];
            
        }
        }
        
        return $_queryStrings;
    }

}

?>