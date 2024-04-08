<?php

/**
 * Toolkit for support DataModel Class.  And help to fast development application.
 *
 * @author Boonsit
 *
 */
class Toolkits {

    public static function MySql2ExtDataType($s) {
        $v = "string";

        switch (strtolower($s)) {
            case 'varchar' :
            case 'char' :
            case 'text' :
            case 'mediumtext' :
            case 'bigtext' :
            case 'string' :
                $v = "string";
                break;
            case 'tinyint' :
            case 'smallint' :
            case 'mediumint' :
            case 'int' :
            case 'bigint' :
                $v = "int";
                break;
            case 'real' :
            case 'float' :
            case 'double' :
                $v = "float";
                break;
            case 'date' :
            case 'time' :
            case 'datetime' :
            case 'timestamp' :
                $v = "date";
                break;
            default :
                $v = 'string';
        }

        return (string) $v;
    }

    public static function ExtJsonField(DataModel $oDataModel) {
        $_s = "<h2>" . get_class($oDataModel) . " : " . __METHOD__ . "</h2>\n";
        $_s .= '{fields : []}';
        $iColumnCount = $oDataModel->countColumn();
        if ($iColumnCount > 0) {
            $a_ = array();
            for ($i_column = 0; $i_column < $iColumnCount; $i_column ++) {
                $a_ ['name'] = $oDataModel->getFieldName($i_column);
                $a_ ['type'] = self::MySql2ExtDataType($oDataModel->getFieldType($i_column));
                if (strtolower($oDataModel->getFieldType($i_column)) == "date" || strtolower($oDataModel->getFieldType($i_column)) == "time" || strtolower($oDataModel->getFieldType($i_column)) == "datetime" || strtolower($oDataModel->getFieldType($i_column)) == "timestamp") {
                    $a_ ['dateFormat'] = 'Y-m-d H:i:s';
                }
                $field [] = $a_;
            }
            $_s = '{fields : ' . json_encode($field) . '}';
        }
        return $_s;
    }

    /**
     * Build javascript valud function
     * @param DataModel $oDataModel
     * @return string
     */
    public static function JqeryJsonField(DataModel $oDataModel) {
        $_s = "<h2>" . get_class($oDataModel) . " : " . __METHOD__ . "</h2>\n";
        $_s .= '{fields : []}';
        $iColumnCount = $oDataModel->countColumn();
        if ($iColumnCount > 0) {
            $a_ = array();
            for ($i_column = 0; $i_column < $iColumnCount; $i_column ++) {
                $a_ ['name'] = $oDataModel->getFieldName($i_column);
                $a_ ['type'] = self::MySql2ExtDataType($oDataModel->getFieldType($i_column));
                if (strtolower($oDataModel->getFieldType($i_column)) == "date" || strtolower($oDataModel->getFieldType($i_column)) == "time" || strtolower($oDataModel->getFieldType($i_column)) == "datetime" || strtolower($oDataModel->getFieldType($i_column)) == "timestamp") {
                    $a_ ['dateFormat'] = 'Y-m-d H:i:s';
                }
                $field [] = $a_;
            }
            $_s = '{fields : ' . json_encode($field) . '}';
        }
        return $_s;
    }

