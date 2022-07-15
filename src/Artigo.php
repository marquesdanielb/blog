<?php

class Artigo
{
    private $mysql;


    public function __construct(mysqli $mysql)
    {
        $this->mysql = $mysql;
    }

    public function exibirTodos()
    {
        $resultado = $this->mysql->query('SELECT * FROM artigos');
        $artigos = $resultado->fetch_all(MYSQLI_ASSOC);

        return $artigos;
    }

    public function exibirArtigo(string $id): array
    {
        $selecionarArtigo = $this->mysql->prepare('SELECT * FROM artigos WHERE id = ?');
        $selecionarArtigo->bind_param('s', $id);
        $selecionarArtigo->execute();
        $artigo = $selecionarArtigo->get_result()->fetch_assoc();

        return $artigo;
    }


}