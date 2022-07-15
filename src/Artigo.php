<?php

class Artigo
{
    private $mysql;

    public function __construct(mysqli $mysql)
    {
        $this->mysql = $mysql;
    }

    public function criarArtigo(string $titulo, string $conteudo): void
    {
        $novoArtigo = $this->mysql->prepare("INSERT INTO artigos (titulo, conteudo) VALUES (?,?);");
        $novoArtigo->bind_param('ss', $titulo, $conteudo);
        $novoArtigo->execute();

    }

    public function removerArtigo(string $id): void
    {
        $removerArtigo = $this->mysql->prepare('DELETE FROM artigos WHERE id = ?');
        $removerArtigo->bind_param('s', $id);
        $removerArtigo->execute();
    }

    public function editaArtigo(string $id, string $titulo, string $conteudo): void
    {
        $editaArtigo = $this->mysql->prepare("UPDATE artigos SET titulo = ?, conteudo = ? WHERE id = ?;");
        $editaArtigo->bind_param('sss', $titulo, $conteudo, $id);
        $editaArtigo->execute();
    }

    public function exibirTodos(): array
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
