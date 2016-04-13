jQuery(document).ready(function( $ ) {

	// Wrap iframes so they can be styled
	$('iframe[src*="youtube.com"]').wrap('<div class="youtubeWrapper" />'); 
	$('iframe[src*="vimeo.com"]').wrap('<div class="vimeoWrapper" />');
	$('iframe[src*="instagram.com"]').wrap('<div class="instagramWrapper" />');

    // Set isotope masonry on .grid
    $(".grid").isotope({
    	itemSelector: '.grid-item',
    	percentPosition: true,
    	masonry: {
    		columnWidth: '.grid-sizer'
    	}
    });

	// Layout the grid once images are loaded
	$(".grid").imagesLoaded().progress( function() {
		$(".grid").isotope('layout');
	});

	// Handle isotype filtering
	$(".categoryFilter").on("click", function() {
		// Get the category slug
		var category = "";
		var categorySlug = $(this).data("slug");

		// If it's all, set the string to empty
		if (categorySlug === "all-works") {
			category = "";

		} else {
			// Otherwise...filter based on category
			category = "." + categorySlug;
		}

		// Filter the isotope grid
		$(".grid").isotope({
			filter: category
		});

		// Figure out if the filter we clicked on already has it's child list showing, in which case we do nothing
		var selector = "#categoryList li:contains('" + categorySlug + "')";

		// Show child list in sidebar, hide any others
		if ($(selector).next(".childCategoryContainer").is(":visible") == false) { 
			$(".childCategoryContainer").slideUp(200);
			$(this).next(".childCategoryContainer").slideDown(200);
		}
		
	});

	// Sticky title, using the position: sticky polyfill javascript
	$(".titleContainer").Stickyfill();

	// Var to keep track of if we're on a portfolio page
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

	// Turns out we don't want this
	// If no page is active, we're on the homepage or some other page where we want to show all the projects
	// if (boolActive == false) {
		// $("#allChildCategoryContainer").show();
	// }

	// Handle some text changing, like the navs, on small screen sizes
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