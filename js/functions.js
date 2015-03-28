$("input").on("keydown",function(e){
	if(e.which==13){
		var item = $(this).parent().children("#stuff").val();
		var user = $(this).data("user");
		var balance = $(this).parent().children("#trans").val();
		$.post("php/mod_db.php",{entry: item,name: user,trans: balance},function(data){
			if(data=="error"){
				alert("Insertion failed!");
			}
			else
				window.location.assign("./");
		}).fail(function(){
			alert("Failed to access db edit script.");
		});
	}
});
$(".add").click(function(){
	var item = $(this).parent().siblings("input").val();
	var user = $(this).data("user");
	var balance = $(this).parent().siblings("#trans").val();
	$.post("php/mod_db.php",{entry: item,name: user,trans: balance},function(data){
		if(data=="error"){
			alert("Insertion failed!");
		}
		else
			window.location.assign("./");
	}).fail(function(){
		alert("Failed to access db edit script.");
	});
});
$(".sub").click(function(){
	var user = $(this).data("user");
	$.post("php/mod_db.php",{name: user},function(data){
		if(data=="error"){
			alert("Delete failed!");
		}
		else
			window.location.assign("./");
	}).fail(function(){
		alert("Failed to access db edit script.");
	});
});