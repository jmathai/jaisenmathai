<?php
  require_once PATH_LIB . '/EpiCurl.php';
  
  class CStocks
  {
    const holding = 0;
    const sold    = 1;
    const uncached= 0;
    const cached  = 1;
    const date_format = 'M d, Y';

    public static $inst = null;
    public static $init = null;
    private $positions = array();

    function init()
    {
      $stocks = simplexml_load_file(PATH_VIEW . '/stocks.xml');
      $i = 0;
      foreach($stocks as $stock)
      {
        $this->positions[$i] = array(
          'purchaseDate'  => (int) strtotime((string)$stock->purchaseDate),
          'purchasePrice' => (float) $stock->purchasePrice,
          'ticker'        => (string) $stock->ticker,
          'shares'        => (int) $stock->shares,
          );

        if($stock->soldPrice > 0)
        {
          $this->positions[$i]['soldDate']  = (int) strtotime((string)$stock->soldDate);
          $this->positions[$i]['soldPrice'] = (float) $stock->soldPrice;
          $this->positions[$i]['status']    = self::sold;
          $this->positions[$i]['cached']    = self::cached;
        }
        else
        {
          $this->positions[$i]['soldDate']  = time();
          $this->positions[$i]['soldPrice'] = Stock::getQuote((string) $stock->ticker);
          $this->positions[$i]['status']    = self::holding;
          $this->positions[$i]['cached']    = self::uncached;
        }
        $i++;
      }
    }

    public function getPositions()
    {
      foreach($this->positions as $i => $position)
      {
        //if($this->positions[$i]['cached'] == self::uncached)
        //{
          $this->getPosition($i);
        //}
      }

      $this->calculateWeights();

      return $this->positions;
    }

    public function getPosition($i)
    {
      if($this->positions[$i]['cached'] == self::cached)
      {
        //return $this->positions[$i];
      }
      
      if($this->positions[$i]['status'] == self::holding)
      {
        $this->positions[$i]['soldPrice'] = number_format($this->positions[$i]['soldPrice']->data, 2);
      }
      
      $this->positions[$i]['cached']        = self::cached;
      $this->positions[$i]['purchaseValue'] = $this->positions[$i]['purchasePrice'] * $this->positions[$i]['shares'];
      $this->positions[$i]['soldValue']     = $this->positions[$i]['soldPrice'] * $this->positions[$i]['shares'];
      $this->positions[$i]['gain']          = ($this->positions[$i]['soldPrice'] * $this->positions[$i]['shares']) - ($this->positions[$i]['purchasePrice'] * $this->positions[$i]['shares']);
      $this->positions[$i]['rate']          = $this->getRateForPosition($i);

      return $this->positions[$i];
    }

    public function getRate($startPrice = 0, $endPrice = 0, $startDate = 0, $endDate = 0)
    {
      $time = (($endDate - $startDate) / 86400 / 365); // time has to be in the same units are the rate which is / year
      $rate = (log(($endPrice / $startPrice)) / $time);
      return $rate;
    }

    public function getRateForPosition($i)
    {
      if($this->positions[$i]['cached'] == self::uncached)
      {
        throw new Exception('uncached exception caught on line ' . __LINE__ . ' in file ' . __FILE__);
      }

      return $this->getRate($this->positions[$i]['purchasePrice'], $this->positions[$i]['soldPrice'], $this->positions[$i]['purchaseDate'], $this->positions[$i]['soldDate']);
    }

    private function calculateWeights()
    {
      $totalDays = 0;
      $totalValue= 0;
      foreach($this->positions as $i => $position)
      {
        $this->positions[$i]['days'] = ceil(($position['soldDate'] - $position['purchaseDate']) / 86400);
        $totalDays += $this->positions[$i]['days'];
        $totalValue += $this->positions[$i]['purchaseValue'];
      }
      

      foreach($this->positions as $i => $position)
      {
        echo "{$position['days']} of {$totalDays}<br/>";
        $this->positions[$i]['weight'] = (($position['days'] / $totalDays) + ($position['purchaseValue'] / $totalValue)) / 2;
        $this->positions[$i]['impact'] = $this->positions[$i]['weight'] * $this->positions[$i]['rate'] * 100;
      }
    }

    public static function getInstance()
    {
      if(self::$inst == null)
      {
        self::$inst = new CStocks();
        self::$inst->init();
      }

      return self::$inst;
    }
  }
  
  class Stock
  {
    public static function getQuote($ticker)
    {
      $amc = EpiCurl::getInstance();
      $ch = curl_init($str = 'http://download.finance.yahoo.com/d/quotes.csv?f=l1&s=' . $ticker);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      return $amc->addCurl($ch);
    }
  }
?>
