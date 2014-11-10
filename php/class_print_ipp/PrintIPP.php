<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 foldmethod=marker: */
 /* @(#) $Header: /sources/phpprintipp/phpprintipp/PrintIPP.php,v 1.25 2006/01/20 19:49:39 harding Exp $
 *
 * Version: 0.92 
 * Class PrintIPP - Send Basic IPP requests, Get and parses IPP Responses.
 *
 *   Copyright (C) 2005-2006  Thomas HARDING
 *   Parts Copyright (C) 2005-2006 Manuel Lemos
 *
 *   This library is free software; you can redistribute it and/or
 *   modify it under the terms of the GNU Library General Public
 *   License as published by the Free Software Foundation; either
 *   version 2 of the License, or (at your option) any later version.
 *
 *   This library is distributed in the hope that it will be useful,
 *   but WITHOUT ANY WARRANTY; without even the implied warranty of
 *   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 *   Library General Public License for more details.
 *
 *   You should have received a copy of the GNU Library General Public
 *   License along with this library; if not, write to the Free Software
 *   Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 *
 *   mailto:thomas.harding@laposte.net
 *   Thomas Harding, 56 rue de la bourie rouge, 45 000 ORLEANS -- FRANCE
 *   
 */
    
/*

    This class is intended to implement Internet Printing Protocol on client side.

    References needed to debug / add functionnalities:
        - RFC 2910
        - RFC 2911
        - RFC 3380
        - RFC 3382
*/
/*
    TODO: beta tests on other servers than Cups
*/


    // {{{ required and included files
            
            require_once("http_class.php");
            
            // If you want http backend from http://www.phpclasses.org/browse/package/3.html
            /*
            require_once("HTTP/http.php");
            include_once("SASL/sasl.php");
            include_once("SASL/basic_sasl_client.php");
            include_once("SASL/digest_sasl_client.php");
            include_once("SASL/ntlm_sasl_client.php");
            */
    // }}}

class PrintIPP {

    // {{{ variables declaration
    // setup variables
    public $paths = array("root" => "/", 
                          "admin" => "/admin/", 
                          "printers" => "/printers/", 
                          "jobs" => "/jobs"); 
    public $http_timeout = 0; // timeout at http connection (seconds) 0 => default => 30.
    public $http_data_timeout = 0; // data reading timeout (milliseconds) 0 => default => 30.
    public $ssl = false;
    public $debug_level = 2; // max 3: very verbose
    public $alert_on_end_tag;// debugging purpose: echo "END tag OK" if (1 and  reads while end tag)
 
    // readables variables
    public $jobs = array();
    public $jobs_uri = array();
    public $status = array();
    public $response_completed = array();
    public $last_job = "";
    public $attributes; // object you can read: attributes after validateJob()
    public $printer_attributes; // object you can read: printer's attributes after getPrinterAttributes()
    public $job_attributes; // object you can read: last job attributes
    public $jobs_attributes; // object you can read: jobs attributes after getJobs()
    public $available_printers = array();
    public $printers_uri = array();
    public $debug = array();
    public $response;
   
    // {{{ protected variables;
    
    protected $log_level = 2; // max 3: very verbose
    protected $log_type = 3; // 3: file | 1: e-mail | 0: logger
    protected $log_destination; // e-mail or file
    protected $serveroutput;
    protected $setup;
    protected $stringjob;
    protected $data;    
    protected $debug_count = 0;
    protected $username;
    protected $charset;
    protected $password;
    protected $requesring_user;
    protected $client_hostname = "localhost";
    protected $stream;    
    protected $host = "localhost";
    protected $port = "631";
    protected $printer_uri;
    protected $timeout = "20"; //20 secs
    protected $errNo;
    protected $errStr;
    protected $datatype;
    protected $datahead;
    protected $datatail;
    protected $meta;
    protected $operation_id;
    protected $delay;
    protected $error_generation; //devel feature
    protected $debug_http = 0;
    protected $no_disconnect;
    protected $job_tags;
    protected $operation_tags;
    protected $index;
    protected $collection ; //RFC3382
    protected $collection_index; //RFC3382
    protected $collection_key = array(); //RFC3382
    protected $collection_depth = -1; //RFC3382
    protected $end_collection = false; //RFC3382
    protected $collection_nbr = array(); //RFC3382
    // }}}
    // }}}
    
    // {{{ constructor
    public function __construct() {
        self::_initTags ();
    }
    // }}}

/*****************
*
* PUBLIC FUNCTIONS
*
*******************/


// SETUP

    // {{{ setPort($port='631')
    public function setPort($port='631'){
        $this->port = $port;
	self::_putDebug("Port is ".$this->port."\n");
    }
    // }}}

    // {{{ setHost($host='localhost')
    public function setHost($host='localhost'){
        $this->host = $host;
	self::_putDebug("Host is ".$this->host."\n");
    }
    // }}}
    
    // {{{ setTimeout($timeout)
    public function setTimeout($timeout){
        $this->timeout = $timeout;
    }
    // }}}

    // {{{ setPrinterURI ($uri)
    public function setPrinterURI ($uri) {
        
        $length = strlen ($uri);
        $length = chr($length);
        
        while (strlen($length) < 2)
            $length = chr(0x00) . $length;
        

        $this->meta->printer_uri = chr(0x45) // uri type | value-tag
                         .  chr(0x00) . chr(0x0B) // name-length
                         .  "printer-uri" // printer-uri | name
                         . $length
                         . $uri;

        $this->printer_uri = $uri;
        
        self::_putDebug(sprintf(_("Printer URI: %s\n"),$uri));
        
        $this->setup->uri = 1;

    }
    // }}}

    // {{{ setData($data)
    public function setData($data){ 
        // 
        $this->data = $data;
        self::_putDebug("Data set\n");
    }
    // }}}
    
    // {{{ setRawText ()
    public function setRawText () {
        $this->setup->datatype = 'TEXT';
        $this->meta->mime_media_type = "";
        $this->setup->mime_media_type = 1;
        $this->datahead = chr(0x16);
                       
        if (is_readable($this->data)){
            //It's a filename.  Open and stream.
            $data = fopen($this->data, "rb");
            while(!feof($data))
                $output = fread($data, 8192);
        } else {
            $output = $this->data;
            }

        if (substr($output,-1,1) != chr(0x0c))
            if (!isset($this->setup->noFormFeed))
                $this->datatail = chr(0x0c);
        
        self::_putDebug(_("Forcing data to be interpreted as RAW TEXT\n"));
    }
    // }}}

    // {{{ unsetRawText ()
    public function unsetRawText () {
        
        $this->setup->datatype = 'BINARY';
        $this->datahead = '';
        $this->datatail = '';
        self::_putDebug(_("Unset forcing data to be interpreted as RAW TEXT\n"));

    }
    // }}}

    // {{{ setBinary()
    public function setBinary () {
        self::unsetRawText();
    }
    // }}}

    // {{{ setFormFeed ()
    public function setFormFeed () {
        $this->datatail = "\r\n".chr(0x0c);
        unset($this->setup->noFormFeed);
    }
    // }}}

    // {{{ unsetFormFeed ()
    public function unsetFormFeed () {
        $this->datatail = '';
        $this->setup->noFormFeed = 1;
    }
    // }}}

    // {{{ setCharset ($charset)
    public function setCharset ($charset='us-ascii') {

        $charset = strtolower($charset);
        $this->charset = $charset;

        $this->meta->charset = chr(0x47) // charset type | value-tag
                         . chr(0x00) . chr(0x12) // name-length
                         . "attributes-charset" // attributes-charset | name
                         . self::_giveMeStringLength($charset) // value-length
                         . $charset; // value
        
        self::_putDebug(sprintf(_("Charset: %s\n"),$charset));

        $this->setup->charset = 1;
    }
    // }}}
 
    // {{{ setLanguage($language)
    public function setLanguage($language='en_us') {

        $language = strtolower($language);
        
        $this->meta->language = chr(0x48)    // natural-language type | value-tag
                         .  chr(0x00) . chr(0x1B) //  name-length
                         .  "attributes-natural-language" //attributes-natural-language
                         .  self::_giveMeStringLength($language) // value-length
                         .  $language; // value
 
        self::_putDebug(sprintf(_("Language: %s\n"),$language));
        
        $this->setup->language = 1;
    }
    // }}}

    // {{{ setMimeMediaType ($mime_media_type='application/octet-stream')
    public function setMimeMediaType ($mime_media_type='application/octet-stream') {
        
        self::setBinary();
                                     
        $length = strlen ($mime_media_type);
        $length = chr($length);
        
        while (strlen($length) < 2)
            $length = chr(0x00) . $length;
        
        
        self::_putDebug( sprintf(_("mime type: %s\n"),$mime_media_type));
 
        $this->meta->mime_media_type = chr(0x49) // mimeMediaType tag
                                . self::_giveMeStringLength('document-format')
                                . 'document-format' // mimeMediaType
                                . self::_giveMeStringLength($mime_media_type)
                                . $mime_media_type; // value
                                    
        $this->setup->mime_media_type = 1;
    }
    // }}}

    // {{{ setDocumentFormat ($mime_media_type="application/octet-stream") // setMimeMediaType alias
    public function setDocumentFormat ($mime_media_type="application/octet-stream") {
        self::setMimeMediaType ($mime_media_type);
    }
    // }}}
    
    // {{{ setCopies ($nbrcopies=1)
    public function setCopies ($nbrcopies=1) {
        
        $this->meta->copies = "";
        if ($nbrcopies == 1 || !$nbrcopies)
            return true;
        
        if ($nbrcopies > 65535 || $nbrcopies < 0) {
            trigger_error(_("Copies must be between 0 and 65535"),E_USER_WARNING);
            return FALSE;
            }
        
        $copies = self::_integerBuild($nbrcopies);

        $this->meta->copies = chr(0x21) // integer type | value-tag
                    . chr(0x00) .chr(0x06) //             name-length
                    . "copies" // copies    |             name
                    . self::_giveMeStringLength($copies) // value-length 
                    . $copies;
        
        self::_putDebug( sprintf(_("Copies: %s\n"),$nbrcopies));
        $this->setup->copies = 1;
    }
    // }}}
    
    // {{{ setDocumentName ($document_name)
    public function setDocumentName ($document_name="") {
        
        $this->meta->document_name = "";
        if (!$document_name)
            return true;
        
        $document_name = substr($document_name,0,1023);
        
        $length = strlen ($document_name);
        $length = chr($length);
        
        while (strlen($length) < 2)
            $length = chr(0x00) . $length;
        
        
        self::_putDebug( sprintf(_("document name: %s\n"),$document_name));
 
        $this->meta->document_name = chr(0x41) // textWithoutLanguage tag
                                . chr(0x00) . chr(0x0d) // name-length 
                                . "document-name" // mimeMediaType
                                . self::_giveMeStringLength($document_name)
                                . $document_name; // value
                                    
    }
    // }}}

    // {{{ setJobName ($jobname='(PHP)',$absolute=false)
    public function setJobName ($jobname='(PHP)',$absolute=false) {
        
        $this->meta->jobname = '';
        if (!$jobname)
            return true;
        
        $postpend = date('-H:i:s-') . $this->_setJobId();
        
        if ($absolute)
            $postpend = '';
        
        if (isset($this->values->jobname) && $jobname == '(PHP)')
            $jobname = $this->values->jobname;
        
        $this->values->jobname = $jobname;
        
        $jobname .= $postpend;
        
        $this->meta->jobname = chr(0x42)  // nameWithoutLanguage type || value-tag
                    . chr(0x00) . chr(0x08) //                           name-length
                    . "job-name" //        job-name   ||                 name
                    . self::_giveMeStringLength($jobname)  //           value-length
                    . $jobname ; //                                      value
        
        self::_putDebug( sprintf(_("Job name: %s\n"),$jobname)); 
        $this->setup->jobname = 1;
    }
    // }}}

    // {{{ setUserName ($username='PHP-SERVER')
    public function setUserName ($username='PHP-SERVER') {
        
        $this->requesting_user = $username;
        $this->meta->username = '';
        if (!$username)
            return true;

        if ($username == 'PHP-SERVER' && isset($this->meta->username))
            return TRUE;
        
        $value_length = 0x00;
        for ($i = 0 ; $i < strlen($username)  ; $i ++) {
            $value_length += 0x01;
            }
        $value_length = chr($value_length);

        while (strlen($value_length) < 2)
            $value_length = chr(0x00) . $value_length;
                       
        $this->meta->username = chr(0x42) // keyword type || value-tag
                            . chr(0x00). chr(0x14) // name-length
                            . "requesting-user-name"
                            . $value_length
                            . $username;
                            
        self::_putDebug( sprintf(_("Username: %s\n"),$username));
        $this->setup->username = 1;
    }
    // }}}

    // {{{ setAuthentification ($username,$password)
    public function setAuthentification ($username,$password) {
        $this->password = $password;
        $this->username = $username;
        
        self::_putDebug( _("Setting password\n"));
        $this->setup->password = 1;
    }
    // }}}

    // {{{ setSides ($sides=2)
    public function setSides ($sides=2) {
        
        $this->meta->sides = '';
        if (!$sides)
            return true;
        
        switch ($sides) {
            case 1:
                $sides = "one-sided";
                break;
            case 2:
                $sides = "two-sided-long-edge";
                break;
            case "2CE":
                $sides = "two-sided-short-edge";
                break;
            default:
                $sides = $sides; // yeah, what ?
                break;
            }
        
                   
        $this->meta->sides = chr(0x44) // keyword type | value-tag
                        . chr(0x00). chr(0x05) //        name-length
                        . "sides" // sides |             name
                        . self::_giveMeStringLength($sides) //               value-length
                        . $sides ; // one-sided |          value
                        
        self::_putDebug( sprintf(_("Sides value seted to %s\n"), $sides));
    }
    // }}}
   
