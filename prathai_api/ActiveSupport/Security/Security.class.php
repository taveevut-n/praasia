<?php 
class Security {

    /**
     * Return value of key on security
     *
     * @param $key string
     */
    static public function getSessionKey($key) {
        return HttpParameter::varSession($key);
    }

    /**
     * Set value to security
     *
     * @param $key string
     * @param $value mix
     */
    static public function setSessionKey($key, $value) {
        HttpParameter::setSessionParam($key, $value);
    }

    /**
     *
     *
     * Check had key on session
     *
     * @param $key string
     * @param $value mix
     */
    static public function hadSessionKey($key) {
        $b = false;
        if (array_key_exists($key, $_SESSION)) {
            $b = true;
        }
        return $b;
    }

    /**
     * Go to page
     *
     * @deprecated
     *
     * @param $s string
     * @throws Exception
     */
    static public function goToURL($s) {
        if ($s != null or $s != "") {
            header("Location:{$s}");
            exit();
        } else {
            throw new Exception("URL is not be empty.");
            exit();
        }
    }
}?>