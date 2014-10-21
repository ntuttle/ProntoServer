<?
define('MUP','207.158.26.15');
class IMG {

	var $ACL = array('127.0.0.1',
		'207.158.26.15',
		'207.158.26.16',
		'174.65.146.36',
		'99.91.157.150',
		'192.168.15.0');

	public function __construct() {
		$this->Verify();
		$this->ImgSetup();
		echo 1;
	}
	public function Verify() {
		for ($i = 1; $i <= 30; $i++) {
			$this->ACL[] = '207.158.26.'.$i;
		}

		for ($i = 1; $i <= 254; $i++) {
			$this->ACL[] = '192.168.15.'.$i;
		}

		$this->AccessList($_SERVER['REMOTE_ADDR']);
		$this->CheckSalt(@$_GET['s']);
	}
	public function CheckSalt($SALT) {
		if ($SALT != md5('M3d1aUn1')) {
			exit('Incorrect Login');
		}
	}

	public function AccessList($IP) {
		if (!in_array($IP, $this->ACL)) {
			$valid = false;
			foreach ($this->ACL as $ip)
			if (preg_match('/([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)0/', $ip, $x)) {
				if (stristr($IP, $x[1])) {
					$valid = true;
					break;
				}
			}

			if ($valid !== true) {
				exit('Access Denied');
			}
		}
	}

	public function ImgSetup() {
		if (isset($_GET['j'])) {
			$this->jobid = str_pad($_GET['j'], 10, '0', STR_PAD_LEFT);
		} else {

			exit('no jobid!');
		}

		if (isset($_GET['t'])) {
			$this->type = $_GET['t'];
		} else {

			exit('no type!');
		}

		if (isset($_GET['i'])) {
			$this->image = $_GET['i'];
		} else {

			exit('no image!');
		}

		$this->ImgMake();
	}
	public function ImgMake() {
		require_once 'img.lib/WideImage.php';
		$type = $this->type;
		$this->$type();
	}
	public function offer() {
		list($p, $i) = explode('/', $_GET['i']);
		$url         = "http://".MUP."/creatives/".$p."/".str_ireplace(' ', "%20", $i);
		WideImage::load($url)->applyFilter(IMG_FILTER_CONTRAST, rand(1, 5))->saveToFile("jobs/{$this->jobid}.jpg");
		$I = imagecreatefromjpeg("jobs/{$this->jobid}.jpg");
		imagejpeg($I, "jobs/{$this->jobid}.jpg", 90);
	}
	public function offerUnsub() {
		$this->TextToImage('unsub_');
	}
	public function globalUnsub() {
		$this->TextToImage();
	}
	public function TextToImage($prefix = false) {
		$lines = explode("|", $this->image);
		$W     = 0;
		foreach ($lines as $l) {
			$w = strlen($l);
			if ($w > $W) {
				$W = $w;
			}
		}

		$s = rand(8, 11);
		$y = rand(16, 18);
		$W = $W*rand(11, 13);
		$H = (count($lines)*$y)+($s*2);
		$I = imagecreatetruecolor($W, $H);
		$w = imagecolorallocate($I, 255, 255, 255);
		$g = imagecolorallocate($I, 125, 125, 125);
		imagefilledrectangle($I, 0, 0, $W, $H, $w);
		$tmp = imagecreatetruecolor($W, $H);
		imagefilledrectangle($tmp, 0, 0, $W, $H, $w);
		$f = array('arial', 'tahoma', 'verdana', 'garamond');
		$f = 'img.lib/Font/'.$f[rand(0, (count($f)-1))].'.ttf';
		$Y = $y;
		$x = 0;
		foreach ($lines as $t) {
			$tb = imagettftext($tmp, $s, 0, $x, $Y, $g, $f, $t);
			$x  = ceil((($W+$x)-$tb[2])/2);
			imagettftext($I, $s, 0, $x, $Y, $g, $f, $t);
			$Y += $y;
		}
		$jpg = "images/unsub/{$prefix}{$this->jobid}.jpg";
		$d   = '1.'.str_pad(rand(1, 29), 4, '0', STR_PAD_LEFT);
		imagejpeg($I, $jpg, 100);
		WideImage::load("images/unsub/{$prefix}{$this->jobid}.jpg")->correctGamma(1, $d)->saveToFile($jpg);
		$IMG = imagecreatefromjpeg($jpg);
		imagejpeg($IMG, $jpg, 90);
	}
}