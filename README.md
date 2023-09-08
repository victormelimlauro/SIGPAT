# SIGPAT
Sistema Integrado de Gestão do Patrimônio

## Objetivo do sistema
Criamos este sistema focando numa demanda de algumas instuições para realizar inventários de ativos de patrimônio.  

A promemática enxergada foi a complexidade no processamento de dados durante operações de inventários onde vários inventáriantes saem em busca dos itens com planilhas impressas e devolvem essas planilhas aos lideres dos inventários para processamento manual.  

A idéia para solucionar estes problemas é criar um sistema WEB de código aberto que proporcione um fluxo RPA (Robotic Process Automation) integrado com base de dados, onde todos os inventáriantes bem como a gestão tenha acesso aos dados em tempo real e seja possivél gerar relatórios.
## Tecnologia utilizada
Optamos por utilizar o PHP com Banco de dados MySQL, pelo fato do PHP ser uma linguagem simples, open source, de fácil utilização, hospedagem e também porque nós temos conhecimento nela, quanto ao MySQL pelo mesmo motivo.  
Por exemplo, basta subir um servidor Xampp em qualquer máquina e aproveitar o SIGPAT !  

## Subindo o banco de Dados e Conectando o sistema
No arquivo **DAO/MySQL.php**  ficam os parâmetros de conexão do Banco de Dados, que devem coincidir com o hostname, login e senha do servidor MySQL.  
Estamos disponibilizando o script de criação do banco de dados na pasta raiz do Git, arquivo .SQL
## Referências do projeto:
Desenvolvido pelo time abaixo para a disciplina de PARADIGMAS DE LINGUAGENS DE PROGRAMAÇÃO EM PYTHON na UniMetrocamp - Campinas - SP - Brasil.

Professor orientador: KESEDE RODRIGUES JULIO | kesede.julio@professores.unimetrocamp.edu.br

* GUILHERME ACACIO PINTO NETO | 202302378935@alunos.unimetrocamp.edu.br
* JUAN FELIPE DE SOUZA | 202102288673@alunos.unimetrocamp.edu.br
* MANUELLA MORETTI FRANCO ZAGLIA | 202102075556@alunos.unimetrocamp.edu.br
* VICTOR MELIM LAURO | 202303647816@alunos.unimetrocamp.edu.br

Projeto iniciado em 2023.2



