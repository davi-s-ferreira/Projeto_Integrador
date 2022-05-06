<?php
// Faz conexão com MySQL/MariaDB
    // Os dados da conexão estão em "_config.ini"
    $i = parse_ini_file($_SERVER['DOCUMENT_ROOT'] . '/_confg.ini', true);

    foreach ($i as $key => $value) :
        if ($_SERVER['SERVER_NAME'] == $key) :

            // Conexão com MySQL/MariaDB usando "mysqli" (orientada a objetos)
            @$conn = new mysqli($value['server'], $value['user'], $value['password'], $value['database']);

            // Trata possíveis exceções
            if ($conn->connect_error) die("Falha de conexão com o banco e dados: " . $conn->connect_error);
        endif;
    endforeach;

        // Seta transações com MySQL/MariaDB para UTF-8
        $conn->query("SET NAMES 'utf8'");
        $conn->query('SET character_set_connection=utf8');
        $conn->query('SET character_set_client=utf8');
        $conn->query('SET character_set_results=utf8');
        
        // Seta dias da semana e meses do MySQL/MariaDB para "português do Brasil"
        $conn->query('SET GLOBAL lc_time_names = pt_BR');
        $conn->query('SET lc_time_names = pt_BR');
        

    // Define o fuso horário (opcional).
    date_default_timezone_set('America/Sao_Paulo');

    // Função que sanitiza campos de formulário.
    function sanitize($field_name, $field_type)
    {

        // Variável com valor do campo filtrado.
        $field_value = '';

        // Aplica o filtro adequado ao tipo de campo.
        switch ($field_type):

                // Se é um campo 'string', remove caracteres perigosos.
            case 'string':
                $field_value = htmlspecialchars($_POST[$field_name]);
                break;

                // Se é um campo 'email', remove caracteres inválidos.
            case 'email':
                $field_value = filter_input(INPUT_POST, $field_name, FILTER_SANITIZE_EMAIL);
                break;

        endswitch;

        // Remove espaços antes e depois da string.
        $field_value = trim($field_value);

        // Remove espaços duplicados no meio da string.
        $field_value = preg_replace('/\\s\\s+/', ' ', $field_value);

        // Retorna o valor do campo já sanitizado.
        return $field_value;
    }

    ?>