<h1>Como começar?</h1>

<p>É nescessario que você tenha o MySQL instalado em seu pc/notebook.</p>

<p>Caso você tenha adicione ao seu MySQL o arquivo sha_files.sql, ao fazer vá até o arquivo config.phpe o abra.</p>

<hr/>

<h3>Altere as seguintes informações. (Obs: Se estiver em local altere as informações da primeira condição do if)</h3>

<ul>
    <li><strong>BASE:</strong> Url do diretorio que o projeto está hospedado</li>
    <li><strong>dbname:</strong> Nome do banco de dados do projeto</li>
    <li><strong>host:</strong> Host do MySQL</li>
    <li><strong>dbuser:</strong> Nome do usuário configurado no seu MySQL (Por padrão vem: root)</li>
    <li><strong>dbpass:</strong> Senha do usuário configurado no seu MySQL (Por padrão vem vázio)</li>
    <li>Nos arquivos js altere as variaveis de url</li>
</ul>

<code>
    define("BASE", "http://localhost/levy/shafiles/");
	$config['dbname'] = 'sha_files';
	$config['host'] = 'localhost';
	$config['dbuser'] = 'root';
	$config['dbpass'] = 'root';
</code>

<hr/>

<strong>Link do figma do projeto: <a href="https://www.figma.com/file/IWwqeR6iVlIjzNTfXMj2CL/ShaFile?node-id=0%3A1" target="_blank">https://www.figma.com/file/IWwqeR6iVlIjzNTfXMj2CL/ShaFile?node-id=0%3A1</a></strong>