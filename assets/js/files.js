const BASE = 'http://localhost/projetos/shafiles';

$(function() {
  getFiles();

  $('#copy').on('click', function() {
    let input = $('#code')[0];
    let inputVal = $('#code').val();

    if(!navigator.clipboard) {
      input.focus();
      input.setSelectionRange(0, 99999);
      document.execCommand('copy');
      input.blur();
    } else {
      navigator.clipboard.writeText(inputVal).then(
        function() {
          Alert('success', 'Código copiado com sucesso!');
        }
      ).catch(
        function() {
          Alert('danger', 'Erro ao tentar copiar o código!')
        }
      )
    }
  })

  $('#close-alert').on('click', function(e) {
    $('#alert').removeClass('active');
  })
})

function time(expires) {
  let timeText = '';
  let minutesText = '';
  let secondsText = '';

  let expDate = new Date(expires);
  let cDate = new Date();

  let minutes = 0;
  let seconds = 0;

  let minutesExp = expDate.getMinutes();
  let minutesC = cDate.getMinutes();

  let secondsBase = 59;
  let secondsC = cDate.getSeconds();

  if(minutesExp < minutesC) {
    minutes = (minutesExp + 60) - minutesC;
  } else {
    minutes = minutesExp - minutesC;
  }

  seconds = secondsBase - secondsC;

  const interval = setInterval(() => {
    minutesText = `${minutes < 10 ? '0'+minutes : minutes}`;
    secondsText = `${seconds < 10 ? '0'+seconds : seconds}`;
    timeText = `${minutesText}:${secondsText}`;

    $('#time').text(timeText);

    seconds--;

    if(seconds === -1) {
      minutes--;
      seconds = 59;
    }

    if(minutes === 0 && seconds === 0) {
      getFiles();

      clearInterval(interval);
    }
  }, 1000)
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

function getFiles() {
  let code = $('#code-text').text();

  $.ajax({
    url: 'ajax/delFilesDefault',
    type: 'GET',
    dataType: 'json'
  });

  $.ajax({
    url: `ajax/getCode?code=${btoa(code)}`,
    type: 'GET',
    dataType: 'json',
    success: (json) => {
      if(json.status) {
        time(json.return.expires);
        renderFiles(json.return.files);
      } else {
        window.location.href = BASE;
      }
    }
  });
}

function renderFiles(files) {
  if(files.length > 0) {
    let html = $('#list-files').html();

    files.forEach(element => {
      html += `
        <div class="card-file">
          <div class="left">
            <i class="fas fa-file-upload"></i>

            <p class="title">${element.file_name.split('.')[0].length > 10 ? element.file_name.split('.')[0].slice(0, 10)+'...' : element.file_name.split('.')[0]}</p>
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