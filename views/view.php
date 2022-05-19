<div class="wrapper view">
    <div class="content">
        <div class="top">
            <div class="logo-area">
                <a href="<?= BASE ?>" class="logo">
                    <img src="<?= BASE ?>assets/img/logo.png" alt="">
                </a>
            </div>

            <div class="expires-area">
                <h1 class="time" id="time">00:00</h1>
                <span class="sub-text">expirar o link</span>
            </div>
        </div>

        <div class="middle">
            <div class="container">
                <div class="list" id="list-files">
                    
                </div>

                <div class="size-area">
                  <div class="size"><span class="f-b" id="size">0</span> <span class='f-m'>/</span> 100 Mb</div>
                </div>
            </div>
        </div>

        <div class="bottom">
            <div class="container">
                <p class="title">code</p>
                <p class="code" id="code-text"><?= $code ?></p>
            </div>
        </div>
    </div>
</div>

<script defer src="<?= BASE ?>assets/js/view.js"></script>