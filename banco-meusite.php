<?php

require_once('class/Convidado.php');
require_once('class/Presente.php');

function protect( &$str ) {
/*** Função para retornar uma string/Array protegidos contra SQL/Blind/XSS Injection*/
    if( !is_array( $str ) ) {                      
            $str = preg_replace( '/(from|select|insert|delete|where|drop|union|order|update|database)/i', '', $str );
            $str = preg_replace( '/(&lt;|<)?script(\/?(&gt;|>(.*))?)/i', '', $str );
            $tbl = get_html_translation_table( HTML_ENTITIES );
            $tbl = array_flip( $tbl );
            $str = addslashes( $str );
            $str = strip_tags( $str );
            return strtr( $str, $tbl );
    } else {
            return array_filter( $str, "protect" );
    }
}

function listaMeusite($conexao) {
    $infos = array();
    $query = "select * from meusite";
    $resultado = mysqli_query($conexao, $query);
    return mysqli_fetch_assoc($resultado);
}

function listaMensagens($conexao) {
    $mensagens = array();
    $query = "select * from mensagens order by id desc";
    $resultado = mysqli_query($conexao, $query);
    while ($mensagem = mysqli_fetch_assoc($resultado)) {
        array_push($mensagens, $mensagem);
    }
    return $mensagens;
}

function listaTransferencias($conexao) {
    $transferencias = array();
    $query = "select * from transferencia_valores order by id desc";
    $resultado = mysqli_query($conexao, $query);
    while ($transferencia = mysqli_fetch_assoc($resultado)) {
        array_push($transferencias, $transferencia);
    }
    return $transferencias;
}

function listaFotos($conexao) {
    $fotos = array();
    $query = "select * from fotos";
    $resultado = mysqli_query($conexao, $query);
    while ($foto = mysqli_fetch_assoc($resultado)) {
        array_push($fotos, $foto);
    }
    return $fotos;
}

function alteraMeusite (
    $conexao,
    $titulo,
    $brand,
    $cabecalho_imagem,
    $titulo_banner,
    $data_casamento,
    $section01_titulo,
    $section01_subtitulo,
    $section01_texto,
    $mensagens_titulo,
    $mensagens_subtitulo,
    $mensagens_imagem,
    $mensagens_quantidade,
    $fotos_titulo,
    $fotos_subtitulo
    )

    { 
    $query = "UPDATE meusite set
    titulo = '{$titulo}',
    brand = '{$brand}',
    cabecalho_imagem = '{$cabecalho_imagem}',
    titulo_banner = '{$titulo_banner}',
    data_casamento = '{$data_casamento}',
    section01_titulo = '{$section01_titulo}',
    section01_subtitulo = '{$section01_subtitulo}',
    section01_texto = '{$section01_texto}',
    mensagens_titulo = '{$mensagens_titulo}',
    mensagens_subtitulo = '{$mensagens_subtitulo}',
    mensagens_imagem = '{$mensagens_imagem}',
    mensagens_quantidade = '{$mensagens_quantidade}',
    fotos_titulo = '{$fotos_titulo}',
    fotos_subtitulo = '{$fotos_subtitulo}'
    ";

    return mysqli_query($conexao, $query);
}

function alteraSecaoLocal (
    $conexao,
    $local_titulo,
    $local_subtitulo,
    $local_imagem,
    $locais
    )

    { 
    $query = "UPDATE meusite set
    local_titulo = '{$local_titulo}',
    local_subtitulo = '{$local_subtitulo}',
    local_imagem = '{$local_imagem}',
    locais = '{$locais}'
    ";

    return mysqli_query($conexao, $query);
}

function alteraLocal01 (
        $conexao,
        $local_local01_titulo,
        $local_local01_horario,
        $local_local01_texto,
        $local_local01_imagem,
        $local_local01_mapa,
        $data_local01
    )

    { 
        $query = "UPDATE meusite set
        local_local01_titulo = '{$local_local01_titulo}',
        local_local01_horario = '{$local_local01_horario}',
        local_local01_texto = '{$local_local01_texto}',
        local_local01_imagem = '{$local_local01_imagem}',
        local_local01_mapa = '{$local_local01_mapa}',
        data_local01 = '{$data_local01}'
    ";

    return mysqli_query($conexao, $query);
}

