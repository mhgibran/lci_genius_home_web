function save(){
	$.ajax({
		"url":"db.php",
		"data":$("#form_add").serialize(),
		"method":"POST"
	})
	.done(function() {
	    location.reload();
	})
	.fail(function() {
		alert( "error" );
	});
}

function edit_data(id,row_dat){
	$("#state").val("edit");
	$("#whereval").val(id);
	var table = $("#datatable").DataTable();

	var data = table.row( $(row_dat).parents("tr") ).data();
	var i =0;
	$.each($(".form-group input"),function(key,val){
		$(val).val(data[i]);
		i++;
	});

	$("#add_button").click();
}

function edit_data_adv(id,row_dat){
	$("#state").val("edit");
	$("#whereval").val(id);
	var table = $("#datatable").DataTable();

	var data = table.row( $(row_dat).parents("tr") ).data();
	var i =0;
	$.each($(".form-group .form-control"),function(key,val){
		var type = $(val)[0].nodeName;
		switch(type){
			case "INPUT":
				$(val).val(data[i]);
				break;
			case "SELECT":
				var temp = data[i].split("&nbsp;");
				var tempo = $(temp[0]).text()
				val.value = tempo;
				break;
			case "TEXTAREA":
				$(val).val(data[i]);
				break;
		}
		i++;
	});

	$("#add_button").click();
}

function clear_data(){
	$("#state").val("add");
	$("#form_add")[0].reset();
}

function del_bed_type(id){
	var table = $("#table").val();
	var where = $("#wherefield").val();
	$.ajax({
		"url":"db.php",
		"data":"state=edit&table=" + table + "&id_bed_type=" + id +"&status=0&wherefield="+ where + "&whereval=" + id,
		"method":"POST"
	})
	.done(function() {
	    location.reload();
	})
	.fail(function() {
		alert( "error" );
	});
}

function del_tower(id){
	var table = $("#table").val();
	var where = $("#wherefield").val();
	$.ajax({
		"url":"db.php",
		"data":"state=edit&table=" + table + "&id_tower=" + id +"&status=0&wherefield="+ where + "&whereval=" + id,
		"method":"POST"
	})
	.done(function() {
	    location.reload();
	})
	.fail(function() {
		alert( "error" );
	});
}

function del_floor(id){
	var table = $("#table").val();
	var where = $("#wherefield").val();
	$.ajax({
		"url":"db.php",
		"data":"state=edit&table=" + table + "&id_floor=" + id +"&status=0&wherefield="+ where + "&whereval=" + id,
		"method":"POST"
	})
	.done(function() {
	    location.reload();
	})
	.fail(function() {
		alert( "error" );
	});
}

function del_status_room(id){
	var table = $("#table").val();
	var where = $("#wherefield").val();
	$.ajax({
		"url":"db.php",
		"data":"state=edit&table=" + table + "&id_status_room=" + id +"&status=0&wherefield="+ where + "&whereval=" + id,
		"method":"POST"
	})
	.done(function() {
	    location.reload();
	})
	.fail(function() {
		alert( "error" );
	});
}

function del_room(id){
	var table = $("#table").val();
	var where = $("#wherefield").val();
	$.ajax({
		"url":"db.php",
		"data":"state=edit&table=" + table + "&id_room=" + id +"&status=0&wherefield="+ where + "&whereval=" + id,
		"method":"POST"
	})
	.done(function() {
	    location.reload();
	})
	.fail(function() {
		alert( "error" );
	});
}

function del_satuan(id){
	var table = $("#table").val();
	var where = $("#wherefield").val();
	$.ajax({
		"url":"db.php",
		"data":"state=edit&table=" + table + "&id_satuan=" + id +"&status=0&wherefield="+ where + "&whereval=" + id,
		"method":"POST"
	})
	.done(function() {
	    location.reload();
	})
	.fail(function() {
		alert( "error" );
	});
}

function del_service_category(id){
	var table = $("#table").val();
	var where = $("#wherefield").val();
	$.ajax({
		"url":"db.php",
		"data":"state=edit&table=" + table + "&id_service_category=" + id +"&status=0&wherefield="+ where + "&whereval=" + id,
		"method":"POST"
	})
	.done(function() {
	    location.reload();
	})
	.fail(function() {
		alert( "error" );
	});
}

function del_guest_type(id){
	var table = $("#table").val();
	var where = $("#wherefield").val();
	$.ajax({
		"url":"db.php",
		"data":"state=edit&table=" + table + "&id_guest_type=" + id +"&status=0&wherefield="+ where + "&whereval=" + id,
		"method":"POST"
	})
	.done(function() {
	    location.reload();
	})
	.fail(function() {
		alert( "error" );
	});
}

function del_company(id){
	var table = $("#table").val();
	var where = $("#wherefield").val();
	$.ajax({
		"url":"db.php",
		"data":"state=edit&table=" + table + "&id_company=" + id +"&status=0&wherefield="+ where + "&whereval=" + id,
		"method":"POST"
	})
	.done(function() {
	    location.reload();
	})
	.fail(function() {
		alert( "error" );
	});
}

function del_guest(id){
	var table = $("#table").val();
	var where = $("#wherefield").val();
	$.ajax({
		"url":"db.php",
		"data":"state=edit&table=" + table + "&id_guest=" + id +"&status=0&wherefield="+ where + "&whereval=" + id,
		"method":"POST"
	})
	.done(function() {
	    location.reload();
	})
	.fail(function() {
		alert( "error" );
	});
}

function del_sob_dis(id){
	var table = $("#table").val();
	var where = $("#wherefield").val();
	$.ajax({
		"url":"db.php",
		"data":"state=edit&table=" + table + "&id_sob_dis=" + id +"&status=0&wherefield="+ where + "&whereval=" + id,
		"method":"POST"
	})
	.done(function() {
	    location.reload();
	})
	.fail(function() {
		alert( "error" );
	});
}