    // {{{ setFidelity ()
    public function setFidelity () {
    
    // whether the server can't replace any attributes (eg, 2 sided print is not possible,
    // so print one sided) and DO NOT THE JOB.
        $this->meta->fidelity = chr(0x22) // boolean type  |  value-tag
                    . chr(0x00). chr(0x16) //                  name-length
                    . "ipp-attribute-fidelity" // ipp-attribute-fidelity | name
                    . chr(0x00) . chr(0x01) //  value-length
                    . chr(0x01); //  true | value
        
        self::_putDebug( _("Fidelity attribute is set (paranoid mode)\n"));
 
    }
    // }}}
    
    // {{{ unsetFidelity ()
    public function unsetFidelity () {
    
    // whether the server can replace any attributes (eg, 2 sided print is not possible,
    // so print one sided) and DO THE JOB.
    
        $this->meta->fidelity = chr(0x22) //  boolean type | value-tag
                            . chr(0x00). chr(0x16) //        name-length
                    . "ipp-attribute-fidelity" // ipp-attribute-fidelity | name
                    . chr(0x00) . chr(0x01) //               value-length
                    . chr(0x00); // false |                   value
        
        self::_putDebug( _("Fidelity attribute is unset\n"));
    }
    // }}}
    
    // {{{ setMessage()
    public function setMessage ($message='') {
        
        $this->meta->message = '';
        if (!$message)
            return true;
    
        $this->meta->message = chr(0x41) // attribute type = textWithoutLanguage
                            . chr(0x00) . chr(0x07)
                            . "message"
                            . self::_giveMeStringLength(substr($message,0,127))
                            . substr($message,0,127);
        
        self::_putDebug( sprintf(_("Setting message to \"%s\"\n"),$message));
    }
    // }}}

    // {{{ setPageRanges($page_ranges)
    public function setPageRanges($page_ranges) {
    
        // $pages_ranges = string:  "1:5 10:25 40:52 ..."
        // to unset, specify an empty string.
        
        $this->meta->page_range = '';
        
        if (!$page_ranges)
            return true;

        $page_ranges = trim(str_replace("-",":",$page_ranges));

        $first = true;
        $page_ranges = split(' ',$page_ranges);
        foreach ($page_ranges as $page_range) {
            $value = self::_rangeOfIntegerBuild($page_range);
            
            if ($first)
                $this->meta->page_ranges .= $this->tags_types['rangeOfInteger']['tag']
                                         .  self::_giveMeStringLength('page-ranges')
                                         .  'page-ranges'
                                         .  self::_giveMeStringLength($value)
                                         .  $value;
            else
                $this->meta->page_ranges .= $this->tags_types['rangeOfInteger']['tag']
                                         .  self::_giveMeStringLength('')
                                         .  self::_giveMeStringLength($value)
                                         .  $value;
            $first = false;                        
            }
            
    }
    // }}}
    
    // {{{ setAttribute($attribute,$value)
    public function setAttribute($attribute,$values) {

        $operation_attributes_tags = array_keys($this->operation_tags);
        $job_attributes_tags = array_keys($this->job_tags);
        
        self::unsetAttribute($attribute);
        
        if (in_array($attribute,$operation_attributes_tags)) {
            if (!is_array($values))
                self::_setOperationAttribute ($attribute,$values);
            else
                foreach ($values as $value)
                    self::_setOperationAttribute ($attribute,$value);
                    
        } elseif (in_array($attribute,$job_attributes_tags)) {
             if (!is_array($values))
                self::_setJobAttribute ($attribute,$values);
            else
                foreach ($values as $value)
                    self::_setJobAttribute ($attribute,$value);
            
        } else {
            trigger_error(sprintf(_('SetAttribute: Tag "%s" is not a printer or a job attribute'),$attribute),E_USER_NOTICE);
            self::_putDebug(sprintf(_('SetAttribute: Tag "%s" is not a printer or a job attribute'),$attribute),2);
            self::_errorLog(sprintf(_('SetAttribute: Tag "%s" is not a printer or a job attribute'),$attribute),2);
            return FALSE;
            }

    }
    // }}}
    
    // {{{ unsetAttribute($attribute)
    public function unsetAttribute($attribute) {

        $operation_attributes_tags = array_keys($this->operation_tags);
        $job_attributes_tags = array_keys($this->job_tags);
        
        if (in_array($attribute,$operation_attributes_tags)) 
            unset  ($this->operation_tags[$attribute]['value'], $this->operation_tags[$attribute]['systag']);
        elseif (in_array($attribute,$job_attributes_tags))
            unset ($this->job_tags[$attribute]['value'], $this->job_tags[$attribute]['systag']);
        else {
            trigger_error(sprintf(_('unsetAttribute: Tag "%s" is not a printer or a job attribute'),$attribute),E_USER_NOTICE);
            self::_putDebug(sprintf(_('unsetAttribute: Tag "%s" is not a printer or a job attribute'),$attribute),2);
            self::_errorLog(sprintf(_('unsetAttribute: Tag "%s" is not a printer or a job attribute'),$attribute),2);
            return FALSE;
            }

    return true;
    }
    // }}}

// LOGGING / DEBUGGING

    // {{{ setLog ($log_destination,$destination_type='file',$level=2)
    public function setLog ($log_destination,$destination_type='file',$level=2) {
        
        if (is_string($log_destination) && !empty($log_destination))
            $this->log_destination = $log_destination;
        
        switch ($destination_type) {
            case 'file':
            case 3:
                $this->log_destination = $log_destination;
                $this->log_type = 3;
                break;
            case 'logger':
            case 0:
                $this->log_destination = '';
                $this->log_type = 0;
                break;
            case 'e-mail':
            case 1:
                $this->log_destination = $log_destination;
                $this->log_type = 1;
                break;
            }
            $this->log_level = $level;
    
    }
    // }}}

    // {{{ printDebug()
    public function printDebug() {
        echo "<pre>";
        for ($i = 0 ; $i < $this->debug_count ; $i++)
            echo $this->debug[$i];
        echo "</pre>";
        $this->debug = array();
        $this->debug_count = 0;
    }
    // }}}
    
    // {{{ getDebug()
    public function getDebug() {
        $debug = '';
        for ($i = 0 ; $i < $this->debug_count ; $i++)
            $debug .= $this->debug[$i];
        $this->debug = array();
        $this->debug_count = 0;
        return $debug;
    }
    // }}}

// OPERATIONS

    // {{{ printJob()
    public function printJob(){
        
        self::_putDebug( sprintf("*************************\nDate: %s\n*************************\n\n",date('Y-m-d H:i:s')));

        if (!$this->_stringJob())
            return FALSE;
                       
        if (is_readable($this->data)){
            self::_putDebug( _("Printing a FILE\n")); 
                
            $this->output = $this->stringjob;
           
            if ($this->setup->datatype == "TEXT")
                $this->output .= chr(0x16);
            
             
            $post_values = array( "Content-Type" => "application/ipp",
                                  "Data" => $this->output,
                                  "File" => $this->data);
            
            if ($this->setup->datatype == "TEXT" && !isset($this->setup->noFormFeed))
                $post_values = array_merge($post_values,array("Filetype"=>"TEXT"));
            
        } else {                      
            self::_putDebug( _("Printing DATA\n")); 
            
            $this->output = $this->stringjob;
            $this->output .= $this->datahead;    
            $this->output .= $this->data;
            $this->output .= $this->datatail;
            
            $post_values = array( "Content-Type" => "application/ipp",
                                  "Data" => $this->output);
             
            
            }
            
        if (self::_sendHttp ($post_values,$this->paths['printers'])) {
        
            if(self::_parseServerOutput()) {
                $this->_getJobId();
                $this->_getJobUri();
                $this->_parseJobAttributes();
            } else {
                $this->jobs = array_merge($this->jobs,array(''));
                $this->jobs_uri = array_merge($this->jobs_uri,array(''));
                }

            }
        
        if (isset($this->serveroutput) && isset($this->serveroutput->status)) {
            
            $this->status = array_merge($this->status,array($this->serveroutput->status));

            if ($this->serveroutput->status == "successfull-ok")
                self::_errorLog(sprintf("printing job %s: ",$this->last_job) .$this->serveroutput->status,3);
            else {
                $this->jobs = array_merge($this->jobs,array(""));
                $this->jobs_uri = array_merge($this->jobs_uri,array(""));
                self::_errorLog(sprintf("printing job: ",$this->last_job) .$this->serveroutput->status,1);
                }
            return $this->serveroutput->status; 
            
            }

        $this->status = array_merge($this->status,array("OPERATION FAILED"));
        $this->jobs = array_merge($this->jobs,array(""));
        $this->jobs_uri = array_merge($this->jobs_uri,array(""));
        self::_errorLog("printing job : OPERATION FAILED",1);
    
    return false;
    }
    // }}}
    
    // {{{ cancelJob ($job_uri)
    public function cancelJob ($job_uri) {
        
        $this->jobs = array_merge($this->jobs,array(""));
        $this->jobs_uri = array_merge($this->jobs_uri,array(""));
        
        self::_putDebug( sprintf("*************************\nDate: %s\n*************************\n\n",date('Y-m-d H:i:s')));
        
        if (!$this->_stringCancel($job_uri))
        return FALSE;
                       
        self::_putDebug( _("Cancelling Job $job_uri\n")); 
            
        $this->output = $this->stringjob;
          
        $post_values = array( "Content-Type"=>"application/ipp",
                              "Data"=>$this->output);
            
        if (self::_sendHttp ($post_values,$this->paths['jobs']))
            self::_parseServerOutput();
          
        
        if (isset($this->serveroutput) && isset($this->serveroutput->status)) {
            
            $this->status = array_merge($this->status,array($this->serveroutput->status));

            if ($this->serveroutput->status == "successfull-ok")
                self::_errorLog("cancelling job $job_uri: ".$this->serveroutput->status,3);
            else            
                self::_errorLog("cancelling job $job_uri: ".$this->serveroutput->status,1);
            return $this->serveroutput->status; 

            }

            $this->status = array_merge($this->status,array("OPERATION FAILED"));
            self::_errorLog("cancelling job : OPERATION FAILED",3);
            
    return false;
    }
    // }}}
    
    // {{{  validateJob ()
    public function validateJob () {
        
        $this->jobs = array_merge($this->jobs,array(""));
        $this->jobs_uri = array_merge($this->jobs_uri,array(""));
        
        $this->serveroutput->response = '';

        self::_putDebug( sprintf("*************************\nDate: %s\n*************************\n\n",date('Y-m-d H:i:s')));
        
                       
        self::_putDebug( _("Validate Job\n")); 
                
        if (!isset($this->setup->charset))
            self::setCharset('us-ascii');
        if (!isset($this->setup->datatype))
            self::setBinary();

        if (!isset($this->setup->uri)) {
            $this->getPrinters();
            unset($this->jobs[count($this->jobs) - 1]);
            unset($this->jobs_uri[count($this->jobs_uri) - 1]);
            unset($this->status[count($this->status) - 1]);
            
            if (array_key_exists(0,$this->available_printers))
               self::setPrinterURI($this->available_printers[0]);
            else {
                trigger_error(_("_stringJob: Printer URI is not set: die"),E_USER_WARNING);
                self::_putDebug( _("_stringJob: Printer URI is not set: die\n"));
                self::_errorLog(" Printer URI is not set, die",2);
                return FALSE;
                }
            }
        
        if (!isset($this->meta->copies))
            self::setCopies(1);
        if (!isset($this->setup->copies))
            self::setCopies(1);
        
        if (!isset($this->setup->language))
            self::setLanguage('en_us');

        if (!isset($this->setup->mime_media_type))
            self::setMimeMediaType();
        if ($this->setup->datatype != "TEXT")
        unset ($this->setup->mime_media_type);
            
        if (!isset($this->setup->jobname))
            if (is_readable($this->data))
                self::setJobName(basename($this->data),true);
            else
                self::setJobName();
        unset($this->setup->jobname);

        if (!isset($this->meta->username))
            self::setUserName();

        if (!isset($this->meta->fidelity))
            $this->meta->fidelity = '';
        
        if (!isset($this->meta->document_name))
            $this->meta->document_name = '';

        if (!isset($this->meta->sides))
            $this->meta->sides = '';
        
        if (!isset($this->meta->page_ranges))
            $this->meta->page_ranges = '';
       
        $jobattributes = '';
        $operationattributes = '';
        self::_buildValues ($operationattributes,$jobattributes);
       
        self::_setOperationId();

        $this->stringjob = chr(0x01) . chr(0x01) // 1.1  | version-number
                         . chr(0x00) . chr (0x04) // Validate-Job | operation-id
                         . $this->meta->operation_id //           request-id
                         . chr(0x01) // start operation-attributes | operation-attributes-tag
                         . $this->meta->charset
                         . $this->meta->language
                         . $this->meta->printer_uri
                         . $this->meta->username
                         . $this->meta->jobname
                         . $this->meta->fidelity
                         . $this->meta->document_name
                         . $this->meta->mime_media_type
                         . $operationattributes
                         . chr(0x02) // start job-attributes | job-attributes-tag
                         . $this->meta->copies
                         . $this->meta->sides
                         . $this->meta->page_ranges
                         . $jobattributes
                         . chr(0x03); // end-of-attributes | end-of-attributes-tag
        

        self::_putDebug( sprintf(_("String sent to the server is:\n%s\n"), $this->stringjob));
 
        $this->output = $this->stringjob;
          
        $post_values = array( "Content-Type"=>"application/ipp",
                              "Data"=>$this->output);
            
        if (self::_sendHttp ($post_values,$this->paths['printers']))
                if(self::_parseServerOutput())
                    self::_parseAttributes();
          
        
        if (isset($this->serveroutput) && isset($this->serveroutput->status)) {
            
            $this->status = array_merge($this->status,array($this->serveroutput->status));

            if ($this->serveroutput->status == "successfull-ok")
                self::_errorLog("validate job: ".$this->serveroutput->status,3);
            else            
                self::_errorLog("validate job: ".$this->serveroutput->status,1);
            
            return $this->serveroutput->status; 

            }

            $this->status = array_merge($this->status,array("OPERATION FAILED"));
            self::_errorLog("validate job : OPERATION FAILED",3);
            
    return false;
    }
    // }}}
 