function alteraLocal02 (
        $conexao,
        $local_local02_titulo,
        $local_local02_horario,
        $local_local02_texto,
        $local_local02_imagem,
        $local_local02_mapa,
        $data_local02
    )

    { 
        $query = "UPDATE meusite set
        local_local02_titulo = '{$local_local02_titulo}',
        local_local02_horario = '{$local_local02_horario}',
        local_local02_texto = '{$local_local02_texto}',
        local_local02_imagem = '{$local_local02_imagem}',
        local_local02_mapa = '{$local_local02_mapa}',
        data_local02 = '{$data_local02}'
    ";

    return mysqli_query($conexao, $query);
}

function alteraBoasVindasNoiva (
    $conexao,
    $noiva_nome,
    $noiva_desc,
    $noiva_img
)

{ 
    $query = "UPDATE meusite set
    noiva_nome = '{$noiva_nome}',
    noiva_desc = '{$noiva_desc}',
    noiva_img = '{$noiva_img}'
";

return mysqli_query($conexao, $query);
}

function alteraBoasVindasNoivo (
    $conexao,
    $noivo_nome,
    $noivo_desc,
    $noivo_img
)

{ 
    $query = "UPDATE meusite set
    noivo_nome = '{$noivo_nome}',
    noivo_desc = '{$noivo_desc}',
    noivo_img = '{$noivo_img}'
";

return mysqli_query($conexao, $query);
}

function alteraSecaoMensagens (
    $conexao,
    $mensagens_titulo,
    $mensagens_subtitulo,
    $mensagens_imagem,
    $mensagens_quantidade
    )

    { 
    $query = "UPDATE meusite set
    mensagens_titulo = '{$mensagens_titulo}',
    mensagens_subtitulo = '{$mensagens_subtitulo}',
    mensagens_imagem = '{$mensagens_imagem}',
    mensagens_quantidade = '{$mensagens_quantidade}'
    ";

    return mysqli_query($conexao, $query);
}

function alteraSecaoPresenca (
    $conexao,
    $presenca_titulo,
    $presenca_subtitulo,
    $presenca_aviso
    )

    { 
    $query = "UPDATE meusite set
    presenca_titulo = '{$presenca_titulo}',
    presenca_subtitulo = '{$presenca_subtitulo}',
    presenca_aviso = '{$presenca_aviso}'
    ";

    return mysqli_query($conexao, $query);
}

function alteraSecaoFotos (
    $conexao,
    $fotos_titulo,
    $fotos_subtitulo
    )

    { 
    $query = "UPDATE meusite set
    fotos_titulo = '{$fotos_titulo}',
    fotos_subtitulo = '{$fotos_subtitulo}'
    ";

    return mysqli_query($conexao, $query);
}

function alteraSecaoPresentes (
    $conexao,
    $presentes_titulo,
    $presentes_subtitulo,
    $pix,
    $pix_img,
    $tem_lista
) { 
    $query = "UPDATE meusite SET
        presentes_titulo = '{$presentes_titulo}',
        presentes_subtitulo = '{$presentes_subtitulo}',
        pix = '{$pix}',
        pix_img = '{$pix_img}',
        tem_lista = '{$tem_lista}'
    ";

    return mysqli_query($conexao, $query);
}



function alteraBannerPrincipal (
    $conexao,
    $titulo,
    $brand,
    $cabecalho_imagem,
    $titulo_banner,
    $data_casamento
    )

    { 
    $query = "UPDATE meusite set
    titulo = '{$titulo}',
    brand = '{$brand}',
    cabecalho_imagem = '{$cabecalho_imagem}',
    titulo_banner = '{$titulo_banner}',
    data_casamento = '{$data_casamento}'
    ";

    return mysqli_query($conexao, $query);
}

function alteraSecaoBoasVindas (
    $conexao,   
    $section01_titulo,
    $section01_subtitulo,
    $section01_texto
    )

    { 
    $query = "UPDATE meusite set
    section01_titulo = '{$section01_titulo}',
    section01_subtitulo = '{$section01_subtitulo}',
    section01_texto = '{$section01_texto}'
    ";

    return mysqli_query($conexao, $query);
}

