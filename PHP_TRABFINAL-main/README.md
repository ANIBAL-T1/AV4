# PHP_TRABFINAL
Trabalho final em PHP com POO e PDO

-------------------------------------------------------------------------------------------------------------------------
Responder o Kahoot abaixo utilizando seu nome:
https://kahoot.it/challenge/05065639?challenge-id=b4c24f45-a0df-4a6b-892a-ebc36c43780b_1712287322143

------------------------------------------------------------------------------------------------------------------------
DESAFIO:
Utililizar a mesma estrutura do APP Fornecedores e adaptar para APP Usuários.
- Estrutura de arquivos:
	conexao.php
	estilo.css
	index.php
	usuario.php
- Classes: 
	Conexao
	Usuario
- Banco de dados e Tabela:
	-- Criação do banco de dados
	CREATE DATABASE IF NOT EXISTS meu_banco;

-- Utilização do banco de dados criado
USE meu_banco;

-- Criação da tabela de usuários
CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    telefone VARCHAR(15) NOT NULL -- Definido como VARCHAR(15) para armazenar números de telefone
);
------------------------------------------------------------------------------------------------------------------------
Criar seu repositório como: PHP_TRABALHO_FINAL

Preencher formulário com seu nome e link da pasta do seu repositório:
https://almeida-cma.github.io/receber/

BOM TRABALHO! Valor: 2,00.
