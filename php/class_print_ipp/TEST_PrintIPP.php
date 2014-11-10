<?php
/*
 *Example of use of PrintIPP
 *
 * Copyright(C) 2005-2006 Thomas Harding
 * All rights reserved.
 * 
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are
 * met:
 * 
 *     * Redistributions of source code must retain the above copyright
 *       notice, this list of conditions and the following disclaimer.
 *     * Redistributions in binary form must reproduce the above copyright
 *       notice, this list of conditions and the following disclaimer in the
 *       documentation and/or other materials provided with the distribution.
 *     * Neither the name of Thomas Harding nor the names of its
 *       contributors may be used to endorse or promote products derived from
 *       this software without specific prior written permission.
 * 
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS
 * IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO,
 * THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR
 * PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR
 * CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL,
 * EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO,
 * PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR
 * PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF
 * LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING
 * NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
 * SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE. 
 *
 *   mailto:thomas.harding@laposte.net
 *   Thomas Harding, 56 rue de la bourie rouge, 45 000 ORLEANS -- FRANCE
 *
 */

/**********************************************************
*
*   S E T U P
*
***********************************************************/

$host = "localhost"; // set serve'rs host here
$ssl = true; // enable ssl if true
$printer_uri = "/printers/HP_LaserJet_3052_USB_1"; // set printer uri here
//$language = "fr_fr";
//$user = "test"; // valid user from lpadmin group
//$password = "0123Test"; // his password
//$document_uri = "http://localhost/";
//$debug_level = 1; // 1: silent; 3: very verbose

error_reporting(E_ALL);
/******************
*
* END OF SETUP
*
*******************/


function __autoload($class_name) {
   require_once $class_name . '.php';
}
   

?>

<html>
<head>
<title>PHP PrintIPP test page</title>
</head>
<body>
<h1>PHP PrintIPP test page</h1>

<p>Note that all options are not showed here</p>


<a href='#status'>Status of operations</a><br />
<a href='#completed'>Completed responses from server</a><br />
<a href='#debug'>debugging informations</a><br />

<?php

//$ipp = new PrintIPP(); // Basic PrintIPP
//$ipp = new ExtendedPrintIPP(); // extended IPP
$ipp = new CupsPrintIPP(); // extended IPP with CUPS specific stuff

$ipp->debug_level = $debug_level; // Debugging

$ipp->setLog('/tmp/printipp','file',1); // logging almost quiet
$ipp->setLog('/tmp/printipp','file',2); // logging verbose
$ipp->setLog('/tmp/printipp','file',3); // logging very verbose

$ipp->setHost("localhost");
$ipp->ssl = $ssl;
//$ipp->setHost("toto");// Resistance test
$ipp->setHost($host); //Put your printer IP or hostname/fqdn here

$ipp->setPrinterURI($printer_uri); // Set printer URI here
//$ipp->setPrinterURI("ipp://localhost:631/printers/epson"); // Set printer URI here
//$ipp->setPrinterURI("/printers/foo"); // => abort "client-error-not-found"

$ipp->setUserName("php IPP tester");

$ipp->setFidelity(); // printing abort if every attribute could not be set on printer. NOTE: CUPS do not abort :)

$ipp->setCharset('utf-8');
$ipp->setLanguage($language);

$ipp->setAuthentification($user,$password); // username & password 

$j = 0;
$test = 1;

/* printing a large file */
/*
echo "<br /><br /><br />TEST ".$test++."<br />";
echo "OPERATION  ".$j++."<br />";
$ipp->setAttribute("printer-resolution","1440x720dpi");
$ipp->setAttribute("job-billing", "Thomas");
$ipp->setAttribute("print-quality", "high");
$ipp->setAttribute("scaling",100);
//$ipp->setCopies(2);
$ipp->setData('testfiles/photo.jpg');
$ipp->setJobName('photo.jpg',true);
echo "Printing a large file: ". $ipp->PrintJob() . "<br />";
printf('$ipp->status[0] = %s <br /><br />', $ipp->status[0]);
$ipp->unsetAttribute("job-billing");
$ipp->setJobName();
$ipp->setAttribute("scaling","");


/* getting printer's attributes */

echo "<br /><br /><br />TEST ".$test++."<br />";
echo "OPERATION  ".$j++."<br />";
echo "Getting Printer's attributes: ". $ipp->getPrinterAttributes() . "<br />";
printf('$ipp->status[%s] = %s <br /><br />', count($ipp->status) -1,$ipp->status[count($ipp->status) -1]);
$timestamp = $ipp->printer_attributes->printer_up_time->_value0;
echo "Printer up-time: ".date('Y-m-d H:i:s',$timestamp)."<br />";
echo "Printer's attributes :<pre>\n"; print_r($ipp->printer_attributes); echo "</pre>";

