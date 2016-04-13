jQuery(document).ready(function( $ ) {

	$('iframe[src*="youtube.com"]').wrap('<div class="youtubeWrapper" />'); 
    $('iframe[src*="vimeo.com"]').wrap('<div class="vimeoWrapper" />');
    $('iframe[src*="instagram.com"]').wrap('<div class="instagramWrapper" />');


	$(".grid").isotope({
	// set itemSelector so .grid-sizer is not used in layout
	itemSelector: '.grid-item',
	percentPosition: true,
	masonry: {
    // use element for option
    columnWidth: '.grid-sizer'
	}
	});

	$(".grid").imagesLoaded().progress( function() {
  		$(".grid").isotope('layout');
	});

	// Handle isotype filtering
	$(".categoryFilter").on("click", function() {
		// Get the category
		var category = $(this).text();
		// Strip whitespace
		category = category.replace(/\s+/g, '');

		// If it's all, set the string to empty
		if (category === "AllWorks") {
			category = "";

		} else {
			category = "." + category;
		}

		// Filter the isotope grid
		$(".grid").isotope({
			filter: category
		});

		// Do some annoying grabs to figure out if the filter we clicked on already has it's child list showing, in which case we do nothing
		category = $(this).text();
		var selector = "#categoryList li:contains('" + category + "')";

		// Show child list in sidebar, hide any others
		if ($(selector).next(".childCategoryContainer").is(":visible") == false) { 
			$(".childCategoryContainer").slideUp(200);
			$(this).next(".childCategoryContainer").slideDown(200);
		}

		
	});

	// Sticky any title
	$(".titleSticky").sticky({ topSpacing: 0 });

	var boolActive = false;

	// Go through and make active the relevant child category list
	$(".childCategoryList a").each(function() {

		if ($(this).text() == $("#portfolioTitle:first").text()) {
			$(this).addClass("active");
			boolActive = true;

			// If we're on a subpage we don't want to show the all category section
			if ( ! $(this).hasClass("allCategoryA")) {
				$(this).parents(".childCategoryContainer").show();
			}
			

		} else {
			$(this).removeClass("active");
		}
	});

	// If no page is active, we're on the homepage or some other page where we want to show all the projects
	if (boolActive == false) {
		$("#allChildCategoryContainer").show();
	}



	// Handle some text changing, like the navs
	enquire.register("screen and (max-width: 39.9375em)", {

    // OPTIONAL
    // If supplied, triggered when a media query matches.
    match : function() {
    	$(".nav-next a").text(">");
    	$(".nav-previous a").text("<");
    },      
                                
    // OPTIONAL
    // If supplied, triggered when the media query transitions 
    // *from a matched state to an unmatched state*.
    unmatch : function() {
    	$(".nav-next a").text("next >");
    	$(".nav-previous a").text("< prev");
    }
      
});
});