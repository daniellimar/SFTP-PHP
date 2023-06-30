<?php
class FTPDownloader {
    private $ftpServer;
    private $ftpUsername;
    private $ftpUserpass;
    private $ftpConn;

    public function __construct($server, $username, $password) {
        $this->ftpServer = $server;
        $this->ftpUsername = $username;
        $this->ftpUserpass = $password;
    }

    public function downloadFile($serverFile, $localFile) {
        $this->connect();
        $this->setPassiveMode();

        if (ftp_get($this->ftpConn, $localFile, $serverFile)) {
            echo "Arquivo importado com sucesso: {$localFile}\n";
        } else {
            echo "Falha ao importar, verifique e tente novamente.\n";
        }

        $this->close();
    }

    private function connect() {
        $this->ftpConn = ftp_connect($this->ftpServer) or die("Erro de conexão com FTP Server: {$this->ftpServer}");
        $login = ftp_login($this->ftpConn, $this->ftpUsername, $this->ftpUserpass) or die("Não foi possível realizar o Login");
    }

    private function setPassiveMode() {
        ftp_pasv($this->ftpConn, true) or die("Não foi possível mudar para o modo passivo");
    }

    private function close() {
        ftp_close($this->ftpConn);
    }
}