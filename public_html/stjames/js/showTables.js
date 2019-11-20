/* Team AZAP
 * Alex, Zach, Antonio, Pavel
 * http://azap.greenrivertech.net/index.php */

$(document).ready(function() {
	$("#startFilter").focus();
});

// adds a listener to window.onload
$(document).ready(function() {
	let main = $("#guestInfo");

	main.DataTable( {
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

	// set row click redirect
	let table = main.DataTable();
	$("#guestInfo tbody").on('click', 'tr', function() {
		// data = table.row(this).data();
		window.location = $(this).attr('data-href');
	});

	// Display dataTables only after initial search is chosen

	$("#search").on('click', function() {
		// Get search value
		let filter = $("#startFilter").val();
		// redraw tables with filter
		main.DataTable().search(filter).draw();

		// set filter on all secondary tables
		$("#needInfo").DataTable().search(filter).draw();
		$("#incomeInfo").DataTable().search(filter).draw();
		$("#addressInfo").DataTable().search(filter).draw();
		$("#houseInfo").DataTable().search(filter).draw();

		// un-hide table
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
	// TODO: remove once working (saved for reference)
	// let rows = $(".clickableRow");
	// rows.on('click', function() {
	// 	window.location = $(this).attr('data-href');
	// });
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