function alteraMensagensQuantidade ($conexao,
    $mensagens_quantidade
    )

    { 
    $query = "UPDATE meusite set
    mensagens_quantidade = '{$mensagens_quantidade}'
    ";

    return mysqli_query($conexao, $query);
    }

function insereTransferencia ($conexao, $nome, $valor, $telefone, $data) {
    
    $nome = protect($nome);
    $valor = protect($valor);
    $telefone = protect($telefone);
    $data = protect($data);
    
    $query = "INSERT INTO transferencia_valores (nome, valor, telefone, data)
    VALUES ('{$nome}','{$valor}','{$telefone}','{$data}')"; 
    return mysqli_query($conexao, $query);
}

function insereMensagem ($conexao, $nome, $data, $mensagem, $telefone) { 
    
    $nome = protect($nome);
    $data = protect($data);
    $mensagem = protect($mensagem);
    $telefone = protect($telefone);
    
    $query = "INSERT INTO mensagens (nome, data, mensagem, telefone)
    VALUES ('{$nome}','{$data}','{$mensagem}','{$telefone}')"; 
    return mysqli_query($conexao, $query);
}

function confirmaMensagem ($conexao,$id,$confirmacao) { 
    $query = "UPDATE mensagens set
    confirmacao = '{$confirmacao}'
    
    where id = '{$id}'
    ";

    return mysqli_query($conexao, $query);
}

function confirmaTransferencia ($conexao,$id,$confirmacao) { 
    $query = "UPDATE transferencia_valores set
    confirmacao = '{$confirmacao}'
    
    where id = '{$id}'
    ";

    return mysqli_query($conexao, $query);
}

function confirmaPresenca ($conexao,$id,$confirmado) { 
    $query = "UPDATE convidados set
    confirmado = '{$confirmado}'
    
    where id = '{$id}'
    ";

    return mysqli_query($conexao, $query);
}

function insereFoto ($conexao, $nova_foto) { 
    $query = "INSERT INTO fotos (nome)
    VALUES ('{$nova_foto}')"; 
    return mysqli_query($conexao, $query);
}

function excluiFoto($conexao, $id) {
    $query = "delete from fotos where id = {$id}";
    return mysqli_query($conexao, $query);
}

function excluiFotoSecaoPresente($conexao, $id) {
    $query = "UPDATE meusite SET pix_img = NULL WHERE id = {$id}";
    return mysqli_query($conexao, $query);
}

function excluiFotoLocal1($conexao, $id) {
    $query = "UPDATE meusite SET local_local01_imagem = NULL WHERE id = {$id}";
    return mysqli_query($conexao, $query);
}

function excluiFotoLocal2($conexao, $id) {
    $query = "UPDATE meusite SET local_local02_imagem = NULL WHERE id = {$id}";
    return mysqli_query($conexao, $query);
}

function excluiFotoPrincipal($conexao, $id) {
    $query = "UPDATE meusite SET cabecalho_imagem = NULL WHERE id = {$id}";
    return mysqli_query($conexao, $query);
}

function excluiFotoNoiva($conexao, $id) {
    $query = "UPDATE meusite SET noiva_img = NULL WHERE id = {$id}";
    return mysqli_query($conexao, $query);
}

function excluiFotoNoivo($conexao, $id) {
    $query = "UPDATE meusite SET noivo_img = NULL WHERE id = {$id}";
    return mysqli_query($conexao, $query);
}

function excluiFotoMensagens($conexao, $id) {
    $query = "UPDATE meusite SET mensagens_imagem = NULL WHERE id = {$id}";
    return mysqli_query($conexao, $query);
}

function excluiFotoLocal($conexao, $id) {
    $query = "UPDATE meusite SET local_imagem = NULL WHERE id = {$id}";
    return mysqli_query($conexao, $query);
}


// CONVIDADOS