/* printing a string */
/*
echo "<br /><br /><br /> TEST ".$test ++."<br />";

echo "OPERATION ". $j ++ ."<br />";
$ipp->setJobName("PHP Test: Text String",true); // default is false: number is automagically appended
$ipp->setData("This is a text string");
echo "Print String: ".$ipp->printJob()."</br />";
echo "Job Attributes:<pre>\n" ; print_r($ipp->job_attributes) ; echo "\n</pre>\n";

// for restart job operation (later)
$first_job = $ipp->last_job;

/* printing a text file */
/*
echo "<br /><br /><br /> TEST ".$test ++."<br />";

        // HINT: you _must_ supply a charset or set output as raw text
        // note that mimeMediaType is resetted to octet-stream after each call of printJob (this is a feature).
echo "OPERATION ". $j ++ ."<br />";
$ipp->setCharset('us-ascii');
$ipp->setMimeMediaType('text/plain');
$ipp->setJobName("PHP Test: US ASCII file",true); // default is false: number is automagically appended
$ipp->setData("./testfiles/test.txt");//Path to file.
$ipp->setAttribute("job-sheets", array("confidential"));
echo "US ASCII file Job status: ".$ipp->printJob("epson")."<br />";
$ipp->setAttribute("job-sheets","");
$ipp->setAttribute("cpi",""); //reset cpi
$ipp->setAttribute("lpi","");

/* printing a document by URI */
/*
echo "<br /><br /><br /> TEST ".$test ++."<br />";

echo "OPERATION ". $j ++ ."<br />";
echo "Job Print URI status: ".$ipp->printUri($document_uri)."<br />";



/* printing a text file in utf-8 */
/*
echo "<br /><br /><br /> TEST ".$test ++."<br />";

echo "OPERATION ". $j ++ ."<br />";
$ipp->setUserName("foo bar");
$ipp->setCharset('utf-8');
$ipp->setMimeMediaType('text/plain'); // if autodetection do not work
// attributes without dedicated function
$ipp->setAttribute('orientation-requested','landscape');
$ipp->setAttribute('number-up',2);
$ipp->setDocumentName("testfile with UTF-8 characters, gzipped");
$ipp->setJobName("testfile with UTF-8 characters, gzipped");
$ipp->setDocumentName("testfile with UTF-8 characters");
$ipp->setData("./testfiles/test-utf8.txt");//Path to file
echo "Printing testfile with UTF-8 characters: ".$ipp->printJob()."<br />";
$ipp->unsetAttribute('orientation-requested');

/* printing a gzipped file */
/*
echo "<br /><br /><br /> TEST ".$test ++."<br />";

echo "OPERATION ". $j ++ ."<br />";
$ipp->setAttribute('compression','gzip');
$ipp->setData("./testfiles/test-utf8-compressed.txt.gz");//Path to file.
echo "Printing testfile with UTF-8 characters, gzipped: ".$ipp->printJob()."<br />";
$ipp->unsetAttribute('compression');


/* getting not-completed jobs */
/*
echo "<br /><br /><br /> TEST ".$test ++."<br />";

echo "OPERATION ". $j ++ ."<br />";
echo "Getting NOT PROCESSED Jobs: ".$ipp->getJobs(true,0,"")."<br />"; // defaults to $my_jobs=true,$limit=0 (no limit),$which_jobs=not-completed,$subset=false 

echo "Job 0 state: ".$ipp->jobs_attributes->job_0->job_state->_value0."<br />";
echo "Job 0 state-reasons: ".$ipp->jobs_attributes->job_0->job_state_reasons->_value0."<br />";
echo "<pre>";print_r($ipp->jobs_attributes); echo "</pre>";

/* getting all jobs (subset of attributes) */
/*
echo "<br /><br /><br /> TEST ".$test ++."<br />";

echo "OPERATION ". $j ++ ."<br />";
echo "Getting ALL Jobs: ".$ipp->getJobs(true,0,"completed",true)."<br />";

echo "Job 0 state: ".$ipp->jobs_attributes->job_0->job_state->_value0."<br />";
echo "Job 0 state-reasons: ".$ipp->jobs_attributes->job_0->job_state_reasons->_value0."<br />";
echo "<pre>";print_r($ipp->jobs_attributes); echo "</pre>";


/* getting a job's attributes */
/*
echo "<br /><br /><br /> TEST ".$test ++."<br />";

echo "OPERATION ". $j ++ ."<br />";
echo "Getting last job's attributes: ".$ipp->getJobAttributes($ipp->last_job,false,'all')."<br />";
                    
$job_state = $ipp->job_attributes->job_state->_value0;
echo "Job-State: $job_state<br />";

$pointer = "_value0";
$job_state_reasons = '';
for ($k = 0 ; isset($ipp->job_attributes->job_state_reasons->$pointer) ; $k++) {
    $job_state_reasons .= $ipp->job_attributes->job_state_reasons->$pointer .", ";
    $pointer = "_value".($k + 1);
    }
echo "Job-State-Reasons: $job_state_reasons<br />";
 
echo "<pre>";print_r($ipp->job_attributes); echo "</pre>";

/* setting job's attributes to new values */
/*
echo "<br /><br /><br /> TEST ".$test ++."<br />";

echo "OPERATION ". $j ++ ."<br />";
echo "deleting print-quality attribute<br />";
$unset_attributes = array("print-quality");//,"printer-resolution");
echo "setting copies to 2<br />";
$ipp->setCopies(2);
echo "setting resolution to 320x200dpi<br />";
$ipp->setAttribute('printer-resolution','320x200dpi');
echo "Setting last job's attributes: ".$ipp->setJobAttributes($ipp->last_job,$unset_attributes)."<br />";
echo "OPERATION ". $j ++ ."<br />";
echo "Getting job's attributes: ".$ipp->getJobAttributes($ipp->last_job)."<br />";
$resolution = $ipp->job_attributes->printer_resolution->_value0;
echo "Resolution: $resolution<br />";
$print_quality = $ipp->job_attributes->print_quality->_value0;
echo "Print-Quality: $print_quality<br />";
 
echo "<pre>";print_r($ipp->job_attributes); echo "</pre>";


/* printing selected pages from a document */
/*
echo "<br /><br /><br /> TEST ".$test ++."<br />";

echo "OPERATION ". $j ++ ."<br />";
$ipp->setAttribute('media','A7');
$ipp->setAttribute('number-up',4);
$ipp->setData("./testfiles/COPYING");
$ipp->setPageRanges('1:2 5:6');
echo "Printing selected pages from document by 4 pages on a single A7 media: ". $ipp->printJob() ."<br />";
$ipp->setPageRanges('');

$ipp->unsetAttribute('media');
$ipp->unsetAttribute('number-up');

/* printing a postcript file */
/*
echo "<br /><br /><br /> TEST ".$test ++."<br />";

echo "OPERATION ". $j ++ ."<br />";
$ipp->setMimeMediaType(); // => autodetection
$ipp->setData("./testfiles/test.ps");
echo "Printing Postscript Job status: ".$ipp->printJob("epson")."<br />";


/* printing a png  file */
/*
echo "<br /><br /><br /> TEST ".$test ++."<br />";

echo "OPERATION ". $j ++ ."<br />";
$ipp->setData("./testfiles/test.png");
echo "Printing png Job status: ".$ipp->printJob("epson")."<br />";

/* printing and cancelling job */
/*
echo "<br /><br /><br /> TEST ".$test ++."<br />";

echo "Printing and Cancelling a job<br />";
$ipp->setData("./testfiles/test.ps");
echo "OPERATION ". $j ++ ."<br />";
echo "Job status: ".$ipp->printJob()."<br />";
$job = $ipp->last_job;
$ipp->setMessage(sprintf(_("job %s cancelled"),$job));
echo "OPERATION ". $j ++ ."<br />";
echo "Cancel status: ".$ipp->cancelJob($job)."<br />";

/* printing strings, no form feed */
/*
echo "<br /><br /><br /> TEST ".$test ++."<br />";

$ipp->setRawText();
$ipp->unsetFormFeed();

echo "Printing RAW TEXT strings<br />";

$ipp->setData("This is a line\n");
echo "OPERATION ". $j ++ ."<br />";
echo "Job status: ".$ipp->printJob("epson")."<br />";

$ipp->setData("This is half a line ");
echo "OPERATION ". $j ++ ."<br />";
echo "Job status: ".$ipp->printJob("epson")."<br />";

$ipp->setData("This is a end of line\n");
echo "OPERATION ". $j ++ ."<br />";
echo "Job status: ".$ipp->printJob("epson")."<br />";

// set copies to 2 (same sheet of paper: form feed is unset)
$ipp->setData("This lines must appeared twice\r\n");
$ipp->setCopies(2);
echo "OPERATION ". $j ++ ."<br />";
echo "Job status: ".$ipp->printJob("epson")."<br />";
$ipp->setCopies(1);

// printing string, then form feed
echo "OPERATION ". $j ++ ."<br />";
$ipp->setFormFeed();
$ipp->setData("End of test");
echo "Job status: ".$ipp->printJob("epson")."<br />";

$ipp->unsetRawText();


/* printing a file to see if unsetRawText works */
/*
echo "<br /><br /><br /> TEST ".$test ++."<br />";

echo "OPERATION ". $j ++ ."<br />";
$ipp->setData("./testfiles/test.ps");
echo "Job status (text file after strings): ".$ipp->printJob()."<br />";


/* multiple document handling */
/*
echo "<br /><br /><br /> TEST ".$test ++."<br />";

$ipp->setUserName("test");
$ipp->setCopies(1);
echo "OPERATION ". $j ++ ."<br />";
echo "Create-Job: ".$ipp->createJob(). "<br />";
printf("Job is: %s<br />",$job = $ipp->last_job);

echo "<pre>";print_r($ipp->job_attributes);echo "</pre>\n";

$ipp->setDocumentName("test-utf8.txt");
$ipp->setData("./testfiles/test-utf8.txt");
echo "OPERATION ". $j ++ ."<br />";
echo "Sending document: " . $ipp->sendDocument($job) . "<br />\n";

echo "OPERATION ". $j ++ ."<br />";
echo "Sending URI: ".$ipp->sendURI('http://localhost',$job). "<br />\n";

$ipp->setDocumentName("text string");
$ipp->setData("This is the string of second document");
echo "OPERATION ". $j ++ ."<br />";
echo "Sending text string as _last_ document: " . $ipp->sendDocument($job,$last=true) . "<br />\n";

// must be refused. Hem: CUPS is very smart, it accepts :)
echo "OPERATION ". $j ++ ."<br />";
echo "Sending document (must be refused): " . $ipp->sendDocument($job,$last=true) . "<br />\n";


/* try to validate a job with filetype printer server can't handle */
/*
echo "<br /><br /><br /> TEST ".$test ++."<br />";

$ipp->setMimeMediaType("application/x-foobar");

echo "OPERATION ". $j ++ ."<br />";
echo "Validate-Job for a document with file format 'application/x-foobar': ".$ipp->validateJob()."<br />";

$ipp->setMimeMediaType();

foreach ($ipp->attributes as $name => $attribute) {
    if ($attribute->_range == 'unsupported-attributes')
        printf('%s "%s": unsupported attribute<br />',$name,$attribute->_value0);
}
reset($ipp->attributes);
echo "Details:<pre>"; print_r($ipp->attributes) ; echo "</pre>";


/* Printing then holding a job */
/*
echo "<br /><br /><br /> TEST ".$test ++."<br />";

echo "OPERATION ". $j ++ ."<br />";
echo "Printing a document :".$ipp->printJob()."<br />";
echo "Job is: ".$job = $ipp->last_job."<br />";
//sleep(1);
echo "OPERATION ". $j ++ ."<br />";
echo "Holding the job for an indefinite period: ".$ipp->holdJob($job,'indefinite')."<br />";
echo "OPERATION ". $j ++ ."<br />";
echo "Getting job state : ".$ipp->getJobAttributes($job)."<br />";
echo "Job State: ".$ipp->job_attributes->job_state->_value0."<br />";
echo "Job State Reason: ".$ipp->job_attributes->job_state_reasons->_value0."<br />";

/* releasing the job */
/*
echo "<br /><br /><br /> TEST ".$test ++."<br />";

echo "OPERATION ". $j ++ ."<br />";
echo "Releasing the job: ".$ipp->releaseJob($job,'indefinite')."<br />";
echo "OPERATION ". $j ++ ."<br />";
echo "Getting job state : ".$ipp->getJobAttributes($job)."<br />";
echo "Job State: ".$ipp->job_attributes->job_state->_value0."<br />";
echo "Job State Reason: ".$ipp->job_attributes->job_state_reasons->_value0."<br />";


/* restarting a job */
/*
echo "<br /><br /><br /> TEST ".$test ++."<br />";
echo "OPERATION ". $j ++ ."<br />";
echo "Restarting the job $first_job (if completed!): ".$ipp->restartJob($first_job)."<br />";
echo "OPERATION ". $j ++ ."<br />";
echo "Getting job state : ".$ipp->getJobAttributes($first_job)."<br />";
echo "Job State: ".$ipp->job_attributes->job_state->_value0."<br />";
echo "Job State Reason: ".$ipp->job_attributes->job_state_reasons->_value0."<br />";


/* purging jobs for a printer */
/*
echo "<br /><br /><br /> TEST ".$test ++."<br />";

echo "OPERATION ". $j ++ ."<br />";
$ipp->setUserName("test");
$ipp->setPrinterURI("ipp://localhost:631/printers/epson"); // Set printer URI here
echo "Purge-Jobs for printer $printer_uri: ". $ipp->purgeJobs() ."<br />";

/* purging jobs for all printers */
/*
echo "<br /><br /><br /> TEST ".$test ++."<br />";

echo "OPERATION ". $j ++ ."<br />";
$ipp->setPrinterURI("ipp://localhost:631/printers/"); // => all printers
echo "Purge-Jobs (all printers): ". $ipp->purgeJobs() ."<br />";


/* pausing printer */
/*
echo "<br /><br /><br /> TEST ".$test ++."<br />";

echo "OPERATION ". $j ++ ."<br />";
$ipp->setPrinterURI($printer_uri);
echo "Pausing Printer $printer_uri, then sleep 1 second: ".$ipp->pausePrinter()."<br />";
sleep(1);
echo "OPERATION ". $j ++ ."<br />";
echo "Getting printer's attributes: ".$ipp->getPrinterAttributes()."<br />";
echo "Printer State: ".$ipp->printer_attributes->printer_state->_value0."<br />";

/* Resuming printer */
/*
echo "<br /><br /><br /> TEST ".$test ++."<br />";

echo "OPERATION ". $j ++ ."<br />";
echo "Resuming Printer $printer_uri, then sleep 1 second: ".$ipp->resumePrinter()."<br />";
sleep(1);
echo "OPERATION ". $j ++ ."<br />";
echo "Getting printer's attributes: ".$ipp->getPrinterAttributes()."<br />";
echo "Printer State: ".$ipp->printer_attributes->printer_state->_value0."<br />";


/* rejecting jobs (CUPS specific)*/

