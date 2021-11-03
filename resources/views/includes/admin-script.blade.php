<script>
var controller              =   '{{ $controller }}';
var action                  =   '{{ $action }}';
var baseUrl                 =   '{{  URL::to('/') }}';
var csrfTkn                 =   '{{ csrf_token() }} ';
var listingUrl				=	'';	
    function showJsonErrors(errors){	
        if(errors != ''){
            resp = $.parseJSON(errors);
            var totErrorLen = resp.length;	
            for(var errCnt =0;errCnt <totErrorLen;errCnt++){
                var modelField         =   resp[errCnt]['modelField'];
                var modelErrorMsg      =   resp[errCnt]['modelErrorMsg'];
                $('[id="'+modelField+'"]').after('<div class="error-message">'+modelErrorMsg+'</div>'); 
            }
        }
    }
    $(document).ready(function(){ 
        $('.datepicker').datepicker({
            autoclose: true,
            format: 'dd-mm-yyyy',
        });
        $('.datepkr').datetimepicker({                
            format: 'DD-MM-YYYY'
        }); 
		$(".datepkrNoRestrict").datetimepicker({
            format: 'DD-MM-YYYY',
		});
		$(".datepkrNoRestrict1").datepicker({
			format: 'dd-mm-yyyy',
			autoclose:true,
			startDate:new Date()
        });
        $(".datemask").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});
        $(".mobilemask").inputmask("999-999-9999");
        $(".phoneNoMask").inputmask("9999999999");
        $(".landMask").inputmask("(99999)-(9999999)");
        $(".pinMask").inputmask("999999");
        $(".adharMask").inputmask("9999999999999999");
		$(".timepicker").timepicker({
          showInputs: false
        });
        $(".iframe").colorbox({iframe:true,fixed:true, width:"900px", height:"600px",opacity:0.2,transition:'elastic'});
        $(".iframeD").colorbox({iframe:true,fixed:true, width:"500px", height:"500px",opacity:0.2,transition:'elastic'});
        $(".iframeLarge").colorbox({iframe:true,fixed:true, width:"90%", height:"90%",opacity:0.2,transition:'elastic'});
        $(".iframeSml").colorbox({iframe:true,fixed:true, width:"350px", height:"600px",opacity:0.2,transition:'elastic'});	
        $(".iframePrcentage").colorbox({iframe:true,fixed:true, width:"90%", height:"80%",opacity:0.2,transition:'elastic'});
        showData();
    });
    function goToCurPage(obj){
        $('#loddingImage').show();	
        $.ajax({
            url: $(obj).attr('href'),
            type: 'get',
            success:function(res){
                $('#listingTable').html(res);
                $('#loddingImage').hide();
                ajaxCompleteFunc();
            }
        });
        return false;
    }
    function isNumberKey(evt){
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57)){
        return false;
        }
        return true;
    }
    function validateAlpha(evt){
        var keyCode = (evt.which) ? evt.which : evt.keyCode
        if ((keyCode < 65 || keyCode > 90) && (keyCode < 97 || keyCode > 123) && keyCode != 32){
            return false;
        }
            return true;
    }
    function cancelFrm(){
        @if($action == 'addRoleData')
            window.location.replace(baseUrl+"/master/add_role_data"); 
        @elseif($action == 'addMenuData')
            window.location.replace(baseUrl+"/master/add_menu_data"); 
        @elseif($action == 'addSubMenuData')
            window.location.replace(baseUrl+"/master/add_sub_menu_data"); 
        @elseif($action == 'addRoleMenu')
            window.location.replace(baseUrl+"/master/add_role_menu");
        @elseif($action == 'addUser')
            window.location.replace(baseUrl+"/setting/add_user_data"); 
        @endif
    }
    function checkConfirmation(){
        if(confirm("Are you sure to Delete ?")){
            return true;
        }else{
            return false;
        }
    }
    function resetFormVal(frmId,hidVal){
        if(hidVal == 1){
            $('#'+frmId).find('input:hidden').val('');
        }else{
            $('#id').val('');
        }       
        $('#'+frmId).find('input:radio, input:checkbox').removeAttr('checked').removeAttr('selected');
        $('.'+frmId).find('input:radio, input:checkbox').removeAttr('checked').removeAttr('selected');
        $('#'+frmId).find('input:password,input:text, input:file, select, textarea').val('');   
        $('.'+frmId).find('input:password,input:text, input:file, select, textarea').val('');
        $('.error-message').remove();
    //resetting file upload content 
    }
    @if($action == 'addRoleData')
		function validateRoleData(){
			$('.registerBtn').prop('disabled',true);
			$('.imgLoader').show();
			$('.error-message').remove();
			$.ajaxSetup({
				headers: {
					'X-CSRF-Token': csrfTkn
				}
			});
			$.ajax({
				url:baseUrl+'/master/validateRoleData',
				type: 'post',
				cache: false,
				data:{
					"formData": $('#entryFrm').serialize(),
				},
				success: function(res){
					$('.imgLoader').hide();
					var resp	=   res.split('****');
					if(resp[1] == 'ERROR'){
						$('.registerBtn').prop('disabled',false);
					}else{
						if(resp[1] == 'FAILURE'){
							$('.btn btn-success').prop('disabled',false);
						   showJsonErrors(resp[2]);
						}else if(resp[1] == 'SUCCESS'){
							saveRoleFrm();
						}
					}
				},
				error: function(xhr, textStatus, thrownError) {
					alert('Something went to wrong.Please Try again later...');
				}
			});
		}
        function saveRoleFrm(){
            $('#sucMsgDiv').hide('slow');
            $('#failMsgDiv').hide('slow');                  
            $('#failMsgDiv').addClass('text-none');
            $('#sucMsgDiv').addClass('text-none');
            // $('.frmbtngroup').prop('disabled',true);            
            $('#loddingImage').show();
            $.ajaxSetup({
                headers: {
                        'X-CSRF-Token': csrfTkn
                }
            });
            $.ajax({
                url:baseUrl+'/master/saveRole',
                type: 'post',
                cache: false,                   
                data:{
                    "formdata": $('#entryFrm').serialize(),
                },
                success: function(res){     
                    $('.error-message').remove();
                    $('#loddingImage').hide();
                    var resp        =   res.split('****'); 
                    if(resp[1] == 'ERROR'){                                         
                        $('#failMsgDiv').removeClass('text-none');
                        $('.failmsgdiv').html(resp[2]);
                        $('#failMsgDiv').show('slow');
                    }else if(resp[1] == 'FAILURE'){
                        showJsonErrors(resp[2]);
                    }else if(resp[1] == 'SUCCESS'){
                        $('#sucMsgDiv').removeClass('text-none');
                        $('.sucmsgdiv').html(resp[2]);
                        $('#sucMsgDiv').show('slow');   
                        setTimeout(function(){window.parent.location.reload(true);}, 1000);
                    }      
                },
                error: function(xhr, textStatus, thrownError) {
                    //alert('Something went to wrong.Please Try again later...');
                }
            });
        }
    @endif  
    @if($action == 'addBoardDetailsData')
		function validateBoardDetailsData(){
			$('.registerBtn').prop('disabled',true);
			$('.imgLoader').show();
			$('.error-message').remove();
			$.ajaxSetup({
				headers: {
					'X-CSRF-Token': csrfTkn
				}
			});
			$.ajax({
				url:baseUrl+'/setting/validateBoardDetailsData',
				type: 'post',
				cache: false,
				data:{
					"formData": $('#entryFrm').serialize(),
				},
				success: function(res){
					$('.imgLoader').hide();
					var resp	=   res.split('****');
					if(resp[1] == 'ERROR'){
						$('.registerBtn').prop('disabled',false);
					}else{
						if(resp[1] == 'FAILURE'){
							$('.btn btn-success').prop('disabled',false);
						   showJsonErrors(resp[2]);
						}else if(resp[1] == 'SUCCESS'){
							saveBoardDetails();
						}
					}
				},
				error: function(xhr, textStatus, thrownError) {
					alert('Something went to wrong.Please Try again later...');
				}
			});
		}
        function saveBoardDetails(){
            $('#sucMsgDiv').hide('slow');
            $('#failMsgDiv').hide('slow');                  
            $('#failMsgDiv').addClass('text-none');
            $('#sucMsgDiv').addClass('text-none');
            // $('.frmbtngroup').prop('disabled',true);            
            $('#loddingImage').show();
            $.ajaxSetup({
                headers: {
                        'X-CSRF-Token': csrfTkn
                }
            });
            $.ajax({
                url:baseUrl+'/setting/saveBoardDetails',
                type: 'post',
                cache: false,                   
                data:{
                    "formdata": $('#entryFrm').serialize(),
                },
                success: function(res){     
                    $('.error-message').remove();
                    $('#loddingImage').hide();
                    var resp        =   res.split('****'); 
                    if(resp[1] == 'ERROR'){                                         
                        $('#failMsgDiv').removeClass('text-none');
                        $('.failmsgdiv').html(resp[2]);
                        $('#failMsgDiv').show('slow');
                    }else if(resp[1] == 'FAILURE'){
                        showJsonErrors(resp[2]);
                    }else if(resp[1] == 'SUCCESS'){
                        $('#sucMsgDiv').removeClass('text-none');
                        $('.sucmsgdiv').html(resp[2]);
                        $('#sucMsgDiv').show('slow');   
                        setTimeout(function(){window.parent.location.reload(true);}, 1000);
                    }      
                },
                error: function(xhr, textStatus, thrownError) {
                    //alert('Something went to wrong.Please Try again later...');
                }
            });
        }
    @endif
    @if($action == 'addSubjectDetailsData')
		function validateSubjectDetailsData(){
			$('.registerBtn').prop('disabled',true);
			$('.imgLoader').show();
			$('.error-message').remove();
			$.ajaxSetup({
				headers: {
					'X-CSRF-Token': csrfTkn
				}
			});
			$.ajax({
				url:baseUrl+'/setting/validateSubjectDetailsData',
				type: 'post',
				cache: false,
				data:{
					"formData": $('#entryFrm').serialize(),
				},
				success: function(res){
					$('.imgLoader').hide();
					var resp	=   res.split('****');
					if(resp[1] == 'ERROR'){
						$('.registerBtn').prop('disabled',false);
					}else{
						if(resp[1] == 'FAILURE'){
							$('.btn btn-success').prop('disabled',false);
						   showJsonErrors(resp[2]);
						}else if(resp[1] == 'SUCCESS'){
							saveSubjectDetails();
						}
					}
				},
				error: function(xhr, textStatus, thrownError) {
					alert('Something went to wrong.Please Try again later...');
				}
			});
		}
        function saveSubjectDetails(){
            $('#sucMsgDiv').hide('slow');
            $('#failMsgDiv').hide('slow');                  
            $('#failMsgDiv').addClass('text-none');
            $('#sucMsgDiv').addClass('text-none');
            // $('.frmbtngroup').prop('disabled',true);            
            $('#loddingImage').show();
            $.ajaxSetup({
                headers: {
                        'X-CSRF-Token': csrfTkn
                }
            });
            $.ajax({
                url:baseUrl+'/setting/saveSubjectDetails',
                type: 'post',
                cache: false,                   
                data:{
                    "formdata": $('#entryFrm').serialize(),
                },
                success: function(res){     
                    $('.error-message').remove();
                    $('#loddingImage').hide();
                    var resp        =   res.split('****'); 
                    if(resp[1] == 'ERROR'){                                         
                        $('#failMsgDiv').removeClass('text-none');
                        $('.failmsgdiv').html(resp[2]);
                        $('#failMsgDiv').show('slow');
                    }else if(resp[1] == 'FAILURE'){
                        showJsonErrors(resp[2]);
                    }else if(resp[1] == 'SUCCESS'){
                        $('#sucMsgDiv').removeClass('text-none');
                        $('.sucmsgdiv').html(resp[2]);
                        $('#sucMsgDiv').show('slow');   
                        setTimeout(function(){window.parent.location.reload(true);}, 1000);
                    }      
                },
                error: function(xhr, textStatus, thrownError) {
                    //alert('Something went to wrong.Please Try again later...');
                }
            });
        }
    @endif
    @if($action == 'addTopicDetailsData')
		function validateTopicDetailsData(){
			$('.registerBtn').prop('disabled',true);
			$('.imgLoader').show();
			$('.error-message').remove();
			$.ajaxSetup({
				headers: {
					'X-CSRF-Token': csrfTkn
				}
			});
			$.ajax({
				url:baseUrl+'/setting/validateTopicDetailsData',
				type: 'post',
				cache: false,
				data:{
					"formData": $('#entryFrm').serialize(),
				},
				success: function(res){
					$('.imgLoader').hide();
					var resp	=   res.split('****');
					if(resp[1] == 'ERROR'){
						$('.registerBtn').prop('disabled',false);
					}else{
						if(resp[1] == 'FAILURE'){
							$('.btn btn-success').prop('disabled',false);
						   showJsonErrors(resp[2]);
						}else if(resp[1] == 'SUCCESS'){
							saveTopicDetails();
						}
					}
				},
				error: function(xhr, textStatus, thrownError) {
					alert('Something went to wrong.Please Try again later...');
				}
			});
		}
        function saveTopicDetails(){
            $('#sucMsgDiv').hide('slow');
            $('#failMsgDiv').hide('slow');                  
            $('#failMsgDiv').addClass('text-none');
            $('#sucMsgDiv').addClass('text-none');
            // $('.frmbtngroup').prop('disabled',true);            
            $('#loddingImage').show();
            $.ajaxSetup({
                headers: {
                        'X-CSRF-Token': csrfTkn
                }
            });
            $.ajax({
                url:baseUrl+'/setting/saveTopicDetails',
                type: 'post',
                cache: false,                   
                data:{
                    "formdata": $('#entryFrm').serialize(),
                },
                success: function(res){     
                    $('.error-message').remove();
                    $('#loddingImage').hide();
                    var resp        =   res.split('****'); 
                    if(resp[1] == 'ERROR'){                                         
                        $('#failMsgDiv').removeClass('text-none');
                        $('.failmsgdiv').html(resp[2]);
                        $('#failMsgDiv').show('slow');
                    }else if(resp[1] == 'FAILURE'){
                        showJsonErrors(resp[2]);
                    }else if(resp[1] == 'SUCCESS'){
                        $('#sucMsgDiv').removeClass('text-none');
                        $('.sucmsgdiv').html(resp[2]);
                        $('#sucMsgDiv').show('slow');   
                        setTimeout(function(){window.parent.location.reload(true);}, 1000);
                    }      
                },
                error: function(xhr, textStatus, thrownError) {
                    //alert('Something went to wrong.Please Try again later...');
                }
            });
        }
    @endif
    @if($action == 'addClassDetailsData')
		function validateClassDetailsData(){
			$('.registerBtn').prop('disabled',true);
			$('.imgLoader').show();
			$('.error-message').remove();
			$.ajaxSetup({
				headers: {
					'X-CSRF-Token': csrfTkn
				}
			});
			$.ajax({
				url:baseUrl+'/setting/validateClassDetailsData',
				type: 'post',
				cache: false,
				data:{
					"formData": $('#entryFrm').serialize(),
				},
				success: function(res){
					$('.imgLoader').hide();
					var resp	=   res.split('****');
					if(resp[1] == 'ERROR'){
						$('.registerBtn').prop('disabled',false);
					}else{
						if(resp[1] == 'FAILURE'){
							$('.btn btn-success').prop('disabled',false);
						   showJsonErrors(resp[2]);
						}else if(resp[1] == 'SUCCESS'){
							saveClassDetails();
						}
					}
				},
				error: function(xhr, textStatus, thrownError) {
					alert('Something went to wrong.Please Try again later...');
				}
			});
		}
        function saveClassDetails(){
            $('#sucMsgDiv').hide('slow');
            $('#failMsgDiv').hide('slow');                  
            $('#failMsgDiv').addClass('text-none');
            $('#sucMsgDiv').addClass('text-none');
            // $('.frmbtngroup').prop('disabled',true);            
            $('#loddingImage').show();
            $.ajaxSetup({
                headers: {
                        'X-CSRF-Token': csrfTkn
                }
            });
            $.ajax({
                url:baseUrl+'/setting/saveClassDetails',
                type: 'post',
                cache: false,                   
                data:{
                    "formdata": $('#entryFrm').serialize(),
                },
                success: function(res){     
                    $('.error-message').remove();
                    $('#loddingImage').hide();
                    var resp        =   res.split('****'); 
                    if(resp[1] == 'ERROR'){                                         
                        $('#failMsgDiv').removeClass('text-none');
                        $('.failmsgdiv').html(resp[2]);
                        $('#failMsgDiv').show('slow');
                    }else if(resp[1] == 'FAILURE'){
                        showJsonErrors(resp[2]);
                    }else if(resp[1] == 'SUCCESS'){
                        $('#sucMsgDiv').removeClass('text-none');
                        $('.sucmsgdiv').html(resp[2]);
                        $('#sucMsgDiv').show('slow');   
                        setTimeout(function(){window.parent.location.reload(true);}, 1000);
                    }      
                },
                error: function(xhr, textStatus, thrownError) {
                    //alert('Something went to wrong.Please Try again later...');
                }
            });
        }
    @endif      
    @if($action == 'addMenuData')
		function validateMenuData(){
			$('.registerBtn').prop('disabled',true);
			$('.imgLoader').show();
			$('.error-message').remove();
			$.ajaxSetup({
				headers: {
					'X-CSRF-Token': csrfTkn
				}
			});
			$.ajax({
				url:baseUrl+'/master/validateMenuData',
				type: 'post',
				cache: false,
				data:{
					"formData": $('#entryFrm').serialize(),
				},
				success: function(res){
					$('.imgLoader').hide();
					var resp	=   res.split('****');
					if(resp[1] == 'ERROR'){
						$('.registerBtn').prop('disabled',false);
					}else{
						if(resp[1] == 'FAILURE'){
							$('.btn btn-success').prop('disabled',false);
						   showJsonErrors(resp[2]);
						}else if(resp[1] == 'SUCCESS'){
							saveMenuFrm();
						}
					}
				},
				error: function(xhr, textStatus, thrownError) {
					alert('Something went to wrong.Please Try again later...');
				}
			});
		}
		function saveMenuFrm(){
            $('#sucMsgDiv').hide('slow');
            $('#failMsgDiv').hide('slow');                  
            $('#failMsgDiv').addClass('text-none');
            $('#sucMsgDiv').addClass('text-none');
            // $('.frmbtngroup').prop('disabled',true);            
            $('#loddingImage').show();
            $.ajaxSetup({
                headers: {
                        'X-CSRF-Token': csrfTkn
                }
            });
            $.ajax({
                url:baseUrl+'/master/saveMenu',
                type: 'post',
                cache: false,                   
                data:{
                    "formdata": $('#entryFrm').serialize(),
                },
                success: function(res){     
                    $('.error-message').remove();
                    $('#loddingImage').hide();
                    var resp        =   res.split('****'); 
					if(resp[1] == 'ERROR'){                                         
                        $('#failMsgDiv').removeClass('text-none');
                        $('.failmsgdiv').html(resp[2]);
                        $('#failMsgDiv').show('slow');
                    }else if(resp[1] == 'FAILURE'){
                        showJsonErrors(resp[2]);
                    }else if(resp[1] == 'SUCCESS'){
                        $('#sucMsgDiv').removeClass('text-none');
                        $('.sucmsgdiv').html(resp[2]);
                        $('#sucMsgDiv').show('slow');   
                         setTimeout(function(){window.parent.location.reload(true);}, 2000);
                    }      
                },
                error: function(xhr, textStatus, thrownError) {
                    //alert('Something went to wrong.Please Try again later...');
                }
            });
        }
    @endif
	@if($action == 'addSubMenuData')
		function validateSubMenuData(){
			$('.registerBtn').prop('disabled',true);
			$('.imgLoader').show();
			$('.error-message').remove();
			$.ajaxSetup({
				headers: {
					'X-CSRF-Token': csrfTkn
				}
			});
			$.ajax({
				url:baseUrl+'/master/validateSubMenuData',
				type: 'post',
				cache: false,
				data:{
					"formData": $('#entryFrm').serialize(),
				},
				success: function(res){
					$('.imgLoader').hide();
					var resp	=   res.split('****');
					if(resp[1] == 'ERROR'){
						$('.registerBtn').prop('disabled',false);
					}else{
						if(resp[1] == 'FAILURE'){
							$('.btn btn-success').prop('disabled',false);
						   showJsonErrors(resp[2]);
						}else if(resp[1] == 'SUCCESS'){
							saveSubMenuFrm();
						}
					}
				},
				error: function(xhr, textStatus, thrownError) {
					alert('Something went to wrong.Please Try again later...');
				}
			});
		}
		function saveSubMenuFrm(){
            $('#sucMsgDiv').hide('slow');
            $('#failMsgDiv').hide('slow');                  
            $('#failMsgDiv').addClass('text-none');
            $('#sucMsgDiv').addClass('text-none');
            // $('.frmbtngroup').prop('disabled',true);            
            $('#loddingImage').show();
            $.ajaxSetup({
                headers: {
                        'X-CSRF-Token': csrfTkn
                }
            });
            $.ajax({
                url:baseUrl+'/master/saveSubMenu',
                type: 'post',
                cache: false,                   
                data:{
                    "formdata": $('#entryFrm').serialize(),
                },
                success: function(res){     
                    $('.error-message').remove();
                    $('#loddingImage').hide();
                    var resp        =   res.split('****'); 
					if(resp[1] == 'ERROR'){                                         
                        $('#failMsgDiv').removeClass('text-none');
                        $('.failmsgdiv').html(resp[2]);
                        $('#failMsgDiv').show('slow');
                    }else if(resp[1] == 'FAILURE'){
                        showJsonErrors(resp[2]);
                    }else if(resp[1] == 'SUCCESS'){
                        $('#sucMsgDiv').removeClass('text-none');
                        $('.sucmsgdiv').html(resp[2]);
                        $('#sucMsgDiv').show('slow');   
                         setTimeout(function(){window.parent.location.reload(true);}, 2000);
                    }      
                },
                error: function(xhr, textStatus, thrownError) {
                    //alert('Something went to wrong.Please Try again later...');
                }
            });
        }
    @endif
    @if($action == 'academicYearData')
        function saveAcademicYear(){
            $('#sucMsgDiv').hide('slow');
            $('#failMsgDiv').hide('slow');                  
            $('#failMsgDiv').addClass('text-none');
            $('#sucMsgDiv').addClass('text-none');
            // $('.frmbtngroup').prop('disabled',true);            
            $('#loddingImage').show();
            $.ajaxSetup({
                headers: {
                        'X-CSRF-Token': csrfTkn
                }
            });
            $.ajax({
                url:baseUrl+'/setting/saveAcademicYear',
                type: 'post',
                cache: false,                   
                data:{
                    "formdata": $('#entryFrm').serialize(),
                },
                success: function(res){     
                    $('.error-message').remove();
                    $('#loddingImage').hide();
                    var resp        =   res.split('****'); 
                    if(resp[1] == 'ERROR'){                                         
                        $('#failMsgDiv').removeClass('text-none');
                        $('.failmsgdiv').html(resp[2]);
                        $('#failMsgDiv').show('slow');
                    }else if(resp[1] == 'FAILURE'){
                        showJsonErrors(resp[2]);
                    }else if(resp[1] == 'SUCCESS'){
                        $('#sucMsgDiv').removeClass('text-none');
                        $('.sucmsgdiv').html(resp[2]);
                        $('#sucMsgDiv').show('slow');   
                         setTimeout(function(){window.parent.location.reload(true);}, 1000);
                    }      
                },
                error: function(xhr, textStatus, thrownError) {
                    //alert('Something went to wrong.Please Try again later...');
                }
            });
        }
    @endif
    @if($action == 'chapterNameData')
        function saveChapterName(){
            $('#sucMsgDiv').hide('slow');
            $('#failMsgDiv').hide('slow');                  
            $('#failMsgDiv').addClass('text-none');
            $('#sucMsgDiv').addClass('text-none');
            // $('.frmbtngroup').prop('disabled',true);            
            $('#loddingImage').show();
            $.ajaxSetup({
                headers: {
                        'X-CSRF-Token': csrfTkn
                }
            });
            $.ajax({
                url:baseUrl+'/setting/saveChapterName',
                type: 'post',
                cache: false,                   
                data:{
                    "formdata": $('#entryFrm').serialize(),
                },
                success: function(res){     
                    $('.error-message').remove();
                    $('#loddingImage').hide();
                    var resp        =   res.split('****'); 
                    if(resp[1] == 'ERROR'){                                         
                        $('#failMsgDiv').removeClass('text-none');
                        $('.failmsgdiv').html(resp[2]);
                        $('#failMsgDiv').show('slow');
                    }else if(resp[1] == 'FAILURE'){
                        showJsonErrors(resp[2]);
                    }else if(resp[1] == 'SUCCESS'){
                        $('#sucMsgDiv').removeClass('text-none');
                        $('.sucmsgdiv').html(resp[2]);
                        $('#sucMsgDiv').show('slow');   
                         setTimeout(function(){window.parent.location.reload(true);}, 1000);
                    }      
                },
                error: function(xhr, textStatus, thrownError) {
                    //alert('Something went to wrong.Please Try again later...');
                }
            });
        }
    @endif
    @if($action == 'subjectNameData')
        function saveSubjectName(){
            $('#sucMsgDiv').hide('slow');
            $('#failMsgDiv').hide('slow');                  
            $('#failMsgDiv').addClass('text-none');
            $('#sucMsgDiv').addClass('text-none');
            // $('.frmbtngroup').prop('disabled',true);            
            $('#loddingImage').show();
            $.ajaxSetup({
                headers: {
                        'X-CSRF-Token': csrfTkn
                }
            });
            $.ajax({
                url:baseUrl+'/setting/saveSubjectName',
                type: 'post',
                cache: false,                   
                data:{
                    "formdata": $('#entryFrm').serialize(),
                },
                success: function(res){     
                    $('.error-message').remove();
                    $('#loddingImage').hide();
                    var resp        =   res.split('****'); 
                    if(resp[1] == 'ERROR'){                                         
                        $('#failMsgDiv').removeClass('text-none');
                        $('.failmsgdiv').html(resp[2]);
                        $('#failMsgDiv').show('slow');
                    }else if(resp[1] == 'FAILURE'){
                        showJsonErrors(resp[2]);
                    }else if(resp[1] == 'SUCCESS'){
                        $('#sucMsgDiv').removeClass('text-none');
                        $('.sucmsgdiv').html(resp[2]);
                        $('#sucMsgDiv').show('slow');   
                         setTimeout(function(){window.parent.location.reload(true);}, 1000);
                    }      
                },
                error: function(xhr, textStatus, thrownError) {
                    //alert('Something went to wrong.Please Try again later...');
                }
            });
        }
    @endif
    @if($action == 'addClassData')
        function saveClassName(){
            $('#sucMsgDiv').hide('slow');
            $('#failMsgDiv').hide('slow');                  
            $('#failMsgDiv').addClass('text-none');
            $('#sucMsgDiv').addClass('text-none');
            // $('.frmbtngroup').prop('disabled',true);            
            $('#loddingImage').show();
            $.ajaxSetup({
                headers: {
                        'X-CSRF-Token': csrfTkn
                }
            });
            $.ajax({
                url:baseUrl+'/setting/saveClassName',
                type: 'post',
                cache: false,                   
                data:{
                    "formdata": $('#entryFrm').serialize(),
                },
                success: function(res){     
                    $('.error-message').remove();
                    $('#loddingImage').hide();
                    var resp        =   res.split('****'); 
                    if(resp[1] == 'ERROR'){                                         
                        $('#failMsgDiv').removeClass('text-none');
                        $('.failmsgdiv').html(resp[2]);
                        $('#failMsgDiv').show('slow');
                    }else if(resp[1] == 'FAILURE'){
                        showJsonErrors(resp[2]);
                    }else if(resp[1] == 'SUCCESS'){
                        $('#sucMsgDiv').removeClass('text-none');
                        $('.sucmsgdiv').html(resp[2]);
                        $('#sucMsgDiv').show('slow');   
                         setTimeout(function(){window.parent.location.reload(true);}, 1000);
                    }      
                },
                error: function(xhr, textStatus, thrownError) {
                    //alert('Something went to wrong.Please Try again later...');
                }
            });
        }
    @endif
    @if($action == 'addBoardData')
        function saveBoardName(){
            $('#sucMsgDiv').hide('slow');
            $('#failMsgDiv').hide('slow');                  
            $('#failMsgDiv').addClass('text-none');
            $('#sucMsgDiv').addClass('text-none');
            // $('.frmbtngroup').prop('disabled',true);            
            $('#loddingImage').show();
            $.ajaxSetup({
                headers: {
                        'X-CSRF-Token': csrfTkn
                }
            });
            $.ajax({
                url:baseUrl+'/setting/saveBoardName',
                type: 'post',
                cache: false,                   
                data:{
                    "formdata": $('#entryFrm').serialize(),
                },
                success: function(res){     
                    $('.error-message').remove();
                    $('#loddingImage').hide();
                    var resp        =   res.split('****'); 
                    if(resp[1] == 'ERROR'){                                         
                        $('#failMsgDiv').removeClass('text-none');
                        $('.failmsgdiv').html(resp[2]);
                        $('#failMsgDiv').show('slow');
                    }else if(resp[1] == 'FAILURE'){
                        showJsonErrors(resp[2]);
                    }else if(resp[1] == 'SUCCESS'){
                        $('#sucMsgDiv').removeClass('text-none');
                        $('.sucmsgdiv').html(resp[2]);
                        $('#sucMsgDiv').show('slow');   
                         setTimeout(function(){window.parent.location.reload(true);}, 1000);
                    }      
                },
                error: function(xhr, textStatus, thrownError) {
                    //alert('Something went to wrong.Please Try again later...');
                }
            });
        }
    @endif
    @if($action == 'addRoleMenu')
        function getMenuSubmenu(t_role_id){
            $('#loddingImage').show();
            $.ajaxSetup({
                headers: {
                        'X-CSRF-Token': csrfTkn
                }
            });
            $.ajax({
                url:baseUrl+'/master/role-wise-menu',
                type: 'get',
                cache: false,
                //dataType: 'json',
                data:{
                    't_role_id':t_role_id
                    //'role_id': $('#role_id').val()
                },
                success: function(res) {
                    $('#listingTable').html(res);
                    $('#loddingImage').hide();
                },
                error: function(xhr, textStatus, thrownError) {
                    $('#loddingImage').hide();
                    //alert('Something went to wrong.Please Try again later...');
                }
            });
        }
        function saveRoleMenuFrm(){
            $('#sucMsgDiv').hide('slow');
            $('#failMsgDiv').hide('slow');                  
            $('#failMsgDiv').addClass('text-none');
            $('#sucMsgDiv').addClass('text-none');
            // $('.frmbtngroup').prop('disabled',true);            
            $('#loddingImage').show();
            $.ajaxSetup({
                headers: {
                        'X-CSRF-Token': csrfTkn
                }
            });
            $.ajax({
                url:baseUrl+'/master/saveRoleMenu',
                type: 'post',
                cache: false,                   
                data:{
                    "formdata": $('#entryFrm').serialize(),
                },
                success: function(res){     
                    $('.error-message').remove();
                    $('#loddingImage').hide();
                    var resp        =   res.split('****'); 
                    if(resp[1] == 'ERROR'){                                         
                        $('#failMsgDiv').removeClass('text-none');
                        $('.failmsgdiv').html(resp[2]);
                        $('#failMsgDiv').show('slow');
                    }else if(resp[1] == 'FAILURE'){
                        showJsonErrors(resp[2]);
                    }else if(resp[1] == 'SUCCESS'){
                        $('#sucMsgDiv').removeClass('text-none');
                        $('.sucmsgdiv').html(resp[2]);
                        $('#sucMsgDiv').show('slow');   
                        setTimeout(function(){ $('#sucMsgDiv').fadeOut('slow'); }, 5000);
                        window.location.replace(baseUrl+"/master/add_role_menu"); 
                    }      
                },
                error: function(xhr, textStatus, thrownError) {
                    //alert('Something went to wrong.Please Try again later...');
                }
            });
        }
    @endif
    
    @if($action == 'changepassword')
        function saveUpdatePwd(){
            $('#sucMsgDiv').hide('slow');
            $('#failMsgDiv').hide('slow');                  
            $('#failMsgDiv').addClass('text-none');
            $('#sucMsgDiv').addClass('text-none');
            // $('.frmbtngroup').prop('disabled',true);            
            $('#loddingImage').show();
            $.ajaxSetup({
                headers: {
                        'X-CSRF-Token': csrfTkn
                }
            });
            $.ajax({
                url:baseUrl+'/user/updatePassword',
                type: 'post',
                cache: false,                   
                data:{
                    "formdata": $('#entryFrm').serialize(),
                },
                success: function(res){     
                    $('.error-message').remove();
                    $('#loddingImage').hide();
                    var resp        =   res.split('****'); 
                    if(resp[1] == 'ERROR'){                                         
                        $('#failMsgDiv').removeClass('text-none');
                        $('.failmsgdiv').html(resp[2]);
                        $('#failMsgDiv').show('slow');
                    }else if(resp[1] == 'FAILURE'){
                        showJsonErrors(resp[2]);
                    }else if(resp[1] == 'SUCCESS'){
                        $('#sucMsgDiv').removeClass('text-none');
                        $('.sucmsgdiv').html(resp[2]);
                        $('#sucMsgDiv').show('slow');   
                        setTimeout(function(){ $('#sucMsgDiv').fadeOut('slow'); }, 8000);
                        window.location.replace(baseUrl+"/user/changepassword"); 
                    }      
                },
                error: function(xhr, textStatus, thrownError) {
                    //alert('Something went to wrong.Please Try again later...');
                }
            });
        }
    @endif
    
    @if($action == 'addTopicwiseQuestionDetailsData')
        function validateTopicWiseQuestionDetailsData(){
            var desc = CKEDITOR.instances.question_details.getData();
            $('#desc').val(desc);
			$('.registerBtn').prop('disabled',true);
			$('.imgLoader').show();
			$('.error-message').remove();
			$.ajaxSetup({
				headers: {
					'X-CSRF-Token': csrfTkn
				}
			});
			$.ajax({
				url:baseUrl+'/setting/validateTopicWiseQuestionDetailsData',
				type: 'post',
				cache: false,
				data:{
					"formData": $('#entryFrm').serialize(),
				},
				success: function(res){
					$('.imgLoader').hide();
					var resp	=   res.split('****');
					if(resp[1] == 'ERROR'){
						$('.registerBtn').prop('disabled',false);
					}else{
						if(resp[1] == 'FAILURE'){
							$('.btn btn-success').prop('disabled',false);
						   showJsonErrors(resp[2]);
						}else if(resp[1] == 'SUCCESS'){
							submitRegForm();
						}
					}
				},
				error: function(xhr, textStatus, thrownError) {
					alert('Something went to wrong.Please Try again later...');
				}
			});
		}
        function submitRegForm(){
            document.forms['entryFrm'].submit();
        } 
    @endif
    @if($action == 'addNoticeDetailsData')
        function validateNoticeDetailsData(){
            var desc = CKEDITOR.instances.notice_details.getData();
            $('#desc').val(desc);
			$('.registerBtn').prop('disabled',true);
			$('.imgLoader').show();
			$('.error-message').remove();
			$.ajaxSetup({
				headers: {
					'X-CSRF-Token': csrfTkn
				}
			});
			$.ajax({
				url:baseUrl+'/setting/validateNoticeDetailsData',
				type: 'post',
				cache: false,
				data:{
					"formData": $('#entryFrm').serialize(),
				},
				success: function(res){
					$('.imgLoader').hide();
					var resp	=   res.split('****');
					if(resp[1] == 'ERROR'){
						$('.registerBtn').prop('disabled',false);
					}else{
						if(resp[1] == 'FAILURE'){
							$('.btn btn-success').prop('disabled',false);
						   showJsonErrors(resp[2]);
						}else if(resp[1] == 'SUCCESS'){
							submitRegForm();
						}
					}
				},
				error: function(xhr, textStatus, thrownError) {
					alert('Something went to wrong.Please Try again later...');
				}
			});
		}
        function submitRegForm(){
            document.forms['entryFrm'].submit();
        } 
    @endif   

    function showData1(){
        @if($action == 'addRole')
            listingUrl                              =	baseUrl+'/master/roleListing';
            listingUrl								+=	'?role_name='+$('#role_name_listing').val();
        @endif
        if(listingUrl != ''){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-Token': csrfTkn
                }
            });
            $('#loddingImage').show();
            $.ajax({
                url:listingUrl,
                type: 'get',
                cache: false,			
                success: function(res) { 
                    $('#loddingImage').hide();
                    $('#listingTable').html(res);
                },
                error: function(xhr, textStatus, thrownError) {
                    $('#loddingImage').hide();
                }
            });
        }
    }
    function getClassNamelist(){
        var selectedVal = $('#t_board_details_id').val();
        $.ajaxSetup({
            headers: {
                    'X-CSRF-Token': csrfTkn
                }
            });
        $.ajax({
            url:baseUrl+'/home/classnamelist',
            type: 'post',
            cache: false,                   
            data:{
                "selectedVal": selectedVal,
            },
            //dataType: 'html',
            success: function(res){     
                $('.error-message').remove();
                $('#loddingImage').hide();
                var resp   =   res;
                var options = '';
                   for(var x = 0; x < resp.length; x++) {
                       options += '<option value="' + resp[x]['id'] + '">' + resp[x]['name'] +'</option>';
                   }
                    $("#t_class_details_id").html(options);
                },
            error: function(xhr, textStatus, thrownError) {
                alert('Something went to wrong.Please Try again later...');
            }
        });
	}
    function getClassNameListByBoardId(){
        var selectedVal = $('#t_board_details_id').val();
        $.ajaxSetup({
            headers: {
                    'X-CSRF-Token': csrfTkn
                }
            });
        $.ajax({
            url:baseUrl+'/setting/classnamelistsbyboardid',
            type: 'post',
            cache: false,                   
            data:{
                "selectedVal": selectedVal,
            },
            //dataType: 'html',
            success: function(res){     
                $('.error-message').remove();
                $('#loddingImage').hide();
                var resp   =   res;
                var options = '';
                   for(var x = 0; x < resp.length; x++) {
                       options += '<option value="' + resp[x]['id'] + '">' + resp[x]['name'] +'</option>';
                   }
                    $("#t_class_details_id").html(options);
                    @if(isset($viewDataObj->t_class_details_id) && (int)$viewDataObj->t_class_details_id != 0)
                        $('#t_class_details_id').val("{{ $viewDataObj->t_class_details_id }}");
                    @endif
                },
            error: function(xhr, textStatus, thrownError) {
                alert('Something went to wrong.Please Try again later...');
            }
        });
	}
    function getSubjectNameList(selectedVal){
        $("#t_topic_details_id").html('');
        $.ajaxSetup({
            headers: {
                    'X-CSRF-Token': csrfTkn
                }
            });
        $.ajax({
            url:baseUrl+'/setting/subjectnamelist',
            type: 'post',
            cache: false,                   
            data:{
                "selectedVal": selectedVal,
            },
            //dataType: 'html',
            success: function(res){     
                $('.error-message').remove();
                $('#loddingImage').hide();
                var resp   =   res;
                var options = '';
                   for(var x = 0; x < resp.length; x++) {
                       options += '<option value="' + resp[x]['id'] + '">' + resp[x]['name'] +'</option>';
                   }
                    $("#t_subject_details_id").html(options);
                    @if(isset($viewDataObj->t_subject_details_id) && (int)$viewDataObj->t_subject_details_id != 0)
                        $('#t_subject_details_id').val("{{ $viewDataObj->t_subject_details_id }}");
                    @endif
                },
            error: function(xhr, textStatus, thrownError) {
                alert('Something went to wrong.Please Try again later...');
            }
        });
	} 
    function getTopicNameList(selectedVal){
        $.ajaxSetup({
            headers: {
                    'X-CSRF-Token': csrfTkn
                }
            });
        $.ajax({
            url:baseUrl+'/setting/topicnamelist',
            type: 'post',
            cache: false,                   
            data:{
                "selectedVal": selectedVal,
            },
            //dataType: 'html',
            success: function(res){     
                $('.error-message').remove();
                $('#loddingImage').hide();
                var resp   =   res;
                var options = '';
                   for(var x = 0; x < resp.length; x++) {
                       options += '<option value="' + resp[x]['id'] + '">' + resp[x]['name'] +'</option>';
                   }
                    $("#t_topic_details_id").html(options);
                    @if(isset($viewDataObj->t_topic_details_id) && (int)$viewDataObj->t_topic_details_id != 0)
                        $('#t_topic_details_id').val("{{ $viewDataObj->t_topic_details_id }}");
                    @endif
                },
            error: function(xhr, textStatus, thrownError) {
                alert('Something went to wrong.Please Try again later...');
            }
        });
	} 
    @if($action == 'changepassword')
        function saveUpdatePwd(){
            $('#sucMsgDiv').hide('slow');
            $('#failMsgDiv').hide('slow');                  
            $('#failMsgDiv').addClass('text-none');
            $('#sucMsgDiv').addClass('text-none');
            $.ajaxSetup({
                headers: {
                        'X-CSRF-Token': csrfTkn
                }
            });
            $.ajax({
                url:baseUrl+'/home/updatePassword',
                type: 'post',
                cache: false,                   
                data:{
                    "formdata": $('#entryFrm').serialize(),
                },
                success: function(res){     
                    $('.error-message').remove();
                    var resp        =   res.split('****'); 
                    if(resp[1] == 'ERROR'){                                         
                        $('#failMsgDiv').removeClass('text-none');
                        $('.failmsgdiv').html(resp[2]);
                        $('#failMsgDiv').show('slow');
                    }else if(resp[1] == 'FAILURE'){
                        showJsonErrors(resp[2]);
                    }else if(resp[1] == 'SUCCESS'){
                        $('#sucMsgDiv').removeClass('text-none');
                        $('.sucmsgdiv').html(resp[2]);
                        $('#sucMsgDiv').show('slow');   
                        setTimeout(function(){ $('#sucMsgDiv').fadeOut('slow'); }, 18000);
                        window.location.replace(baseUrl+"/home/changepassword"); 
                    }      
                },
                error: function(xhr, textStatus, thrownError) {
                    //alert('Something went to wrong.Please Try again later...');
                }
            });
        }
    @endif
    @if(isset($id) && $id != ''){
        @if($action == 'addTopicDetailsData' || $action == 'addTopicwiseQuestionDetailsData')
            var id = "{{$viewDataObj->t_class_details_id }}";
            getSubjectNameList(id);
        @endif
        @if($action == 'addTopicwiseQuestionDetailsData')
            var id = "{{$viewDataObj->t_subject_details_id }}";
            getTopicNameList(id);
        @endif
        @if($action == 'addNoticeDetailsData')
            var id = "{{$viewDataObj->t_board_details_id }}";
            getClassNameListByBoardId(id);
        @endif
    }
    @endif  
    function printDiv(contElement){			
        var data	=	$('.'+contElement).html();
        var mywindow = window.open('', 'my div', 'height=400,width=800');
        mywindow.document.write('<html><head><title>my div</title>');
        mywindow.document.write('</head><body >');
        mywindow.document.write(data);
        mywindow.document.write('</body></html>');
        mywindow.print();
        mywindow.close();
        return true;
    }
    @if(isset($layoutArr['viewDataObj']) && is_object($layoutArr['viewDataObj']))
        @foreach($layoutArr['viewDataObj'] as $modelKey=>$modelVal)
            var elementId		=	"{{ $modelKey }} ";// alert(elementId);
            var elementVal		=	"{{ $modelVal }}";// alert(elementVal);
            if($('#'+elementId).length > 0){
                if(elementId != 'address'){
                    $('#'+elementId).val(elementVal);
                }
            }
        @endforeach
    @endif
</script>