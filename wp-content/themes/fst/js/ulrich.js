jQuery(document).ready(function ($) {
document.onreadystatechange = function () {
if (document.readyState === 'complete') {


/* ============================================ *\

	Allgemein
	
\* ============================================ */

/*schöner Seite laden*/
$("#content_container, #site-title, #hamburger_container").animate({
	opacity:1
   	},{
   	duration:500,
   	complete : function(){},
});


/* =============================================================== *\ 

 	 Logo- und Menü-Position 

\* =============================================================== */ 
  
function logo_menu_pos(){
		
	if($(window).width()<600){
		$logo_hoehe = 0;
		$menu_hoehe = 0;		
		$("#hamburger_container").css("top", "auto");	
		$("#hamburger_container").css("bottom", "0");	
		
	} else{
		$logo_hoehe = (($( window ).height()/2)-($("#fathom_string_trio_logo").height()/2));
		$menu_hoehe = (($( window ).height()/2)-($("#hamburger_container").height()/2));
		$("#hamburger_container").css("top", $menu_hoehe);	
		$("#hamburger_container").css("bottom", "auto");	
	
	}
	
	$("#fathom_string_trio_logo").css("margin-top", $logo_hoehe);	
}

logo_menu_pos();

/* =============================================================== *\ 
 	 Nach dem Resize feuern 
\* =============================================================== */ 
  
var resizeId;
$(window).resize(function() {
    clearTimeout(resizeId);
    resizeId = setTimeout(doneResizing, 5);
});

function doneResizing(){logo_menu_pos();}

/* ================================================== *\ 
 	 Menü 
\* ================================================== */ 
 
 
$( ".hamburger" ).click(function() {
  $( "#menu" ).toggleClass( "offen" );
});

var hamburger = document.querySelector(".hamburger");
	hamburger.onclick = function () {
   	this.classList.toggle ("checked");
}




/* =============================================================== *\ 

 	 Repertoire - Filter ein- und ausblenden 

\* =============================================================== */ 
$("#rep_filter_sort").click(function () {
	  $("#filter_sort_buttons").toggle(200,"easeOutQuint",function(){
	   });
});  



/* =============================================================== *\ 

 	 Isotope

\* =============================================================== */ 

// init Isotope
var $grid = $('.repertoire_grid').isotope({
  itemSelector: '.repertoire_eintrag',
  layoutMode: 'fitRows',
  getSortData: {
    nachname: '.nachname',
	werktitel: '.werktitel',
	entstehungsjahr: '.entstehungsjahr',
}
});



/* =============================================================== *\ 
 	 Repertoire-Liste filtern 
\* =============================================================== */ 
  
// Dieser angepasste Code erlaubt es mehrere Filter zu kombinieren
// Bei Klick > Filter in Array schreiben, wenn Filter schon vorhanden, Filter aus Array löschen  

var filter_array = [];
var my_string;

$filters = $('#filters').on( 'click', 'button', function() {
	var $this = $(this);
	var neues_element = $this.attr('data-filter');
	var index = filter_array.indexOf(neues_element);

	//wenn das Element noch nicht im Array enthalten ist
	if(filter_array.indexOf(neues_element)==-1){
		filter_array.push(neues_element);
	} else {
		filter_array.splice(index, 1);
	}

	// Array zu einem String zusammenführen
	// Im String alle (g)kommas entfernen
	my_string = filter_array.join();
	my_string = my_string.replace(/,/g, "");

	if ($this.is('.is-checked')){
		$this.removeClass('is-checked');
	} else {
		$this.addClass('is-checked');
	}
	
	//console.log(my_string2);
	$grid.isotope({ filter: my_string });
});



/* =============================================================== *\ 
 	 Sortieren 
\* =============================================================== */ 

// Sortieren mit Toogle-Button
// bind filter button click
$filters = $('#sorts').on( 'click', 'button', function() {
  var $this = $( this );
  var sortValue;
  if ( $this.is('.is-checked') ) {
    // uncheck
    sortValue = 'original-order';
  } else {
    sortValue = $this.attr('data-sort-value');
    $filters.find('.is-checked').removeClass('is-checked');
  }
  $this.toggleClass('is-checked');

  // use filterFn if matches value
  sortValue = sortValue;
  console.log(sortValue);
  $grid.isotope({ sortBy: sortValue });
});




/* =============================================================== *\ 

 	 Footer-Position 

\* =============================================================== */ 
 $footer_hoehe = $(".footer_content").outerHeight(true); 
 $("#page_wrapper").css("padding-bottom", $footer_hoehe);
 $("footer").css("height", $footer_hoehe);


}//readyState
}//onreadystatechange
});//ready beenden