function insereConvidado ($conexao, Convidado $convidado) {
    $nome = protect($convidado->nome);
    $total_pessoas = protect($convidado->total_pessoas);
    $telefone = protect($convidado->telefone);
    $data = protect($convidado->data);

    $query = "INSERT INTO convidados (nome, total_pessoas, telefone, data)
    VALUES ('{$nome}','{$total_pessoas}','{$telefone}', '{$data}')"; 
    return mysqli_query($conexao, $query);
}

function listaConvidados($conexao) {
    $convidados = array();
    $query = "select * from convidados order by nome asc";
    $resultado = mysqli_query($conexao, $query);
    while ($convidado_array = mysqli_fetch_assoc($resultado)) {
        
        $convidado = new Convidado();

        $convidado->id = $convidado_array['id'];
        $convidado->nome = $convidado_array['nome'];
        $convidado->total_pessoas = $convidado_array['total_pessoas'];
        $convidado->email = $convidado_array['email'];
        $convidado->telefone = $convidado_array['telefone'];
        $convidado->confirmado = $convidado_array['confirmado'];
        $convidado->data = $convidado_array['data'];
        
        array_push($convidados, $convidado);
    }
    return $convidados;
}

function listaPresenca($conexao, $id) {
    $infos = array();
    $query = "select * from convidados where id = {$id} ";
    $resultado = mysqli_query($conexao, $query);
    return mysqli_fetch_assoc($resultado);
}

function alteraPresenca ($conexao, Convidado $convidado) { 

$query = "UPDATE convidados set
nome = '{$convidado->nome}',
telefone = '{$convidado->telefone}',
total_pessoas = '{$convidado->total_pessoas}'
where id = '{$convidado->id}'";

return mysqli_query($conexao, $query);
}

function excluiPresenca($conexao, $id) {
    $query = "delete from convidados where id = {$id}";
    return mysqli_query($conexao, $query);
}

function excluiTransferencia($conexao, $id) {
    $query = "delete from transferencia_valores where id = {$id}";
    return mysqli_query($conexao, $query);
}

// PRESENTES

function inserePresente ($conexao, Presente $presente) { 
    $query = "INSERT INTO lista_presentes (titulo, valor, link, codCategoria, imagem)
    VALUES ('{$presente->titulo}','{$presente->valor}',
        '{$presente->link}', '{$presente->categoria}','{$presente->imagem}')"; 
    return mysqli_query($conexao, $query);
}

function listaPresentes($conexao) {
    $presentes = array();
    $query = "select *,lp.id as id, c.nome as categoria from lista_presentes as lp join categorias as c
    on lp.codCategoria = c.id order by titulo asc, categoria asc";
    $resultado = mysqli_query($conexao, $query);
    while ($presente_array = mysqli_fetch_assoc($resultado)) {
        
        $presente = new Presente();

        $presente->id = $presente_array['id'];
        $presente->titulo = $presente_array['titulo'];
        $presente->valor = $presente_array['valor'];
        $presente->link = $presente_array['link'];
        $presente->categoria = $presente_array['categoria'];
        $presente->confirmacao = $presente_array['confirmacao'];
        $presente->imagem = $presente_array['imagem'];
        $presente->nome_pessoa = $presente_array['nome_pessoa'];
        $presente->telefone = $presente_array['telefone'];
        $presente->data = $presente_array['data'];
        array_push($presentes, $presente);
    }
    return $presentes;
}

function listaPresente($conexao, $id) {
    $presentes = array();
    $query = "select *,lp.id as id, c.nome as categoria, c.id as categoriaId from lista_presentes as lp join categorias as c
    on lp.codCategoria = c.id and lp.id = '{$id}'";
    $resultado = mysqli_query($conexao, $query);
    while ($presente_array = mysqli_fetch_assoc($resultado)) {
        
        $presente = new Presente();

        $presente->id = $presente_array['id'];
        $presente->titulo = $presente_array['titulo'];
        $presente->valor = $presente_array['valor'];
        $presente->link = $presente_array['link'];
        $presente->categoria = $presente_array['categoria'];
        $presente->categoriaId = $presente_array['categoriaId'];
        $presente->confirmacao = $presente_array['confirmacao'];
        $presente->imagem = $presente_array['imagem'];
        $presente->data = $presente_array['data'];

        array_push($presentes, $presente);
    }
    return $presente;
}

