<?
class LinkEncode {

  var $Garbage;
  var $Mask;
  var $JobID;
  var $MD5;
  var $Uri;
  var $Seperators = array('/','_');

  public function __construct($L,$J=false,$M=false)
    {
      if($J)
        {
          $this->Mask = $L;
          $this->JobID = $J;
          $this->MD5 = $M;
        }
      else
        $this->Uri = $L;
      $this->result = ($J)?$this->LinkEncode($L,$J,$M):$this->LinkDecode($L);
    }

  public function LinkDecode($LINK)
    {
      if($LINK!='')
        {
          if(preg_match('/(.*)\.(jpg|png|gif|giff|tif|tiff|jpeg|html|php|htm)/',$LINK,$x))
            {
              $ext = $x[2];
              $LINK = $x[1];
            }
          $c = 0;
          $L = str_replace($this->Seperators,'/',$LINK);
          foreach(count_chars($L,1) as $i=>$v)
            if(chr($i)=="/")
              $c = ($c+$v);
          //$MD5 = substr($L,-32);
          //$L = substr($L,0,-32);
          if(stristr($L,'/')){
            $L = explode('/',$L);
            $JL=floor(@(10/$c));
            $JEL=(10%$c)+$JL;
            $ML=@floor(5/$c);
            $MEL=(5%$c)+$ML;
            $xL=floor(10/$c);
            $xEL=(10%$c)+$xL;
            $MD5L=floor(32/$c);
            $MD5EL=(32%$c)+$MD5L;
            for($i=0;$i<$c;$i++)
              if($i==($c-1))
                {
                  $J[] = substr(@$L[($i+1)],0,$JEL);
                  $M[] = substr(@$L[($i+1)],$JEL,$MEL);
                  $X[] = substr(@$L[($i+1)],($JEL+$MEL),$xEL);
                  $MD5[] = substr(@$L[($i+1)],($JEL+$MEL+$xEL),$MD5EL);
                }
              else
                {
                  $J[] = substr($L[($i+1)],0,$JL);
                  $M[] = substr($L[($i+1)],$JL,$ML);
                  $X[] = substr($L[($i+1)],($JL+$ML),$xL);
                  $MD5[] = substr($L[($i+1)],($JL+$ML+$xL),$MD5L);
                }
            $this->Mask = $_['MASK'] = implode('',$M);
            $this->JobID = $_['JOBID'] = implode('',$J);
            $this->MD5 = $_['MD5'] = implode('',$MD5);
            $this->Garbage = implode('',$X);
          }else{
            return false;
          }
        }
      return @$_;
    }

  public function LinkEncode($M,$J,$MD5)
    {
      $l = rand(2,4);
      $r = rand(1,2);
      $this->Garbage = $x = $this->Random(10);
      $JL = floor(10/$l);
      $JEL = ((10%$l)+$JL);
      $ML = floor(5/$l);
      $MEL = ((5%$l)+$ML);
      $xL = floor(10/$l);
      $xEL = ((10%$l)+$xL);
      $MD5L = floor(32/$l);
      $MD5EL = ((32%$l)+$MD5L);
      $r = rand(5,50);
      $LINK[] = $this->Random($r).$this->Random(1,implode('',$this->Seperators));
      for($i=0;$i<$l;$i++)
        {
          if($i==($l-1))
            {
              $LINK[] = substr($J,($JL*$i),$JEL);
              $LINK[] = substr($M,($ML*$i),$MEL);
              $LINK[] = substr($x,($xL*$i),$xEL);
              $LINK[] = substr($MD5,($MD5L*$i),$MD5EL);
            }
          else
            {
              $LINK[] = substr($J,($JL*$i),$JL);
              $LINK[] = substr($M,($ML*$i),$ML);
              $LINK[] = substr($x,($xL*$i),$xL);
              $LINK[] = substr($MD5,($MD5L*$i),$MD5L);
            }
          $e = $this->Random(1,implode('',$this->Seperators));
          if($i!=($l-1))
            $LINK[] = $e;
        }
      $this->Uri = $_ = implode('',$LINK);
      return $_;
    }

  public static function Random($l,$c=false)
    {
      $c = ($c)?$c:'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
      $s = strlen($c);
      for($i=0;$i<$l;$i++)
        $_[] = $c[rand(0,$s-1)];
      $_ = implode('',$_);
      return $_;
    }
}
?>
