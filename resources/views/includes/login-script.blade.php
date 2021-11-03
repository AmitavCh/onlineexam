<script>
    var controller = '{{ $controller }}';
    var action = '{{ $action }}';
    var csrfTkn = '{{ csrf_token() }}';
    var baseUrl = '{{ URL::to(' / ') }}';
    var onChangeFunction = '';
    var listingUrl = '';

    function showJsonErrors(errors) {
        if (errors != '') {
            resp = $.parseJSON(errors);
            var totErrorLen = resp.length;
            for (var errCnt = 0; errCnt < totErrorLen; errCnt++) {
                var modelField = resp[errCnt]['modelField'];
                var modelErrorMsg = resp[errCnt]['modelErrorMsg'];
                $('[id="' + modelField + '"]').after('<div class="error-message">' + modelErrorMsg + '</div>');
            }
        }
    }
    function resetFormVal(frmId, hidVal){

    if (hidVal == 1){

    $('#' + frmId).find('input:hidden').val('');
    } else{

    $('#id').val('');
    }

    $('#' + frmId).find('input:radio, input:checkbox').removeAttr('checked').removeAttr('selected');
            $('.' + frmId).find('input:radio, input:checkbox').removeAttr('checked').removeAttr('selected');
            $('#' + frmId).find('input:password,input:text, input:file, select, textarea').val('');
            $('.' + frmId).find('input:password,input:text, input:file, select, textarea').val('');
            $('.error-message').remove();
            //resetting file upload content	

    }
    @if ($action == 'lostPassword')
            function validateLostpswdMail(){
            $('.error-message').remove();
                    $('#loddingImage').show();
                    $('.frmbtngroup').prop('disabled', true);
                    $('.form-control').prop('readonly', true);
                    $.ajaxSetup({
                    headers: {
                    'X-CSRF-Token': csrfTkn
                    }
                    });
                    $.ajax({
                    url:baseUrl + '/user/validatelostpswdmail',
                            type: 'post',
                            cache: false,
                            data:{
                            "formdata": $('#form-lostpswd').serialize(),
                            },
                            success: function(res){
                            var resp = res.split('****');
                                    $('#loddingImage').hide();
                                    $('.form-control').prop('readonly', false);
                                    $('.frmbtngroup').prop('disabled', false);
                                    if (resp[1] == 'ERROR'){
                            $('#failMsgDiv').removeClass('text-none');
                                    $('.failmsgdiv').html(resp[2]);
                                    $('#failMsgDiv').show('slow');
                                    setTimeout(function(){ $('#failMsgDiv').fadeOut('slow'); }, 5000);
                            } else if (resp[1] == 'FAILURE'){
                            showJsonErrors(resp[2]);
                            } else if (resp[1] == 'SUCCESS'){
                            resetFormVal('form-lostpswd', 0);
                                    $('#sucMsgDiv').removeClass('text-none');
                                    $('.sucmsgdiv').html(resp[2]);
                                    $('#sucMsgDiv').show('slow');
                                    setTimeout(function(){ $('#sucMsgDiv').fadeOut('slow'); }, 5000);
                                    //window.location.replace(baseUrl+"/usersetting/userlist"); 
                            }
                            },
                            error: function(xhr, textStatus, thrownError) {
                            $('#loddingImage').hide();
                                    $('.form-control').prop('readonly', false);
                                    $('.frmbtngroup').prop('disabled', false);
                                    $('.failmsgdiv').html('Something went to wrong.Please Try again later...');
                                    $('#failMsgDiv').show('slow');
                                    setTimeout(function(){ $('#failMsgDiv').fadeOut('slow'); }, 5000);
                            }
                    });
            }
    function changeUrl(){
    window.location.replace(baseUrl + "/usersetting/userlist");
    }
    @endif
            @if ($action == 'resetPassword')
            function resetPassword(){
            $('.frmbtngroup').prop('disabled', true);
                    $('.registerBtn').prop('disabled', true);
                    $('.regBtnTxt').html('Please wait...');
                    $('.imgLoader').show();
                    $.ajaxSetup({
                    headers: {
                    'X-CSRF-Token': csrfTkn
                    }
                    });
                    $.ajax({
                    url:baseUrl + '/user/resetnewpassword',
                            type: 'post',
                            cache: false,
                            data:{
                            "formdata": $('#form-resetpswd').serialize(),
                            },
                            success: function(res){
                            $('.error-message').remove();
                                    $('.registerBtn').prop('disabled', false);
                                    $('.imgLoader').hide();
                                    $('.regBtnTxt').html('SUBMIT');
                                    var resp = res.split('****');
                                    if (resp[1] == 'SUCCESS'){
                            resetFormVal('form-resetpswd', 0);
                                    $('.sucmsgdiv').html(resp[2]);
                                    $('#sucMsgDiv').show('slow');
                                    setTimeout(function(){ $('#sucMsgDiv').fadeOut('slow'); }, 3000);
                                    setTimeout(function(){ window.location.replace(baseUrl + "/"); }, 5000);
                            } else if (resp[1] == 'FAILURE'){
                            showJsonErrors(resp[2]);
                            } else if (resp[1] == 'ERROR'){
                            alert(resp[2]);
                            }
                            },
                            error: function(xhr, textStatus, thrownError) {
                            alert('Something went to wrong.Please Try again later...');
                            }
                    });
            }
    @endif

            @if ($action == 'changePassword')

            function changePassword(){

            $('.frmbtngroup').prop('disabled', true);
                    showBlockUI();
                    $('.error-message').remove();
                    $('#sucMsgDiv').hide('slow');
                    $('#failMsgDiv').hide('slow');
                    $.ajaxSetup({

                    headers: {

                    'X-CSRF-Token': csrfTkn

                    }

                    });
                    $.ajax({

                    url:baseUrl + '/user/changenewpassword',
                            type: 'post',
                            cache: false,
                            data:{

                            "formdata": $('#entryFrm').serialize(),
                            },
                            success: function(res){

                            $('.frmbtngroup').prop('disabled', false);
                                    $.unblockUI();
                                    var resp = res.split('****');
                                    if (resp[1] == 'SUCCESS'){

                            resetFormVal('entryFrm', 0);
                                    $('.sucmsgdiv').html(resp[2]);
                                    $('#sucMsgDiv').show('slow');
                                    setTimeout(function(){ $('#sucMsgDiv').fadeOut('slow'); }, 5000);
                                    showData(1);
                            } else if (resp[1] == 'FAILURE'){

                            showJsonErrors(resp[2]);
                            } else if (resp[1] == 'ERROR'){

                            $('.failmsgdiv').html(resp[2]);
                                    $('#failMsgDiv').show('slow');
                            }

                            },
                            error: function(xhr, textStatus, thrownError) {

                            $.unblockUI();
                                    $('.frmbtngroup').prop('disabled', false);
                                    $('.failmsgdiv').html('Something went to wrong.Please Try again later...');
                                    $('#failMsgDiv').show('slow');
                            }

                    });
            }

    @endif



            @if ($action == 'userRegister')

            function saveCreateUser(){

            $('.frmbtngroup').prop('disabled', true);
                    $('.registerBtn').prop('disabled', true);
                    $('.regBtnTxt').html('Please wait...');
                    $('.imgLoader').show();
                    $.ajaxSetup({
                    headers: {
                    'X-CSRF-Token': csrfTkn
                    }
                    });
                    $.ajax({
                    url:baseUrl + '/user/savecreateuser',
                            type: 'post',
                            cache: false,
                            data:{
                            "formdata": $('#form-signup').serialize(),
                            },
                            success: function(res){
                            $('.error-message').remove();
                                    $('.registerBtn').prop('disabled', false);
                                    $('.imgLoader').hide();
                                    $('.regBtnTxt').html('SUBMIT');
                                    var resp = res.split('****');
                                    if (resp[1] == 'SUCCESS'){
                            resetFormVal('form-signup', 0);
                                    $('.sucmsgdiv').html(resp[2]);
                                    $('#sucMsgDiv').show('slow');
                                    setTimeout(function(){ $('#sucMsgDiv').fadeOut('slow'); }, 3000);
                                    setTimeout(function(){ window.location.replace(baseUrl + "/"); }, 5000);
                            } else if (resp[1] == 'FAILURE'){
                            showJsonErrors(resp[2]);
                            } else if (resp[1] == 'ERROR'){
                            alert(resp[2]);
                            }
                            },
                            error: function(xhr, textStatus, thrownError) {
                            alert('Something went to wrong.Please Try again later...');
                            }
                    });
            }
    @endif
</script>