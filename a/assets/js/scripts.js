$(document).ready(function(){
    
    $('.wysiwyg').summernote({
        height: 400,
        minHeight: null,
        maxHeight: null,
        focus: true
    });
    
	$('#'+first).fadeIn();
	$('.loaders li[page='+first+']').addClass("active");
	document.title = 'FluffCMS';
	$(".loader").fadeOut();
	
	//Active Classes and Loaders
	$('.loaders li').click(function() {
		$('.loaders li').removeClass('active');
		$(this).addClass("active");
		
		history.pushState("hi", $(this).attr("page"), $(this).attr("page"));
		var page = $(this).attr("page");
		var title = $(this).text();
		
		document.title = title+' | FluffCMS';
		
		$(".container").children("section").fadeOut();
        $("#"+page).delay(500).fadeIn();
	});
	
	$('#tabs a').click(function (e) {
	  e.preventDefault();
	  $(this).tab('show');
	})
	
	$('button').button()
});

//Create Functions	
$("form.create").submit(function(){   
	var type = $(this).attr("data-type");
	if(type == "page" || type == "block"){
		CKEDITOR.instances[type+'content'].updateElement(); 
	}
  $.post(
	'system/AJAX/create.php',
      $(this).serialize(),
		function(data){
			$(".notifications").html(data);
			if(type == "page" || type == "block"){
				CKEDITOR.instances[type+'content'].setData('');
			};
			$("form[data-type="+type+"]")[0].reset()
		});
      return false;
});


//Update Functions
 $(function() {
    $("button#updateTrue").click(function(){
		var type = $(this).attr("data-type");
		if(type == "page" || type == "block"){
			CKEDITOR.instances[type+'edit'].updateElement();
		}
		$.ajax({
			type: "POST",
			url: "system/AJAX/update.php",
			data: $('form.'+type).serialize(),
			success: function(msg){
					$(".notifications").html(msg),
					$("#editModal").modal('hide')
					},
			error: function(){
				alert("failure");
				}
	  });
	});
});


//Edit Functions
function edit(vtype, vid){
 $.getJSON('system/AJAX/edit.php?type='+escape(vtype)+'&id='+escape(vid), function(data) {
			editpop(vtype, data)
        });
}


function editpop(vtype, data){
	//Set Common
	var ctype = vtype.charAt(0).toUpperCase() + vtype.slice(1);
	$('#editModal .type').html(ctype);
	$('#editModal #updateTrue').attr('data-type', vtype);
	$('#editModal form').hide();
	$('#editModal form.'+vtype).show();
	
	//Pages
	if(vtype == "page"){
		$('#editModal #title').val(data['title']);
		$('#editModal #url').val(data['url']);
		$('#editModal #id').val(data['id']);
        $('#editModal #template').val(data['template']);
		$('#editModal #content.wysiwyg').summernote('code', data['content']);
	}
	//Blocks
	if(vtype == "block"){
		$('#editModal .title').html(data['title']);
		$('#editModal #title').attr('value', data['title']);
		$('#editModal #id').attr('value', data['id']);
		$('#editModal #blockedit .wysiwyg').html(data['content']);
	}
	//Users
	if(vtype == "user"){
		$('#editModal .title').html(data['name']);
		$('#editModal #name').attr('value', data['name']);
		$('#editModal #username').attr('value', data['username']);
		$('#editModal #role').val(data['role']);
		//$('#editModal #password').attr('value', data['password']);
		$('#editModal #id').attr('value', data['id']);
	}
	//Nav
	if(vtype == "navigation"){
		$('#editModal .title').html(data['text']);
		$('#editModal .type').attr('value', 'navigation');
		$('#editModal .id').attr('value', data['item_id']);
		$('#editModal #navurl').attr('value', data['url']);
		$('#editModal #editnavtext').val(data['text']);
		$('#editModal #target').val(data['target']);
		$('#editModal #navattr').val(data['attr']);
		if(data['type'] == 1){
			$('#editModal input.external').prop('checked',true);
			$('#editModal input.local').prop('checked',false);
			$('#editModal .navaddurl').removeClass('input-prepend');
			$('#editModal .linkurl').removeClass('navurl').attr('pattern', 'https?://.+');
			$('#editModal .navaddurl .add-on').css('display', 'none');
		}else if(data['type'] == 0){
			$('#editModal input.local').prop('checked',true);
			$('#editModal input.external').prop('checked',false);
			$('#editModal .navaddurl').addClass('input-prepend');
			$('#editModal .linkurl').addClass('navurl').attr('pattern', '[^!@#$%&*()|{}.,<> ]*');
			$('#editModal .navaddurl .add-on').css('display', 'inline-block');
		}
	}
    //Posts
	if(vtype == "post"){
		$('#editModal .title').html(data['title']);
		$('#editModal #title').attr('value', data['title']);
		$('#editModal #url').attr('value', data['url']);
		$('#editModal #id').attr('value', data['id']);
		$('#editModal #poseedit .wysiwyg').html(data['content']);
	}
    
    $('#editModal').modal('show');
}


//Delete Functions
$(document).on("click", ".deleteButton", function () {
     var id = $(this).data('id');
     var title = $(this).data('title');
     var type = $(this).data('type');
     $(".modal-body #id").text( id );
     $(".modal-body #title").text( title );
     $(".modal-body #type").text( type );
	 $(".deleteYes").attr("onClick", "del('"+type+"', '"+id+"')");
	 $("#deleteModal").modal('show');
});

function del(vtype, vid){
    $.ajax({
       type: "POST",
       url: "system/AJAX/delete.php",
       data: { type: vtype, id: vid },
       success: function(data){
         $(".notifications").html(data)
       }
     });
}

//Navigation Editor
$(".navurl").typeahead({
      source: urls
});

$(document).on("click", ".local", function () {
	$('.navaddurl').addClass('input-prepend');
	$('.linkurl').addClass('navurl').attr('pattern', '[^!@:#$%&*()|{}.,<> ]*');
	$('.navaddurl .add-on').css('display', 'inline-block');
});

$(document).on("click", ".external", function () {
	  $('.navaddurl').removeClass('input-prepend');
	  $('.linkurl').removeClass('navurl').attr('pattern', 'https?://.+');
	  $('.navaddurl .add-on').css('display', 'none');
});

$("form#navadd").submit( function () {   
  $.post(
	'system/AJAX/nav_create.php',
      $(this).serialize(),
		function(data){
			$(".notifications").html(data),
			$("form#navadd")[0].reset()
		});
      return false;
});

$(document).ready(function(){
	$('.navigationEdit').nestedSortable({
		disableNesting: 'no-nest',
		forcePlaceholderSize: true,
		handle: 'div',
		helper: 'clone',
		items: 'li',
		maxLevels: 2,
		opacity: .6,
		placeholder: 'placeholder',
		revert: 250,
		tabSize: 25,
		tolerance: 'pointer',
		toleranceElement: '> div',
		update: function () {
			list = $(this).nestedSortable('toArray');
			$.post(
				'system/AJAX/nav_update.php',
				{ list: list },
				function(data){
					$(".notifications").notify(data);
				},
				"html"
			);
		}
	});
});

$(document).on("click", ".navitemedit", function () {
	edit('navigation', $(this).attr('data-id'));
});

//image upload
function readURL(input, target){
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            target.attr('src', e.target.result);
            target.parent().find('.btn-upload').fadeOut(function(){
                target.fadeIn();
            });
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$(".theImage").change(function(){
    readURL(this, $('#'+$(this).data('target')));
});

$('.btn-upload').click(function(e){
    e.preventDefault();
    $(this).parent().find('input[type=file]').click();
});
