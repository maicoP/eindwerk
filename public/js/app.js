$(document).ready(function(){
	var imageCount= '1';
	$('#add-image').click(function(){
		++imageCount;
		$('#input-images').append('<div id="img-'+imageCount+'"><input multiple="1" class="col-md-6" name="images[]" type="file"><button id="del-'+imageCount+'" type="button" class="btn btn-danger img-del col-md-2 col-md-offset-4">x</button></div>');
		
	});

	$(document.body).on('click','.img-del',function(){
		var id = $(this).attr('id');
		id = id.replace('del-','');
		$('#img-'+id).remove();
	});

	$(document.body).on('click','.delImg',function(){
		console.log($(this).attr('id'));
		$.ajaxSetup({
	        headers: {
	            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        }
	    });
		$.ajax({
               type: "POST",
              	url: "/images/delete/"+$(this).attr('id'),
            }).done(function(){
            	location.reload();
            });
        });
	})
