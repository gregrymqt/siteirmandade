<?php
class Sessao {
    public function __construct() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }
    
    public function criarSessaoUsuario($cd_u, $email_u) {
        $_SESSION['cd_u'] = $cd_u;
        $_SESSION['email_u'] = $email_u;
    }

    public function criarSessaoEmpresa($cd_em, $email_em) {
        $_SESSION['cd_em'] = $cd_em;
        $_SESSION['email_em'] = $email_em;
    }

    
    public function verificarSessao() {
        return isset($_SESSION['cd_u']);
    }
}
?>