echo "<br /><br /><br />TEST ".$test++."<br />";
echo "OPERATION  ".$j++."<br />";
echo "Rejecting jobs for printer $printer_uri (CUPS operation): ".$ipp->cupsRejectJobs($printer_uri,$printer_state_message="Printer stopped for maintainance")."<br />";

// try to print //

echo "OPERATION ". $j ++ ."<br />";
$ipp->setCharset('us-ascii');
$ipp->setMimeMediaType('text/plain');
$ipp->setJobName("PHP Test: US ASCII file",true); // default is false: number is automagically appended
//$ipp->setAttribute("job-sheets", array("confidential","secret"));
$ipp->setAttribute("cpi",17); // 10,12 or 17. default to 10 //cpi and lpi attributes are CUPS specific
$ipp->setAttribute("lpi",8); // 6 or 8, default: 6
$ipp->setData("./testfiles/test.txt");//Path to file.
echo "US ASCII file Job status: ".$ipp->printJob("epson")."<br />";
$ipp->setAttribute("cpi",""); //reset cpi
$ipp->setAttribute("lpi","");

echo "OPERATION ". $j ++ ."<br />";
$ipp->getPrinterAttributes();
printf("Printer state: %s (%s)<br />",$ipp->printer_attributes->printer_state->_value0,
                                      $ipp->printer_attributes->printer_state_message->_value0);
