<?php
require_once ("apps/libs/lib_path.php");


class AppplicationBootStap extends ABootstap {
	/********************************Not change anything********************************************/
	function __construct() {

		/* call parent constrctor */
		parent::__construct ( ServerParameter::varServer("QUERY_STRING","control=main&action=home"));

		/* init Class module on appliction */
		$this->registerModuleClass ();

		/* lunch application */
		$this->lunchApplication ();
	}
        
	public function lunchApplication() {
                
            
		if (array_key_exists ( $this->mControl, $this->mModuleClass )) {
			$this->loadClass ( $this->mModuleClass [$this->mControl] );
		}else{
			echo "Module not yet to register.";
		}
                
	}
	/********************************Not change anything********************************************/


	/* add register class module here. */
	public function registerModuleClass() {
		$this->mModuleClass ["main"] = "MainControls";
                $this->mModuleClass ["register"] = "RegisterControls";
		$this->mModuleClass ["admin"] = "AdminControls";
		$this->mModuleClass ["authen"] = "AuthenControls";
		$this->mModuleClass ["toolkit"] = "ToolkitControls";
	}

}


/********************************Not change anything********************************************/
new AppplicationBootStap ();
/********************************Not change anything********************************************/
?>