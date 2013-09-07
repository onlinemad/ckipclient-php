<?php
class CKIP{
	public $username;
	public $password;
	
	public $serverIP;
	public $serverPort;
	
	public $rawText;
	public $returnText;
	
	public $sentence = Array();
	private $term = Array(Array(),Array());

function send(){
	
	$xw = new xmlWriter();
    $xw->openMemory();
    
    $xw->startDocument('1.0');
    
    $xw->startElement('wordsegmentation');
    $xw->writeAttribute( 'version', '0.1');
    
    $xw->startElement('option');
    $xw->writeAttribute( 'showcategory', '1');
    $xw->endElement();
    
    $xw->startElement('authentication');
    $xw->writeAttribute( 'username', $this->username);
    $xw->writeAttribute( 'password', $this->password);
    $xw->endElement();  
    
    $xw->startElement('text');
    $xw->writeRaw($this->rawText);
    $xw->endElement();  
    
    $xw->endElement();
    
    $message=iconv("utf-8","big5",$xw->outputMemory(true));
    
    //send message to CKIP server
    set_time_limit(60);
    
    $protocol = getprotobyname("tcp");
    $socket = socket_create(AF_INET, SOCK_STREAM, $protocol);
    socket_connect($socket,$this->serverIP,$this->serverPort);
    socket_write($socket,$message);
    $this->returnText = iconv("big5","utf-8",socket_read($socket,strlen($message)*3));
    
    socket_shutdown($socket);
	socket_close($socket);
    
}
	
function getSentence(){
	$xml = new SimpleXMLElement($this->returnText);
	
	$this->sentence = $xml->result->sentence;
	
	
	/*foreach ($xml->result->sentence as $sentence) {
	   echo $sentence, '<br />';
	}
	*/
	//echo $xml->->sentence;
}	
}
?>