    // {{{ getPrinterAttributes()
    public function getPrinterAttributes() {
        
        $this->jobs = array_merge($this->jobs,array(""));
        $this->jobs_uri = array_merge($this->jobs_uri,array(""));

        self::_setOperationId();
        $this->parsed = array();
        unset($this->printer_attributes);
        
        if (!isset($this->setup->uri)) {
            $this->getPrinters();
            unset($this->jobs[count($this->jobs) - 1]);
            unset($this->jobs_uri[count($this->jobs_uri) - 1]);
            unset($this->status[count($this->status) - 1]);
            
            if (array_key_exists(0,$this->available_printers))
               self::setPrinterURI($this->available_printers[0]);
            else {
                trigger_error(_("_stringJob: Printer URI is not set: die"),E_USER_WARNING);
                self::_putDebug( _("_stringJob: Printer URI is not set: die\n"));
                self::_errorLog(" Printer URI is not set, die",2);
                return FALSE;
                }
            }
            
        if (!isset($this->setup->charset))
            self::setCharset('us-ascii');
            
        if (!isset($this->setup->language))
            self::setLanguage('en_us');

        if (!isset($this->meta->username))
            self::setUserName();
       
        $this->stringjob = chr(0x01) . chr(0x01) // 1.1  | version-number
                         . chr(0x00) . chr (0x0b) // Print-URI | operation-id
                         . $this->meta->operation_id //           request-id
                         . chr(0x01) // start operation-attributes | operation-attributes-tag
                         . $this->meta->charset
                         . $this->meta->language
                         . $this->meta->printer_uri
                         . $this->meta->username
                         . chr(0x03); // end-of-attributes | end-of-attributes-tag
                         
        self::_putDebug(sprintf(_("String sent to the server is:\n%s\n"), $this->stringjob));
        
        self::_putDebug(sprintf(_("Getting printer attributes of %s\n"),$this->printer_uri)); 
            
        $this->output = $this->stringjob;
          
        $post_values = array( "Content-Type"=>"application/ipp",
                              "Data"=>$this->output);
            
        if (self::_sendHttp ($post_values,$this->paths['root']))
            if (self::_parseServerOutput())
                self::_parsePrinterAttributes(); 
        
        $this->attributes = &$this->printer_attributes;
        
        if (isset($this->serveroutput) && isset($this->serveroutput->status)) {
            
            $this->status = array_merge($this->status,array($this->serveroutput->status));
            
            if  ($this->serveroutput->status == "successfull-ok")
                self::_errorLog(sprintf(_("getting printer attributes of %s: %s"),$this->printer_uri,
                                                                        $this->serveroutput->status),3);
            else 
                self::_errorLog(sprintf(_("getting printer attributes of %s: %s"),$this->printer_uri,
                                                                        $this->serveroutput->status),1);

            return $this->serveroutput->status;
            }

            $this->status = array_merge($this->status,array("OPERATION FAILED"));
            self::_errorLog(date("Y-m-d H:i:s : ")
                        .basename($_SERVER['PHP_SELF'])
                        .sprintf(_("getting printer's attributes of %s : OPERATION FAILED"),
                                     $this->printer_uri),3);
    
    return false;
    }
    // }}}

    // {{{ getJobs ($my_jobs=true,$limit=0,$which_jobs="");
    public function getJobs($my_jobs=true,$limit=0,$which_jobs="not-completed",$subset=false) {
        
        $this->jobs = array_merge($this->jobs,array(""));
        $this->jobs_uri = array_merge($this->jobs_uri,array(""));

        self::_setOperationId();
        $this->parsed = array();
        unset($this->printer_attributes);
        
        if (!isset($this->setup->uri)) {
            $this->getPrinters();
            unset($this->jobs[count($this->jobs) - 1]);
            unset($this->jobs_uri[count($this->jobs_uri) - 1]);
            unset($this->status[count($this->status) - 1]);
            
            if (array_key_exists(0,$this->available_printers))
               self::setPrinterURI($this->available_printers[0]);
            else {
                trigger_error(_("getJobs: Printer URI is not set: die"),E_USER_WARNING);
                self::_putDebug( _("_stringJob: Printer URI is not set: die\n"));
                self::_errorLog("getJobs: Printer URI is not set, die",2);
                return FALSE;
                }
            }
            
        if (!isset($this->setup->charset))
            self::setCharset('us-ascii');
            
        if (!isset($this->setup->language))
            self::setLanguage('en_us');

        if (!isset($this->meta->username))
            self::setUserName();

        if ($limit) {
            $limit = self::_integerBuild($limit);
            $this->meta->limit = chr(0x21) // integer
                               . self::_giveMeStringLength('limit')
                               . 'limit'
                               . self::_giveMeStringLength($limit)
                               . $limit;
        } else
            $this->meta->limit = '';
        
        if ($which_jobs == 'completed')
                $this->meta->which_jobs = chr(0x44) // keyword
                                        . self::_giveMeStringLength('which-jobs')
                                        . 'which-jobs'
                                        . self::_giveMeStringLength($which_jobs)
                                        . $which_jobs;
        else
            $this->meta->which_jobs = "";

        if ($my_jobs)
            $this->meta->my_jobs = chr(0x22) // boolean
                                 . self::_giveMeStringLength('my-jobs')
                                 . 'my-jobs'
                                 . self::_giveMeStringLength(chr(0x01))
                                 . chr(0x01);
        else
            $this->meta->my_jobs = '';
            
        $this->stringjob = chr(0x01) . chr(0x01) // 1.1  | version-number
                         . chr(0x00) . chr (0x0A) // Get-Jobs | operation-id
                         . $this->meta->operation_id //           request-id
                         . chr(0x01) // start operation-attributes | operation-attributes-tag
                         . $this->meta->charset
                         . $this->meta->language
                         . $this->meta->printer_uri
                         . $this->meta->username
                         . $this->meta->limit
                         . $this->meta->which_jobs 
                         . $this->meta->my_jobs
                         ;
       if ($subset)
           $this->stringjob .=
                          chr(0x44) // keyword
                         . self::_giveMeStringLength('requested-attributes')
                         . 'requested-attributes'
                         . self::_giveMeStringLength('job-uri')
                         . 'job-uri'
                         . chr(0x44) // keyword
                         . self::_giveMeStringLength('')
                         . ''
                         . self::_giveMeStringLength('job-name')
                         . 'job-name'
                         . chr(0x44) // keyword
                         . self::_giveMeStringLength('')
                         . ''
                         . self::_giveMeStringLength('job-state')
                         . 'job-state'
                         . chr(0x44) // keyword
                         . self::_giveMeStringLength('')
                         . ''
                         . self::_giveMeStringLength('job-state-reason')
                         . 'job-state-reason'
                         ;
        $this->stringjob .= chr(0x03); // end-of-attributes | end-of-attributes-tag
                         
        self::_putDebug(sprintf(_("String sent to the server is:\n%s\n"), $this->stringjob));
        
        self::_putDebug(sprintf(_("getting jobs of %s\n"),$this->printer_uri)); 
            
        $this->output = $this->stringjob;
          
        $post_values = array( "Content-Type"=>"application/ipp",
                              "Data"=>$this->output);
            
        if (self::_sendHttp ($post_values,$this->paths['jobs']))
            if (self::_parseServerOutput())
                self::_parseJobsAttributes();
                
        $this->attributes = &$this->jobs_attributes;

        
        if (isset($this->serveroutput) && isset($this->serveroutput->status)) {
            
            $this->status = array_merge($this->status,array($this->serveroutput->status));
            
            if ($this->serveroutput->status == "successfull-ok")
                self::_errorLog(sprintf(_("getting jobs of printer %s: "),$this->printer_uri)
                            .$this->serveroutput->status,3);
            else
                 self::_errorLog(sprintf(_("getting jobs of printer %s: "),$this->printer_uri)
                                             .$this->serveroutput->status,1);
                                             
            return $this->serveroutput->status;
            }    
            
        $this->status = array_merge($this->status,array("OPERATION FAILED"));
        self::_errorLog(date("Y-m-d H:i:s : ")
                        .basename($_SERVER['PHP_SELF'])
                        .sprintf(_("getting jobs of %s : OPERATION FAILED"),
                                     $this->printer_uri),3);
            
    return false;
    }
    // }}}

    // {{{ getJobAttributes ($job_uri,subset="false",$attributes_group="all");
    public function getJobAttributes($job_uri,$subset=false,$attributes_group="all") {
       
        $this->jobs = array_merge($this->jobs,array(""));
        $this->jobs_uri = array_merge($this->jobs_uri,array(""));
        
        if (!$job_uri) {
            trigger_error(_("getJobAttributes: Job URI is not set, die."));
            return FALSE;
            }
 
        self::_setOperationId();
        $this->parsed = array();
        unset($this->printer_attributes);
        
        if (!isset($this->setup->uri)) {
            $this->getPrinters();
            unset($this->jobs[count($this->jobs) - 1]);
            unset($this->jobs_uri[count($this->jobs_uri) - 1]);
            unset($this->status[count($this->status) - 1]);
            
            if (array_key_exists(0,$this->available_printers))
               self::setPrinterURI($this->available_printers[0]);
            else {
                trigger_error(_("getJobs: Printer URI is not set: die"),E_USER_WARNING);
                self::_putDebug( _("_stringJob: Printer URI is not set: die\n"));
                self::_errorLog("getJobs: Printer URI is not set, die",2);
                return FALSE;
                }
            }
            
        if (!isset($this->setup->charset))
            self::setCharset('us-ascii');
            
        if (!isset($this->setup->language))
            self::setLanguage('en_us');

        if (!isset($this->meta->username))
            self::setUserName();

        $this->meta->job_uri = chr(0x45) // URI
                             . self::_giveMeStringLength('job-uri')
                             . 'job-uri'
                             . self::_giveMeStringLength($job_uri)
                             . $job_uri;
           
        $this->stringjob = chr(0x01) . chr(0x01) // 1.1  | version-number
                         . chr(0x00) . chr (0x09) // Get-Job-Attributes | operation-id
                         . $this->meta->operation_id //           request-id
                         . chr(0x01) // start operation-attributes | operation-attributes-tag
                         . $this->meta->charset
                         . $this->meta->language
                         . $this->meta->job_uri
                         . $this->meta->username
                         ;
       if ($subset)
           $this->stringjob .=
                          chr(0x44) // keyword
                         . self::_giveMeStringLength('requested-attributes')
                         . 'requested-attributes'
                         . self::_giveMeStringLength('job-uri')
                         . 'job-uri'
                         . chr(0x44) // keyword
                         . self::_giveMeStringLength('')
                         . ''
                         . self::_giveMeStringLength('job-name')
                         . 'job-name'
                         . chr(0x44) // keyword
                         . self::_giveMeStringLength('')
                         . ''
                         . self::_giveMeStringLength('job-state')
                         . 'job-state'
                         . chr(0x44) // keyword
                         . self::_giveMeStringLength('')
                         . ''
                         . self::_giveMeStringLength('job-state-reason')
                         . 'job-state-reason'
                         ;
        elseif($attributes_group) {
            switch($attributes_group) {
                case 'job-template':
                    break;
                case 'job-description':
                    break;
                case 'all':
                    break;
                default:
                    trigger_error(_('not a valid attribute group: ').$attributes_group,E_USER_NOTICE);
                    $attributes_group = '';
                    break;
                }
            $this->stringjob .=
                          chr(0x44) // keyword
                         . self::_giveMeStringLength('requested-attributes')
                         . 'requested-attributes'
                         . self::_giveMeStringLength($attributes_group)
                         . $attributes_group;
            }
        $this->stringjob .= chr(0x03); // end-of-attributes | end-of-attributes-tag
                         
        self::_putDebug(sprintf(_("String sent to the server is:\n%s\n"), $this->stringjob));
        
        self::_putDebug(sprintf(_("getting jobs of %s\n"),$this->printer_uri)); 
            
        $this->output = $this->stringjob;
          
        $post_values = array( "Content-Type"=>"application/ipp",
                              "Data"=>$this->output);
            
        if (self::_sendHttp ($post_values,$this->paths['jobs']))
            if (self::_parseServerOutput())
                self::_parseJobAttributes();
        
        $this->attributes = &$this->job_attributes;
        
        if (isset($this->serveroutput) && isset($this->serveroutput->status)) {
            
            $this->status = array_merge($this->status,array($this->serveroutput->status));
            
            if ($this->serveroutput->status == "successfull-ok")
                self::_errorLog(sprintf(_("getting job attributes for %s: "),$job_uri)
                            .$this->serveroutput->status,3);
            else
                 self::_errorLog(sprintf(_("getting job attributes dor %s: "),$job_uri)
                                             .$this->serveroutput->status,1);
                                             
            return $this->serveroutput->status;
            }    
            
        $this->status = array_merge($this->status,array("OPERATION FAILED"));
        self::_errorLog(date("Y-m-d H:i:s : ")
                        .basename($_SERVER['PHP_SELF'])
                        .sprintf(_("getting jobs attributes of %s : OPERATION FAILED"),
                                     $job_uri),3);
            
    return false;
    }

