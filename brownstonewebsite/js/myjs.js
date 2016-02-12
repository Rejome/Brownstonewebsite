//template------------------------------------
$('body').tooltip({
	selector: '.img-responsive, .supplier_link'
});
$('[data-toggle="tooltip"]').tooltip();   

$('.carousel').carousel({
	interval: 3000
})
//products---------------------------------------------------------
$("#livesearch").delegate('.searchButton','click',function(e){
	alert($(this).attr('data-target'));
	$($(this).attr('data-target')).modal('show');
});

$("#browseBy").change(function(){
	window.location.assign($("#browseBy").val());
});
$(".readmores").click(function () {
	$("#p1"+$(this).attr("href")).hide();
	$("#p2"+$(this).attr("href")).attr('style','float:left;clear:left;margin-top:5px;width:450px;');
	$("#p2"+$(this).attr("href")).show();
	return false;
});
$("#livesearch").delegate('.readmores','click',function(e){
	$("#pe1"+$(this).attr("href")).hide();
	$("#pe2"+$(this).attr("href")).attr('style','float:left;clear:left;margin-top:5px;width:450px;');
	$("#pe2"+$(this).attr("href")).show();
	return false;
});

$("#livesearch").delegate('.right','click',function(e){
	var leftPos = $('.'+$(this).attr('id')).scrollLeft();
	  $('.'+$(this).attr('id')).animate({scrollLeft: leftPos - 500}, 900);
	  if((leftPos - 300)<=0){
		  $( "#"+$(this).attr('id')).parent().find( ".right" ).fadeTo( "slow" , 0, function() {
		  });
		}
	  $( "#"+$(this).attr('id')).parent().find( ".left" ).css("visibility","visible");
	  $( "#"+$(this).attr('id')).parent().find( ".left" ).css("opacity","1");
});
$("#livesearch").delegate('.left','click',function(e){
	 var leftPos = $('.'+$(this).attr('id')).scrollLeft();
	$('.'+$(this).attr('id')).animate({scrollLeft: leftPos + 500}, 900);
	$( "#"+$(this).attr('id')).parent().find( ".right" ).css("visibility","visible");
	$( "#"+$(this).attr('id')).parent().find( ".right" ).css("opacity","1");
	$( "#"+$(this).attr('id')).parent().find( ".left" ).fadeTo( "slow" , 0, function() {
	  });
});
$(".right").click(function () {
	  var leftPos = $('.'+$(this).attr('id')).scrollLeft();
	  $('.'+$(this).attr('id')).animate({scrollLeft: leftPos - 500}, 900);
	  if((leftPos - 300)<=0){
		  $( "#"+$(this).attr('id')).parent().find( ".right" ).fadeTo( "slow" , 0, function() {
		  });
		}
	  $( "#"+$(this).attr('id')).parent().find( ".left" ).css("visibility","visible");
		$( "#"+$(this).attr('id')).parent().find( ".left" ).css("opacity","1");
	});

$(".left").click(function () { 
  var leftPos = $('.'+$(this).attr('id')).scrollLeft();
  $('.'+$(this).attr('id')).animate({scrollLeft: leftPos + 500}, 900);
	$( "#"+$(this).attr('id')).parent().find( ".right" ).css("visibility","visible");
	$( "#"+$(this).attr('id')).parent().find( ".right" ).css("opacity","1");
	$( "#"+$(this).attr('id')).parent().find( ".left" ).fadeTo( "slow" , 0, function() {
  });
});
$("#sear").keyup(function() {
	if($("#sear").val()==""){
		$("#pcontent").show();
		$("#livesearch").hide();
		$("#facebook").hide();
	}
});
//news-------------------------------------------------
$('#slide-submenu').on('click',function() {			        
	$(this).closest('.list-group').fadeOut('slide',function(){
		$('.mini-submenu').fadeIn();	
	});
	
  });

$('.mini-submenu').on('click',function(){		
	$(this).next('.list-group').toggle('slide');
	$('.mini-submenu').hide();
});

