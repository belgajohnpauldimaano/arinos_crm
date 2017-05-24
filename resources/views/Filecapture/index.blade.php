@extends('layouts.main')

@section('content')

<div id="masthead" class="site-header">
    <h1>ファイル取込画面</h1>
</div> <!-- .site-header -->
<div class="site-main" role="main">
    <div class="file-capture">

        <img src="/images/ajax-loader.gif" id="ajax-loader" style="position: absolute; top: 30%; left: 45%;display: none;" />

        <div class="field-row">
            <label>
                <form role="form" action="/call_list" method="post" enctype="multipart/form-data" accept-charset="UTF-8" id="form1">
                {{ csrf_field() }}            
                <span class="title">架電リストファイル</span>
                <input type="file" value="" name="call_list_file"  id="call_list_file" />
                <span class="text">&nbsp;</span>
                <button class="btn-blue btn" id="btn-call-list" >取込</button>
                </form>
                
            </label>
        </div>

        <div class="field-row">
            <label>
                <form role="form" action="/dm_acquisition_list " method="post" enctype="multipart/form-data" accept-charset="UTF-8" id="form2">
                {{ csrf_field() }}
                <span class="title">DM取得リストファイル</span>
                <input type="file" value="" name="dm_acquisition_list_file" id="dm_acquisition_list_file" />
                <span class="text">&nbsp;</span>
                <!--<button class="btn-blue btn" id="btn-dm-acquisition-list" >取込</button>-->
                <button class="btn-blue btn" id="btn-dm-acquisition-list" type="submit">取込</button>
                <p>
                    <label><input type="radio" name="acquisition_format" class="acquisition_format" value="1" id="acquisition_format_1" > URIZO</label>
                    <label><input type="radio" name="acquisition_format" class="acquisition_format" value="2"> リスタ</label>
                    <label><input type="radio" name="acquisition_format" class="acquisition_format" value="3"> リストル</label>
                    <label><input type="radio" name="acquisition_format" class="acquisition_format" value="4"> その他</label>
                </p>
                </form>
            </label>
        </div>

        <div class="field-row">
            <label>
               
                <form id="frm_get_ng_list" role="form">
                {{ csrf_field() }}
                <span class="title">アプローチ完全NGリストファイル</span>
                <input type="file" value="" id="get_ng_list" name="get_ng_list"/>
                <span class="text">&nbsp;</span>
                <button class="btn-blue btn" type="submit" id="ngListCapture">取込</button>&nbsp;&nbsp;
                <button class="btn-blue btn" id="ngListExecute">実行</button>
                </form>
            </label>
        </div>

        <div class="field-row">
            <form action="" id="frm_get_dm_list">
                {{ csrf_field() }}
                <label>
                    <span class="title">DM送付完了リストファイル</span>
                    <input type="file" value="" id="get_dm_list" name="get_dm_list" />
                    <span class="text">&nbsp;</span>
                    <button class="btn-blue btn" id="btn_get_dm_list">取込</button>
                </label>
            </form>
        </div>

        <div class="field-row">
            <div class="error" style="display: none;">
                エラー： 
                <span class="error_message">
                    エラー内容
                </span>
            </div>
            <div class="button">
                <a href="{{ route('main') }}" class="btn-blue">戻る</a>
            </div>
        </div>
    </div>
</div> <!-- .site-main -->
@endsection

@section('scripts')