    // }}}

    // {{{ getPrinters();
    public function getPrinters() {

        // placeholder for vendor extension operation (getAvailablePrinters for CUPS)
        $this->jobs = array_merge($this->jobs,array(''));
        $this->jobs_uri = array_merge($this->jobs_uri,array(''));
        $this->status = array_merge($this->status,array(''));    
    }
    // }}}    

/******************
*
* DEVELOPPEMENT FUNCTIONS
*
*******************/
 
    // {{{ generateError($error)
    public function generateError ($error) {
        switch ($error) {
            case "request_body_malformed":
                $this->error_generation->request_body_malformed = chr(0xFF);
                break;
            default:
                true;
                break;
            }
    // }}}

    // {{{ resetError ($error)
        trigger_error(sprintf(_('Setting Error %s'),$error),E_USER_NOTICE);
    }
    
    public function resetError ($error) {
        unset ($this->error_generation->$error);
        trigger_error(sprintf(_('Reset Error %s'),$error),E_USER_NOTICE);
    }
    // }}}

/******************
*
* PROTECTED FUNCTIONS
*
*******************/

// HTTP OUTPUT

    // {{{ _sendHttp ($post_values,$uri)
    protected function _sendHttp ($post_values,$uri) {
    /*
        This function Copyright (C) 2005-2006 Thomas Harding, Manuel Lemos  
    */
            
            $this->response_completed[] = "no";       
            unset($this->serverouptut);

            self::_putDebug( _("Processing HTTP request\n\n"));
            
            $this->serveroutput->headers = array();
            $this->serveroutput->body = "";
            
            $http = new http_class;
            
            
            if ($this->debug_http) {
                $http->debug = 1;
                $http->html_debug=0;
            } else {
                $http->debug=0;
                $http->html_debug=0;
            }
            
            $url="http://".$this->host.":".$this->port;
            if ($this->ssl)
                $url="https://".$this->host.":".$this->port;
            
            
            $http->timeout = $this->http_timeout;
            $http->data_timeout= $this->http_data_timeout;
            
            $http->force_multipart_form_post = false;
            $http->user = $this->username;
            $http->password = $this->password;
            
            $error=$http->GetRequestArguments($url,$arguments);
            $arguments["RequestMethod"]="POST";
            $arguments["Headers"] = array("Content-Type" => "application/ipp");
            $arguments["BodyStream"] = array( array("Data" => $post_values["Data"]) );

            if (isset($post_values["File"]))
                $arguments["BodyStream"][]=array("File"=>$post_values["File"]);
            if (isset($post_values["FileType"])
             && !strcmp($post_values["FileType"],"TEXT"))
                 $arguments["BodyStream"][]=array("Data"=>Chr(12));
            
            $arguments["RequestURI"] = $uri;
            
            $error=$http->Open($arguments);
            
            //echo "<pre>";print_r(memory_get_usage());echo "<pre>";
            // ~1.5M

            if($error=="") {
                $error=$http->SendRequest($arguments);
                
                if($error=="") {
                
                    self::_putDebug( "\nH T T P    R E Q U E S T :\n\n");
                    self::_putDebug("Request headers:\n");
                    
                    for(Reset($http->request_headers),$header=0;$header<count($http->request_headers);Next($http->request_headers),$header++) {
                    
                        $header_name=Key($http->request_headers);
                        if(GetType($http->request_headers[$header_name])=="array") {
                             for($header_value=0;$header_value<count($http->request_headers[$header_name]);$header_value++)
                                self::_putDebug( $header_name.": ".$http->request_headers[$header_name][$header_value]."\n");
                        } else
                              self::_putDebug( $header_name.": ".$http->request_headers[$header_name]."\n");
                         
                        }
                    self::_putDebug( "\n\nRequest body:\n");
                    self::_putDebug( htmlspecialchars($http->request_body)
                                 ."\n\n********************\n* END REQUEST BODY *\n********************\n\n");

                         
                    $i = 0;
                    $headers=array();
                    unset($this->serveroutput->headers);
                    $error=$http->ReadReplyHeaders($headers);
                    
                    self::_putDebug( "\nH T T P    R E S P O N S E :\n\n");
                    if($error=="") {
                    
                        "Response headers:\n\n";
                        for(Reset($headers),$header=0;$header<count($headers);Next($headers),$header++) {
                            $header_name=Key($headers);
                            if(GetType($headers[$header_name])=="array") {
                                for($header_value=0;$header_value<count($headers[$header_name]);$header_value++) {
                                    self::_putDebug( $header_name.": ".$headers[$header_name][$header_value]."\n");
                                    $this->serveroutput->headers[$i] = $header_name.": ".$headers[$header_name][$header_value];
                                    $i++;
                                    }
                            } else {
                                self::_putDebug( $header_name.": ".$headers[$header_name]."\r\n");
                                $this->serveroutput->headers[$i] = $header_name.": ".$headers[$header_name];
                                $i++;
                                }
                            }
                             
                        self::_putDebug( "\n\nResponse body:\n");
                        $this->serveroutput->body = "";
                        for(;;) {
                            $error=$http->ReadReplyBody($body,1024);
                            if($error!="" || strlen($body)==0)
                            break;
                            self::_putDebug(htmlentities($body));
                            $this->serveroutput->body .= $body;
                            }
                        }
                        self::_putDebug( "\n\n*********************\n* END RESPONSE BODY *\n*********************\n\n");
                    }
                }
            $http->Close();
            if(strlen($error)) {
                self::_putDebug($error,1);
                trigger_error($error,E_USER_WARNING);
                $this->serveroutput->status = $error;
                return FALSE;
                }
    return true;
    }
    // }}}

// INIT
    
    // {{{ _initTags ()
    protected function _initTags () {
        
        $this->tags_types = array ( "unsupported" => array ("tag" => chr(0x10),
                                                        "build" => ""),
                              "reserved"    => array ("tag" => chr(0x11),
                                                        "build" => ""),
                              "unknown"     => array ("tag" => chr(0x12),
                                                        "build" => ""),
                              "no-value"    => array ("tag" => chr(0x13),
                                                        "build" => "no_value"),
                              "integer"     => array ("tag" => chr(0x21),
                                                        "build" => "integer"),
                              "boolean"     => array ("tag" => chr(0x22),
                                                        "build" => "boolean"),
                              "enum"        => array ("tag" => chr(0x23),
                                                        "build" => "enum"),
                              "octetString" => array ("tag" => chr(0x30),
                                                        "build" => "octet_string"),
                              "datetime"    => array ("tag" => chr(0x31),
                                                        "build" => "datetime"),
                              "resolution"  => array ("tag" => chr(0x32),
                                                        "build" => "resolution"),
                              "rangeOfInteger" => array ("tag" => chr(0x33),
                                                        "build" => "range_of_integers"),
                              "textWithLanguage" => array ("tag" => chr(0x35),
                                                        "build" => "string"),
                              "nameWithLanguage" => array ("tag" => chr(0x36),
                                                        "build" => "string"),
                              /*
                              "text" => array ("tag" => chr(0x40),
                                                        "build" => "string"),
                              "text string" => array ("tag" => chr(0x40),
                                                        "build" => "string"),
                              */
                              "textWithoutLanguage" => array ("tag" => chr(0x41),
                                                        "build" => "string"),
                              "nameWithoutLanguage" => array ("tag" => chr(0x42),
                                                        "buid" => "string"),
                              "keyword"     => array ("tag" => chr(0x44),
                                                        "build" => "string"),
                              "uri"         => array ("tag" => chr(0x45),
                                                        "build" => "string"),
                              "uriScheme"   => array ("tag" => chr(0x46),
                                                        "build" => "string"),
                              "charset"     => array ("tag" => chr(0x47),
                                                        "build" => "string"),
                              "naturalLanguage" => array ("tag" => chr(0x48),
                                                        "build" => "string"),
                              "mimeMediaType" => array ("tag" => chr(0x49),
                                                        "build" => "string"),
                              "extendedAttributes" => array ("tag" => chr(0x7F),
                                                        "build" => "extended"),
                              );
                                                        
 
        $this->operation_tags = array ("compression" => array("tag" => "keyword"),
                                     "document-natural-language" => array("tag" => "naturalLanguage"),
                                     "job-k-octets" => array("tag" => "integer"),
                                     "job-impressions" => array("tag" => "integer"),
                                     "job-media-sheets" => array("tag" => "integer"),
                                     ); 

        $this->job_tags = array (   "job-priority" => array("tag" => "integer"),
                                    "job-hold-until" => array("tag" => "keyword"),
                                    "job-sheets" => array("tag" => "keyword"), //banner page
                                    "multiple-document-handling" => array("tag" => "keyword"),
                                    //"copies" => array("tag" => "integer"), // has its own function
                                    "finishings" => array("tag" => "enum"),
                                    //"page-ranges" => array("tag" => "rangeOfInteger"), // has its own function
                                    //"sides" => array("tag" => "keyword"), // has its own function
                                    "number-up" => array("tag" => "integer"),
                                    "orientation-requested" => array("tag" => "enum"),
                                    "media" => array("tag" => "keyword"),
                                    "printer-resolution" => array("tag" => "resolution"),
                                    "print-quality" => array("tag" => "enum"),
                                    "job-message-from-operator" => array("tag" => "textWithoutLanguage"),
                                    );
    }
    // }}}

// SETUP

    // {{{ _setOperationId ()
    protected function _setOperationId () {
            $prepend = '';
            $this->operation_id += 1;
            $this->meta->operation_id = self::_integerBuild($this->operation_id);
            self::_putDebug( "operation id is: ".$this->operation_id."\n");
    }
    // }}}
    
    // {{{ _setJobId()
    protected function _setJobId() {

        $this->meta->jobid +=1;
        $prepend = '';
        $prepend_length = 4 - strlen($this->meta->jobid);
        for ($i = 0; $i < $prepend_length ; $i++ )
            $prepend .= '0';

    return $prepend.$this->meta->jobid;
    }
    // }}}
    
    // {{{ _setJobUri ($job_uri) 
    protected function _setJobUri ($job_uri) {
       
        $this->meta->job_uri = chr(0x45) // type uri
                             . chr(0x00).chr(0x07) // name-length
                             . "job-uri"
                             //. chr(0x00).chr(strlen($job_uri))
                             . self::_giveMeStringLength($job_uri)
                             . $job_uri;
        
        self::_putDebug( "job-uri is: ".$job_uri."\n");
    }
    // }}}
    
// RESPONSE PARSING

    // {{{ _parseServerOutput ()
    protected function _parseServerOutput () {

        $this->serveroutput->response = array();
        
        if (!self::_parseHttpHeaders ()) return FALSE;
        
        $this->_parsing->offset = 0;
        
        self::_parseIppVersion ();
        self::_parseStatusCode ();
        self::_parseRequestID  ();
        self::_parseResponse ();
        
        //devel
        self::_putDebug( sprintf("***********\nIPP STATUS: %s\n***********\n\n",$this->serveroutput->status));
        self::_putDebug( "***************************** END OF OPERATION *****************************\n\n\n");
       
   return true;
   }
   // }}}
   
    // {{{ _parseHttpHeaders
    protected function _parseHttpHeaders () {
        
        $response = "";
        
        switch ($this->serveroutput->headers[0]) {
            
            case "http/1.1 200 ok: ":
                $this->serveroutput->httpstatus = "HTTP/1.1 200 OK";
                $response = "OK";
                break;
            case "":
                $this->serveroutput->httpstatus = "HTTP/1.1 000 No Response From Server";
                $this->serveroutput->status = "HTTP-ERROR-000_NO_RESPONSE_FROM_SERVER";
                trigger_error("No Response From Server",E_USER_WARNING);
                self::_errorLog("No Response From Server",1);
                $this->disconnected = 1;
                return FALSE;
                break;
            default:
                $server_response = preg_replace("/: $/",'',$this->serveroutput->headers[0]);
                $strings = split(' ',$server_response,3);
                $errno = $strings[1];
                $string = strtoupper(str_replace(' ','_',$strings[2]));
                trigger_error(sprintf(_("server responds %s"),$server_response),E_USER_WARNING);
                self::_errorLog("server responds ".$server_response,1);
                $this->serveroutput->httpstatus = strtoupper($strings[0])." ".$errno." ".ucfirst($strings[2]);
                $this->serveroutput->status = "HTTP-ERROR-".$errno."-".$string;
                $this->disconnected = 1;
                return FALSE;
                break;
            }
        
        unset ($this->serveroutput->headers);
        
    return TRUE;
    }
    // }}}
     
    // {{{ _parseIppVersion ()
    protected function _parseIppVersion () {

        $ippversion = (ord($this->serveroutput->body[ $this->_parsing->offset]) *  256) 
                    +  ord($this->serveroutput->body[$this->_parsing->offset + 1]);
        
        switch($ippversion) {
            case 0x0101:
                $this->serveroutput->ipp_version = "1.1";
                break;
            default:
                $this->serveroutput->ipp_version = sprintf("%u.%u (Unknown)",ord($this->serveroutput->body[ $this->_parsing->offset]) *  256,ord($this->serveroutput->body[$this->_parsing->offset + 1]));
                break;
        }
        
   self::_putDebug( "I P P    R E S P O N S E :\n\n"); 
   self::_putDebug( "IPP version ".$this->serveroutput->body[ $this->_parsing->offset]
                                 .$this->serveroutput->body[$this->_parsing->offset + 1]
                                 .": "
                                 .$this->serveroutput->ipp_version."\n");
    
        $this->_parsing->offset += 2;
    return;
    }
    // }}}

