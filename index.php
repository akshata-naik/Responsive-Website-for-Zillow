<?php 

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
date_default_timezone_set('America/Los_Angeles');

error_reporting(E_ALL ^ E_NOTICE);
    $StreetAdd=$_POST["address"];
    $City=$_POST["city"];
    $StateC=$_POST["state"];
    
    $arr=array('zws-id'=>'X1-ZWz1dy0u5m766j_97i73', 'address' => $StreetAdd, 'citystatezip'=>$City.", ".$StateC, 'rentzestimate'=>'true');
    $url="http://www.zillow.com/webservice/GetDeepSearchResults.htm?";
    $url=$url.http_build_query($arr);
    $xmldoc=simplexml_load_file($url);
 
    $StreetAdd=$_POST["address"];
    $City=$_POST["city"];
    $StateC=$_POST["state"];
    
    $arr=array('zws-id'=>'X1-ZWz1dy0u5m766j_97i73', 'address' => $StreetAdd, 'citystatezip'=>$City.", ".$StateC, 'rentzestimate'=>'true');
    $url="http://www.zillow.com/webservice/GetDeepSearchResults.htm?";
    $url=$url.http_build_query($arr);
    
    $xmldoc=simplexml_load_file($url);
    
    $Zpid=(integer)$xmldoc->response->results->result->zpid;
    
    //Code Value
    $code =(string)$xmldoc->message->code;         
   // date_default_timezone_set('America/Los_Angeles');
    //Address-Street
    $street= (string)$xmldoc->response->results->result->address->street;
        if($street=="")
        {$street="N/A";}

    //Address-city
    $city= (string)$xmldoc->response->results->result->address->city;
        if($city=="")
        {$city="N/A";}

    //Address-state
    $state= (string)$xmldoc->response->results->result->address->state;
        if($state=="")
            $state="N/A";
    //Address-zipcode
    $zipcode= (string)$xmldoc->response->results->result->address->zipcode;
        if($zipcode=="")
            $zipcode="N/A";
    //Address-string
    $address=$street.", ".$city.", ".$state."-".$zipcode;
    //Address-link
    $link= (string)$xmldoc->response->results->result->links->homedetails;

    //Address-propertytype
    $Property_type=(string) $xmldoc->response->results->result->useCode;
        if($Property_type=="")
            $Property_type="N/A";

    //Year-built
    $Year_built= (string)$xmldoc->response->results->result->yearBuilt;
        if($Property_type=="")
            $Property_type="N/A";

    //Lot-size
    $Lot_size=(string)$xmldoc->response->results->result->lotSizeSqFt;
        if($Lot_size=="")
            $Lot_size="N/A";
        else
            $Lot_size= (string)number_format((float)$xmldoc->response->results->result->lotSizeSqFt).' sq.ft.';   

    //Finished Area
    $Finished_Area=(string)$xmldoc->response->results->result->finishedSqFt;
        if($Finished_Area=="")
            $Finished_Area="N/A";
        else
            $Finished_Area= (string)number_format((float)$xmldoc->response->results->result->finishedSqFt).' sq.ft.';
        

    //Number of Bathrooms
    $Bathrooms=(string) $xmldoc->response->results->result->bathrooms;
        if($Bathrooms=="")
            $Bathrooms="N/A";

    //Number of Bedrooms
    $Bedrooms= (string)$xmldoc->response->results->result->bedrooms;
        if($Bedrooms=="")
            $Bedrooms="N/A";

    //Tax assessment year
    $taxAssesmentYear=(string) $xmldoc->response->results->result->taxAssessmentYear;
        if($taxAssesmentYear=="")
            $taxAssesmentYear="N/A";

    //Tax Assesment
    $taxAssessment=(string)$xmldoc->response->results->result->taxAssessment;
        if($taxAssessment=="")
            $taxAssessment="N/A";
        else
            $taxAssessment= (string)'$'.number_format((float)$xmldoc->response->results->result->taxAssessment,2,'.',',');
    

    //Last Sold price
    $LastSP=(string)$xmldoc->response->results->result->lastSoldPrice;
        if($LastSP=="")
            $LastSP="N/A";
        else
        $LastSP=(string) '$'.number_format((float)$xmldoc->response->results->result->lastSoldPrice,2,'.',',');
        
    
    //Last Sold Date
    $LastSD=(string)$xmldoc->response->results->result->lastSoldDate;
        if($LastSD=="")
            $LastSD="N/A";
        else
            $LastSD=(string) date("d-M-Y", strtotime($xmldoc->response->results->result->lastSoldDate));
        

    //Zestimate amount Updated Date
    $ZDate=(string)$xmldoc->response->results->result->zestimate->{'last-updated'};
        if($ZDate=="")
            $ZDate="N/A";
        else
            $ZDate= (string)date("d-M-Y", strtotime($xmldoc->response->results->result->zestimate->{'last-updated'}));
                
        
    //Zestimate amount
    $Zamount=(string)$xmldoc->response->results->result->zestimate->amount;
        if($Zamount=="")
            $Zamount="N/A";
        else
            $Zamount=(string)'$'.number_format((float)$xmldoc->response->results->result->zestimate->amount,2,'.',',');
        

    //Over Zestimate value change
    $ZZValueChange= (string)$xmldoc->response->results->result->zestimate->valueChange;
    if($ZZValueChange=="")
    {
        $ZValueChange=" N/A";
    }
    else if($ZZValueChange>0)
    {
        $ZValueChange=(string)'$'.number_format((float)$ZZValueChange,2,'.',',');
        $Img1=(string)'http://cs-server.usc.edu:45678/hw/hw6/up_g.gif';
        $sign="+";
    }
    else if($ZZValueChange<0)
    {
        $ZValueChange='$'.number_format(abs((float)$ZZValueChange),2,'.',',');
        $Img1=(string)'http://cs-server.usc.edu:45678/hw/hw6/down_r.gif'; 
        $sign="-";
    }
    else if($ZZValueChange==0)
    {
        $ZValueChange=(string)'$'.number_format((float)$ZZValueChange,2,'.',',');
        $sign="0";
    }
    

    //Value Range LOW to HIGH
    $RHigh=(string)$xmldoc->response->results->result->zestimate->valuationRange->high;
        if ($RHigh=="")
            $RHigh="N/A";
        else
            $RHigh=(string) '$'.number_format((float)$xmldoc->response->results->result->zestimate->valuationRange->high,2,'.',',');
    $RLow=(string)$xmldoc->response->results->result->zestimate->valuationRange->low;
        if($RLow=="")
            $RLow="N/A";
        else
            $RLow=(string) '$'.number_format((float)$xmldoc->response->results->result->zestimate->valuationRange->low,2,'.',',');
    $ValueRange= $RLow." - ".$RHigh;

    //Rentzestimate updated Date
    $RZDate=(string)$xmldoc->response->results->result->rentzestimate->{'last-updated'};
        if($RZDate=="")
            $RZDate="N/A";
        else
            $RZDate= (string)date("d-M-Y", strtotime($xmldoc->response->results->result->rentzestimate->{'last-updated'}));
        
    //Rentzestimate amount
    $RZamount=(string)$xmldoc->response->results->result->rentzestimate->amount;
        if($RZamount=="")
            $RZamount="N/A";
        else
            $RZamount=(string) '$'.number_format((float)$xmldoc->response->results->result->rentzestimate->amount,2,'.',',');
        
        
    //Rentzestimate Value change
    $RZZValueChange=(string) $xmldoc->response->results->result->rentzestimate->valueChange;
    if($RZZValueChange=="")
    {
        $RZValueChange="N/A";
    }
    else if($RZZValueChange>0)
    {
        $RZValueChange=(string)'$'.number_format((float)$RZZValueChange,2,'.',',');
        $Img2=(string)'http://cs-server.usc.edu:45678/hw/hw6/up_g.gif';
        $signR="+";
    }
    else if($RZZValueChange<0)
    {
        $RZValueChange=(string)'$'.number_format(abs((float)$RZZValueChange),2,'.',',');
        $Img2=(string)'http://cs-server.usc.edu:45678/hw/hw6/down_r.gif'; 
        $signR="-";
    }
    else
    {
        $RZValueChange=(string)'$'.number_format((float)$RZZValueChange,2,'.',',');
        $sign="0";
    }
    
    //Rentzestimate value range
    $RRLow=(string)$xmldoc->response->results->result->rentzestimate->valuationRange->low;
        if($RRLow=="")
            $RRLow="N/A";
        else
            $RRLow= (string)'$'.number_format((float)$xmldoc->response->results->result->rentzestimate->valuationRange->low,2,'.',',');
    $RRHigh=(string)$xmldoc->response->results->result->rentzestimate->valuationRange->high;
        if($RRHigh=="")
            $RRHigh="N/A";
        else
            $RRHigh=(string) '$'.number_format((float)$xmldoc->response->results->result->rentzestimate->valuationRange->high,2,'.',',');
    $RValueRange= $RRLow." - ".$RRHigh;

