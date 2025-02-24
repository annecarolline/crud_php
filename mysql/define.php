<?php

   session_start();
   date_default_timezone_set('America/Sao_Paulo');


  
    //define('SQLPORTA','3306');//PORTA Mysql
    define('SQLPORTA','5432');//PORTA Postgres
    define('SQLSERVIDOR', 'localhost');//SERVIDOR
    define('SQLDB','bancoTeste');//BANCO DE DADOS
    //define('SQLUSER','root');//USUARIO Mysql
    define('SQLUSER','postgres');//USUARIO Postgres
    //define('SQLPWD','7@B2S5');//SENHA 
    define('SQLPWD','!32@70.Ac!@');//SENHA Postgres
 



    
   


    /*
   //info login
   define('TBLLOGIN','');//tabela de login
   define('COLLOGIN','');//coluna de login, pode ser um email tambem
   define('COLSENHA','');//coluna de senha, pode ser senha de email tambem
   define('PWDCRYPT', ''); //SENHA CRIPTOGRAFADA: TRUE OU FALSE
   
   
   //PHPMailer
   define('EMAILASSUNTO','xxxxxxxxxxxxxx');//ASSUNTO DO EMAIL
   define('EMAILREMETENTE','');//EMAIL DO REMETENTE
   define('EMAILREMETENTENOME','');//NOME DO REMETENTE
   define('EMAILHOSTSMTP','');//HOST SMTP
   define('EMAILPORTASMTP','');//PORTA SMTP
   define('EMAILUSUARIO','xxxxxxxxxxxxr');//USUÁRIO SMTP
   define('EMAILSENHA','xxxxx');//SENHA SMTP
    */
    
?>