// Accepting Jobs (CUPS specfic) //

echo "OPERATION  ".$j++."<br />";
echo "Accepting jobs for printer $printer_uri (CUPS operation): ".$ipp->cupsAcceptJobs($printer_uri)."<br />";

/* printing the text file */
/*
echo "OPERATION  ".$j++."<br />";
echo "US ASCII file Job status: ".$ipp->printJob("epson")."<br />";


/* getting only default printer's uri (CUPS extention) */
/*
echo "<br /><br /><br />TEST ".$test++."<br />";
echo "OPERATION ".$j ++."<br />";

printf("Default printer URI [CUPS specific]: %s<pre>\n",$ipp->cupsGetDefaults(array('printer-uri-supported')));
printf("Default printer URI is: %s<br />",$ipp->printer_attributes->printer_uri_supported->_value0);
print_r($ipp->printer_attributes); echo "</pre>";



/* getting default printer attributes (CUPS extension) */
/*
echo "<br /><br /><br />TEST ".$test++."<br />";
echo "OPERATION ".$j ++."<br />";
echo "Getting default printer attributes [CUPS specific]<br /><pre>\n";
$ipp->cupsGetDefaults(array('all'));

print_r($ipp->printer_attributes);

echo "</pre>\nPrinter historic for default printer:\n"; 
    
$histo = $ipp->printer_attributes->printer_state_history->_value1;
    
    $idx_histo = "_indice0";
    for ($idx = 0 ; isset($histo->$idx_histo) ; $idx ++) {
    echo "<h3>next event:</h3>\n";
            foreach ($histo->$idx_histo as $key => $value) {
                if (is_object($value))
                    if ($key != 'printer_state_time') 
                        printf("%s: %s<br />",$key,$value->_value0);
                    else
                        printf("%s: %s<br />",$key,date('Y-m-d H:i:s',$value->_value0));
                    $idx_key = "_key". ($key + 1);
                }
    $idx_histo = '_indice'. ($idx + 1);
    }
echo "<br /><br /><br />\n";


/* getting printers (vendor extention) (currently CUPS only)*/
/*
echo "<br /><br /><br /> TEST ".$test ++."<br />";

echo "OPERATION ".$j++."<br />";
echo "Available printers [CUPS EXTENTION]:<pre>" ; 
echo $ipp->getPrinters() . "\n"; // there is an alias "cupsGetPrinters" for CUPS.
print_r($ipp->available_printers);
echo "</pre>";
echo "Printers's attributes<pre>\n";
print_r ($ipp->printers_attributes);
echo "</pre>\n";


for ($i = 0 ; $i < count($ipp->available_printers) ; $i ++) {
$ipp->setPrinterURI($ipp->available_printers[$i]);
echo "OPERATION ".$j ++."<br />";
$ipp->getPrinterAttributes();
echo "Printer attributes for printer $i:<pre>\n"; print_r($ipp->printer_attributes); echo "</pre>";
if (isset($ipp->printer_attributes->printer_type->_value2)
        && ($ipp->printer_attributes->printer_type->_value2) == 'print-black')
    echo "The printer can print black<br />\n";
if (isset($ipp->printer_attributes->printer_type->_value3)
        && ($ipp->printer_attributes->printer_type->_value3) == 'print-color')
    echo "The printer can print color<br />\n";

    echo "Printer State: ".$ipp->printer_attributes->printer_state->_value0."<br />";
    echo "Printer State message: ".$ipp->printer_attributes->printer_state_message->_value0."<br />";
    echo "Document formats supported:<br /><pre>";

    $pointer = "_value0";
    for ($k = 0 ; isset($ipp->printer_attributes->document_format_supported->$pointer); $k++) {
        echo $ipp->printer_attributes->document_format_supported->$pointer . "\n";
        $pointer = "_value" . ($k + 1);
        }
    echo "</pre>";

echo "------- END FOR PRINTER $i -------------<br /n>";
}


/* send a buggy request */
/*
echo "<br /><br /><br /> TEST ".$test ++."<br />";
echo "OPERATION ". $j ++ ."<br />";
$ipp->setData("This is an error : nothing printed\n");
$ipp->generateError ("request_body_malformed");
echo "Sending a buggy request. status: ".$ipp->printJob()."<br />";

$ipp->resetError("request_body_malformed");



/**/

echo "END OF OPERATIONS <br /><br /><br />";

/* get informations about jobs and status */

echo "Available printers:<br />\n" ;
echo "<pre>\n";
print_r($ipp->available_printers);
echo "</pre>";

echo "Jobs:\n<br />" ; 
echo "<pre>\n";
print_r($ipp->jobs);
echo "</pre>";

echo "Jobs URIs:\n<br />\n";
echo "<pre>\n";
print_r($ipp->jobs_uri);
echo "</pre>";

echo "Printers URIs:\n" ; 
echo "<pre>\n";
print_r($ipp->printers_uri);
echo "</pre>";

echo "<a id='status'>Operations status:</a>\n" ; 
echo "<pre>\n";
print_r($ipp->status);
echo "</pre>";

echo "<a id='completed'>Completed responses from server</a>\n";
echo "<pre>";
print_r($ipp->response_completed);
echo "</pre>";

/* get debugging informations */

echo "<h3 id='debug'>Debug</h3><pre>";
$ipp->printDebug();
echo "</pre>";


/* end of test */

?>

<h3>END OF TESTFILE</h3>
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
</body>
</html>