//http://www.zillow.com/webservice/GetChart.htm?zws-id=<ZWSID>&unit-type=percent&zpid=48749425&width=300&height=150
$charturl='http://www.zillow.com/webservice/GetChart.htm?';

//1year zestimate
$chartpara=array('zws-id'=>'X1-ZWz1dy0u5m766j_97i73','unit-type'=>'percent', 'zpid'=>$Zpid, 'width'=>600, 'height'=>300, 'chartDuration'=>'1year');
$charturl1=$charturl.http_build_query($chartpara);
//echo $charturl;
$chart1year=simplexml_load_file($charturl1);
//print_r($chart1year);
$year1url=(string)$chart1year->response->url;
//echo $year1url;

//5year zestimate
$chartpara5=array('zws-id'=>'X1-ZWz1dy0u5m766j_97i73','unit-type'=>'percent', 'zpid'=>$Zpid, 'width'=>600, 'height'=>300, 'chartDuration'=>'5years');
$charturl5=$charturl.http_build_query($chartpara5);
//echo $charturl5;
$chart5year=simplexml_load_file($charturl5);
//print_r($chart1year);
$year5url=(string)$chart5year->response->url;
//echo $year5url;
//10year zestimate
$chartpara10=array('zws-id'=>'X1-ZWz1dy0u5m766j_97i73','unit-type'=>'percent', 'zpid'=>$Zpid, 'width'=>600, 'height'=>300, 'chartDuration'=>'10years');
$charturl10=$charturl.http_build_query($chartpara10);
//echo $charturl10;
$chart10year=simplexml_load_file($charturl10);
//print_r($chart10year);
$year10url=(string)$chart10year->response->url;
//echo $year10url;