function listaPresente2($conexao, $id) {
    $presentes = array(); // Inicializa o array de presentes
    $query = "SELECT *, lp.id as id, c.nome as categoria, c.id as categoriaId 
              FROM lista_presentes AS lp 
              JOIN categorias AS c 
              ON lp.codCategoria = c.id 
              WHERE lp.id = '{$id}'";

    $resultado = mysqli_query($conexao, $query);
    while ($presente_array = mysqli_fetch_assoc($resultado)) {
        
        $presente = new Presente(); // Cria um novo objeto Presente

        // Popula o objeto com os dados retornados
        $presente->id = $presente_array['id'];
        $presente->titulo = $presente_array['titulo'];
        $presente->valor = $presente_array['valor'];
        $presente->link = $presente_array['link'];
        $presente->categoria = $presente_array['categoria'];
        $presente->categoriaId = $presente_array['categoriaId'];
        $presente->confirmacao = $presente_array['confirmacao'];
        $presente->imagem = $presente_array['imagem'];
        $presente->data = $presente_array['data'];

        array_push($presentes, $presente); // Adiciona o objeto ao array
    }

    return $presentes; // Retorna o array de objetos
}


function confirmaPresente ($conexao,$id,$confirmacao) { 
    $query = "UPDATE lista_presentes set
    confirmacao = '{$confirmacao}'
    
    where id = '{$id}'
    ";

    return mysqli_query($conexao, $query);
}

function excluiPresente($conexao, $id) {
    $query = "delete from lista_presentes where id = {$id}";
    return mysqli_query($conexao, $query);
}

    function excluiRecebido($conexao, $id, $nome_pessoa, $telefone, $confirmacao) {
        $query = "UPDATE lista_presentes 
                  SET confirmacao = '{$confirmacao}',
                      nome_pessoa = '{$nome_pessoa}',
                      telefone = '{$telefone}'
                  WHERE id = '{$id}'";
    
        return mysqli_query($conexao, $query);
    }

function alteraPresente ($conexao, Presente $presente) { 

    $query = "UPDATE lista_presentes set
    titulo = '{$presente->titulo}',
    valor = '{$presente->valor}',
    codCategoria = '{$presente->categoria}',
    link = '{$presente->link}',   
    imagem = '{$presente->imagem}'
    where id = '{$presente->id}'
    ";
    
    return mysqli_query($conexao, $query);
    }

function insereCategoria ($conexao, $categoria) { 
    $query = "INSERT INTO categorias (nome)
    VALUES ('{$categoria}')"; 
    return mysqli_query($conexao, $query);
}

function alteraCategoria($conexao, $id, $nome) {
    $query = "UPDATE categorias SET nome = '{$nome}' WHERE id = {$id}";
    return mysqli_query($conexao, $query);
}


function listaCategorias($conexao) {
    $categorias = array();
    $query = "select * from categorias order by nome asc ";
    $resultado = mysqli_query($conexao, $query);
    while ($categoria = mysqli_fetch_assoc($resultado)) {
        array_push($categorias, $categoria);
    }
    return $categorias;
}

function excluiCategoria($conexao, $id) {
    $query1 = "UPDATE lista_presentes SET codCategoria = '1' where codCategoria = {$id}";
    mysqli_query($conexao, $query1);
    $query2 = "DELETE FROM categorias WHERE id = {$id}";
    return mysqli_query($conexao, $query2);
}

function listaTotal($conexao) {
    $infos = array();
    $query = "select total_pessoas from convidados where id = 1";
    $resultado = mysqli_query($conexao, $query);
    return mysqli_fetch_assoc($resultado);
}

function listaConfirmado($conexao) {
    $infos = array();
    $query = "SELECT SUM(total_pessoas) as soma FROM convidados where confirmado = 1";
    $resultado = mysqli_query($conexao, $query);
    return mysqli_fetch_assoc($resultado);
}

function excluiMensagem($conexao, $id) {
    $query = "delete from mensagens where id = {$id}";
    return mysqli_query($conexao, $query);
}

