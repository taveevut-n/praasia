<?php
/**
 * @author Rewat Boonsit
 *
 */
class ToolkitControls extends AControl {
	/**
	 * String table name
	 *
	 * @var DataModel
	 */
	private $m_Datamodel = null;
	function __construct() {

		// $j = new JSONObject();
		// $j->add("d",true);
		// $j->add("da","aa123");

		// $j2 = new JSONObject();
		// $j2->add("d",true);
		// $j2->add("da","bb123");

		// $j3 = new JSONObject();
		// $j3->add("d",true);
		// $j3->add("da","cc123");
		// $j3->add("db","c123");
		// $j3->add("dc","123");

		// $x = new JSONArray();
		// $x->add("test", $j);
		// $x->add("test", $j);
		// $x->add("test", $j);

		// // echo $x->get(1)->getValue("da"); echo "<br/>";
		// // echo $x->get(0);echo "<br/>";
		// // echo $x->get(1);
		// $xx = new JSONObject();
		// $xx->add("status","success");
		// $xx->add("message","load success");

		// $xx->add("data",$x);
		// echo $xx;
		parent::__construct ();
		switch (HttpParams::varGet ( "action" )) {
			case 'createForm' :
				$this->createForm ( HttpParams::varGet ( "model" ) );
				break;

			case 'createTableForm' :
				$this->getViewCommand(HttpParams::varGet ( "model" ) );
				$this->createTableForm ( HttpParams::varGet ( "model" ) );
				$this->jsValidForm ( HttpParams::varGet ( "model" ) );
				$this->jsClearForm(HttpParams::varGet ( "model" ));
				$this->newId ( HttpParams::varGet ( "model" ) );
				$this->newDatamode ( HttpParams::varGet ( "model" ) );
				$this->updateDatamode ( HttpParams::varGet ( "model" ) );
				$this->createDatamodel ( HttpParams::varGet ( "model" ) );
				$this->deleteById ( HttpParams::varGet ( "model" ) );
				$this->deleteByIdReturnJson ( HttpParams::varGet ( "model" ) );
$this->exportListJSON(HttpParams::varGet ( "model" ));
				break;
			case 'jsValidForm' :
				$this->jsValidForm ( HttpParams::varGet ( "model" ) );
				break;

			case 'createDataModel' :
				$this->createDatamodel ( HttpParams::varGet ( "model" ) );
				break;

			case 'updateDataModel' :
				$this->updateDatamode ( HttpParams::varGet ( "model" ) );
				break;

			case 'newDataModel' :
				$this->newDatamode ( HttpParams::varGet ( "model" ) );
				break;

			case 'newId' :
				$this->newId ( HttpParams::varGet ( "model" ) );
				break;

			case 'deleteById' :
				$this->deleteById ( HttpParams::varGet ( "model" ) );
				break;

			case 'additionDataModel' :
				$this->additionDatamodel ( HttpParams::varGet ( "model" ) );

				break;
		}
	}

	/**
	 * Build form
	 */
	public function getViewCommand($_datamodel) {
		$oDataModel = new $_datamodel ();
		print "<h3>" . get_class ( $oDataModel ) . "</h3>";
		print "<pre>";
		print Toolkits::getViewCommand ( $oDataModel );
		print "</pre>";
		print "<hr>";
	}

	/**
	 * Build form
	 */
	public function createTableForm($_datamodel) {
		$oDataModel = new $_datamodel ();
		print "<h3>" . get_class ( $oDataModel ) . "</h3>";
		print "<pre>";
		print Toolkits::HtmlTableForm ( $oDataModel );
		print "</pre>";
		print "<hr>";
	}

	/**
	 * Build form
	 */
	public function createForm($_datamodel) {
		$oDataModel = new $_datamodel ();
		print "<h3>" . get_class ( $oDataModel ) . "</h3>";
		print "<pre>";
		print Toolkits::HtmlForm ( $oDataModel );
		print "</pre>";
		print "<hr>";
	}
	public function jsValidForm($_datamodel) {
		$oDataModel = new $_datamodel ();
		print "<h3>" . get_class ( $oDataModel ) . "</h3>";
		print "<pre>";
		print Toolkits::JsValidForm ( $oDataModel );
		print "</pre>";
		print "<hr>";
	}
	public function jsClearForm($_datamodel) {
		$oDataModel = new $_datamodel ();
		print "<h3>" . get_class ( $oDataModel ) . "</h3>";
		print "<pre>";
		print Toolkits::JsClearForm ( $oDataModel );
		print "</pre>";
		print "<hr>";
	}
	public function deleteById($_datamodel) {
		$oDataModel = new $_datamodel ();
		print "<h3>" . get_class ( $oDataModel ) . "</h3>";
		print "<pre>";
		print Toolkits::actionDeleteById ( $oDataModel );
		print "</pre>";
		print "<hr>";
	}
	public function deleteByIdReturnJson($_datamodel) {
		$oDataModel = new $_datamodel ();
		print "<h3>" . get_class ( $oDataModel ) . "</h3>";
		print "<pre>";
		print Toolkits::actionDeleteByIdReturnJson ( $oDataModel );
		print "</pre>";
		print "<hr>";
	}
	public function additionDatamodel($_datamodel) {
		$oDataModel = new $_datamodel ();
		print "<h3>" . get_class ( $oDataModel ) . "</h3>";
		print "<pre>";
		print Toolkits::additionDatamodel ( $oDataModel );
		print "</pre>";
		print "<hr>";
	}
	public function newId($_datamodel) {
		$oDataModel = new $_datamodel ();
		print "<h3>" . get_class ( $oDataModel ) . "</h3>";
		print "<pre>";
		print Toolkits::actionNewId ( $oDataModel );
		print "</pre>";
	}

	/**
	 * Build Datamodel
	 */
	public function createDatamodel($_datamodel) {
		$oDataModel = new $_datamodel ();
		print "<h3>" . get_class ( $oDataModel ) . "</h3>";
		print "<pre>";
		print Toolkits::additionDatamodel ( $oDataModel );
		print "</pre>";
		print "<hr>";
	}

	/**
	 * Build script update from Datamodel
	 */
	public function updateDatamode($_datamodel) {
		$oDataModel = new $_datamodel ();
		print "<h3>" . get_class ( $oDataModel ) . "</h3>";
		print "<pre>";
		print Toolkits::Form2ActionUpdate ( $oDataModel );
		print "</pre>";
		print "<hr>";
	}
        public function exportListJSON($_datamodel) {
		$oDataModel = new $_datamodel ();
		print "<h3>" . get_class ( $oDataModel ) . "</h3>";
		print "<pre>";
		print Toolkits::ExportListJSON ( $oDataModel );
		print "</pre>";
		print "<hr>";
	}

	/**
	 * Build script new record from Datamodel
	 */
	public function newDatamode($_datamodel) {
		$oDataModel = new $_datamodel ();
		print "<h3>" . get_class ( $oDataModel ) . "</h3>";
		print "<pre>";
		print Toolkits::Form2ActionNewSave ( $oDataModel );
		print "</pre>";
		print "<hr>";
	}
}?>