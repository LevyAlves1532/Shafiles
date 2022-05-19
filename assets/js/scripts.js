//DEFINIR SE É EM PRODUÇÃO OU~DESENVOLVIMENTO
var url_local = window.location.href;
//produção
if (url_local.indexOf('localhost') == -1) {
    var url = 'http://shafiles.epizy.com';
}
//desenvolvimento
else {
    var url = 'http://localhost/projetos/shafiles';
}