<?php

session_start();
include_once("conexao.php");

// Primeiro tratamento do arquivo
$arquivoEnviado = $_FILES["fileToUpload"]["name"];
$name = str_replace(array(' ', "\t", "\n", "-"), '', $arquivoEnviado);
$target_dir = "uploads/";
$target_file = $target_dir . basename($name);
$uploadOk = 1;
$FileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

//verifica se a extensão do arquivo é csv
if($FileType != "csv") {
    echo "Envie apenas arquivos .csv.";
    $uploadOk = 0;
}

// verifica se o arquivo já existe
if (file_exists($target_file)) {
    echo "Renomeie o arquivo.";
    $uploadOk = 0;
}

//verifica se uploadOk é zero
if ($uploadOk == 0) {
    echo "Arquivo não enviado.";
    // se tudo estiver ok, tenta fazer o upload do arquivo
    } else {

        //move arquivo temporariamente para a pasta uploads
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        //echo "O arquivo ". htmlspecialchars( basename($name)). " foi enviado.</br>";

        //se estiver tudo ok com o arquivo, inicia conexao com banco de dados
            if($uploadOk == 1){

                $FileName = md5(strtolower (basename($name, ".csv")));
                $dados = file($target_file);

                $zero = '0';

                //cria tabela temporária para receber dados do csv
                $sqlCriaTabela = "
                CREATE TABLE $FileName (
                    matricula VARCHAR (50),
                    he_50 VARCHAR (50) DEFAULT 0,
                    he_100 VARCHAR (50) DEFAULT 0,
                    hj_atestado VARCHAR (50) DEFAULT 0,
                    hj_acidente VARCHAR (50) DEFAULT 0,
                    aus_just VARCHAR (50) DEFAULT 0,
                    ha_not VARCHAR (50) DEFAULT 0,
                    h_sobreaviso VARCHAR (50) DEFAULT 0,
                    f_normal VARCHAR (50) DEFAULT 0,
                    f_horas VARCHAR (50) DEFAULT 0,
                    d_repouso VARCHAR (50) DEFAULT 0,
                    conversor VARCHAR (255)
                );";
                $criaTabela = mysqli_query($conexao, $sqlCriaTabela);

                //insere dados do csv na tabela criada
                foreach($dados as $linha){
                    $linha = trim($linha);
                    $valor = explode(';', $linha);
                    $arrayNumeros = array('0','1','2','3','4','5','6','7','8','9');

                    $matricula = $valor[0];
                    if(!strlen($matricula)){
                        $matricula = 'a';
                    }

                    $he_50 = $valor[4];
                    $he_100 = $valor[5];
                    $hj_atestado = $valor[6];
                    $hj_acidente = $valor[7];
                    $aus_just = $valor[8];
                    $ha_not = $valor[9];
                    $h_sobreaviso = $valor[10];
                    $f_normal = $valor[11];
                    $f_horas = $valor[12];
                    $d_repouso = $valor[13];                    

                    if(in_array($matricula[0], $arrayNumeros, true)){
                        $result_conversor = "
                            INSERT INTO $FileName (
                                matricula, he_50, he_100, hj_atestado, hj_acidente, aus_just, ha_not, h_sobreaviso, f_normal, f_horas, d_repouso
                                ) VALUES (
                                '$matricula', '$he_50', '$he_100', '$hj_atestado', '$hj_acidente', '$aus_just', '$ha_not', '$h_sobreaviso', '$f_normal', '$f_horas', '$d_repouso'
                                );
                        ";
                        $resultado_conversor = mysqli_query($conexao, $result_conversor);	
                    }
                }

                // Atualiza colunas com zeros caso o defaut não funcione ao criar tabela

                $update0 = "
                    update
                    $FileName
                    set 
                        matricula = '0'
                    where
                        matricula = '';
                ";

                $update4 = "
                    update
                    $FileName
                    set 
                        he_50 = '0'
                    where
                        he_50 = '';
                ";

                $update5 = "
                    update
                    $FileName
                    set 
                        he_100 = '0'
                    where
                        he_100 = '';
                ";

                $update6 = "
                    update
                    $FileName
                    set 
                        hj_atestado = '0'
                    where
                        hj_atestado = '';
                ";

                $update7 = "
                    update
                    $FileName
                    set 
                        hj_acidente = '0'
                    where
                        hj_acidente = '';
                ";

                $update8 = "
                    update
                    $FileName
                    set 
                        aus_just = '0'
                    where
                        aus_just = '';
                ";

                $update9 = "
                    update
                    $FileName
                    set 
                        ha_not = '0'
                    where
                        ha_not = '';
                ";

                $update10 = "
                    update
                    $FileName
                    set 
                        h_sobreaviso = '0'
                    where
                        h_sobreaviso = '';
                ";

                $update11 = "
                    update
                    $FileName
                    set 
                        f_normal = '0'
                    where
                        f_normal = '';
                ";

                $update12 = "
                    update
                    $FileName
                    set 
                        f_horas = '0'
                    where
                        f_horas = '';
                ";

                $update13 = "
                    update
                    $FileName
                    set 
                        d_repouso = '0'
                    where
                        d_repouso = '';
                ";

                $alteranull0 = mysqli_query($conexao, $update0);
                $alteranull4 = mysqli_query($conexao, $update4);
                $alteranull5 = mysqli_query($conexao, $update5);
                $alteranull6 = mysqli_query($conexao, $update6);
                $alteranull7 = mysqli_query($conexao, $update7);
                $alteranull8 = mysqli_query($conexao, $update8);
                $alteranull9 = mysqli_query($conexao, $update9);
                $alteranull10 = mysqli_query($conexao, $update10);
                $alteranull11 = mysqli_query($conexao, $update11);
                $alteranull12 = mysqli_query($conexao, $update12);
                $alteranull13 = mysqli_query($conexao, $update13);

                /*
                INSERIR AQUI TRATAMENTO DOS DADOS NO SQL
                */

                $sqlAtualizaVirgula = "
                    update 
                    $FileName
                    set
                        he_50 = replace (he_50, '12x36', '0'),
                        he_50 = replace (he_50, ',', '.'),
                        he_100 = replace (he_100, ',', '.'),
                        hj_atestado = replace (hj_atestado, ',', '.'),
                        hj_acidente = replace (hj_acidente, ',', '.'),
                        aus_just = replace (aus_just, ',', '.'),
                        ha_not = replace (ha_not, ',', '.'),
                        h_sobreaviso = replace (h_sobreaviso, ',', '.'),
                        f_normal = replace (f_normal, ',', '.'),
                        f_horas = replace (f_horas, ',', '.'),
                        d_repouso = replace (d_repouso, ',', '.')
                ;";

                $sqlModificaColuna = "
                alter table $FileName
                modify column
                    he_50 = decimal(5,2),
                    he_100 = decimal(5,2),
                    hj_atestado = decimal(5,2),
                    hj_acidente = decimal(5,2),
                    aus_just = decimal(5,2),
                    ha_not = decimal(5,2),
                    h_sobreaviso = decimal(5,2),
                    f_normal = decimal(5,2),
                    f_horas = decimal(5,2),
                    d_repouso = decimal(5,2)
                ;";

                $sqlAtualizaPonto = "
                update 
                $FileName
                set
                    he_50 = replace (he_50, '.', ''),
                    he_100 = replace (he_100, '.', ''),
                    hj_atestado = replace (hj_atestado, '.', ''),
                    hj_acidente = replace (hj_acidente, '.', ''),
                    aus_just = replace (aus_just, '.', ''),
                    ha_not = replace (ha_not, '.', ''),
                    h_sobreaviso = replace (h_sobreaviso, '.', ''),
                    f_normal = replace (f_normal, '.', ''),
                    f_horas = replace (f_horas, '.', ''),
                    d_repouso = replace (d_repouso, '.', '')
                ;";

                $sqlConverte = "
                update $FileName
                set conversor = concat(
                    lpad(matricula,6,'0'),
                    lpad(he_50,5,'0'),
                    lpad(he_100,5,'0'),
                    lpad(hj_atestado,5,'0'),
                    lpad(hj_acidente,5,'0'),
                    lpad(aus_just,5,'0'),
                    lpad(ha_not,5,'0'),
                    lpad(h_sobreaviso,5,'0'),
                    lpad(f_normal,5,'0'),
                    lpad(f_horas,5,'0'),
                    lpad(d_repouso,5,'0'))
                 ;";

                $atualizaVirgula = mysqli_query($conexao, $sqlAtualizaVirgula);
                $modificaColuna = mysqli_query($conexao, $sqlModificaColuna);
                $atualizaPonto = mysqli_query($conexao, $sqlAtualizaPonto);
                $converte = mysqli_query($conexao, $sqlConverte);

                //apaga arquivo
                unlink($target_file);

                //cria arquivo com o nome convertido na pasta downloads
                $novoNome = $FileName.".txt";
                $arquivo = fopen($novoNome, 'w');

                //seleciona dados do banco de dados
                $sqlSelectDados = "
                    select conversor from $FileName
                    where conversor != '000000000000000000000000000000000000000000000000000'
                ";
                $selectDados = mysqli_query($conexao, $sqlSelectDados);

                //armazena dados em uma variável
                while($dados = mysqli_fetch_array($selectDados)){
                    $conversor = $dados['0']; //armazena coluna
                    $log = "$conversor\n";  //pula linha
                    fwrite($arquivo, $log); //insere dado no arquivo
                }

                //força download do arquivo
                $file_url = $novoNome;
                header('Content-Type: application/octet-stream');
                header("Content-Transfer-Encoding: Binary"); 
                header("Content-disposition: attachment; filename=\"" . basename($file_url) . "\""); 
                readfile($file_url); 
                unlink($novoNome);
                //fim força download arquivo

                //Apaga tabela
                $sqlApagaTabela = "drop table $FileName;";
                $apagaTabela = mysqli_query($conexao, $sqlApagaTabela);
                

            } else {
                echo "Ocorreu um erro durante o envio.";
            }
        }
    }

mysqli_close($conexao);
?>