function capitalizeFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}

function convertToSlug(text){
    return text.toLowerCase().replace(/[^\w ]+/g,'').replace(/ +/g,'-');
}

$(document).ready(function(){
	$('.loaders li[page='+first+']').trigger('click');
    $('.loader').fadeOut(500);
    
    $('.wysiwyg').summernote({
        height: 400,
        minHeight: null,
        maxHeight: null,
        focus: true
    });
    
    $('[data-toggle="tooltip"]').tooltip();
});

//Active Classes and Loaders
$('.loaders li').click(function(){
    if($(this).hasClass('dropdown'))
        return;
    
    $('.loaders li').removeClass('active');
    $(this).addClass("active");

    var page = $(this).attr("page");
    var title = $(this).text();

    $('.container section[data-page]').fadeOut(200);
    $('.container section[data-page='+page+']').delay(200).fadeIn(200);

    history.pushState("page", $(this).attr("page"), $(this).attr("page"));

    document.title = title+' · FluffCMS';
});

$('#tabs a').click(function(e){
  e.preventDefault();
  $(this).tab('show');
});

$('input[data-url-target]').keyup(function(){
    $('input.'+$(this).data('url-target')).val(convertToSlug($(this).val()));
});

//Create Functions	
$("form.create").submit(function(e){   
    e.preventDefault()
	var type = $(this).attr("data-type");
	if(type == "page" || type == "block" || type == "post"){
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
			if(type == "page" || type == "block" || type == "post"){
				$("form[data-type='"+type+"'] .wysiwyg").summernote('code', null);
			};
			$("form[data-type="+type+"]")[0].reset();
		});
    location.reload();
    return false;
});


//Update Functions
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
    
    var theForm = $('#editModal form.'+vtype);
	theForm.show();
	
	//Pages
	if(vtype == "page"){
        theForm.find('#id').val(data['id']);
		theForm.find('#title').val(data['title']);
		theForm.find('#url').val(data['url']);
        theForm.find('#template').val(data['template']);
		theForm.find('#content.wysiwyg').summernote('code', data['content']);
        if(data['image']){
            theForm.find('#featuredImage').val(data['image']);
            theForm.find('#editPagePreview').attr("src", data['image']);
            
            theForm.find('.image-box').addClass('uploaded');
        }else{
            theForm.find('.image-box').removeClass('uploaded');
        }
	}
	//Blocks
	if(vtype == "block"){
		theForm.find('#title').val(data['title']);
		theForm.find('#id').val(data['id']);
		theForm.find('#content.wysiwyg').summernote('code', data['content']);
	}
	//Users
	if(vtype == "user"){
        theForm.find('#id').val(data['id']);
		theForm.find('#name').val(data['name']);
		theForm.find('#username').val(data['username']);
		theForm.find('#role').val(data['role']);
		theForm.find('#email').val(data['email']);
	}
	//Links
	if(vtype == "navigation"){
        theForm.find('#id').val(data['id']);
		theForm.find('#url').val(data['url']);
		theForm.find('#text').val(data['text']);
		theForm.find('#target').val(data['target']);
		theForm.find('#attr').val(data['attr']);
		if(data['type'] == 1){
			theForm.find('input.external').prop('checked',true);
			theForm.find('input.local').prop('checked',false);
			theForm.find('.navaddurl').removeClass('input-prepend');
			theForm.find('.linkurl').removeClass('navurl').attr('pattern', 'https?://.+');
			theForm.find('.navaddurl .add-on').css('display', 'none');
		}else if(data['type'] == 0){
			theForm.find('input.local').prop('checked',true);
			theForm.find('input.external').prop('checked',false);
			theForm.find('.navaddurl').addClass('input-prepend');
			theForm.find('.linkurl').addClass('navurl').attr('pattern', '[^!@#$%&*()|{}.,<> ]*');
			theForm.find('.navaddurl .add-on').css('display', 'inline-block');
		}
	}
    //Posts
	if(vtype == "post"){
        theForm.find('#id').val(data['id']);
		theForm.find('#title').val(data['title']);
		theForm.find('#url').val(data['url']);
        theForm.find('#status').val(data['status']);
		theForm.find('#content.wysiwyg').summernote('code', data['content']);
        if(data['image']){
            theForm.find('#featuredImage').val(data['image']);
            theForm.find('#editPostPreview').attr("src", data['image']);
            
            theForm.find('.image-box').addClass('uploaded');
        }else{
            theForm.find('.image-box').removeClass('uploaded');
        }
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

$(document).on('click', '.addLink', function() {   
  $.post(
	'system/AJAX/nav_create.php',
      $("form#navadd").serialize(),
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