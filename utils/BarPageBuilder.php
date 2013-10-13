<?php

/**
 * Very simple wrapper class around high charts for generating simple horizontal bar charts 
 */
class BarPageBuilder
{
    protected $title = '';
    
    protected $xAxisTitle = '';
    
    protected $yAxisTitle = '';
    
    protected $data = array();
    
    /**
     * Set the titles
     * @param array $data
     * @param string $title
     * @param string $xAxisTitle
     * @param string $yAxisTitle 
     */
    public function __construct($data, $title = "", $xAxisTitle = "", $yAxisTitle = "")
    {
        $this->data = $data;
        $this->title = $title;
        $this->xAxisTitle = $xAxisTitle;
        $this->yAxisTitle = $yAxisTitle;
    }
    
    /**
     * Return a string that is a web page
     * @return string
     */
    public function getHtmlPage()
    {
        return $this->getHeader().$this->getBody();
    }
    
    /**
     * 
     * @return string
     */
    public function getHeader()
    {
        return <<<HEADER
<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>{$this->title}</title>        
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script src="../js/highcharts.js"></script>
<script src="../js/modules/exporting.js"></script>    
		<script type="text/javascript">
$(function () {
        
        $('#container').highcharts({
            chart: {
                type: 'bar'
            },
            title: {
                text: '{$this->title}'
            },
            xAxis: {
                title: {
                    text: '{$this->xAxisTitle}'
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: '{$this->yAxisTitle}',
                    align: 'high'
                },
                labels: {
                    overflow: 'justify'
                }
            },
            tooltip: {
                valueSuffix: ' times'
            },
            plotOptions: {
                bar: {
                    dataLabels: {
                        enabled: true
                    }
                }
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'top',
                x: -40,
                y: 100,
                floating: true,
                borderWidth: 1,
                backgroundColor: '#FFFFFF',
                shadow: true
            },
            credits: {
                enabled: false
            },
            series: 
                {$this->getData()}
            
        });
    });
    
		</script>
	</head>
HEADER;
        
    }
    
   /**
    * 
    * Expects array key value array , returns a json array
    * @return string
    */
   public function getData()
   {
       $data = array();
       foreach($this->data as $key => $value){ 
           $data[] = array('name' => $key, 'data' => array($value));
       }       
       return json_encode($data);
   }
    
    
   public function getBody()
   {
       return <<<BODY
<body>
<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
</body>   
</html>
BODY;
       
   }
    
}