    // {{{ _parseStatusCode ()
    protected function _parseStatusCode () {
        $status_code = (ord($this->serveroutput->body[$this->_parsing->offset]) * 256)
                     +  ord($this->serveroutput->body[$this->_parsing->offset + 1]);
        

        $this->serveroutput->status ="NOT PARSED";
        
        $this->_parsing->offset += 2;
        
        if (strlen($this->serveroutput->body) < $this->_parsing->offset) 
        return false;

        
        if ($status_code < 0x00FF) {
            $this->serveroutput->status = "successfull";
        } elseif ($status_code < 0x01FF) {
            $this->serveroutput->status = "informational";
        } elseif ($status_code < 0x02FF) {
            $this->serveroutput->status = "redirection";
        } elseif ($status_code < 0x04FF) {
            $this->serveroutput->status = "client-error";
        } elseif ($status_code < 0x05FF) {
            $this->serveroutput->status = "server-error";
            }  

        switch ($status_code) {
            case 0x0000:
                $this->serveroutput->status = "successfull-ok";
                break;
            case 0x0001:
                $this->serveroutput->status = "successful-ok-ignored-or-substituted-attributes";
                break;
            case 0x002:
                $this->serveroutput->status = "successful-ok-conflicting-attributes";
                break;
            case 0x0400:
                $this->serveroutput->status = "client-error-bad-request";
                break;
            case 0x0401:
                $this->serveroutput->status = "client-error-forbidden";
                break;
            case 0x0402:
                $this->serveroutput->status = "client-error-not-authenticated";
                break;
            case 0x0403:
                $this->serveroutput->status = "client-error-not-authorized";
                break;
            case 0x0404:
                $this->serveroutput->status = "client-error-not-possible";
                break;
            case 0x0405:
                $this->serveroutput->status = "client-error-timeout";
                break;
            case 0x0406:
                $this->serveroutput->status = "client-error-not-found";
                break;       
            case 0x0407:
                $this->serveroutput->status = "client-error-gone";
                break;      
            case 0x0408:
                $this->serveroutput->status = "client-error-request-entity-too-large";
                break;      
            case 0x0409:
                $this->serveroutput->status = "client-error-request-value-too-long";
                break;      
            case 0x040A:
                $this->serveroutput->status = "client-error-document-format-not-supported";
                break;      
            case 0x040B:
                $this->serveroutput->status = "client-error-attributes-or-values-not-supported";
                break;      
            case 0x040C:
                $this->serveroutput->status = "client-error-uri-scheme-not-supported";
                break;      
            case 0x040D:
                $this->serveroutput->status = "client-error-charset-not-supported";
                break;      
            case 0x040E:
                $this->serveroutput->status = "client-error-conflicting-attributes";
                break;      
            case 0x040F:
                $this->serveroutput->status = "client-error-compression-not-supported";
                break;      
            case 0x0410:
                $this->serveroutput->status = "client-error-compression-error";
                break;      
            case 0x0411:
                $this->serveroutput->status = "client-error-document-format-error";
                break;      
            case 0x0412:
                $this->serveroutput->status = "client-error-document-access-error";
                break;      
            case 0x0413: // RFC3380
                $this->serveroutput->status = "client-error-attributes-not-settable";
                break;
            case 0x0500:
                $this->serveroutput->status = "server-error-internal-error";
                break;      
            case 0x0501:
                $this->serveroutput->status = "server-error-operation-not-supported";
                break;      
            case 0x0502:
                $this->serveroutput->status = "server-error-service-unavailable";
                break;      
            case 0x0503:
                $this->serveroutput->status = "server-error-version-not-supported";
                break;      
            case 0x0504:
                $this->serveroutput->status = "server-error-device-error";
                break;      
            case 0x0505:
                $this->serveroutput->status = "server-error-temporary-error";
                break;      
            case 0x0506:
                $this->serveroutput->status = "server-error-not-accepting-jobs";
                break;      
            case 0x0507:
                $this->serveroutput->status = "server-error-busy";
                break;      
            case 0x0508:
                $this->serveroutput->status = "server-error-job-canceled";
                break;      
            case 0x0509:
                $this->serveroutput->status = "server-error-multiple-document-jobs-not-supported";
                break;      
            default:
                break;
        }
        
    
    self::_putDebug( "status-code ".$this->serveroutput->body[$this->_parsing->offset]
                                  .$this->serveroutput->body[$this->_parsing->offset + 1]
                                  .": "
                                  .$this->serveroutput->status."\n");
        
    return;
    }
    // }}}

    // {{{ _parseRequestID ()
    protected function _parseRequestID () {
        
        $this->serveroutput->request_id = self::_interpretInteger(substr($this->serveroutput->body,$this->_parsing->offset,4));
        self::_putDebug( "request-id ". $this->serveroutput->request_id);
        $this->_parsing->offset += 4;

    return;    
    }
    // }}}

   // {{{ _parseResponse ()
   protected function _parseResponse () {
        $j = -1;
        $this->index = 0;
        for ($i = $this->_parsing->offset; $i < strlen($this->serveroutput->body) ; $i = $this->_parsing->offset) {
        
        
            $tag = ord($this->serveroutput->body[$this->_parsing->offset]);
            
            
            if ($tag > 0x0F) {
                
                self::_readAttribute($j);
                $this->index ++;
                continue;
                }

            switch ($tag) {
                case 0x01:
                    $j += 1;
                    $this->serveroutput->response[$j]['attributes'] = "operation-attributes";
                    $this->index = 0;
                    $this->_parsing->offset += 1;
                    break;
                case 0x02:
                    $j += 1;
                    $this->serveroutput->response[$j]['attributes'] = "job-attributes";
                    $this->index = 0;
                    $this->_parsing->offset += 1;
                    break;
                case 0x03:
                    $j +=1;
                    $this->serveroutput->response[$j]['attributes'] = "end-of-attributes";
                    self::_putDebug( "tag is: ".$this->serveroutput->response[$j]['attributes']."\n");
                    if ($this->alert_on_end_tag === 1)
                        echo "END tag OK<br />";
                    $this->response_completed[(count($this->response_completed) -1)] = "completed";
                    return;
                case 0x04:
                    $j += 1;
                    $this->serveroutput->response[$j]['attributes'] = "printer-attributes";
                    $this->index = 0;
                    $this->_parsing->offset += 1;
                    break;
                case 0x05:
                    $j += 1;
                    $this->serveroutput->response[$j]['attributes'] = "unsupported-attributes";
                    $this->index = 0;
                    $this->_parsing->offset += 1;
                    break;
                default:
                    $j += 1;
                    $this->serveroutput->response[$j]['attributes'] = sprintf(_("0x%x (%u) : attributes tag Unknown (reserved for future versions of IPP"),$tag,$tag);
                    $this->index = 0;
                    $this->_parsing->offset += 1;
                    break;
                }
        
         self::_putDebug( "tag is: ".$this->serveroutput->response[$j]['attributes']."\n\n\n");
    
        }  
    return;        
    }
    // }}}
   
    // {{{ _readAttribute($attributes_type,$ji,&$collection=false)
    protected function _readAttribute($attributes_type) {
        
            $tag = ord($this->serveroutput->body[$this->_parsing->offset]);
            
            $this->_parsing->offset += 1;
            $j = $this->index;
            
            $tag = self::_readTag($tag);

            switch ($tag) {
                 case "begCollection": //RFC3382 (BLIND CODE)
                    if ($this->end_collection)
                        $this->index --;
                    $this->end_collection = false;
                    $this->serveroutput->response[$attributes_type][$j]['type'] = "collection";
                    self::_putDebug( "tag is: begCollection\n");
                    self::_readAttributeName ($attributes_type,$j);
                    if (!$this->serveroutput->response[$attributes_type][$j]['name']) { // it is a multi-valued collection
                        $this->collection_depth ++;
                        $this->index --;
                        $this->collection_nbr[$this->collection_depth] ++;
                    } else {
                        $this->collection_depth ++;
                        if ($this->collection_depth == 0)
                            $this->collection = (object) 'collection';
                        if (array_key_exists($this->collection_depth,$this->collection_nbr))
                            $this->collection_nbr[$this->collection_depth] ++;
                        else
                            $this->collection_nbr[$this->collection_depth] = 0;
                        unset($this->end_collection);
                        
                        }
                    self::_readValue ("begCollection",$attributes_type,$j);
                    break;
                 case "endCollection": //RFC3382 (BLIND CODE)
                    $this->serveroutput->response[$attributes_type][$j]['type'] = "collection";
                    self::_putDebug( "tag is: endCollection\n");
                    self::_readAttributeName ($attributes_type,$j,0);
                    self::_readValue ('name',$attributes_type,$j,0);
                    $this->collection_depth --;
                    $this->collection_key[$this->collection_depth] = 0;
                    $this->end_collection = true;
                    break;
                 case "memberAttrName": // RFC3382 (BLIND CODE)
                    $this->serveroutput->response[$attributes_type][$j]['type'] = "memberAttrName";
                    $this->index -- ;
                    self::_putDebug( "tag is: memberAttrName\n");
                    self::_readCollection ($attributes_type,$j);
                    break;
 
                default:
                    $this->collection_depth = -1;
                    $this->collection_key = array();
                    $this->collection_nbr = array();
                    $this->serveroutput->response[$attributes_type][$j]['type'] = $tag;
                    self::_putDebug( "tag is: $tag\n");
                    $attribute_name = self::_readAttributeName ($attributes_type,$j);
                    if (!$attribute_name)
                        $attribute_name = $this->attribute_name;
                    else
                        $this->attribute_name = $attribute_name;
                    $value = self::_readValue ($tag,$attributes_type,$j);
                    $this->serveroutput->response[$attributes_type][$j]['value'] = 
                        self::_interpretAttribute($attribute_name,$tag,$this->serveroutput->response[$attributes_type][$j]['value']);
                    break;
                
            }
    return;
    }
    // }}}

    // {{{  _readTag($tag)
    protected function _readTag($tag) {

            switch ($tag) {
                case 0x10:
                    $tag = "unsupported";
                    break;
                case 0x11:
                    $tag = "reserved for 'default'";
                    break;
                case 0x12:
                    $tag = "unknown";
                    break;
                case 0x13:
                    $tag = "no-value";
                    break;
                case 0x15: // RFC 3380
                    $tag = "not-settable";
                    break;
                case 0x16: // RFC 3380
                    $tag = "delete-attribute";
                    break;
                case 0x17: // RFC 3380
                    $tag = "admin-define";
                    break;
                case 0x20:
                    $tag = "IETF reserved (generic integer)";
                    break;
                case 0x21:
                    $tag = "integer";
                    break;
                case 0x22:
                    $tag = "boolean";
                    break;
                case 0x23:
                    $tag = "enum";
                    break;
                case 0x30:
                    $tag = "octetString";
                    break;
                case 0x31:
                    $tag = "datetime";
                    break;
                 case 0x32:
                    $tag = "resolution";
                    break;
                 case 0x33:
                    $tag = "rangeOfInteger";
                    break;
                 case 0x34: //RFC3382 (BLIND CODE)
                    $tag = "begCollection";
                    break;
                 case 0x35:
                    $tag = "textWithLanguage";
                    break;
                 case 0x36:
                    $tag = "nameWithLanguage";
                    break;
                 case 0x37: //RFC3382 (BLIND CODE)
                    $tag = "endCollection";
                    break;
                 case 0x40:
                    $tag = "IETF reserved text string";
                    break;
                 case 0x41:
                    $tag = "textWithoutLanguage";
                    break;
                 case 0x42:
                    $tag = "nameWithoutLanguage";
                    break;
                 case 0x43:
                    $tag = "IETF reserved for future";
                    break;
                 case 0x44:
                    $tag = "keyword";
                    break;
                 case 0x45:
                    $tag = "uri";
                    break;
                 case 0x46:
                    $tag = "uriScheme";
                    break;
                 case 0x47:
                    $tag = "charset";
                    break;
                 case 0x48:
                    $tag = "naturalLanguage";
                    break;
                 case 0x49:
                    $tag = "mimeMediaType";
                    break;
                 case 0x4A: // RFC3382 (BLIND CODE)
                    $tag = "memberAttrName";
                    break;
                  case 0x7F:
                    $tag = "extended type";
                    break;
                 default:
                 
                    if ($tag >= 0x14 && $tag < 0x15 && $tag > 0x17 && $tag <= 0x1f) 
                        $tag = "out-of-band";
                    elseif (0x24 <= $tag && $tag <= 0x2f) 
                        $tag = "new integer type";
                    elseif (0x38 <= $tag && $tag <= 0x3F) 
                        $tag = "new octet-stream type";
                    elseif (0x4B <= $tag && $tag <= 0x5F) 
                        $tag = "new character string type";
                    elseif ((0x60 <= $tag && $tag < 0x7f) || $tag >= 0x80 )
                        $tag = "IETF reserved for future";
                    else
                        $tag = sprintf("UNKNOWN: 0x%x (%u)",$tag,$tag);
                        
                    break;                                                            
                }
    return $tag; 
    }
    // }}}

