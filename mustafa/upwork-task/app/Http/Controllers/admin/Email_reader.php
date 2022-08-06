<?php

namespace App\Http\Controllers\admin;

class Email_reader extends ControllerAmin {

    // imap server connection
    public $conn;
    // inbox storage and inbox message count
    private $inbox;
    private $msg_cnt;
    // email login credentials
    private $server = 'https://5.9.89.253:993';
    private $user = 'info@hilul.net';
    private $pass = 'qguoH^t)Gj&H';
    private $port = 993; // adjust according to server settings

    // connect to the server and get the inbox emails
    function __construct() {
//        $this->connect();
//        $this->inbox();
    }

    // close the server connection
    public function close() {
        $this->inbox = array();
        $this->msg_cnt = 0;

        imap_close($this->conn);
    }

    // open the server connection
    // the imap_open function parameters will need to be changed for the particular server
    // these are laid out to connect to a Dreamhost IMAP server
    public function connect() {
        $this->conn = imap_open('{' . $this->server . '/imap/ssl/novalidate-cert}INBOX', $this->user, $this->pass);
    }

    // move the message to a new folder
    public function move($msg_index, $folder = 'INBOX.Processed') {
        // move on server
        imap_mail_move($this->conn, $msg_index, $folder);
        imap_expunge($this->conn);

        // re-read the inbox
        $this->inbox();
    }

    // get a specific message (1 = first email, 2 = second email, etc.)
    public function get($msg_index = NULL) {
        if (count($this->inbox) <= 0) {
            return array();
        } elseif (!is_null($msg_index) && isset($this->inbox[$msg_index])) {
            return $this->inbox[$msg_index];
        }

        return $this->inbox[0];
    }

    // read the inbox
    public function inbox() {

         $server = 'https://5.9.89.253';
         $user = 'info@hilul.net';
         $pass = 'qguoH^t)Gj&H';
         $port = 143; // adjust according to server settings
        imap_open("{".$server.":".$port."}INBOX", "$user", "$pass");

        echo "asd";
        die;
        $this->msg_cnt = imap_num_msg($this->conn);

        $in = array();
        for ($i = 1; $i <= $this->msg_cnt; $i++) {
            $in[] = array(
                'index' => $i,
                'header' => imap_headerinfo($this->conn, $i),
                'body' => imap_body($this->conn, $i),
                'structure' => imap_fetchstructure($this->conn, $i)
            );
        }

        $this->inbox = $in;
    }

}

?>