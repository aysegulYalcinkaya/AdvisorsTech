<?php
include_once 'db.php';
include_once 'dbconfig.php';


function getClients()
{
    global $db;
    $query = "SELECT id,name FROM tracker order by name";
    $clients = $db->query($query)->fetchAll();
    return $clients;
}

function getClientInfoByID($id)
{
    global $db;
    $query = "SELECT name, AddressLine1, City, State, Zip, Website, PhoneNumber, id, InitialEmailSent, CompanyinCW, AdvisorsTechMSPStatus, CWProjectCreated, InfoinITGlue, AgentInstall, DomainAccess, MailMirgration, M365E3, Mimecast, PCEncryption, OnboardingType, M365FINRA, NetworkScan, SwagBox, M365E3TotalLicenseCount, MimecastTotalUsers, TotalPCs, TotalMacs, TotalEmployees FROM tracker WHERE id=?";
	$client=$db->query($query,array($id))->fetchArray();
    return $client;
}

function getStats()
{
    global $db;
    
    //Status Count - IAR Complete
    $queryComplete = "SELECT COUNT(*) as count FROM tracker WHERE AdvisorsTechMSPStatus = 'Complete' AND OnboardingType = 'IAR';";
    $complete = $db->query($queryComplete)->fetchArray();
    
    //Query Status - IAR In Flight
    $queryInFlight = "SELECT COUNT(*) as count FROM tracker WHERE AdvisorsTechMSPStatus = 'In Flight' AND OnboardingType = 'IAR';";
    $inFlight = $db->query($queryInFlight)->fetchArray();
    
    //Query Status - IAR Backlog
    $queryBacklog = "SELECT COUNT(*) as count FROM tracker WHERE AdvisorsTechMSPStatus = 'Backlog' AND OnboardingType = 'IAR';";
    $backLog = $db->query($queryBacklog)->fetchArray();
    
    //Query Status - IAR Total
    $queryIARTotal = "SELECT COUNT(*) as count FROM tracker WHERE OnboardingType = 'IAR';";
    $iarTotal = $db->query($queryIARTotal)->fetchArray();

    //Status Count - NON-IAR Complete
	$queryNONIARComplete = "SELECT COUNT(*) as count FROM tracker WHERE AdvisorsTechMSPStatus = 'Complete' AND OnboardingType = 'NON-IAR';";
    $noniarComplete = $db->query($queryNONIARComplete)->fetchArray();
    
    //Query Status - NON-IAR In Flight
	$queryNONIARInFlight = "SELECT COUNT(*) as count FROM tracker WHERE AdvisorsTechMSPStatus = 'In Flight' AND OnboardingType = 'NON-IAR';";
    $noniarInFlight = $db->query($queryNONIARInFlight)->fetchArray();
    
    //Query Status - NON-IAR Backlog
	$queryNONIARBacklog = "SELECT COUNT(*) as count FROM tracker WHERE AdvisorsTechMSPStatus = 'Backlog' AND OnboardingType = 'NON-IAR';";
    $noniarBacklog = $db->query($queryNONIARBacklog)->fetchArray();
    
    //Query Status - IAR Total
	$queryNONIARTotal = "SELECT COUNT(*) as count FROM tracker WHERE OnboardingType = 'NON-IAR';";
    $noniarTotal = $db->query($queryNONIARTotal)->fetchArray();
    
    return array('complete'=>$complete['count'],'inFlight'=>$inFlight['count'],'backlog'=>$backLog['count'],'iarTotal'=>$iarTotal['count'],
                 'noniarComplete'=>$noniarComplete['count'],'noniarInFlight'=>$noniarInFlight['count'],'noniarBacklog'=>$noniarBacklog['count'],'noniarTotal'=>$noniarTotal['count']);

}

function update_onboarding_progress($data){
    global $db;
    $query="UPDATE tracker SET name=?,AddressLine1=?,city=?,state=?,zip=?,phoneNumber=?,website=?,InitialEmailSent = ?,
                   CompanyinCW = ?, CWProjectCreated = ?, InfoinITGlue = ?,
                   DomainAccess = ?, AgentInstall = ?, M365E3 = ?, MailMirgration =?, Mimecast = ?, 
                   PCEncryption = ?, OnboardingType = ?, M365FINRA = ?, NetworkScan = ?, SwagBox = ?,
                   AdvisorsTechMSPStatus = ?,TotalPCs = ?, TotalMacs = ?, TotalEmployees = ? WHERE id = ? ";
    $update=$db->query($query,array($data['name'],$data['AddressLine1'],$data['City'],
        $data['State'],$data['Zip'],$data['PhoneNumber'],$data['Website'],
        $data['InitialEmailSent'],$data['CompanyinCW'],$data['CWProjectCreated'],
        $data['InfoinITGlue'],$data['DomainAccess'],$data['AgentInstall'],$data['M365E3'],
        $data['MailMirgration'],$data['Mimecast'],$data['PCEncryption'],$data['OnboardingType'],
        $data['M365FINRA'],$data['NetworkScan'],$data['SwagBox'],$data['AdvisorsTechMSPStatus'],
        $data['TotalPCs'],$data['TotalMacs'],$data['TotalEmployees'],$data['id']));
    if ($update->affectedRows()){
        return "Record updated";
    }
    return "";
}

function login($user, $pwd)
{
    global $db;
    $query = "SELECT * from users where UserName=? and password=MD5(?)";
    $result=$db->query($query,array($user,$pwd));
    if ($result) {
        return true;
    } else {
        return false;
    }
}