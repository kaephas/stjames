/* Team AZAP
 * Alex, Zach, Antonio, Pavel
 * http://azap.greenrivertech.net/index.php */

// adds a listener to window.onload
$(document).ready(function() {
	$("#guestInfo").DataTable( {
		"order": [[ 2, "asc" ]],
		"oSearch": {"sSearch": "Empty Search"}
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

	showTable();

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
