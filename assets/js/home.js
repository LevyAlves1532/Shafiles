$(function() {
    let files;
    let filesTop ;
    let filesSize = 0;

    initialize();

    $('#form-upload').on('submit', function(e) {
        e.preventDefault();

        let formData = new FormData(this);

        $.ajax({
            url: url+'/ajax/uploadFiles',
            type: 'POST',
            data: formData,
            dataType: 'json',
            contentType: false,
            processData: false,
            success: function(json) {
                if(json.status) {
                    Alert('success', 'Arquivos enviados com sucesso!');

                    setTimeout(() => {
                        window.location.href = url+'/files?code='+json.return;
                    }, 2000)
                } else {
                    Alert('danger', json.return);
                }
            }
        })
    })

    $('#close-alert').on('click', function(e) {
        $('#alert').removeClass('active');
    })

    $('#files').on('change', function(e) {
        e.preventDefault();
        $(this).removeClass('active');

        files = e.target.files;

        let type = ['image/jpeg', 'image/jpg', 'image/png', 'application/zip', 'video/mp4'];

        filesTop = [];

        for(let x = 0;x<files.length;x++) {
            if(type.includes(files[x].type)) {
                filesTop.push(files[x]);

                filesTop.forEach(element => {
                    filesSize = filesSize + element.size;
                })

                filesSize = Math.ceil((filesSize / 1024) / 977);                
            } else {
                Alert('danger', 'Um/Todos os arquivos não são compativeis');
                return;
            }
        }

        if(filesSize <= 100) {
            $('#files')[0].files = files;
            renderFiles(filesTop);
        } else {
            Alert('danger', 'Envio dos arquivos ultrapassam o limite de 100Mb');
        }
    })

    $('#drop-area').on('dragover', function(e) {
        e.preventDefault();
        $(this).addClass('active');
    });

    $('#drop-area').on('dragleave', function(e) {
        $(this).removeClass('active');
    });

    $('#drop-area').on('drop', function(e) {
        e.preventDefault();
        $(this).removeClass('active');

        files = e.originalEvent.dataTransfer.files;

        let type = ['image/jpeg', 'image/jpg', 'image/png', 'application/zip', 'video/mp4'];

        filesTop = [];

        for(let x = 0;x<files.length;x++) {
            if(type.includes(files[x].type)) {
                filesTop.push(files[x]);

                filesTop.forEach(element => {
                    filesSize = filesSize + element.size;
                })

                filesSize = Math.ceil((filesSize / 1024) / 977);                
            } else {
                Alert('danger', 'Um/Todos os arquivos não são compativeis');
                return;
            }
        }

        if(filesSize <= 100) {
            $('#files')[0].files = files;
            renderFiles(filesTop);
        } else {
            Alert('danger', 'Envio dos arquivos ultrapassam o limite de 100Mb');
        }
    });

    $('#search-code').on('click', function() {
        let val = $('#input-code').val();

        $.ajax({
            url: url+`/ajax/getCode?code=${btoa(val)}`,
            type: 'GET',
            dataType: 'json',
            success: (json) => {
                if(json.status) {
                    window.location.href = url+'/files/view/'+val;
                } else {
                    Alert('danger', json.return)
                }
            }
        });
    })
})

function initialize() {
    $.ajax({
        url: url+'/ajax/delFilesDefault',
        type: 'GET',
        dataType: 'json'
    });
}

function Alert(type, message) {
    switch(type) {
        case 'success':
            $('#alert').css('border-bottom', `4px solid #18E100`);
            $('#title-alert').css('color', '#18E100');
            $('#title-alert').text('Sucesso');
            $('#close-alert').css('background-color', '#18E100');
            $('#message-alert').text(message);
        break;
        case 'warning':
            $('#alert').css('border-bottom', `4px solid #F99700`);
            $('#title-alert').css('color', '#F99700');
            $('#title-alert').text('aviso');
            $('#close-alert').css('background-color', '#F99700');
            $('#message-alert').text(message);
        break;
        case 'danger':
            $('#alert').css('border-bottom', `4px solid #E10000`);
            $('#title-alert').css('color', '#E10000');
            $('#title-alert').text('erro');
            $('#close-alert').css('background-color', '#E10000');
            $('#message-alert').text(message);
        break;
    }

    $('#alert').addClass('active');

    setTimeout(() => {
        $('#alert').removeClass('active');
    }, 5000)
}

function renderFiles(files) {
    if(files.length > 0) {
        let html = $('#list-files').html();

        files.forEach(element => {
            html += `
                <div class="card-file">
                    <div class="left">
                        <i class="fas fa-file-upload"></i>

                        <p class="title">${element.name.split('.')[0].length > 10 ? element.name.split('.')[0].slice(0, 10)+'...' : element.name.split('.')[0]}</p>
                    </div>

                    <div class="middle">
                        <p class="text">${Math.ceil((element.size / 1024) / 977)} Mb</p>
                    </div>

                    <div class="right">

                    </div>
                </div>
            `;
        })

        $('#list-files').html(html);

        $('#drop-area').css('display', 'none');
        $('#send-form').css('display', 'block');
        $('#list-files').css('display', 'block');
    }
}