    /**
     * Build div html form
     * @param DataModel $oDataModel
     * @return string
     */
    public static function HtmlForm(DataModel $oDataModel) {
        $_s = "<h2>" . get_class($oDataModel) . " : " . __METHOD__ . "</h2>\n";
        $_s .= '';
        $_class_name = strtolower(get_class($oDataModel));
        $iColumnCount = $oDataModel->countColumn();
        if ($iColumnCount > 0) {
            $a_ = array();
            $_s .= "\n" . '<form id="frm_' . $_class_name . '" name="frm_' . $_class_name . '" action="' . $_class_name . '_controls.class.php?action=" method="post">';
            for ($i_column = 0; $i_column < $iColumnCount; $i_column ++) {
                $_s .= "\n<div>\n\t";
                $_s .= "\n<div>\n\t<label>" . $oDataModel->getFieldName($i_column) . "</label></div>";
                $_s .= "\n<div>" . '<input type="text" value="" id="' . $oDataModel->getFieldName($i_column) . '" name="' . $oDataModel->getFieldName($i_column) . '" />' . "</div>";
                $_s .= "\n<div id=\"msg_" . strtolower($oDataModel->getFieldName($i_column)) . "\"></div>\n";
                $_s .= "\n</div>\n\t";
            }
            $_s .= "\n<div><input type='button' name='btn_" . get_class($oDataModel) . "_sumbit' id='btn_" . get_class($oDataModel) . "_sumbit' value='submit' /> &nbsp;<input type='button' name='btn_" . get_class($oDataModel) . "_reset' id='btn_" . get_class($oDataModel) . "_reset' value='reset' /></div>\n";
            $_s .= '</form>';
        }
        return $_s;
    }

    /**
     * Build Table Form
     * @param DataModel $oDataModel
     * @return string
     */
    public static function HtmlTableForm(DataModel $oDataModel) {
        $_s = "<h2>" . get_class($oDataModel) . " : " . __METHOD__ . "</h2>\n";

        $_class_name = strtolower(get_class($oDataModel));
        $iColumnCount = $oDataModel->countColumn();
        if ($iColumnCount > 0) {
            $a_ = array();
            $_s .= "\n" . '<form id="frm_' . $_class_name . '" name="frm_' . $_class_name . '" action="@{action-' . strtolower($_class_name) . '-url}" method="post">';

            $_s .="\n\t<table border=\"1\">";

            for ($i_column = 0; $i_column < $iColumnCount; $i_column ++) {
                $_s .= "\n\t<tr>\n\t";
                $_s .= "\n\t\t<td width=\"110\"><label for=\"{$oDataModel->getFieldName($i_column)}\">" . $oDataModel->getFieldName($i_column) . "</label></td>";

                $_s .= "\n\t\t<td width=\"200\">" . '<input title="Comment for ' . $oDataModel->getFieldName($i_column) . '" type="text" value="@{' . $oDataModel->getFieldName($i_column) . '}" id="' . $oDataModel->getFieldName($i_column) . '" name="' . $oDataModel->getFieldName($i_column) . '" maxlength="50" />' . "</td>";
                $_s .= "\n\t\t<td width=\"250\" id=\"msg_" . strtolower($oDataModel->getFieldName($i_column)) . "\"></td>\n";
                $_s .= "\n\t</tr>\n\t";
            }
            $_s .= "\n<tr>\n\t\t<td></td>\n\t\t<td><input type='button' name='btn_" . get_class($oDataModel) . "_submit' id='btn_" . get_class($oDataModel) . "_submit' value='submit' /> &nbsp;<input type='button' name='btn_" . get_class($oDataModel) . "_reset' id='btn_" . get_class($oDataModel) . "_reset' value='reset' /></td><td></td></tr>\n";

            $_s .="</table>";
            $_s .= '</form>';
        }
        return $_s;
    }