<script>
$(document).ready(function() {

$('.field-row label input[type="file"]').on('change', function() {
    var filename = $(this).val();
    if (filename.substring(3,11) == 'fakepath') {
        filename = filename.substring(12);
        $(this).next('.text').text(filename);
    }
});

// Disable all buttons on page load
$('.btn').prop("disabled", true);


//--- CALL LIST ---

$('#call_list_file').change(function() {
    $('#btn-call-list').prop("disabled", false);
    $('.error').hide();
    $('.error_message').text("");
});

$('#btn-call-list').click(function(e) {

    e.preventDefault();

    var file_data = $('#call_list_file').prop('files')[0];   
    
    var form_data = new FormData();                  
    
    form_data.append('call_list_file', file_data);
    form_data.append('_token', "{{ csrf_token() }}");

    $.ajax({
        url: "call_list",
        dataType: 'text',
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,                         
        type: 'post',
        beforeSend: function()
        { 
            $('#ajax-loader').show();
        },
        success: function(data)
        {
            if (data != "ok") {
                $('.error').show();
                $('.error_message').text(data);
            }
        },
        complete: function()
        {
            $('.btn').prop("disabled", true);
            $('#ajax-loader').hide();
        }
     });

});



//--- DM ACQUISITION LIST ---

$('#dm_acquisition_list_file').change(function() {
    $('#btn-dm-acquisition-list').prop("disabled", false);
    $( "#acquisition_format_1" ).prop( "checked", true );
    $('.error').hide();
    $('.error_message').text("");
});

$('#btn-dm-acquisition-list').click(function(e) {

    e.preventDefault();

    var file_data = $('#dm_acquisition_list_file').prop('files')[0];   
    var acquisition_format = $('.acquisition_format').val();

    var form_data = new FormData();                  
    
    form_data.append('acquisition_format', acquisition_format);
    form_data.append('dm_acquisition_list_file', file_data);
    form_data.append('_token', "{{ csrf_token() }}");

    $.ajax({
        url: "dm_acquisition_list",
        dataType : 'json',
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,                         
        type: 'post',
        beforeSend: function()
        { 
            $('#ajax-loader').show();
        },
        success: function(data)
        {   
            if (data.error == "none") {
                //ok
            } else if (data.error == "duplicate") {
                window.location = data.duplicate_csv_link
            } else if (data.error == "format") {
                $('.error').show();
                $('.error_message').text(data.msg);
            }
        },
        complete:function()
        {
            $('.btn').prop("disabled", true);
            $('#ajax-loader').hide();
            $( ".acquisition_format" ).prop( "checked", false );
        }
     });

});



//--- NG LIST ---

$('#get_ng_list').change(function() {
    $('#ngListCapture').prop("disabled", false);
    $('.error').hide();
    $('.error_message').text("");
});

$('#frm_get_ng_list').submit(function (e) {
    
    e.preventDefault();

    var formData = new FormData($(this)[0]);
        $.ajax({
        url : "{{ route('ng_list') }}",
        type : 'POST',
        dataType: 'json',
        data : formData,
        contentType : false,
        processData : false,
        beforeSend: function()
        { 
            $('#ajax-loader').show();
        },
        success: function(data)
        {
            if(data.errMsg1){
                
                $(".error_message").html(JSON.stringify(data.errMsg1));
                $('#ngListExecute').prop("disabled", true);
                $('#ngListCapture').prop("disabled", false);
                $('.error').show();
            }
            
            if(data.errMsg){
                $(".error_message").html(data.errMsg);
                $('.error').show();
                $('#ngListExecute').prop("disabled", true);
                $('#ngListCapture').prop("disabled", false);
            }
        },
        complete:function(data)
        {
        
            $('#ngListExecute').prop("disabled", false);
            $('#ngListCapture').prop("disabled", true);
            $('#ajax-loader').hide();

        }
    });
    
});



//--- DM SENDING COMPLETION LIST ---

$('#get_dm_list').change(function() {
    $('#btn_get_dm_list').prop("disabled", false);
    $('.error').hide();
    $('.error_message').text("");
});

$('#frm_get_dm_list').submit(function (e) {
    e.preventDefault();

    var formData = new FormData($(this)[0]);

    $.ajax({
        url : "{{ route('dm_completion_list') }}",
        type : 'POST',
        data : formData,
        dataType : 'json',
        beforeSend: function()
        { 
            $('#ajax-loader').show();
        },
        contentType : false,
        processData : false,
        success : function (data) {
            console.log(data);
            if(data.errCode == 0) {
                // no error
                if(data.duplicate_data.has_exist_in_table) {
                    window.location = duplicate_csv_link;
                }
                if (data.unregistered_data.has_unregistered_data) {
                    window.location = data.unregistered_data.unregistered_csv_link
                }
            } else {
                $('.error').show();
                $('.error_message').text(data.errMsg);
            } 

            $('#ajax-loader').hide();
        }
    });
});




});

</script>
@endsection