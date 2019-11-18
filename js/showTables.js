/* Team AZAP
 * Alex, Zach, Antonio, Pavel
 * http://azap.greenrivertech.net/index.php */

// adds a listener to window.onload
$(document).ready(function() {

	$("#guestInfo").DataTable( {
		// last name = 2
		"order": [[ 2, "asc" ]]
	});
	$("#needInfo").DataTable( {
		"order": [[ 5, "asc" ]]
	});
	$("#incomeInfo").DataTable( {
		"order": [[ 2, "asc" ]]
	});
	$("#addressInfo").DataTable( {
		"order": [[ 2, "asc" ]]
	});
	$("#houseInfo").DataTable( {
		"order": [[ 2, "asc" ]]
	});

	// Display dataTables only after initial search is chosen
	let search = $("#search");
	search.on('click', function() {
		// Get search value
		let filter = $("#startFilter").val();

		// // redraw tables with filter
		$("#guestInfo").DataTable().search(filter).draw();
		$("#needInfo").DataTable().search(filter).draw();
		$("#incomeInfo").DataTable().search(filter).draw();
		$("#addressInfo").DataTable().search(filter).draw();
		$("#houseInfo").DataTable().search(filter).draw();

		// show table
		$("#hideTable").show();
		// hide the initial search box
		$("#searchFilter").hide();

		showTable();
	});

	// "click" if enter is pressed
	$("#startFilter").keyup(function(event) {
		// keyCode 13 = enter
		if(event.keyCode === 13) {
			search.click();
		}
	});

	let rows = $(".clickableRow");
	rows.on('click', function() {
		window.location = $(this).attr('data-href');
	})
});


function showTable()
{
	$guest = $("#info"); // main guest table button
	$needs = $("#needs"); // needs table button
	$income = $("#income"); // income table button
	$address = $("#address"); // address table button
	$household = $("#household"); // household table button

	$("#guestbtn").on({
		// after clicking button
		click : function() {
			// show table
			$guest.css("display", "block");
			// hide others
			$needs.css("display", "none");
			$income.css("display", "none");
			$address.css("display", "none");
			$household.css("display", "none");
		}
	});

	$("#needbtn").on({
		// after clicking button
		click : function() {
			// show table
			$needs.css("display", "block");
			// hide others
			$guest.css("display", "none");
			$income.css("display", "none");
			$address.css("display", "none");
			$household.css("display", "none");
		}
	});

	$("#incomebtn").on({
		// after clicking button
		click : function() {
			// show table
			$income.css("display", "block");
			// hide others
			$guest.css("display", "none");
			$needs.css("display", "none");
			$address.css("display", "none");
			$household.css("display", "none");
		}
	});

	$("#addressbtn").on({
		// after clicking button
		click : function() {
			// show table
			$address.css("display", "block");
			// hide others
			$guest.css("display", "none");
			$needs.css("display", "none");
			$income.css("display", "none");
			$household.css("display", "none");
		}
	});

	$("#housebtn").on({
		// after clicking button
		click : function() {
			// show table
			$household.css("display", "block");
			// hide others
			$guest.css("display", "none");
			$needs.css("display", "none");
			$income.css("display", "none");
			$address.css("display", "none");
		}
	});
}