/* =============================================================== *\ 
ulrich.digital Block extend 

- Erweiteret die gewnünschten Blocks mit einem Wahr/Falsch-Toggle
- hängt dem Block die entsprechende Klasse an.
- erstellt ein data-attribute
\* =============================================================== */ 
  

const allowedBlocks = [ 'core/image', 'core/paragraph' ];
const allowedPostType = [ 'projekt' ];
const myClassArchive = 'archive-hidden';
const myClassSingle = 'single-hidden';
//data-attribute siehe unten

import classnames from 'classnames';
import assign from "lodash.assign";

const { addFilter } = wp.hooks;
const { Fragment }	= wp.element;
const { InspectorAdvancedControls, InspectorControls }	= wp.blockEditor;
const { createHigherOrderComponent } = wp.compose;
const { PanelBody,ToggleControl } = wp.components;


/**
 * Add custom attribute
 * @param {Object} settings Settings for the block.
 * @return {Object} settings Modified settings.
 */

function addAttributes( settings ) {
    //check if object exists for old Gutenberg version compatibility
    //add allowedBlocks restriction
	if( typeof settings.attributes !== 'undefined' && allowedBlocks.includes( settings.name )  ){
		settings.attributes = Object.assign( settings.attributes, {
            hideOnSingle:{ type: 'boolean', default: false, },
            visibleOnArchive:{ type: 'boolean', default: false, },
		});
	}
	return settings;
}

/**
 * Add mobile visibility controls on Advanced Block Panel.
 * @param {function} BlockEdit Block edit component.
 * @return {function} BlockEdit Modified block edit component.
 */
 
const withAdvancedControls = createHigherOrderComponent( ( BlockEdit ) => {    
    	return ( props ) => {

    		const {
    			name,
    			attributes,
    			setAttributes,
    			isSelected,
    		} = props;

    		const {
                hideOnSingle,
    			visibleOnArchive,
    		} = attributes;
    		

            return (
    			<Fragment>
    				{ isSelected && allowedBlocks.includes( name ) &&
    					<InspectorControls>
                        <PanelBody
                            title={  'Anzeige-Optionen'  }
                            initialOpen={ true }
                            className={'startseiten_toggle'}
                            >
                            <ToggleControl
                                label={  'Auf Übersichts-Seite anzeigen'  }
                                checked={ !! visibleOnArchive }
                                onChange={ () => setAttributes( {  visibleOnArchive: ! visibleOnArchive } ) }
                                help={ !! visibleOnArchive ?  'Anzeigen'  :  'Nicht anzeigen'  }
                            />                        
                            <ToggleControl
                                label={  'Auf Projektseite verbergen'  }
                                checked={ !! hideOnSingle }
                                onChange={ () => setAttributes( {  hideOnSingle: ! hideOnSingle } ) }
                                help={ !! hideOnSingle ?  'Verbergen'  :  'Nicht verbergen'  }
                            />
                            </PanelBody>
    					</InspectorControls>
    				}
                    <BlockEdit {...props} />
    			</Fragment>
    		);
    	};

}, 'withAdvancedControls');





/**
 * Add custom element class in save element.
 *
 * @param {Object} extraProps     Block element.
 * @param {Object} blockType      Blocks object.
 * @param {Object} attributes     Blocks attributes.
 *
 * @return {Object} extraProps Modified block element.
 */
function applyExtraClass( extraProps, blockType, attributes ) {

	const { hideOnSingle } = attributes;
	
    if ( typeof hideOnSingle !== 'undefined' && !hideOnSingle && allowedBlocks.includes( blockType.name )) {
        //extraProps.className = classnames( extraProps.className, 'archive-hidden' );
        extraProps.className = classnames( extraProps.className, myClassSingle );
        assign(extraProps, {
            'data-visible-on-single'  : attributes.hideOnSingle
        });

    }else if(allowedBlocks.includes( blockType.name )) {
        assign(extraProps, {
            'data-visible-on-single' : attributes.hideOnSingle
        });
    }

	return extraProps;
}

/* =============================================================== *\ 

 	 Add Filters 

\* =============================================================== */ 
/*var $test = wp.data.select( 'core/editor' ).getCurrentPostType();
console.log($test);
*/


addFilter(
	'blocks.registerBlockType',
	'editorskit/custom-attributes',
	addAttributes
);

addFilter(
	'editor.BlockEdit',
	'editorskit/custom-advanced-control',
	withAdvancedControls
);

addFilter(
	'blocks.getSaveContent.extraProps',
	'editorskit/applyExtraClass',
	applyExtraClass
);