    // {{{ _readCollection($attributes_type,$j,&$collection)
    protected function _readCollection($attributes_type,$j) {
       
        $name_length = ord($this->serveroutput->body[$this->_parsing->offset]) *  256
                     +  ord($this->serveroutput->body[$this->_parsing->offset + 1]);
        
        $this->_parsing->offset += 2;
        
        self::_putDebug( "Collection name_length ". $name_length ."\n");
        
        $name = '';
        for ($i = 0; $i < $name_length; $i++) {
            $name .= $this->serveroutput->body[$this->_parsing->offset];
            $this->_parsing->offset += 1;
            if ($this->_parsing->offset > strlen($this->serveroutput->body))
                return;
            }
        
        $collection_name = $name;
        
        $name_length = ord($this->serveroutput->body[$this->_parsing->offset]) *  256
                     +  ord($this->serveroutput->body[$this->_parsing->offset + 1]);
        $this->_parsing->offset += 2;
        
        self::_putDebug( "Attribute name_length ". $name_length ."\n");
        
        $name = '';
        for ($i = 0; $i < $name_length; $i++) {
            $name .= $this->serveroutput->body[$this->_parsing->offset];
            $this->_parsing->offset += 1;
            if ($this->_parsing->offset > strlen($this->serveroutput->body))
                return;
            }
        
        $attribute_name = $name;
        if ($attribute_name == "") {
            $attribute_name = $this->last_attribute_name;
            $this->collection_key[$this->collection_depth] ++;
        } else {
            $this->collection_key[$this->collection_depth] = 0;
        }
        $this->last_attribute_name = $attribute_name;
        
        self::_putDebug( "Attribute name ".$name."\n");
        
        $tag = self::_readTag(ord($this->serveroutput->body[$this->_parsing->offset]));
        $this->_parsing->offset ++;
        
        $type = $tag;
        
        $name_length = ord($this->serveroutput->body[$this->_parsing->offset]) *  256
                     +  ord($this->serveroutput->body[$this->_parsing->offset + 1]);
        $this->_parsing->offset += 2;
        
        self::_putDebug( "Collection2 name_length ". $name_length ."\n");
        
        $name = '';
        for ($i = 0; $i < $name_length; $i++) {
            $name .= $this->serveroutput->body[$this->_parsing->offset];
            $this->_parsing->offset += 1;
            if ($this->_parsing->offset > strlen($this->serveroutput->body))
                return;
            }
        
        $collection_value = $name;
        $value_length = ord($this->serveroutput->body[$this->_parsing->offset]) *  256
                      +  ord($this->serveroutput->body[$this->_parsing->offset + 1]);
        
        self::_putDebug( "Collection value_length ".$this->serveroutput->body[ $this->_parsing->offset]
                                       . $this->serveroutput->body[$this->_parsing->offset + 1]
                                       .": "
                                       . $value_length
                                       . " ");
        
        $this->_parsing->offset += 2;
        
        $value = '';
        for ($i = 0; $i < $value_length; $i++) {
            
            if ($this->_parsing->offset >= strlen($this->serveroutput->body))
                return;
            $value .= $this->serveroutput->body[$this->_parsing->offset];
            $this->_parsing->offset += 1;
            
            }
        
        $object = &$this->collection;
        for ($i = 0 ; $i <= $this->collection_depth ; $i ++) {
            $indice = "_indice".$this->collection_nbr[$i];
            if (!isset($object->$indice))
                $object->$indice = (object) 'indice';
            $object = &$object->$indice;
            }
         
        $value_key = "_value".$this->collection_key[$this->collection_depth];
        $col_name_key = "_collection_name".$this->collection_key[$this->collection_depth];
        $col_val_key = "_collection_value".$this->collection_key[$this->collection_depth];
        
        $attribute_value = self::_interpretAttribute($attribute_name,$tag,$value);
        $attribute_name = str_replace('-','_',$attribute_name);
        
        
        self::_putDebug( sprintf("Value: %s\n",$value));
        $object->$attribute_name->_type = $type;
        $object->$attribute_name->$value_key = $attribute_value;
        $object->$attribute_name->$col_name_key = $collection_name;
        $object->$attribute_name->$col_val_key = $collection_value;
        
    $this->serveroutput->response[$attributes_type][$j]['value'] = $this->collection;
    }
    // }}}
    
    // {{{ _readAttributeName ($attributes_type,$j)
    protected function _readAttributeName ($attributes_type,$j,$write=1) {

        $name_length = ord($this->serveroutput->body[ $this->_parsing->offset]) *  256
                     +  ord($this->serveroutput->body[$this->_parsing->offset + 1]);
        $this->_parsing->offset += 2;
        
        self::_putDebug( "name_length ". $name_length ."\n");
        
        $name = '';
        for ($i = 0; $i < $name_length; $i++) {
            if ($this->_parsing->offset >= strlen($this->serveroutput->body))
                return;
            $name .= $this->serveroutput->body[$this->_parsing->offset];
            $this->_parsing->offset += 1;
            }
        
        if($write)
        $this->serveroutput->response[$attributes_type][$j]['name'] = $name;

        self::_putDebug( "name " . $name . "\n");
    
    return $name;   
    }
    // }}}

    // {{{ _readValue ($type,$attributes_type,$j)
    protected function _readValue ($type,$attributes_type,$j,$write=1) {

        $value_length = ord($this->serveroutput->body[$this->_parsing->offset]) *  256
                      +  ord($this->serveroutput->body[$this->_parsing->offset + 1]);
        
        self::_putDebug( "value_length ".$this->serveroutput->body[ $this->_parsing->offset]
                                       . $this->serveroutput->body[$this->_parsing->offset + 1]
                                       .": "
                                       . $value_length
                                       . " ");
        
        $this->_parsing->offset += 2;
        
        $value = '';
        for ($i = 0; $i < $value_length; $i++) {
            
            if ($this->_parsing->offset >= strlen($this->serveroutput->body))
                return;
            $value .= $this->serveroutput->body[$this->_parsing->offset];
            $this->_parsing->offset += 1;
            
            }
            
        self::_putDebug( sprintf("Value: %s\n",$value));
        
        if ($write)
        $this->serveroutput->response[$attributes_type][$j]['value'] = $value;

    return $value;
    }
    // }}}

    // {{{ _parseAttributes()
    protected function _parseAttributes() {
 
        $k = -1;
        for ($i = 0 ; $i < count($this->serveroutput->response) ; $i++)
            for ($j = 0 ; $j < (count($this->serveroutput->response[$i]) - 1) ; $j ++)
                if (!empty($this->serveroutput->response[$i][$j]['name'])) {
                    $k++;
                    $l = 0;
                    $this->parsed[$k]['range'] = $this->serveroutput->response[$i]['attributes'];
                    $this->parsed[$k]['name'] = $this->serveroutput->response[$i][$j]['name'];
                    $this->parsed[$k]['type'] = $this->serveroutput->response[$i][$j]['type'];
                    $this->parsed[$k][$l] = $this->serveroutput->response[$i][$j]['value'];
                } else {
                    $l ++;
                    $this->parsed[$k][$l] = $this->serveroutput->response[$i][$j]['value'];
                    }
        $this->serveroutput->response = array();
        
        for ($i = 0 ; $i < count($this->parsed) ; $i ++) {
                    $name = $this->parsed[$i]['name'];
                    $php_name = str_replace('-','_',$name);
                    $type = $this->parsed[$i]['type'];
                    $range = $this->parsed[$i]['range'];
                    $this->attributes->$php_name->_type = $type;
                    $this->attributes->$php_name->_range = $range;
                    for ($j = 0 ; $j < (count($this->parsed[$i]) - 3) ; $j ++) {
                        $value = $this->parsed[$i][$j];
                        $index = '_value'.$j;
                        $this->attributes->$php_name->$index = $value;
                        }
                    }
                    
        $this->parsed = array();
    
    }
    // }}}
    
    // {{{ _parsePrinterAttributes()
    protected function _parsePrinterAttributes() {

        //if (!preg_match('#successful#',$this->serveroutput->status))
        //   return false;

        $k = -1;
        for ($i = 0 ; $i < count($this->serveroutput->response) ; $i++)
            for ($j = 0 ; $j < (count($this->serveroutput->response[$i]) - 1) ; $j ++)
                if (!empty($this->serveroutput->response[$i][$j]['name'])) {
                    $k++;
                    $l = 0;
                    $this->parsed[$k]['range'] = $this->serveroutput->response[$i]['attributes'];
                    $this->parsed[$k]['name'] = $this->serveroutput->response[$i][$j]['name'];
                    $this->parsed[$k]['type'] = $this->serveroutput->response[$i][$j]['type'];
                    $this->parsed[$k][$l] = $this->serveroutput->response[$i][$j]['value'];
                } else {
                    $l ++;
                    $this->parsed[$k][$l] = $this->serveroutput->response[$i][$j]['value'];
                    }
        $this->serveroutput->response = array();
        
        for ($i = 0 ; $i < count($this->parsed) ; $i ++) {
                    $name = $this->parsed[$i]['name'];
                    $php_name = str_replace('-','_',$name);
                    $type = $this->parsed[$i]['type'];
                    $range = $this->parsed[$i]['range'];
                    $this->printer_attributes->$php_name->_type = $type;
                    $this->printer_attributes->$php_name->_range = $range;
                    for ($j = 0 ; $j < (count($this->parsed[$i]) - 3) ; $j ++) {
                        $value = $this->parsed[$i][$j];
                        $index = '_value'.$j;
                        $this->printer_attributes->$php_name->$index = $value;
                        }
                    }
                    
        $this->parsed = array();
                
         
    }
    // }}}

    // {{{ _parseJobAttributes()
    protected function _parseJobAttributes() {

        //if (!preg_match('#successful#',$this->serveroutput->status))
        //    return false;
        
        $k = -1;
        for ($i = 0 ; $i < count($this->serveroutput->response) ; $i++)
            for ($j = 0 ; $j < (count($this->serveroutput->response[$i]) - 1) ; $j ++)
                if (!empty($this->serveroutput->response[$i][$j]['name'])) {
                    $k++;
                    $l = 0;
                    $this->parsed[$k]['range'] = $this->serveroutput->response[$i]['attributes'];
                    $this->parsed[$k]['name'] = $this->serveroutput->response[$i][$j]['name'];
                    $this->parsed[$k]['type'] = $this->serveroutput->response[$i][$j]['type'];
                    $this->parsed[$k][$l] = $this->serveroutput->response[$i][$j]['value'];
                } else {
                    $l ++;
                    $this->parsed[$k][$l] = $this->serveroutput->response[$i][$j]['value'];
                    }
        
        $this->serveroutput->response = array();
        
        for ($i = 0 ; $i < count($this->parsed) ; $i ++) {
                    $name = $this->parsed[$i]['name'];
                    $php_name = str_replace('-','_',$name);
                    $type = $this->parsed[$i]['type'];
                    $range = $this->parsed[$i]['range'];
                    $this->job_attributes->$php_name->_type = $type;
                    $this->job_attributes->$php_name->_range = $range;
                    for ($j = 0 ; $j < (count($this->parsed[$i]) - 3) ; $j ++) {
                        $value = $this->parsed[$i][$j];
                        $index = '_value'.$j;
                        $this->job_attributes->$php_name->$index = $value;
                        }
                    }
                    
        $this->parsed = array();
                
         
    }
    // }}}

    // {{{ _parseJobsAttributes()
    protected function _parseJobsAttributes() {

        //if ($this->serveroutput->status != "successfull-ok")
        //    return false;
        
        $job = -1;
        for ($i = 0 ; $i < count($this->serveroutput->response) ; $i++) {
            if ($this->serveroutput->response[$i]['attributes'] == "job-attributes")
                $job ++;
            $k = -1; 
            for ($j = 0 ; $j < (count($this->serveroutput->response[$i]) - 1) ; $j ++)
                if (!empty($this->serveroutput->response[$i][$j]['name'])) {
                    $k++;
                    $l = 0;
                    $this->parsed[$job][$k]['range'] = $this->serveroutput->response[$i]['attributes'];
                    $this->parsed[$job][$k]['name'] = $this->serveroutput->response[$i][$j]['name'];
                    $this->parsed[$job][$k]['type'] = $this->serveroutput->response[$i][$j]['type'];
                    $this->parsed[$job][$k][$l] = $this->serveroutput->response[$i][$j]['value'];
                } else {
                    $l ++;
                    $this->parsed[$job][$k][$l] = $this->serveroutput->response[$i][$j]['value'];
                    }
            }
        
        $this->serveroutput->response = array();
        
        for ($job_nbr = 0 ; $job_nbr <= $job ; $job_nbr ++) {
            $job_index = "job_".$job_nbr;
            for ($i = 0 ; $i < count($this->parsed[$job_nbr]) ; $i ++) {
                    $name = $this->parsed[$job_nbr][$i]['name'];
                    $php_name = str_replace('-','_',$name);
                    $type = $this->parsed[$job_nbr][$i]['type'];
                    $range = $this->parsed[$job_nbr][$i]['range'];
                    $this->jobs_attributes->$job_index->$php_name->_type = $type;
                    $this->jobs_attributes->$job_index->$php_name->_range = $range;
                    for ($j = 0 ; $j < (count($this->parsed[$job_nbr][$i]) - 3) ; $j ++) {
                        $value = self::_interpretAttribute($name,$type,$this->parsed[$job_nbr][$i][$j]);
                        $index = '_value'.$j;
                        $this->jobs_attributes->$job_index->$php_name->$index = $value;
                        }
                    }
            }
            
        $this->parsed = array();
                
         
    }
    // }}}

    // {{{ _interpretAttribute($attribute_name,$type,$value)
    protected function _interpretAttribute($attribute_name,$type,$value) {
        
        switch ($type) {
            case "integer":
                $value = self::_interpretInteger($value);
                break;
            case "rangeOfInteger":
                $value = self::_interpretRangeOfInteger($value);
                break;
            case 'boolean':
                $value = ord($value);
                if ($value == 0x00)
                    $value = 'false';
                else
                    $value = 'true';
                break;
            case 'datetime':
                $value = self::_interpretDateTime($value);
                break;
            case 'enum':
                $value = $this->_interpretEnum($attribute_name,$value); // must be overwritten by children
                break;
            case 'resolution':
                $unit = $value[8];
                $value = self::_interpretRangeOfInteger(substr($value,0,8));
                switch($unit) {
                    case chr(0x03):
                        $unit = "dpi";
                        break;
                    case chr(0x04):
                        $unit = "dpc";
                        break;
                    }
                $value = $value." ".$unit;
                break;
            default:
                break;
                }
    return $value;
    }
    // }}}
    
