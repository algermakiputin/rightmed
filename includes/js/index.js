jQuery(document).ready(function($) {
	var base_url = $("meta[name='base_url']").attr('content');
	$(".notification").click(function(e) {
		e.preventDefault();
		var recipient = $(this).data("recipient");
		$.ajax({
			type : 'post',
			data : {
				id : recipient
			},
			url : base_url + 'NotificationController/viewed',
			success : function(data) {
				window.location.href = $(this).attr('href');
			}
		});
	})
	$("#schedules").on('click', '.edit', function(){
		var id = $(this).data('id');
		$("#addeditmodal").modal('toggle');
		$("#addeditmodal .modal-title").html("Editting a doctor's schedule");
          $("#addedit_schedule").attr("action", "edit_schedule");
		$.ajax({
			type : 'POST',
			data : {
				id : id
			}, 
			url : base_url + 'Staff/getScheduleDetails',
			success : function(data) {
				var result = JSON.parse(data);
				$("#date").val(result.date);
				$("#start").val(result.start);
				$("#end").val(result.end);
				$("#id").val(result.id);
				$("#doctor").val(result.user_id);
			}
		})
	});
	$("[name='birthdate']").change(function() {
	     var bdate = moment($(this).val());
	     var currentAge = moment().diff(bdate, 'years');
	     $("#age").val(currentAge);
	})
      

	$("[name='birthdate']").datepicker();
	$("#doctor-select").change(function() {
		var id = $(this).val();
		$.ajax({
			type : 'POST',
			data : {
				id : id
			}, 
			url : base_url + 'Staff/getDoctorSchedule',
			success : function(data) {
				var result = JSON.parse(data);
				$("#schedule-info .row").empty();
				var count = parseInt(Object.keys(result).length);

				if (count) {

					$.each(result, function(key, value) {
						$("#schedule-info .row").prepend(
							'<div class="col-md-12 text-center" style="padding-right:0">' +
								'<div class="schedule-box" data-id="'+value.id+'">' +
								'<i class="fa fa-clock-o"></i> <span class="time">'+value.date + ' ' +value.start+' - '+value.end+'</span>' +
								' Slots Remaining '+value.available+'</div>' +
								'</div>'
							);
	            
					});
					$("#schedule-info .row").prepend('<div class="col-md-12"><label>Doctor Schedule</label></div>');
				}else {
					$("#schedule-info .row").html('<div class="col-md-12"><p class="text-info">The Doctor is not available at this time</p></div>');
				}
						
			}
		});
	})
	$("#addeditmodal").on('click', '.schedule-box', function() {
		$(".schedule-box").removeClass('active');
		$(this).addClass('active');
		$("#schedule_time").val($(this).data('id'));
	})
	 
 
	var patient_table = $("#patient_table").DataTable({
		serverSide : true,
		ordering : false,
	 	dom: 'rtip',
	 	processing : true,

	 	ajax : {
	 		type : 'POST',
	 		url : base_url + 'Staff/patientsDataTable'
	 	},
	 	"columnDefs": [
            	{
	                "targets": [ 7 ],
	                "visible": false,
	                "searchable": false
            	} 
        	],
	 	initComplete : function() {
	 		 $("#select-gender").change(function() {
	 		 	var gender = $(this).val();
	 		 	patient_table.search('');
	 		 	patient_table.columns(1).search('');
	 			patient_table.columns(2).search('');
	 			patient_table.columns(3).search(''); 
	 			patient_table.columns(4).search('');
	 			patient_table.columns(5).search('');
	 		 	patient_table.columns(0).search(gender).draw();
	 		 })

	 		 $("#filter-age").click(function() {
	 		 	var start = $("#age-start").val();
	 		 	var end = $("#age-end").val();
	 		 	$("#filter-indicator").text('');
	 		 	patient_table.search('');
	 		  	patient_table.columns(0).search('');
	 			patient_table.columns(3).search('');
	 			patient_table.columns(4).search('');
	 			patient_table.columns(5).search('');
	 		 	patient_table.columns(1).search(start);
	 		 	patient_table.columns(2).search(end).draw();
	 		 	$("#agerange").modal('toggle');
	 		 	$("#filter-indicator").text("Filter age: " + start + ' - ' + end);
	 		 })

	 		 $("#patient-search").keyup(function() {
	 		 	$("#filter-indicator").text('');
	 		 	patient_table.columns(0).search('');
	 			patient_table.columns(1).search('');
	 			patient_table.columns(2).search('');
	 		 	patient_table.columns(3).search('');
	 		 	patient_table.columns(4).search('');
	 		 	patient_table.columns(5).search('');
	 		 	patient_table.search($(this).val()).draw();
	 		 })
	 		
	 	},
	 	"language": {
	      "emptyTable": "No data available in the patients records"
	    }
	});

	new $.fn.dataTable.Buttons( patient_table, {
	    name: 'commands',
	    buttons: [
	    		{
	                extend: 'print',
	                text : '<i class="fa fa-print"></i> Print',
	                title : 'Patients Records',
	                customize: function ( win ) {
	                    $(win.document.body).find( 'table' )
	                        .addClass( 'compact' )
	                        .css( 'font-size', '28px' );

	                },
	                exportOptions: {
	                    columns: [ 0, 1, 2,3,4,5,7 ]
	                },
	                className : 'btn btn-default btn-sm btn-custom'
            	}
	    ]
	} );
	 
	patient_table.buttons( 0, null ).containers().appendTo( '.middle-toolbar' );

	$("#filter-diagnose-form").submit(function(e) {
		var diagnoses = $("[name='diagnose-filter']").val();
		patient_table.search('');
		patient_table.columns(0).search('');
	 	patient_table.columns(1).search('');
		patient_table.columns(2).search('');
		patient_table.columns(3).search(''); 
		patient_table.columns(4).search('');
		patient_table.columns(5).search(diagnoses).draw();
		$("#filter-indicator").text("Filter diagnoses: " + diagnoses);
		$("#diagnosesFilter").modal('toggle');
		e.preventDefault();
	})

	$("#filter-address-form").submit(function(e) {
	 	var elem = $("#filter-address-form [name='filter-address']");
	 	var address = elem.val();
	 	 
	 	if (address) {
	 		patient_table.search('');
	  		patient_table.columns(0).search('');
	 		patient_table.columns(1).search('');
	 		patient_table.columns(2).search('');
	 		patient_table.columns(4).search('');
	 		patient_table.columns(5).search('');
	 		patient_table.columns(3).search(address).draw();
	 		$("#filter-indicator").text("Filter address: " + address);
	 	}
	 	$("#addressfilter").modal('toggle');
	 	e.preventDefault();
	 })

	$("#filter-diagnoses-form").submit(function(e) {
		e.preventDefault();
		var ws = $("#weight-start").val();
		var we = $("#weight-end").val();
		var hs = $("#height-start").val();
		var he = $("#height-end").val();
		var ts = $("#temperature-start").val();
		var te = $("#temperature-end").val();
		var bps = $("#bloodpressure-start").val();
		var bpe = $("#bloodpressure-end").val();
		var data = {
			weight : {
				start : ws,
				end : we
			},
			height : { 
				start : hs,
				end : he
			},
			bloodpressure : { 
				start : bps,
				end : bpe
			},
			temperature : { 
				start : ts,
				end : te
			}
		};


		patient_table.search('');
  		patient_table.columns(0).search('');
 		patient_table.columns(1).search('');
 		patient_table.columns(2).search('');
 		patient_table.columns(3).search('');
 		patient_table.columns(5).search('');
		patient_table.columns(4).search(JSON.stringify(data)).draw();
		$("#measurementsFilter").modal('toggle');
		// $("#filter-indicator").text('Filter diagnoses: weight:' + ws + ' - ' + we +
		// 		' Height: ' + hs + ' - ' + he +
		// 		' Temperature: ' + ts + ' - ' + te +
		// 		' Bloodpressure: ' + bps + ' - ' + bpe
		//  );
		

	})

 
	
	$("#age-start, #age-end").on('input change', function() {
		var slide1 = $("#age-start");
		var slide2 = $("#age-end");
		var start = slide1.val();
	 	var end = slide2.val();
		if (parseInt(start) > parseInt(end)) {
			alert("Start age can't be greather than end age");
			slide1.val(0);
			slide2.val(100);
			return false;
		}
		$("#rangeValues").text("Age: " + start + ' - ' + end);

	})



	$("#weight-start, #weight-end").on('input change', function() {
		rangeSlider($("#weight-start"), $("#weight-end"), $("#weightValues"), 'Weight', 'kg.');	
	})
	$("#height-start, #height-end").on('input change', function() {
		rangeSlider($("#height-start"), $("#height-end"), $("#heightValues"), 'Height', 'cms.');	
	})
	$("#bloodpressure-start, #bloodpressure-end").on('input change', function() {
		rangeSlider($("#bloodpressure-start"), $("#bloodpressure-end"), $("#bloodpressureValues"), 'Blood Pressure', 'mmHg');	
	})
	$("#temperature-start, #temperature-end").on('input change', function() {
		rangeSlider($("#temperature-start"), $("#temperature-end"), $("#temperatureValues"), 'Temparature', 'C.');	
	})

	$("#patient_table").on('click','.checkup', function() {
		var id = $(this).data('id');
		$("#patient").val(id);
		$.ajax({
			type : 'POST',
			data : {
				id : id
			},
			url : base_url + 'Staff/getCheckup',
			success : function(data) {
				var result = JSON.parse(data);
				$("#height").val(result.height);
				$("#weight").val(result.weight);
				$("#temper").val(result.temperature);
				$("#bloodpres").val(result.blood_pressure);
				$("#symptoms").val(result.symptoms);
				$("#prevmed").val(result.prevmed);
			}
		});
	});

	$("#patient_table").on('click', '.remove', function() {
		var id = $(this).data('id');
		$("#id-remove").val(id);
	})

	$("#patient_table").on('click', '.edit', function() {
		var id = $(this).data('id');
		$("#addeditmodal .modal-title").text('Edit Patient');
		$("#addedit_user").attr('action', base_url + 'Staff/edit_patient');
		$.ajax({
			type : 'POST',
			data : {
				id : id
			},
			url : base_url + 'Staff/getPatientInfo',
			success : function(data) {
				var result = JSON.parse(data);
				$("#usern").val(result.username);
				$("#passw").val(result.password);
				$("#fname").val(result.fname);
				$("#mname").val(result.mname);
				$("#lname").val(result.lname);
				$("#gender").val(result.gender);
				$("#birthdate").val(result.birthdate);
				$("#age").val(result.age);
				$("#marital_status").val(result.marital_status);
				$("#address").val(result.address);
				$("#contact").val(result.contact);
				$("#email").val(result.email);
				$("#edit-patient-id").val(id);
			}
		});
	});

	
})


function rangeSlider(elem1,elem2, values, text, unit = "") {
	var slide1 = elem1;
	var slide2 = elem2;
	var start = slide1.val();
 	var end = slide2.val();
	if (parseInt(start) > parseInt(end)) {
		alert("Start "+text+" can't be greather than end " + text);
		slide1.val(0);
		slide2.val(100);
		return false;
	}
	values.text(text +": " + start + unit + ' - ' + end + unit);
}