function confirmadorPresente($conexao, $id, $nome_pessoa, $telefone, $confirmacao, $data) {
    $query = "UPDATE lista_presentes 
              SET confirmacao = '{$confirmacao}', 
                  nome_pessoa = '{$nome_pessoa}', 
                  telefone = '{$telefone}',
                  data = '{$data}'
              WHERE id = '{$id}'";

    return mysqli_query($conexao, $query);
}


function listaPresentes1($conexao) {
    $presentes = array();
    $query = "select *,lp.id as id, c.nome as categoria from lista_presentes as lp join categorias as c
    on lp.codCategoria = c.id order by valor asc, categoria asc";
    $resultado = mysqli_query($conexao, $query);
    while ($presente_array = mysqli_fetch_assoc($resultado)) {
        
        $presente = new Presente();

        $presente->id = $presente_array['id'];
        $presente->titulo = $presente_array['titulo'];
        $presente->valor = $presente_array['valor'];
        $presente->link = $presente_array['link'];
        $presente->categoria = $presente_array['categoria'];
        $presente->confirmacao = $presente_array['confirmacao'];
        $presente->imagem = $presente_array['imagem'];

        array_push($presentes, $presente);
    }
    return $presentes;
}

function listaPresentes2($conexao) {
    $presentes = array();
    $query = "select *,lp.id as id, c.nome as categoria from lista_presentes as lp join categorias as c
    on lp.codCategoria = c.id order by valor desc, categoria asc";
    $resultado = mysqli_query($conexao, $query);
    while ($presente_array = mysqli_fetch_assoc($resultado)) {
        
        $presente = new Presente();

        $presente->id = $presente_array['id'];
        $presente->titulo = $presente_array['titulo'];
        $presente->valor = $presente_array['valor'];
        $presente->link = $presente_array['link'];
        $presente->categoria = $presente_array['categoria'];
        $presente->confirmacao = $presente_array['confirmacao'];
        $presente->imagem = $presente_array['imagem'];

        array_push($presentes, $presente);
    }
    return $presentes;
}


function informaDoacao($conexao, $id, $nome_pessoa, $telefone, $confirmacao) {
    // Atualizar apenas os campos nome, telefone e confirmação
    $query = "UPDATE lista_presentes SET
        nome_pessoa = '{$nome_pessoa}', 
        telefone = '{$telefone}',
        confirmacao = '{$confirmacao}'
        WHERE id = '{$id}'";
    
    return mysqli_query($conexao, $query);
}

function insereVideo($conexao, $novo_video) {
    // Atualizar o registro existente em vez de inserir um novo
    $query = "UPDATE meusite SET video = '{$novo_video}'";
    return mysqli_query($conexao, $query);
}

function excluiVideo($conexao, $id) {
    $query = "UPDATE meusite SET video = '' WHERE id = {$id}";
    return mysqli_query($conexao, $query);
}

function insereVideo2($conexao, $novo_video) {
    // Atualizar o registro existente em vez de inserir um novo
    $query = "UPDATE meusite SET video_presente = '{$novo_video}'";
    return mysqli_query($conexao, $query);
}

function excluiVideo2($conexao, $id) {
    $query = "UPDATE meusite SET video_presente = '' WHERE id = {$id}";
    return mysqli_query($conexao, $query);
}

function exibirVideo($conexao) {
    // Consulta para obter o nome do vídeo associado
    $query = "SELECT video_presente FROM meusite WHERE id = 1";
    return $video_presente;
}

function insereTextoPresente ($conexao, $texto_presente) { 
    $query = "UPDATE meusite set texto_presente = '{$texto_presente}'";
    return mysqli_query($conexao, $query);
}

function save ($sessid, $userid, $seats) {
    $sql = "INSERT INTO `reservations` (`session_id`, `seat_id`, `user_id`) VALUES ";
    $data = [];
    foreach ($seats as $seat) {
      $sql .= "(?,?,?),";
      array_push($data, $sessid, $seat, $userid);
    }
    $sql = substr($sql, 0, -1);
    $this->query($sql, $data);
    return true;
  }