    // {{{ _interpretInteger($value)
    protected function _interpretInteger($value) {

        // they are _signed_ integers
        $value_parsed = 0;
        
        for ($i = strlen($value) ; $i > 0 ; $i --) 
            $value_parsed += (1 << (($i - 1)*8)) * ord($value[strlen($value) - $i]);
       if ($value_parsed >= 2147483648)
        $value_parsed -= 4294967296;
    return $value_parsed;
    }
    // }}}
    
    // {{{ _interpretRangeOfInteger($value)
    protected function _interpretRangeOfInteger($value) {
        
        $value_parsed = 0;
        $integer1 = $integer2 = 0;
        
        $halfsize = strlen($value) / 2;
       
        $integer1 = self::_interpretInteger(substr($value,0,$halfsize));
        $integer2 = self::_interpretInteger(substr($value,$halfsize,$halfsize));
         
        $value_parsed = sprintf('%s-%s',$integer1,$integer2);
        
        
    return $value_parsed;
    }
    // }}}
 
    // {{{ _interpretDateTime($date) {
    protected function _interpretDateTime($date) {
        $year = self::_interpretInteger(substr($date,0,2));
        $month =  self::_interpretInteger(substr($date,2,1));
        $day =  self::_interpretInteger(substr($date,3,1));
        $hour =  self::_interpretInteger(substr($date,4,1));
        $minute =  self::_interpretInteger(substr($date,5,1));
        $second =  self::_interpretInteger(substr($date,6,1));
        $direction = substr($date,8,1);
        $hours_from_utc = self::_interpretInteger(substr($date,9,1));
        $minutes_from_utc = self::_interpretInteger(substr($date,10,1));
        
        $date = sprintf('%s-%s-%s %s:%s:%s %s%s:%s',$year,$month,$day,$hour,$minute,$second,$direction,$hours_from_utc,$minutes_from_utc);

    return $date;
    }   
    // }}}
    
    // {{{ _interpretEnum()
    protected function _interpretEnum($attribute_name,$value) {
        
        $value_parsed = self::_interpretInteger($value);
        
        switch ($attribute_name) {
            case 'job-state':
                switch ($value_parsed) {
                    case 0x03:
                        $value = 'pending';
                        break;
                    case 0x04:
                        $value = 'pending-held';
                        break;
                    case 0x05:
                        $value = 'processing';
                        break;
                    case 0x06:
                        $value = 'processing-stopped';
                        break;
                    case 0x07:
                        $value = 'canceled';
                        break;
                    case 0x08:
                        $value = 'aborted';
                        break;
                    case 0x09:
                        $value = 'completed';
                        break;
                    }
                if ($value_parsed > 0x09)
                    $value = sprintf('Unknown(IETF standards track "job-state" reserved): 0x%x',$value_parsed);
                break;
            case 'print-quality':
            case 'print-quality-supported':
            case 'print-quality-default':
                switch ($value_parsed) {
                    case 0x03:
                        $value = 'draft';
                        break;
                    case 0x04:
                        $value = 'normal';
                        break;
                    case 0x05:
                        $value = 'high';
                        break;
                    }
                break;
            case 'printer-state':
                switch ($value_parsed) {
                    case 0x03:
                        $value = 'idle';
                        break;
                    case 0x04:
                        $value = 'processing';
                        break;
                    case 0x05:
                        $value = 'stopped';
                        break;
                    }
                if ($value_parsed > 0x05)
                    $value = sprintf('Unknown(IETF standards track "printer-state" reserved): 0x%x',$value_parsed);
                break;
            
            case 'operations-supported':
                switch($value_parsed) {
                    case 0x0000:
                    case 0x0001:
                        $value = sprintf('Unknown(reserved) : %s',ord($value));
                        break;
                    case 0x0002:
                        $value = 'Print-Job';
                        break;
                    case 0x0003:
                        $value = 'Print-URI';
                        break;
                    case 0x0004:
                        $value = 'Validate-Job';
                        break;
                    case 0x0005:
                        $value = 'Create-Job';
                        break;
                    case 0x0006:
                        $value = 'Send-Document';
                        break;
                    case 0x0007:
                        $value = 'Send-URI';
                        break;
                    case 0x0008:
                        $value = 'Cancel-Job';
                        break;
                    case 0x0009:
                        $value = 'Get-Job-Attributes';
                        break;
                    case 0x000A:
                        $value = 'Get-Jobs';
                        break;
                    case 0x000B:
                        $value = 'Get-Printer-Attributes';
                        break;
                    case 0x000C:
                        $value = 'Hold-Job';
                        break;
                    case 0x000D:
                        $value = 'Release-Job';
                        break;
                    case 0x000E:
                        $value = 'Restart-Job';
                        break;
                    case 0x000F:
                        $value = 'Unknown(reserved for a future operation)';
                        break;
                    case 0x0010:
                        $value = 'Pause-Printer';
                        break;
                    case 0x0011:
                        $value = 'Resume-Printer';
                        break;
                    case 0x0012:
                        $value = 'Purge-Jobs';
                        break;
                    case 0x0013:
                        $value = 'Set-Printer-Attributes'; // RFC3380
                        break;
                    case 0x0014:
                        $value = 'Set-Job-Attributes'; // RFC3380
                        break;
                    case 0x0015:
                        $value = 'Get-Printer-Supported-Values'; // RFC3380
                        break;
                    case 0x0016:
                        $value = 'Create-Printer-Subscriptions';
                        break;
                    case 0x0017:
                        $value = 'Create-Job-Subscriptions';
                        break;
                    case 0x0018:
                        $value = 'Get-Subscription-Attributes';
                        break;
                    case 0x0019:
                        $value = 'Get-Subscriptions';
                        break;
                    case 0x001A:
                        $value = 'Renew-Subscription';
                        break;
                    case 0x001B:
                        $value = 'Cancel-Subscription';
                        break;
                    case 0x001C:
                        $value = 'Get-Notifications';
                        break;
                    case 0x001D:
                        $value = sprintf('Unknown (reserved IETF "operations"): 0x%x',ord($value));
                        break;
                    case 0x001E:
                        $value = sprintf('Unknown (reserved IETF "operations"): 0x%x',ord($value));
                        break;
                    case 0x001F:
                        $value = sprintf('Unknown (reserved IETF "operations"): 0x%x',ord($value));
                        break;
                    case 0x0020:
                        $value = sprintf('Unknown (reserved IETF "operations"): 0x%x',ord($value));
                        break;
                    case 0x0021:
                        $value = sprintf('Unknown (reserved IETF "operations"): 0x%x',ord($value));
                        break;
                    case 0x0022: 
                        $value = 'Enable-Printer';
                        break;
                    case 0x0023: 
                        $value = 'Disable-Printer';
                        break;
                    case 0x0024: 
                        $value = 'Pause-Printer-After-Current-Job';
                        break;
                    case 0x0025: 
                        $value = 'Hold-New-Jobs';
                        break;
                    case 0x0026: 
                        $value = 'Release-Held-New-Jobs';
                        break;
                    case 0x0027: 
                        $value = 'Deactivate-Printer';
                        break;
                    case 0x0028: 
                        $value = 'Activate-Printer';
                        break;
                    case 0x0029: 
                        $value = 'Restart-Printer';
                        break;
                    case 0x002A: 
                        $value = 'Shutdown-Printer';
                        break;
                    case 0x002B: 
                        $value = 'Startup-Printer';
                        break;
                }
                if ($value_parsed > 0x002B && $value_parsed <= 0x3FFF)
                    $value = sprintf('Unknown(IETF standards track operations reserved): 0x%x',$value_parsed);
                elseif ($value_parsed >= 0x4000 && $value_parsed <= 0x8FFF) {
                    if (method_exists($this,'_getEnumVendorExtensions')) {
                        $value = $this->_getEnumVendorExtensions($value_parsed);
                    } else
                        $value = sprintf('Unknown(Vendor extension for operations): 0x%x',$value_parsed);
                } elseif ($value_parsed > 0x8FFF)
                    $value = sprintf('Unknown operation (should not exists): 0x%x',$value_parsed);
                
                break;
            case 'finishings':
            case 'finishings-default':
            case 'finishings-supported':
                switch ($value_parsed) {
                    case 3:
                        $value = 'none';
                        break;
                    case 4:
                        $value = 'staple';
                        break;
                    case 5:
                        $value = 'punch';
                        break;
                    case 6:
                        $value = 'cover';
                        break;
                    case 7:
                        $value = 'bind';
                        break;
                    case 8:
                        $value = 'saddle-stitch';
                        break;
                    case 9:
                        $value = 'edge-stitch';
                        break;
                    case 20:
                        $value = 'staple-top-left';
                        break;
                    case 21:
                        $value = 'staple-bottom-left';
                        break;
                    case 22:
                        $value = 'staple-top-right';
                        break;
                    case 23:
                        $value = 'staple-bottom-right';
                        break;
                    case 24:
                        $value = 'edge-stitch-left';
                        break;
                    case 25:
                        $value = 'edge-stitch-top';
                        break;
                    case 26:
                        $value = 'edge-stitch-right';
                        break;
                    case 27:
                        $value = 'edge-stitch-bottom';
                        break;
                    case 28:
                        $value = 'staple-dual-left';
                        break;
                    case 29:
                        $value = 'staple-dual-top';
                        break;
                    case 30:
                        $value = 'staple-dual-right';
                        break;
                    case 31:
                        $value = 'staple-dual-bottom';
                        break;
                    }
                if ($value_parsed > 31)
                    $value = sprintf('Unknown(IETF standards track "finishing" reserved): 0x%x',$value_parsed);
                break;
            
            case 'orientation-requested':
            case 'orientation-requested-supported':
            case 'orientation-requested-default':
                switch ($value_parsed) {
                    case 0x03:
                        $value = 'portrait';
                        break;
                    case 0x04:
                        $value = 'landscape';
                        break;
                    case 0x05:
                        $value = 'reverse-landscape';
                        break;
                    case 0x06:
                        $value = 'reverse-portrait';
                        break;
                    }
                if ($value_parsed > 0x06)
                    $value = sprintf('Unknown(IETF standards track "orientation" reserved): 0x%x',$value_parsed);
                break;
                
            default:
                break;
            }
    return $value;
    }
    // }}}
 
    // {{{ _getJobId ()
    protected function _getJobId () {
        
        if (!isset($this->serveroutput->response))
            $this->jobs = array_merge($this->jobs,array('NO JOB'));
        
        $jobfinded = false;
        for ($i = 0 ; (!$jobfinded && array_key_exists($i,$this->serveroutput->response)) ; $i ++)
            if (($this->serveroutput->response[$i]['attributes']) == "job-attributes")
                for ($j = 0 ; array_key_exists($j,$this->serveroutput->response[$i]) ; $j++)
                    if ($this->serveroutput->response[$i][$j]['name'] == "job-id") {
                        $this->last_job = $this->serveroutput->response[$i][$j]['value'];
                        $this->jobs = array_merge($this->jobs,array($this->serveroutput->response[$i][$j]['value']));
                        return;
                        
                        }
                        
    }
    // }}}
 
    // {{{ _getJobUri ()
    protected function _getJobUri () {

        if (!isset($this->jobs_uri))
            $this->jobs_uri = array();
            
        $jobfinded = false;
        for ($i = 0 ; (!$jobfinded && array_key_exists($i,$this->serveroutput->response)) ; $i ++)
            if (($this->serveroutput->response[$i]['attributes']) == "job-attributes")
                for ($j = 0 ; array_key_exists($j,$this->serveroutput->response[$i]) ; $j++)
                    if ($this->serveroutput->response[$i][$j]['name'] == "job-uri") {
                        $this->last_job = $this->serveroutput->response[$i][$j]['value'];
                        $this->jobs_uri = array_merge($this->jobs_uri,array($this->last_job));
                        return;
                        
                        }
        $this->last_job = '';
        
    }
    // }}}
    
    /*
    // NOTICE : HAVE TO READ AGAIN RFC 2911 TO SEE IF IT IS PART OF SERVER'S RESPONSE (CUPS DO NOT)
    // {{{ _getPrinterUri ()
    protected function _getPrinterUri () {

        for ($i = 0 ; (array_key_exists($i,$this->serveroutput->response)) ; $i ++)
            if (($this->serveroutput->response[$i]['attributes']) == "job-attributes")
                for ($j = 0 ; array_key_exists($j,$this->serveroutput->response[$i]) ; $j++)
                    if ($this->serveroutput->response[$i][$j]['name'] == "printer-uri") {
                        $this->printers_uri = array_merge($this->printers_uri,array($this->serveroutput->response[$i][$j]['value']));

                        return;
                        
                        }

        $this->printers_uri = array_merge($this->printers_uri,array(''));
 
    }
    // }}}
    */
    
    // {{{ _giveMeStringLength ($string)   
    protected function _giveMeStringLength ($string) {
        
        $prepend = '';
        $length = strlen($string);
        $lengthlength = strlen(chr($length));
        while ($lengthlength < 2) {
            $prepend .= chr(0x00);
            $lengthlength += 1;
            }
        $length = $prepend . chr($length);
 
    return $length;
    }
    // }}}

// REQUEST BUILDING
    