//contact----------------------------------------
 var verifyCallback = function(response) {
alert(response);
};
var widgetId1;
var widgetId2;
var onloadCallback = function() {
	// Renders the HTML element with id 'example1' as a reCAPTCHA widget.
	// The id of the reCAPTCHA widget is assigned to 'widgetId1'.
	widgetId1 = grecaptcha.render('capchaThis', {
	  'sitekey' : '6LeagQYTAAAAAPpiKcFmPVmIheUWb9uxCMkA6LJC',
	  'theme' : 'light'
	});
	widgetId2 = grecaptcha.render(document.getElementById('example2'), {
	  'sitekey' : '6LeagQYTAAAAAPpiKcFmPVmIheUWb9uxCMkA6LJC'
	});
	grecaptcha.render('example3', {
	  'sitekey' : '6LeagQYTAAAAAPpiKcFmPVmIheUWb9uxCMkA6LJC',
	  'callback' : verifyCallback,
	  'theme' : 'dark'
	});
};
$("#frmSubmit").submit(function(){
	var human = grecaptcha.getResponse(widgetId1);
	if(human == "") {
		$('#captchaConfirm').attr('style', '');
		return false;
	}
	
});

$('#sear').keypress(function(e) {
	if(e.which == 13) {
		var str =$("#sear").val();
		if (str.length==0) {
			  //document.getElementById( 'pcontent' ).style.display = 'block';
			document.getElementById("livesearch").innerHTML="";
			return;
		}
		if (window.XMLHttpRequest) {
			// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp=new XMLHttpRequest();
		} else {  // code for IE6, IE5
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange=function() {
			if (xmlhttp.readyState==4 && xmlhttp.status==200) {
				document.getElementById("livesearch").innerHTML=xmlhttp.responseText;
			}
		}
			if($("#byby").val()=="products"){
				xmlhttp.open("GET",""+$("#base_input").val()+"js/xml/productsSearch.php?q="+str+"&baseurl="+$("#base_input").val(), true);
			}else if($("#byby").val()=="productselected"){
				xmlhttp.open("GET",""+$("#base_input").val()+"js/xml/productsSearch2.php?q="+str+"&typs="+$("#typs_input").val()+"&baseurl="+$("#base_input").val(), true);
			}else if($("#byby").val()=="productAll"){
				xmlhttp.open("GET",""+$("#base_input").val()+"js/xml/productsSearchAll.php?q="+str+"&baseurl="+$("#base_input").val(), true);
			}else if($("#byby").val()=="industries"){
				xmlhttp.open("GET",""+$("#base_input").val()+"js/xml/industrySearch.php?q="+str+"&baseurl="+$("#base_input").val()+"", true);
			}else if($("#byby").val()=="industryselected1"){
				xmlhttp.open("GET",""+$("#base_input").val()+"js/xml/industrySearch2.php?q="+str+"&inds="+$("#inds_input").val()+"&baseurl="+$("#base_input").val()+"", true);
			}else if($("#byby").val()=="industryselected2"){
				xmlhttp.open("GET",""+$("#base_input").val()+"js/xml/industrySearch3.php?q="+str+"&inds="+$("#inds_input").val()+"&typs="+$("#typs_input").val()+"&baseurl="+$("#base_input").val(), true);
			}else if($("#byby").val()=="suppliers"){
				xmlhttp.open("GET",""+$("#base_input").val()+"js/xml/suppliersSearch.php?q="+str+"&baseurl="+$("#base_input").val(), true);
			}else if($("#byby").val()=="supplierselected"){
				xmlhttp.open("GET",""+$("#base_input").val()+"js/xml/suppliersSearch2.php?q="+str+"&sups="+$("#sups_input").val()+"&baseurl="+$("#base_input").val(), true);
			}else if($("#byby").val()=="supplierselected2"){
				xmlhttp.open("GET",""+$("#base_input").val()+"js/xml/suppliersSearch3.php?q="+str+"&sups="+$("#sups_input").val()+"&typs="+$("#typs_input").val()+"&baseurl="+$("#base_input").val(), true);
			} 
		xmlhttp.send();
		$("#pcontent").hide();
		$("#livesearch").fadeOut('fast').delay(2000).fadeIn('slow');
		$("#facebook").fadeIn('fast').delay(1000).fadeOut('slow');
	}
});

