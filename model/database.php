<?php

class db
{

    private $ip = "api.iagofragnan.com.br";
    private $user = "dudak";
    private $pass = "132490Kj@br=";
    private $port = 3306;
    private $database = "expotec_duda";
    public $con;


    public function __construct()
    {
        $this->con = mysqli_connect($this->ip, $this->user, $this->pass, $this->database, $this->port);
    }

    function registrarPontuacao($nome, $pontuacao)
    {
        $sql = "INSERT INTO jogadores values (default, '" . $nome . "', " . $pontuacao . ");";
        $this->con->query($sql);
    }

    function getRanking()
    {
        $sql = "SELECT * FROM jogadores order by pontuacao DESC;";
        $result = $this->con->query($sql);

        if ($result->num_rows > 0) {
            $data = [];
            while ($row = $result->fetch_assoc()) {
                $data[] = $row; // Store each row in an array
            }
            return $data;
        } else {
            echo "Sem jogadores registrados.";
        }
    }
    function getRandomWord()
    {
        $sql = "SELECT * FROM palavras ORDER BY RAND() LIMIT 1;";
        $result = $this->con->query($sql);

        if ($result->num_rows > 0) {
            $data = [];
            while ($row = $result->fetch_assoc()) {
                $data[] = $row; // Store each row in an array
            }
            return $data;
        } 
        return false;
    }
}
