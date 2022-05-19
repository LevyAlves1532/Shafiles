$(function() {
  initialize();
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
  let secondsExp = expDate.getSeconds();
  let secondsC = cDate.getSeconds();

  if(minutesExp < minutesC) {
    minutes = (minutesExp + 60) - minutesC;
  } else {
    minutes = minutesExp - minutesC;
  }

  seconds = (secondsBase - secondsC) - secondsExp;
  
  if(seconds < 0) {
    seconds = secondsBase + seconds;
  }

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
      initialize();

      clearInterval(interval);
    }

    if(minutes < 0) {
      initialize();

      clearInterval(interval);
    }
  }, 1000)
}

function initialize() {
  let code = $('#code-text').text();

  $.ajax({
    url: url+'/ajax/delFilesDefault',
    type: 'GET',
    dataType: 'json'
  });

  $.ajax({
    url: url+`/ajax/getCode?code=${btoa(code)}`,
    type: 'GET',
    dataType: 'json',
    success: (json) => {
      if(json.status) {
        time(json.return.expires);
        renderFiles(json.return.files, json.return.url);
      } else {
        window.location.href = url;
      }
    }
  });
}

function renderFiles(files, file_name) {
  if(files.length > 0) {
    let html = $('#list-files').html();
    let size = 0;

    files.forEach(element => {
      if(element.size) {
        let sizeFile = Math.ceil((parseInt(element.size) / 1024) / 976);

        size = size + sizeFile;
      }

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
            <a href="${url}/assets/img/${file_name}/${element.file_name}" class="btn-download" download><i class="fas fa-download"></i></a>
          </div>
        </div>
      `;
    })

    $('#size').text(size);

    $('#list-files').html(html);

    $('#drop-area').css('display', 'none');
    $('#send-form').css('display', 'block');
    $('#list-files').css('display', 'block');
  }
}