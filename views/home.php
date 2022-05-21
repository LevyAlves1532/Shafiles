<div class="wrapper home">
    <div class="content">
        <div class="top">
            <div class="logo-area">
                <a href="<?= BASE ?>" class="logo">
                    <img src="<?= BASE ?>assets/img/logo.png" alt="">
                </a>
            </div>
        </div>

        <div class="middle">
            <div class="container">
                <form enctype="multipart/form-data" id="form-upload" class="form-upload">
                    <input type="file" name="files[]" accept="image/jpeg,image/jpg,image/png,video/mp4,application/zip" multiple id="files" class="input file">

                    <div class="list-files-area" id="list-files" style="display: none;">

                    </div>

                    <label for="files" class="input-area" id="drop-area">
                        <i class="fas fa-file-upload"></i>

                        <h1 class="title">Arraste os arquivos aqui</h1>

                        <p class="text">Gere links para compartilhar seus arquivos. (.jpg / .jpeg / .png / .mp4 / .zip)<br /> máximo: 100mb </p>
                    </label>

                    <button class="btn" style="display: none;" id="send-form">Compartilhar</button>
                </form>
            </div>
        </div>

        <div class="bottom">
            <div class="container">
                <input type="text" class="input text" id="input-code" placeholder="Cole código do arquivo compartilhado com você!">

                <button class="btn" id="search-code"><i class="fas fa-search"></i></button>
            </div>
        </div>
    </div>

    <div class="modal-area" id="modal-warning">
        <h1 class="title">Seja Bem-Vindo ao ShaFile</h1>

        <p class="text">
            O ShaFile é uma aplicação feita para o compartilhamento de arquivos,
            pedimos por gentileza para que não compartilhe nenhum tipo de arquivo
            que possa prejudicar a o usuario que irá recebe-lo. 
        </p>

        <p class="sub-text">
            Atenção: utilize códigos somente de pessoas que você conhece
            cuidado a o fazer o download e instalação de algum arquivo.
        </p>

        <button class="btn-warning" id="btn-warning">
            Estou pronto para usar!
        </button>
    </div>

    <div class="background" id="background-warning"></div>
</div>

<script defer src="<?= BASE ?>assets/js/home.js"></script>