const uploadForm = $('#upload_file'),
    theFile = $('#the_file'),
    progressBarFill = $('#progress_bar').find('.progress-bar-fill'),
    progressBarText = progressBarFill.find('.progress-bar-text'),
    uploadFile = (event) => {
        event.preventDefault()

         $.ajax({
            type: 'POST',
            url: '/post-upload-file',
            data: new FormData($('#upload_file')[0]),
            cache: false,
            processData: false,
            contentType: false,
            xhr: function(){
                let xhr = $.ajaxSettings.xhr() ;
                xhr.upload.onprogress = function(evt){
                    let percent = ((evt.loaded/evt.total) * 100);

                    percent = String(percent).split('.')[0] + '%';

                    progressBarFill.css('width', percent);
                    progressBarText.text(percent)
                } ;
                xhr.upload.onload = function(){ console.log('DONE!') } ;
                return xhr ;
            }
        }).done(() => {
            alert('por fin');
        })
    };


uploadForm.submit(function(e){ uploadFile(e); })