$arr=array('code' => $code, 
           'result'=>array('homedetails' => $link,
                            'address' =>$address,
                            'street'=>$street, 
                            'city' =>$city, 
                            'state'=>$state, 
                            'zipcode'=>$zipcode, 
                            'useCode'=>$Property_type, 
                            'lastSoldPrice'=>$LastSP,
                            'yearBuilt'=>$Year_built, 
                            'lastSoldDate'=> $LastSD, 
                            'lotSizeSqFt'=>$Lot_size,
                            'estimateLastUpdate'=>$ZDate, 
                            'estimateAmount'=>$Zamount,
                            'finishedSqFt'=>$Finished_Area, 
                            'estimateValueChangeSign'=>$sign, 
                            'imgn'=>'http://cs-server.usc.edu:45678/hw/hw6/down_r.gif', 
                            'imgp'=> 'http://cs-server.usc.edu:45678/hw/hw6/up_g.gif', 
                            'estimateValueChange'=> $ZValueChange,
                            'bathrooms'=> $Bathrooms, 
                            'bedrooms'=> $Bedrooms, 
                            'estimateValuationRange' => $ValueRange,
                            'restimateLastUpdate'=>$RZDate, 
                            'restimateAmount'=>$RZamount,
                            'taxAssessmentYear'=>$taxAssesmentYear,
                            'restimateValueChangeSign'=>$signR, 
                            'restimateValueChange'=>$RZValueChange, 
                            'taxAssessment'=>$taxAssessment, 
                            'restimateValuationRange'=>$RValueRange),
          'chart'=>array('year1'=>$year1url, 
                         'year5'=>$year5url, 
                         'year10'=>$year10url)
          );

echo json_encode($arr, JSON_PRETTY_PRINT);

?>
    