    public static function ExportListJSON(DataModel $oDataModel) {
        $_s = "<h2>JSON Format " . get_class($oDataModel) . " : " . __METHOD__ . "</h2>\n";

        $_class_name = strtolower(get_class($oDataModel));
        $iColumnCount = $oDataModel->countColumn();
        if ($iColumnCount > 0) {
            $a_ = array();
            $_s .="header(HttpHeader::\$TEXT_JSON_UTF8);\n";
            $_s .= "\n'{\n";

      
            for ($i_column = 0; $i_column < $iColumnCount; $i_column ++) {

                
                $fn = $oDataModel->buildMethodName($oDataModel->getFieldName($i_column));
                
                 $_s .= '"'.$oDataModel->getFieldName($i_column) .'":" \'. '  . '$_->get' . $fn . ' () .\' "' ;
                if (($i_column+1) != $iColumnCount) {
                    $_s .=",\n";
                    
                }
               
            } $_s .="\n}'\n";
            
            $_s .= "<h2> Array Format " . get_class($oDataModel) . " : " . __METHOD__ . "</h2>\n";
            
            
            
                
            
            $_s .="header(HttpHeader::\$TEXT_JSON_UTF8);\n";
            
            $_s .= "<h3> Array Format Empty Data</h3>\n";
            
             $_s .= '$_a[\'head\'][\'items\'] = $_->countRecord();                       
$_a[\'status\'] = "success";
$_a[\'message\'] = "get data '.get_class($oDataModel).' was success";'."\n";

      $_s .='$_a[\'data\'][0] array();';
            
            $_s .= "<h3> Array Format Has Data</h3>\n";
            
            $_s .= '$_a[\'head\'][\'items\'] = $_->countRecord();                       
$_a[\'status\'] = "success";
$_a[\'message\'] = "get data '.get_class($oDataModel).' was success";'."\n";

      $_s .='$_a[\'data\'][0] = array(';
      
            for ($i_column = 0; $i_column < $iColumnCount; $i_column ++) {

                $fn = $oDataModel->buildMethodName($oDataModel->getFieldName($i_column));
                $_s .='\''.$oDataModel->getFieldName($i_column) .'\' => $_->get' . $fn . '()';
                 
                if (($i_column+1) != $iColumnCount) {
                    $_s .=",";    
                    if($i_column != 0 && ($i_column %1) == 0){
                        $_s .="\n";    
                    }
                }
               
            } $_s .=");\n";
        }
        return $_s;
    }

    public static function JsValidForm(DataModel $oDataModel, $_bScriptTag = false) {
        $_s = "<h2>" . get_class($oDataModel) . " : " . __METHOD__ . "</h2>\n";
        $iColumnCount = $oDataModel->countColumn();
        if ($iColumnCount > 0) {
            $a_ = array();
            if ($_bScriptTag == true) {
                $_s .= "\n" . '<script type="text/javascript" language="javascript">';
            }

            $_s .= '/**
 * Valid value in form
 * @returns boolean
 * @file name ' . md5(strtolower(get_class($oDataModel))) . '.js
 */
function validForm(){
	var b_valid = true;';

            for ($i_column = 0; $i_column < $iColumnCount; $i_column ++) {
                $_s .= "\n\t";
                $_s .= 'if($("#' . strtolower($oDataModel->getFieldName($i_column)) . '").val() == ""){';
                $_s .= "\n\t\t";
                $_s .= 'b_valid = false;';
                $_s .= "\n\t\t";
                $_s .= '$("#' . strtolower($oDataModel->getFieldName($i_column)) . '").addClass("input-error");';
                $_s .= "\n\t\t";
                $_s .= '$("#msg_' . strtolower($oDataModel->getFieldName($i_column)) . '").html("' . strtolower($oDataModel->getFieldName($i_column)) . ' field is invalid data.");';
                $_s .= "\n\t";
                $_s .= '}else{';
                $_s .= "\n\t\t";
                $_s .= '$("#' . strtolower($oDataModel->getFieldName($i_column)) . '").removeClass("input-error");';
                $_s .= "\n\t\t";
                $_s .= '$("#msg_' . strtolower($oDataModel->getFieldName($i_column)) . '").html("");';
                $_s .= "\n\t";
                $_s .= '}';
                $_s .= "\n";
            }
            $_s .= "\n\t";
            $_s .= 'if(b_valid==true){
		$("#frm_' . strtolower(get_class($oDataModel)) . '").submit();
	}
}';
            if ($_bScriptTag == true) {
                $_s .= '</script>';
            }
        }
        return $_s;
    }

    public static function JsClearForm(DataModel $oDataModel, $_bScriptTag = false) {
        $_s = "<h2>" . get_class($oDataModel) . " : " . __METHOD__ . "</h2>\n";
        $_s .= '';
        $iColumnCount = $oDataModel->countColumn();
        if ($iColumnCount > 0) {
            $a_ = array();
            if ($_bScriptTag == true) {
                $_s .= "\n" . '<script type="text/javascript" language="javascript">';
            }

            $_s .= '/**
 * Clear value and message text in form
 * @returns void
 * @file name ' . md5(strtolower(get_class($oDataModel))) . '.js
 */

function clearForm(){';
            for ($i_column = 0; $i_column < $iColumnCount; $i_column ++) {

                $_s .= "\n\t" . '$("#' . strtolower($oDataModel->getFieldName($i_column)) . '").val("");';
                $_s .= "\n\t" . '$("#msg_' . strtolower($oDataModel->getFieldName($i_column)) . '").html("");';
                $_s .= "\n";
            }
            $_s .= "\n";
            $_s .= "}";
            if ($_bScriptTag == true) {
                $_s .= '</script>';
            }
        }
        return $_s;
    }

    /**
     *
     *
     *
     * DataModel to build script php action new record
     *
     * @param DataModel $oDataModel
     * @param string $type_param
     *        	example _POST ,_GET, _REQUEST
     * @param string $pre_fix_field
     * @param string $post_fix_field
     */
    public static function Form2ActionNewSave(DataModel $oDataModel, $type_param = "_POST", $pre_fix_field = "", $post_fix_field = "") {
        $_type_param = "HttpParameter::varPost";
        if (strtoupper($type_param) == "_GET") {
            $_type_param = "HttpParameter::varGet";
        } elseif (strtoupper($type_param) == "_REQUEST") {
            $_type_param = "HttpParameter::varRequest";
        }
        $_s = "<h2>" . get_class($oDataModel) . " : " . __METHOD__ . "</h2>\n";
        $_s .= '';
        $iColumnCount = $oDataModel->countColumn();
        if ($iColumnCount > 0) {
            $_s = 'function new' . get_class($oDataModel) . '(){
	$b = false;
	$_ = new ' . get_class($oDataModel) . '();
	$_->newRecord ();
';
            for ($i_column = 0; $i_column < $iColumnCount; $i_column ++) {
                $fn = $oDataModel->buildMethodName($oDataModel->getFieldName($i_column));
                $_s .= "\t\t" . '$_->set' . $fn . ' ( ' . $_type_param . '(\'' . $pre_fix_field . $oDataModel->getFieldName($i_column) . $post_fix_field . '\')' . ', ' . self::MatchMySqlTypeField(strtolower($oDataModel->getFieldType($i_column))) . ' );' . "\n";
            }
            $_s .= '
	if ($_->saveRecord ()) {
		$b = true;
	}
	return $b;
}' . "\n";
        }
        return $_s;
    }

    /**
     *
     *
     *
     * DataModel to build script php action new record
     *
     * @param DataModel $oDataModel
     * @param string $type_param
     *        	example _POST ,_GET, _REQUEST
     * @param string $pre_fix_field
     * @param string $post_fix_field
     */
    public static function Form2ActionNewSaveAndUpdate(DataModel $oDataModel, $type_param = "_POST", $pre_fix_field = "", $post_fix_field = "") {
        $_type_param = "HttpParameter::varPost";
        if (strtoupper($type_param) == "_GET") {
            $_type_param = "HttpParameter::varGet";
        } elseif (strtoupper($type_param) == "_REQUEST") {
            $_type_param = "HttpParameter::varRequest";
        }
        $_s = "<h2>" . get_class($oDataModel) . " : " . __METHOD__ . "</h2>\n";
        $_s .= '';
        $iColumnCount = $oDataModel->countColumn();
        if ($iColumnCount > 0) {
            $_s = 'function new' . get_class($oDataModel) . '(){
	$b = false;
	$_ = new ' . get_class($oDataModel) . '();
	$_->newRecord ();
';
            for ($i_column = 0; $i_column < $iColumnCount; $i_column ++) {
                $fn = $oDataModel->buildMethodName($oDataModel->getFieldName($i_column));
                $_s .= "\t\t" . '$_->set' . $fn . ' ( ' . $_type_param . '(\'' . $pre_fix_field . $oDataModel->getFieldName($i_column) . $post_fix_field . '\')' . ', ' . self::MatchMySqlTypeField(strtolower($oDataModel->getFieldType($i_column))) . ' );' . "\n";
            }
            $_s .= '
	if ($_->saveRecord ()) {
		$b = true;
	}
	return $b;
}' . "\n";
        }
        return $_s;
    }

    /**
     * Return view object command for part view action
     * @param Datamodel $oDataModel
     * @return string
     */
    public static function getViewCommand(Datamodel $oDataModel) {

        $_s = '';
// 		$oDataModel->

        for ($i = 0; $i < $oDataModel->countColumn(); $i++) {
            $_s.='$_vt->assignValue ( "' . strtolower($oDataModel->getFieldName($i)) . '", $_->get' . $oDataModel->buildMethodName($oDataModel->getFieldName($i)) . ' () );</br>';
        }

        return $_s;
    }

    /**
     *
     *
     *
     * DataModel to build script php action update record
     *
     * @param DataModel $oDataModel
     * @param string $type_param
     *        	example _POST ,_GET, _REQUEST
     * @param string $pre_fix_field
     * @param string $post_fix_field
     */
    public static function Form2ActionUpdate(DataModel $oDataModel, $type_param = "_POST", $pre_fix_field = "", $post_fix_field = "") {
        $_type_param = "HttpParameter::varPost";
        if (strtoupper($type_param) == "_GET") {
            $_type_param = "HttpParameter::varGet";
        } elseif (strtoupper($type_param) == "_REQUEST") {
            $_type_param = "HttpParameter::varRequest";
        }
        $_s = "<h2>" . get_class($oDataModel) . " : " . __METHOD__ . "</h2>
		\n";

        $iColumnCount = $oDataModel->countColumn();
        if ($iColumnCount > 0) {
            $_s = 'function update' . get_class($oDataModel) . '(){
	$b = false;
	$_ = new ' . get_class($oDataModel) . '();
	$_->findBy ("' . $oDataModel->getPkFieldName() . '=\'".' . $_type_param . '(\'' . $pre_fix_field . $oDataModel->getPkFieldName() . $post_fix_field . '\')' . '."\'");

	if ($_->countRecord () == 1) {
';
            for ($i_column = 0; $i_column < $iColumnCount; $i_column ++) {
                $fn = $oDataModel->buildMethodName($oDataModel->getFieldName($i_column));

                if ($oDataModel->getPkFieldName() == $oDataModel->getFieldName($i_column)) {
                    continue;
                }

                $_s .= "\t\t" . '$_->set' . $fn . ' ( ' . $_type_param . '(\'' . $pre_fix_field . $oDataModel->getFieldName($i_column) . $post_fix_field . '\')' . ', ' . self::MatchMySqlTypeField(strtolower($oDataModel->getFieldType($i_column))) . ' );' . "\n";
            }
            $_s .= '
		if ($_->updateRecord ()) {
			$b = true;
		}
	}
	return $b;
}' . "\n";
        }

        return $_s;
    }

    public static function actionNewId(DataModel $oDataModel) {
        $_s = "<h2>" . get_class($oDataModel) . " : " . __METHOD__ . "</h2>\n";
        $_s .= 'private function new' . get_class($oDataModel) . 'Id() {
	$_ = new ' . get_class($oDataModel) . ' ();
	$_->findLast ();
	$_->moveNextRecord ();
	return intval ( ($_->getId () != "") ? $_->getId () : 0 ) + 1;
}' . "\n";
        return $_s;
    }

    public static function actionDeleteById(DataModel $oDataModel, $type_param = "_POST", $pre_fix_field = "", $post_fix_field = "") {
        $_type_param = "HttpParameter::varPost";
        if (strtoupper($type_param) == "_GET") {
            $_type_param = "HttpParameter::varGet";
        } elseif (strtoupper($type_param) == "_REQUEST") {
            $_type_param = "HttpParameter::varRequest";
        }
        $_s = "<h2>" . get_class($oDataModel) . " : " . __METHOD__ . "</h2>\n";
        $_s .= '/**
	 * delete data on table ' . $oDataModel->getTable() . '
	 *
	 * @return boolean
	 */
		';
        $_s .= 'private function deleteBy' . get_class($oDataModel) . 'Id() {
	$b = false;
	$_ = new ' . get_class($oDataModel) . ' ();
	$b = $_->deleteRecord("' . $oDataModel->getPkFieldName() . ' =\'".' . $_type_param . '(\'' . $pre_fix_field . $oDataModel->getPkFieldName() . $post_fix_field . '\')' . '."\'");
	return $b;
}' . "\n";
        return $_s;
    }

    public static function actionDeleteByIdReturnJson(DataModel $oDataModel, $type_param = "_POST", $pre_fix_field = "", $post_fix_field = "") {
        $_type_param = "HttpParameter::varPost";
        if (strtoupper($type_param) == "_GET") {
            $_type_param = "HttpParameter::varGet";
        } elseif (strtoupper($type_param) == "_REQUEST") {
            $_type_param = "HttpParameter::varRequest";
        }
        $_s = "<h2>" . get_class($oDataModel) . " : " . __METHOD__ . "</h2>\n";
        $_s .= '/**
	 * delete data on table ' . $oDataModel->getTable() . '.  And return in json format
	 *
	 * @return string
	 */';
        $_s .= 'private function deleteBy' . get_class($oDataModel) . 'Id() {
	$s="";
	$b = false;
	$_ = new ' . get_class($oDataModel) . ' ();
	$b = $_->deleteRecord("' . $oDataModel->getPkFieldName() . ' =\'".' . $_type_param . '(\'' . $pre_fix_field . $oDataModel->getPkFieldName() . $post_fix_field . '\')' . '."\'");
	if ($b == true) {
			$s = \'{"status":"success", "message":"delete data success.", "data":{} }\';
		}else{
			$s = \'{"status":"failure","message":"delete data fail.", "data":{} }\';
		}
	return $s;
}' . "\n";
        return $_s;
    }

    private static function MatchMySqlTypeField($s) {
        $v = "string";

        switch (strtolower($s)) {
            case 'varchar' :
            case 'char' :
            case 'text' :
            case 'mediumtext' :
            case 'bigtext' :
            case 'string' :
                $v = "S_CHARACTOR";
                break;
            case 'tinyint' :
            case 'smallint' :
            case 'mediumint' :
            case 'int' :
            case 'bigint' :
            case 'real' :
            case 'float' :
            case 'double' :
                $v = "S_NUMERIC";
                break;
            case 'date' :
            case 'time' :
            case 'datetime' :
            case 'timestamp' :
                $v = "S_DATETIME";
                break;
            default :
                $v = 'S_CHARACTOR';
        }
        return $v;
    }

    /**
     * create script set and get to be property of class for Sub Class of
     * DatabaseModel
     *
     * @param DataModel $oDataModel
     * @return string
     */
    public static function additionDatamodel(DataModel $oDataModel) {
        $_s = "<h2>" . get_class($oDataModel) . " : " . __METHOD__ . "</h2>
		\n";

        for ($i_column = 0; $i_column < $oDataModel->countColumn(); $i_column ++) {
            $fn = $oDataModel->buildMethodName($oDataModel->getFieldName($i_column));
            if ($oDataModel->getIsView() == false) {
                $_s .= "
/**
* Set value to {$oDataModel->getFieldName($i_column)}
* @param string \$v
* @param integer \$cln
* @return " . get_class($oDataModel) . "
*/";
                $_s .= "\npublic function set$fn(\$v, \$cln=S_CHARACTOR){\n\$this->setValue ( '{$oDataModel->getFieldName($i_column)}', \$v, \$cln ); \nreturn \$this; \n}\n";
            }
            $_s .= "
/**
* Get value from {$oDataModel->getFieldName($i_column)}
* @return string
*/";
            $_s .= "\npublic function get$fn(){\nreturn \$this->getValue ( '{$oDataModel->getFieldName($i_column)}' );\n}\n";


            $_s .= "
/**
* Find value by field {$oDataModel->getFieldName($i_column)}
* @param string \$v field name
* @param array \$a field => DESC|ASC
* @return self
* @Example \$this->findBy$fn(\"one\",array(\"key_field\"=>\"DESC|ASC\");
*/";
            $_s .= "\npublic function findBy$fn(\$v,\$a = array()){\n \$this->findBy ( \"{$oDataModel->getFieldName($i_column)}='{\$v}'\" ,\$a);\nreturn \$this; \n}\n";
        }
        return $_s;
    }

    /**
     * create script set and get to be property of class for Sub Class of
     * DatabaseModel
     *
     * @param Datamodel $oDataModel
     * @return string
     */
    public static function buildSetGetPropertyDatamodel(Datamodel $oDataModel) {
        return self::additionDatamodel($oDataModel);
    }

    /**
     * create script set only to be property of class for Sub Class of
     * DatabaseModel
     *
     * @param DataModel $oDataModel
     * @return string
     */
    public static function buildSetPropertyDatamodel(DataModel $oDataModel) {
        $s = "<h2>" . get_class($oDataModel) . " : " . __METHOD__ . "</h2>\n";
        for ($i_column = 0; $i_column < $oDataModel->countColumn(); $i_column ++) {
            $fn = $oDataModel->buildMethodName($oDataModel->getFieldName($i_column));
            if ($oDataModel->getIsView() == false) {
                $_s .= "\npublic function set$fn(\$v, \$cln=S_CHARACTOR){\n\$this->setValue ( '{$oDataModel->getFieldName($i_column)}', \$v, \$cln );}\n";
            }
        }
        return $_s;
    }

    /**
     * create script get only to be property of class for Sub Class of
     * DatabaseModel
     *
     * @param DataModel $oDataModel
     * @return string
     */
    public static function buildGetPropertyDatamodel(DataModel $oDataModel) {
        $s = "<h2>" . get_class($oDataModel) . " : " . __METHOD__ . "</h2>\n";
        for ($i_column = 0; $i_column < $oDataModel->countColumn(); $i_column ++) {
            $fn = $oDataModel->buildMethodName($oDataModel->getFieldName($i_column));

            $_s .= "\npublic function get$fn(){\nreturn \$this->getValue ( '{$oDataModel->getFieldName($i_column)}' );}\n";
        }
        return $_s;
    }

    /**
     *
     *
     *
     * Create unit test function
     *
     * @param DataModel $oDataModel
     * @param string $type_param
     *        	= POST,GET,REQUEST
     */
    public static function BuildUnitTest(DataModel $oDataModel, $type_param = "POST") {
        print "require_once '../controls/register_controls.class.php';";

        print "class UnitTest {";
        print "/**";
        print "* ";
        print "* @var RegisterControls";
        print "*/";
        print "private \$mObj = null;";
        print "function __construct() {";
        print "\$_POST ['action'] = \"newRegister\";";
        print "\$_REQUEST ['action'] = \$_POST ['action'];";
        print "\$_POST ['email'] = \"ravatna@gmail.com\";";
        print "\$_POST ['fname'] = \"เรวัฒน์\";";
        print "\$_POST ['pword'] = \"240700\";";
        print "\$_POST ['sname'] = \"บุญสิทธิ์\";";
        print "\$_POST ['uname'] = \"ravatna\";";
        print "}";

        print "public function newRegister() {";
        print "new RegisterControls ();";
        print "}";
        print "}";
        print "\$u = new UnitTest ();";
        print "\$u->newRegister ();";
    }

}

?>