    // {{{ _stringJob ()
    protected function _stringJob () {
    
        if (!isset($this->setup->charset))
            self::setCharset('us-ascii');
        if (!isset($this->setup->datatype))
            self::setBinary();

        if (!isset($this->setup->uri)) {
            $this->getPrinters();
            unset($this->jobs[count($this->jobs) - 1]);
            unset($this->jobs_uri[count($this->jobs_uri) - 1]);
            unset($this->status[count($this->status) - 1]);
            
            if (array_key_exists(0,$this->available_printers))
               self::setPrinterURI($this->available_printers[0]);
            else {
                trigger_error(_("_stringJob: Printer URI is not set: die"),E_USER_WARNING);
                self::_putDebug( _("_stringJob: Printer URI is not set: die\n"));
                self::_errorLog(" Printer URI is not set, die",2);
                return FALSE;
                }
            }
            
        if (!isset($this->setup->copies))
            self::setCopies(1);
        
        if (!isset($this->setup->language))
            self::setLanguage('en_us');

        if (!isset($this->setup->mime_media_type))
            self::setMimeMediaType();
        if ($this->setup->datatype != "TEXT")
        unset ($this->setup->mime_media_type);
            
        if (!isset($this->setup->jobname))
            self::setJobName();
        unset($this->setup->jobname);

        if (!isset($this->meta->username))
            self::setUserName();

        if (!isset($this->meta->fidelity))
            $this->meta->fidelity = '';
        
        if (!isset($this->meta->document_name))
            $this->meta->document_name = '';

        if (!isset($this->meta->sides))
            $this->meta->sides = '';
        
        if (!isset($this->meta->page_ranges))
            $this->meta->page_ranges = '';
       
        $jobattributes = '';
        $operationattributes = '';
        self::_buildValues($operationattributes,$jobattributes);
        
        
        self::_setOperationId();

        if (!isset($this->error_generation->request_body_malformed))
            $this->error_generation->request_body_malformed = "";
       
        $this->stringjob = chr(0x01) . chr(0x01) // 1.1  | version-number
                         . chr(0x00) . chr (0x02) // Print-Job | operation-id
                         . $this->meta->operation_id //           request-id
                         . $this->error_generation->request_body_malformed
                         . chr(0x01) // start operation-attributes | operation-attributes-tag
                         . $this->meta->charset
                         . $this->meta->language
                         . $this->meta->printer_uri
                         . $this->meta->username
                         . $this->meta->jobname
                         . $this->meta->fidelity
                         . $this->meta->document_name
                         . $this->meta->mime_media_type
                         . $operationattributes
                         . chr(0x02) // start job-attributes | job-attributes-tag
                         . $this->meta->copies
                         . $this->meta->sides
                         . $this->meta->page_ranges
                         . $jobattributes
                         . chr(0x03); // end-of-attributes | end-of-attributes-tag
        

        self::_putDebug( sprintf(_("String sent to the server is:\n%s\n"), $this->stringjob));
        return TRUE;
    }
    // }}}

    // {{{ _stringCancel ()
    protected function _stringCancel ($job_uri) {
    
        if (!isset($this->setup->charset))
            self::setCharset('us-ascii');
        if (!isset($this->setup->datatype))
            self::setBinary();
        if (!isset($this->setup->language))
            self::setLanguage('en_us');
        if (!$this->requesting_user)   
            self::setUserName();
        if (!isset($this->meta->message))
            $this->meta->message = '';

        self::_setOperationId();
     
        self::_setJobUri($job_uri);
        
        if (!isset($this->error_generation->request_body_malformed))
            $this->error_generation->request_body_malformed = "";
       
        $this->stringjob = chr(0x01) . chr(0x01) // 1.1  | version-number
                         . chr(0x00) . chr (0x08) // cancel-Job | operation-id
                         . $this->meta->operation_id //           request-id
                         . $this->error_generation->request_body_malformed
                         . chr(0x01) // start operation-attributes | operation-attributes-tag
                         . $this->meta->charset
                         . $this->meta->language
                         . $this->meta->job_uri
                         . $this->meta->username
                         . $this->meta->message
                         . chr(0x03); // end-of-attributes | end-of-attributes-tag
                         
        self::_putDebug( sprintf(_("String sent to the server is:\n%s\n"), $this->stringjob));
        return TRUE;
    }
    // }}}

    // {{{ _enumBuild ($tag,$value)
    protected function _enumBuild ($tag,$value) {
        
        switch ($tag) {
            case "orientation-requested":
                switch ($value) {
                    case 'portrait':
                        $value = chr(3);
                        break;
                    case 'landscape':
                        $value = chr(4);
                        break;
                    case 'reverse-landscape':
                        $value = chr(5);
                        break;
                    case 'reverse-portrait':
                        $value = chr(6);
                        break;
                }
            break;
            case "print-quality":
                switch($value) {
                    case 'draft':
                        $value = chr(3);
                        break;
                    case 'normal':
                        $value = chr(4);
                        break;
                    case 'high':
                        $value = chr(5);
                        break;
                }
            break;
            case "finishing":
                switch ($value) {
                        case 'none':
                            $value = chr(3);
                            break;
                        case 'staple':
                            $value = chr(4);
                            break;
                        case 'punch':
                            $value = chr(5);
                            break;
                        case 'cover':
                            $value = chr(6);
                            break;
                        case 'bind':
                            $value = chr(7);
                            break;
                        case 'saddle-stitch':
                            $value = chr(8);
                            break;
                        case 'edge-stitch':
                            $value = chr(9);
                            break;
                        case 'staple-top-left':
                            $value = chr(20);
                            break;
                        case 'staple-bottom-left':
                            $value = chr(21);
                            break;
                        case 'staple-top-right':
                            $value = chr(22);
                            break;
                        case 'staple-bottom-right':
                            $value = chr(23);
                            break;
                        case 'edge-stitch-left':
                            $value = chr(24);
                            break;
                        case 'edge-stitch-top':
                            $value = chr(25);
                            break;
                        case 'edge-stitch-right':
                            $value = chr(26);
                            break;
                        case 'edge-stitch-bottom':
                            $value = chr(27);
                            break;
                        case 'staple-dual-left':
                            $value = chr(28);
                            break;
                        case 'staple-dual-top':
                            $value = chr(29);
                            break;
                        case 'staple-dual-right':
                            $value = chr(30);
                            break;
                        case 'staple-dual-bottom':
                            $value = chr(31);
                            break;
                    }
                break;
            }

        $prepend = '';
        while ((strlen($value) + strlen($prepend)) < 4)
            $prepend .= chr(0);
        
    return $prepend.$value;
    }
    // }}}

    // {{{ _integerBuild ($integer)
    protected function _integerBuild ($value) {
        
        if ($value >= 2147483647 || $value < -2147483648) {
            trigger_error(_("Values must be between -2147483648 and 2147483647: assuming '0'"),E_USER_WARNING);
            return chr(0x00).chr(0x00).chr(0x00).chr(0x00);
            }
        
        $initial_value = $value;
            
            $int1 = $value & 0xFF;
            $value -= $int1;
            $value = $value >> 8;
            $int2 = $value & 0xFF;
            $value -= $int2;
            $value = $value >> 8;
            $int3 = $value & 0xFF;
            $value -= $int3;
            $value = $value >> 8;
            $int4 = $value & 0xFF; //64bits

    if ($initial_value < 0)
        $int4 = chr($int4) | chr(0x80);
    else
        $int4 = chr($int4);

    $value = $int4.chr($int3).chr($int2).chr($int1);
    
    return $value;
    }
    // }}}

    // {{{ _rangeOfIntegerBuild ($integers)
    protected function _rangeOfIntegerBuild ($integers) {
        
        $integers = split(":",$integers);
        
        for ($i = 0 ; $i < 2 ; $i++) 
            $outvalue[$i] = self::_integerBuild($integers[$i]);
            
        return $outvalue[0].$outvalue[1];
    }
    // }}}

    // {{{ _buildValue ($key,$values,&$attributes_string);
    protected function _buildValues (&$operationattributes,&$jobattributes) {

        $operationattributes = '';
        foreach ($this->operation_tags as $key => $values) {
            $item = 0;
            if (array_key_exists('value',$values)) 
                    foreach ($values['value'] as $item_value) {
                        if ($item == 0)
                            $operationattributes .= $values['systag']
                                        . self::_giveMeStringLength($key)
                                        . $key
                                        . self::_giveMeStringLength($item_value)
                                        . $item_value;
                        else
                            $operationattributes .= $values['systag']
                                        . self::_giveMeStringLength('')
                                        . self::_giveMeStringLength($item_value)
                                        . $item_value;
                    
                        $item++;
                    }
            }
        
        $jobattributes = '';
        foreach ($this->job_tags as $key => $values) {
            $item = 0;
            if (array_key_exists('value',$values))
                    foreach ($values['value'] as $item_value) {
                    if ($item == 0)
                            $jobattributes .= $values['systag']
                                        . self::_giveMeStringLength($key)
                                        . $key
                                        . self::_giveMeStringLength($item_value)
                                        . $item_value;
                        else
                            $jobattributes .= $values['systag']
                                        . self::_giveMeStringLength('')
                                        . self::_giveMeStringLength($item_value)
                                        . $item_value;
                    
                        $item++;
                    }
            }
        reset ($this->job_tags);
        reset ($this->operation_tags);
    return true;
    }
    // }}}

    // {{{ _setOperationAttribute ($attribute,$value)
    protected function _setOperationAttribute ($attribute,$value) {
    //used by setAttribute
            $tag_type = $this->operation_tags[$attribute]['tag'];
            switch ($tag_type) {
                case 'integer':
                    $this->operation_tags[$attribute]['value'][] = self::_integerBuild($value);
                    break;
                case 'keyword':
                case 'naturalLanguage':
                    $this->operation_tags[$attribute]['value'][] = $value;
                    break;
                default:
                    trigger_error(sprintf(_('SetAttribute: Tag "%s": cannot set attribute'),$attribute),E_USER_NOTICE);
                    self::_putDebug(sprintf(_('SetAttribute: Tag "%s": cannot set attribute'),$attribute),2);
                    self::_errorLog(sprintf(_('SetAttribute: Tag "%s": cannot set attribute'),$attribute),2);
                    return FALSE;
                    break;
                }
            $this->operation_tags[$attribute]['systag'] = $this->tags_types[$tag_type]['tag'];
                
    }
    // }}}
    
    // {{{ _setJobAttribute ($attribute,$value)
    protected function _setJobAttribute ($attribute,$value) {
    //used by setAttribute
             
             $tag_type = $this->job_tags[$attribute]['tag'];
             switch ($tag_type) {
                case 'integer':
                    $this->job_tags[$attribute]['value'][] = self::_integerBuild($value);
                    break;
                case 'nameWithoutLanguage':
                case 'nameWithLanguage':
                case 'textWithoutLanguage':
                case 'textWithLanguage':
                case 'keyword':
                case 'naturalLanguage':
                    $this->job_tags[$attribute]['value'][] = $value;
                break;
                case 'enum':
                    $value = $this->_enumBuild($attribute,$value); // may be overwritten by children
                    $this->job_tags[$attribute]['value'][] = $value;
                    break;
                case 'rangeOfInteger':
                    // $value have to be: INT1:INT2 , eg 100:1000
                    $this->job_tags[$attribute]['value'][] = self::_rangeOfIntegerBuild($value);
                break;
                case 'resolution':
                    if (preg_match("#dpi#",$value)) $unit = chr(0x3);
                    if (preg_match("#dpc#",$value)) $unit = chr(0x4);
                    $search = array("#(dpi|dpc)#",'#(x|-)#');
                    $replace = array("",":");
                    $value = self::_rangeOfIntegerBuild(preg_replace($search,$replace,$value)).$unit;
                    $this->job_tags[$attribute]['value'][] = $value;
                    break;
                default:
                    trigger_error(sprintf(_('SetAttribute: Tag "%s": cannot set attribute'),$attribute),E_USER_NOTICE);
                    self::_putDebug(sprintf(_('SetAttribute: Tag "%s": cannot set attribute'),$attribute),2);
                    self::_errorLog(sprintf(_('SetAttribute: Tag "%s": cannot set attribute'),$attribute),2);
                    return FALSE;
                    break;
                }
            $this->job_tags[$attribute]['systag'] = $this->tags_types[$tag_type]['tag'];
    
    }
    // }}}

// DEBUGGING

    // {{{ _putDebug($string,$level)
    protected function _putDebug($string,$level=3) {
        if ($level > $this->debug_level)
            return;
        $this->debug[$this->debug_count] = substr($string,0,1024);
        $this->debug_count ++;
        //$this->debug .= substr($string,0,1024);
    }
    // }}}

// LOGGING

    // {{{ _errorLog($log,$level)
    protected function _errorLog($string_to_log,$level) {
        
        if ($level > $this->log_level)
            return;
    
        $string = sprintf('%s : %s:%s user %s : %s',
                            basename($_SERVER['PHP_SELF']),
                            $this->host,
                            $this->port,
                            $this->requesting_user,
                            $string_to_log);
            
        if ($this->log_type == 0) {
            error_log($string);
            return;
            }
        
        $string = sprintf("%s %s Host %s:%s user %s : %s\n",
                            date('M d H:i:s'),
                            basename($_SERVER['PHP_SELF']),
                            $this->host,
                            $this->port,
                            $this->requesting_user,
                            $string_to_log);
        error_log($string,$this->log_type,$this->log_destination);

    return;
    }
    // }}}
   
};

/*
 * Local variables:
 * mode: php
 * tab-width: 4
 * c-basic-offset: 4
 * End:
 */
?>
