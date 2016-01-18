function capitalizeFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}

function convertToSlug(text){
    return text.toLowerCase().replace(/[^\w ]+/g,'').replace(/ +/g,'-');
}

$(document).ready(function(){
    
    $('.wysiwyg').summernote({
        height: 400,
        minHeight: null,
        maxHeight: null,
        focus: true
    });
    
	$('#'+first).fadeIn();
	$('.loaders li[page='+first+']').addClass("active");
	document.title = capitalizeFirstLetter(first)+' · FluffCMS';
	$(".loader").fadeOut();
	
	//Active Classes and Loaders
	$('.loaders li').click(function(){
        if($(this).hasClass('dropdown'))
            return;
        
		$('.loaders li').removeClass('active');
		$(this).addClass("active");
		
		history.pushState("hi", $(this).attr("page"), $(this).attr("page"));
		var page = $(this).attr("page");
		var title = $(this).text();
		
		document.title = title+' · FluffCMS';
		
		$(".container").children("section").fadeOut();
        $("#"+page).delay(500).fadeIn();
	});
	
	$('#tabs a').click(function (e) {
	  e.preventDefault();
	  $(this).tab('show');
	});
});

$('input[data-url-target]').keyup(function(){
    $('input.'+$(this).data('url-target')).val(convertToSlug($(this).val()));
});

//Create Functions	
$("form.create").submit(function(e){   
    e.preventDefault()
	var type = $(this).attr("data-type");
	if(type == "page" || type == "block"){
		$("form[data-type='"+type+"'] #htmlcontent").html($("form[data-type='"+type+"'] .wysiwyg").summernote('code'));
	}
  $.post(
	'system/AJAX/create.php',
      $(this).serialize(),
		function(data){
            $('.notifications').notify({
                message: { text: data },
                type: "success"
            }).show();
			if(type == "page" || type == "block"){
				$("form[data-type='"+type+"'] .wysiwyg").summernote('code', null);
			};
			$("form[data-type="+type+"]")[0].reset()
		});
      return false;
});


//Update Functions
 $(function() {
    $("button.editSave").click(function(e){
        e.preventDefault();
		var type = $(this).attr("data-type");
		if(type == "page" || type == "block"){
			$("form."+type+" #htmlcontent").html($("form."+type+" .wysiwyg").summernote('code'));
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
	$('.navaddurl').addClass('input-group');
	$('.linkurl').attr('pattern', '[^!@:#$%&*()|{}.,<> ]*');
	$('.navaddurl .input-group-addon').css('display', 'table-cell');
});

$(document).on("click", ".external", function () {
    $('.navaddurl').removeClass('input-group');
    $('.linkurl').attr('pattern', 'https?://.+');
    $('.navaddurl .input-group-addon').css('display', 'none');
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
$(document).on("click", ".btn-upload", function(e){
    e.preventDefault();
    var ImageBox = $(this).parent();
    
    ImageBox.find('input[type=file]').click();
    
    $(".theImage").change(function(){
        $('.btn-upload').button('loading');
        
        var data = new FormData();
    
        jQuery.each(ImageBox.find('#file')[0].files, function(i, file) {
            data.append('file-'+i, file);
        });

        $.ajax({
            url: 'system/AJAX/upload.php',
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            type: 'POST',
            success: function(data){
                if(data == "fail"){
                    alert('Upload failed. Please try again with a PNG, JPEG or GIF Image Type.');
                    $('.btn-upload').button('reset');
                }else{
                    ImageBox.find('img').attr('src', data);
                    $('.btn-upload').fadeOut(function(){
                        ImageBox.find('img').fadeIn();
                        ImageBox.find('.deleteImage').delay(1000).fadeIn();
                        $('.btn-upload').button('reset');
                    });
                    
                    ImageBox.find('.imgurl').val(data);
                }
            }
        });
    });
});

$(document).on("click", ".deleteImage", function(e){
    var ImageBox = $(this).parent();
    
    var src = ImageBox.find('img').attr('src').split('/').pop();
    
    $.post(
        'system/AJAX/delete_upload.php',
        { imgsrc: src },
        function(data){
            ImageBox.find('.deleteImage').fadeOut();
            ImageBox.find('img').fadeOut(function(){
                ImageBox.find('img').attr('src', '');
                ImageBox.find('.btn-upload').fadeIn();
            });
        },
        "html"
    );
});