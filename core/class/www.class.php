<?php
class www {
  var $HTML;
  public function __construct($CFG)
    {
      $this->CFG = $CFG;
      $this->DB = $CFG->DB;
      $this->Head();
      $this->Navbar();
      $this->Frame();
      $this->Foot();
    }
  /**
   * Btns
   * -------------------------
   **/
  static function Btns($Btns)
    {
      if(empty($Btns)){return;}
      $B = is_array($Btns)?$Btns:[$Btns];
      foreach($B as $b){$_[] = self::Btn($b);}
      $_ = implode('',$_);
      return '<div class="btn">'.$_.'</div>';
    }
  /**
   * Btn
   * -------------------------
   **/
  static function Btn($b)
    {
      if(!empty($b)){
        $ID = str_ireplace(" ",'',$b);
        $_ = '<button id="'.$ID.'">'.$b.'</button>';
        return $_;
      }
    }
  /**
   * Navbar
   * -------------------------
   **/
  public function Navbar()
    {
      $HTML[] = '<td class="nb" width="auto">';
      $HTML[] = '</td>';
      $HTML[] = '<td class="nb" style="width:980px;max-width:980px;">';
        $HTML[] = '<b class="logo">'. DOMAIN .'</b>';
        $HTML[] = '<a href="http://'.DOMAIN.'/contact">Contact Us</a>';
        $HTML[] = '<a href="http://'.DOMAIN.'/unsub">Unsubscribe</a>';
        $HTML[] = '<a href="http://'.DOMAIN.'/signup">Sign Up</a>';
        $HTML[] = '<a href="http://'.DOMAIN.'/">Home</a>';
      $HTML[] = '</td>';
      $HTML[] = '<td class="nb" width="auto">';
      $HTML[] = '</td>';
      $HTML[] = '</tr>';
      $this->HTML($HTML);
    }
  /**
   * HTML
   * -------------------------
   **/
  public function HTML($html)
    {
      $HTML = empty($this->HTML)?[]:$this->HTML;
      $this->HTML = array_merge($HTML,$html);
    }
  /**
   * GetFiles
   * -------------------------
   **/
  public function GetFiles($p,$check=false)
    {
      $DIR = str_ireplace('\\','/',DIR.$p).'/';
      $DH = opendir($DIR);
      while($FN = readdir($DH))
        if(!in_array($FN,['.','..'])){
          if($check)
            CheckDirs(LOGS.'apps/'.$FN.'/');
          $x = ucwords(str_replace('_',' ',$FN));
          $li[] = '<li><a href="/'.$p.'/'.$FN.'" target="Frame">'.$x.'</a></li>';
        }
      closedir($DH);
      $li = empty($li) ? '<li style="color:red;">no files in '.$p.'/</li>' : implode(LF,$li) ;
      $ul = '<ul>'.$li.'</ul>';
      return $ul;
    }
  /**
   * JS
   * -------------------------
   **/
  public static function JS()
    {
      $JS[]  = 'http://mu-portal.com/libs/jquery.js';
      foreach($JS as $js)
        $_JS[] = '<script type="text/javascript" src="'.$js.'"></script>';
      return implode(LF,$_JS);
    }
  /**
   * CSS
   * -------------------------
   **/
  public static function CSS()
    {
      $S = [];     // CSS Styles
      $S['*']             = [
        'font-family'     => 'tahoma',
        'color'           => 'white',
        'border'          => 'none',
        'text-decoration' => 'none',
        'padding'         => '0px',
        'margin'          => '0px',
        'border-collapse' => 'collapse',
        'text-shadow'     => '0px 0px 3px black'
        ];
      $S['.body']         = [
        'background'      => '#E4FCD4'
        ];
      $S['.out']          = [
        'background'      => '#222222',
        'padding'         => '10px 25px'
        ];
      $S['.out h3']       = [
        'border-bottom'   => '1px solid #ffbb00',
        'margin'          => '0px -25px',
        'padding'         => '5px 25px'
        ];
      $S['.body, .out']   = [
        'position'        => 'absolute',
        'top'             => 0,
        'bottom'          => 0,
        'left'            => 0,
        'right'           => 0
        ];
      $S['table.body']    = [
        'height'          => '100%',
        'width'           => '100%'
        ];
      $S['a']             = [
        'font-size'       => '14px',
        'font-weight'     => 'bold'
        ];
      $S['td.nb a']       = [
        'display'         => 'inline-block',
        'padding'         => '10px 25px',
        'float'           => 'right',
        'font-size'       => '12px'
        ];
      $S['a:hover']       = [
        'color'           => '#92FF4F'
        ];
      $S['td.nb a:hover'] = [
        'background'      => '#333333'
        ];
      $S['td.nb b.logo']  = [
        'font-size'       => '28px',
        'font-family'     => "'Lobster', cursive",
        'display'         => 'inline-block',
        'padding'         => '0px',
        'color'           => '#92FF4F'
        ];
      $S['ul']            = [
        'list-style'      => 'none'
        ];
      $S['li']            = [
        'font-size'       => '10px',
        'margin'          => '0px'
        ];
      $S['li a']          = [
        'padding'         => '2px 10px',
        'color'           => 'grey'
        ];
      $S['li a:hover']    = [
        'color'           => 'white',
        'font-style'      => 'italic'
        ];
      $S['.nb']           = [
        'padding'         => '0px',
        'background'      => 'black'
        ];
      $S['td.footer']     = [
        'text-align'      => 'center',
        'padding'         => '0px',
        'background'      => 'black'
        ];
      $S['td.footer p']   = [
        'display'         => 'inline-block',
        'padding'         => '10px'
        ];
      $S['td.footer *']   = [
        'font-size'       => '10px',
        'margin'          => '2px 10px'
        ];
      $S['td']            = [
        'vertical-align'  => 'top'
        ];
      $S['td.i']          = [
        'height'          => '50px'
        ];
      $S['span.info']     = [
        'display'         => 'inline',
        'font-style'      => 'italic',
        'padding'         => '5px 15px',
        'margin'          => '10px 5px',
        'float'           => 'right'
        ];
      $S['span.pmta']     = [
        'padding'         => '2px 10px',
        'margin'          => '0px',
        'float'           => 'left'
        ];
      $S['span.pmta h1']  = [
        'font'            => '42px impact',
        'color'           => 'white'
        ];
      $S['.f']            = [
        'display'         => 'inline-block',
        'postition'       => 'absolute',
        'top'             => 0,
        'bottom'          => 0,
        'left'            => 0,
        'right'           => 0,
        'width'           => '100%',
        'height'          => '99%',
        'background'      => '#222222',
        'color'           => 'white'
        ];
      $S['h2']            = [
        'border-bottom'   => '1px solid #ffbb00'
        ];
      $S['h1,h2,h3']      = [
        'color'           => '#ffbb00',
        'font-family'     => 'arial'
        ];
      $S['.content h2']   = [
        'margin'          => '5px -25px'
        ];
      $S['h1,h2']         = [
        'margin'          => '0px -10px',
        'padding'         => '5px 20px'
        ];
      $S['h2,h3']         = [
        'font-size'       => '18px'
        ];
      $S['button']        = [
        'padding'         => '2px 10px',
        'color'           => 'black',
        'text-shadow'     => 'none',
        'margin'          => '0px 2px',
        'font-size'       => '14px',
        'font-weight'     => 'bold',
        'border-radius'   => '3px',
        'box-shadow'      => 'inset 0px 0px 5px black'
        ];
      $S['button:hover']  = [
        'cursor'          => 'pointer',
        'background'      => 'lime',
        'box-shadow'      => '0px 0px 5px white'
        ];
      $S['div.btn']       = [
        'padding'         => '10px',
        'background'      => 'black',
        'margin'          => '0px -25px',
        'border-bottom'   => '1px dashed white',
        'text-align'      => 'right',
        'width'           => '100%'
        ];
      $S['div.alt']       = [
        'background'        => 'white',
        'color'             => 'grey',
        'font-size'         => '12px',
        'text-shadow'       => 'none',
        'margin'            => '0px -25px',
        'padding'           => '10px 25px',
        'box-shadow'        => 'inset 0px 0px 5px black'
        ];
      $S['div.alt *']     = [
        'color'           => 'grey',
        'text-shadow'     => 'none'
        ];
      $S['div.alt pre']   = [
        'border'          => '1px dashed grey',
        'padding'         => '5px 10px',
        'background'      => '#FFF3D1'
        ];
      $S['div.alt hr']    = [
        'background'      => 'grey',
        'height'          => '1px'
        ];
      $S['.tbl tr td']    = [
        'padding'           => '2px 5px'
        ];
      $S['.tbl tr:hover td'] = [
        'background'      => '#cccccc',
        'color'           => 'black',
        'cursor'          => 'pointer'
        ];
      $S['.tbl']          = [
        'box-shadow'      => '0px 0px 5px black',
        'background'      => '#ececec',
        'width'           => '100%'
        ];
      $S['tr.header th']  = [
        'background'      => 'black',
        'color'           => 'white',
        'padding'         => '3px',
        'text-align'      => 'center'
        ];
      $S['span > b']      = [
        'color'           => 'inherit'
        ];
      $S['form input[type=text]']      = [
        'border'          => '1px dashed grey',
        'padding'         => '5px 10px',
        'background'      => '#FFF3D1'
        ];
      $S['label.input'] = [
        'display'         => 'inline-block',
        'width'           => '300px',
        'text-align'      => 'right'
      ];
      $S['input[type=text]'] = [
        'width'           => '300px',
        'margin'          => '0px 0px 10px'
      ];
      $S['textarea'] = [
        'width'           => '500px',
        'border'          => '1px dashed grey',
        'background'      => '#FFF3D1'
      ];
      $S['label.title'] = [
        'width'           => '100px !important',
        'text-align'      => 'right',
        'padding'         => '5px 10px'
      ];
      $S['td.content']    = [
        'padding'         => '10px 25px',
        'color'           => 'black',
        'text-shadow'     => 'none',
        'background'      => '#ffffff',
        'box-shadow'      => '0px 0px 5px grey',
        'height'          => '100%'
      ];
      $S['td.content *']  = [
        'color'           => 'black',
        'text-shadow'     => 'none'
      ];
      $S['td.content p']  = [
        'text-indent'     => '25px',
        'margin'          => '10px',
        'font-size'       => '14px',
        'line-height'     => '24px'
      ];
      $S['td.content p.toc']  = [
        'text-align'     => 'justify'
      ];
      foreach($S as $e=>$s){
        $C = [$e.'{'];
        foreach($s as $k=>$v)
          $C[] = "  ".$k.':'.$v.';';
        $C[] = '}';
        $_CSS[] = implode(LF,$C);
        }
      $_CSS = implode(LF,$_CSS);
      return '<style type="text/css">'.$_CSS.'</style>';
    }
  /**
   * Alt
   * -------------------------
   * wrap content in black on white styles
   * -------------------------
   * @param string $C // content to stylize
   * -------------------------
   **/
  static function Alt($C)
    {
      return '<div class="alt">'.$C.'</div>';
    }
  /**
   * Script Head
   * -------------------------
   **/
  static function ScriptHead($Title=false)
    {
      $HTML[] = '<!DOCTYPE html>';
      $HTML[] = '<html>';
      $HTML[] = '<head>';
      $HTML[] = self::JS();
      $HTML[] = self::CSS();
      $HTML[] = '</head>';
      $HTML[] = '<body class="out">';
      $HTML[] = '<pre>';
      $HTML[] = '<h3>'.$Title.'</h3>';
      return implode(LF,$HTML);
    }
  /**
   * Head
   * -------------------------
   **/
  public function Head()
    {
      $HTML[] = '<!DOCTYPE html>';
      $HTML[] = '<html>';
      $HTML[] = '<head>';
      $HTML[] = $this->JS();
      $HTML[] = $this->CSS();
      $HTML[] = "<link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>";
      $HTML[] = '</head>';
      $HTML[] = '<body class="body">';
      $HTML[] = '<table class="body">';
      $HTML[] = '<tr>';
      $this->HTML($HTML);
    }
  /**
   * Foot
   * -------------------------
   **/
  public function Foot()
    {
      $HTML[] = '<tr>';
      $HTML[] = '<td class="footer" width="auto">';
      $HTML[] = '</td>';
      $HTML[] = '<td class="footer" style="width:980px;max-width:980px;">';
      $HTML[] = '<p>';
      $HTML[] = '<a href="http://'.DOMAIN.'/terms">Terms of Service</a>';
      $HTML[] = ' | ';
      $HTML[] = '<a href="http://'.DOMAIN.'/privacy">Privacy Policy</a>';
      $HTML[] = ' | ';
      $HTML[] = 'Copyright &copy; 2014. All Rights Reserved. ';
      $HTML[] = '<a href="http://'.DOMAIN.'/">'.strtoupper( DOMAIN ).'</a>';
      $HTML[] = '</p>';
      $HTML[] = '</td>';
      $HTML[] = '<td class="footer" width="auto">';
      $HTML[] = '</td>';
      $HTML[] = '</tr>';
      $HTML[] = '</table>';
      $HTML[] = '</body>';
      $HTML[] = '</html>';
      $this->HTML($HTML);
    }
  /**
   * Frame
   * -------------------------
   **/
  public function Frame()
    {

      $HTML[] = '<tr>';
      $HTML[] = '<td width="auto">';
      $HTML[] = '</td>';
      $HTML[] = '<td style="width:980px;max-width:980px;" class="content">';
      $HTML[] = $this->GetPage(@$_GET['PAGE']);
      $HTML[] = '</td>';
      $HTML[] = '<td width="auto">';
      $HTML[] = '</td>';
      $HTML[] = '</tr>';
      $this->HTML($HTML);
    }
  public function GetPage($PAGE)
    {
      $CONTENT = '';
      //$CONTENT = '<pre>'.print_r($GLOBALS,true).'</pre>';
      switch($PAGE) {
        case 'terms':
          $TITLE = 'Terms &amp; Conditions';
          $CONTENT = '<p class="toc">All email communications sent by redirect are 100% CAN-SPAM compliant. The CAN-SPAM Act (Controlling the Assault of Non-Solicited Pornography and Marketing Act of 2003)supersedes the various conflicting state laws for the regulation of email. We are completely permission-based. All of our services are in full compliance with CAN SPAM laws. We supply a CAN-SPAM compliance guarantee on all our email. We maintain comprehensive opt-out lists, properly identify and clean bounce-back e-mail addresses, as well as implement and manage permission and frequency rules for all email we send. Should you have any questions regarding our policies, please email us at info@redirect</p>';
          $CONTENT .= '<p class="toc">You may Unsubscribe programs at any time. In every e-mail communication we send, there is an unsubscribe hyperlink that allows the recipient to unsubscribe from the specific marketing program by simply clicking the hyperlink provided and following the instructions that follow. We attempt to process all unsubscribe requests in a prompt fashion. However, after unsubscribing, we cannot guarantee that you will never receive another mailing from us, because we may obtain your e-mail address in the future through a different e-mail marketing program that you have opted into. We can guarantee, however, that if you should ever receive another e-mail communication from redirect, you will be able to remove your e-mail address via the unsubscribe hyperlink. redirect is able to offer its free services, in part, based upon the willingness of our users to be contacted by our marketing partners, including affiliated third party advertisers. By allowing redirect to make the information you supply available to our marketing partners, you will receive free product and service information that may be of interest to you. redirect reserves the right to provide aggregate or group data about redirect users for lawful purposes. Aggregate or group data is data that describes the demographics, usage, or characteristics of redirect participants as a group, without disclosing personally identifiable information. By opening a redirect account, you agree to allow redirect to provide such aggregate data to third parties. In addition, redirect may employ pixel tags (also known as clear gifs) to track the pages that our Users visit at the redirect website for purposes of formatting future campaigns and upgrading visitor information used in reporting statistics. Additionally, when you open, preview or click on the advertising portion of our e-mails and/or those of our marketing partners and/or affiliates of redirect, you have agreed to the terms set forth in our Privacy Policy and agree that as a function of opening, previewing or clicking on the advertising portion of our e-mails, that you will receive new or additional marketing communications from us, our marketing partners and/or affiliates of redirect. redirect also reserves the right to release current or past User information in the event that redirect believes that the User is using, or has used, Services of redirect in violation of the terms and conditions, to commit unlawful acts, if the information is subpoenaed, if redirect is sold or acquired, or when redirect deems it necessary or appropriate. By agreeing to these terms, you hereby consent to the disclosure of any record or communication to any third party when redirect, in its sole discretion, determines the disclosure to be appropriate. To the extent that User credit card-specific information is collected by redirect and any of its affiliates and/or subsidiaries, said information will be kept in confidence and will not be shared with any third parties (other than consumer credit agencies) without the User\'s prior informed consent. Notwithstanding the foregoing, redirect and its affiliates and/or subsidiaries reserve the right to share with third parties the fact that they have credit card information on file for specific Users but they will not share the specific credit card information with third parties without the User\'s prior informed consent. We endeavor to safeguard and protect our Users\' information. When Users submit information at the website, their information is protected both online and off-line. The privacy of your personal information is very important to us. Our employees are committed to our privacy and security policies. The servers that we store personally identifiable information in are kept in a secure physical environment. Users under 18 years of age are not allowed to participate in sweepstakes or game promotion offered by redirect. No information should be submitted to, or posted at, any redirect website by visitors under 18 years of age without the prior consent of their parent or guardian. Notwithstanding the foregoing, children 13 years of age and younger are not permitted to access the redirect website and we do not knowingly collect personal information from such children. We encourage parents and guardians to spend time online with their children and to participate and monitor the interactive activities of their children. Users may receive e-mail confirming their registration with redirect as well as promotional marketing of commercial products and services. redirect does not endorse, nor is redirect responsible for the accuracy of, the privacy policies and/or terms and conditions of each of the advertisers and/or third parties accessible through the redirect website. The entities which advertise and/or place banner ads on the redirect website are independent third parties and not affiliated with redirect. By using this site, including, without limitation, signing up for offers and/or continuing to receive information from redirect, you agree to the redirect Privacy Policy. We reserve the right, at our discretion, to change, modify, add, and/or remove portions of this Privacy Policy at any time. All Privacy Policy changes will take effect immediately upon their posting on the redirect website. Please check this page periodically for changes. Your continued use of the redirect website or acceptance of our emails following the posting of changes to these terms will mean that you accept these changes and agree to continue receiving emails from us. If you do not agree to the terms of this Privacy Policy, You may Unsubscribe By Clicking <a href="http://'.DOMAIN.'/unsub">Here</a>.</p>';
          break;
        case 'privacy':
          $TITLE = 'Privacy Policy';
          $CONTENT = '<p class="toc">This Privacy Policy covers colossalroad.com treatment of personally identifiable information that redirect collects when you agree to receive e-mail marketing from one of our partner websites. It is important that visitors are fully informed about the use of their personal information. redirect believes in 100% permission-based marketing. This Privacy Policy also applies to consumers that have agreed to receive e-mail marketing from redirect whether at our website, via e-mail, via third party partner websites or otherwise. We may sell the personal information that you supply to us and we may work with other businesses to bring selected retail opportunities to our members. These businesses may include providers of direct marketing services and applications, including lookup and reference, data enhancement, suppression and validation. Additionally, colossalroad.com purchases and manages e-mail lists generated by affiliate websites and organizations. Users may remove themselves from a specific mailing list by utilizing the unsubscribe options that are present and available at the end of each piece of e-mail that redirect sends.</p>';
          $CONTENT .= '<p class="toc">You may Unsubscribe programs at any time. In every e-mail communication we send, there is an unsubscribe hyperlink that allows the recipient to unsubscribe from the specific marketing program by simply clicking the hyperlink provided and following the instructions that follow. We attempt to process all unsubscribe requests in a prompt fashion. However, after unsubscribing, we cannot guarantee that you will never receive another mailing from us, because we may obtain your e-mail address in the future through a different e-mail marketing program that you have opted into. We can guarantee, however, that if you should ever receive another e-mail communication from redirect, you will be able to remove your e-mail address via the unsubscribe hyperlink. redirect is able to offer its free services, in part, based upon the willingness of our users to be contacted by our marketing partners, including affiliated third party advertisers. By allowing redirect to make the information you supply available to our marketing partners, you will receive free product and service information that may be of interest to you. redirect reserves the right to provide aggregate or group data about redirect users for lawful purposes. Aggregate or group data is data that describes the demographics, usage, or characteristics of redirect participants as a group, without disclosing personally identifiable information. By opening a redirect account, you agree to allow redirect to provide such aggregate data to third parties. In addition, redirect may employ pixel tags (also known as clear gifs) to track the pages that our Users visit at the redirect website for purposes of formatting future campaigns and upgrading visitor information used in reporting statistics. Additionally, when you open, preview or click on the advertising portion of our e-mails and/or those of our marketing partners and/or affiliates of redirect, you have agreed to the terms set forth in our Privacy Policy and agree that as a function of opening, previewing or clicking on the advertising portion of our e-mails, that you will receive new or additional marketing communications from us, our marketing partners and/or affiliates of redirect. redirect also reserves the right to release current or past User information in the event that redirect believes that the User is using, or has used, Services of redirect in violation of the terms and conditions, to commit unlawful acts, if the information is subpoenaed, if redirect is sold or acquired, or when redirect deems it necessary or appropriate. By agreeing to these terms, you hereby consent to the disclosure of any record or communication to any third party when redirect, in its sole discretion, determines the disclosure to be appropriate. To the extent that User credit card-specific information is collected by redirect and any of its affiliates and/or subsidiaries, said information will be kept in confidence and will not be shared with any third parties (other than consumer credit agencies) without the User\'s prior informed consent. Notwithstanding the foregoing, redirect and its affiliates and/or subsidiaries reserve the right to share with third parties the fact that they have credit card information on file for specific Users but they will not share the specific credit card information with third parties without the User\'s prior informed consent. We endeavor to safeguard and protect our Users\' information. When Users submit information at the website, their information is protected both online and off-line. The privacy of your personal information is very important to us. Our employees are committed to our privacy and security policies. The servers that we store personally identifiable information in are kept in a secure physical environment. Users under 18 years of age are not allowed to participate in sweepstakes or game promotion offered by redirect. No information should be submitted to, or posted at, any redirect website by visitors under 18 years of age without the prior consent of their parent or guardian. Notwithstanding the foregoing, children 13 years of age and younger are not permitted to access the redirect website and we do not knowingly collect personal information from such children. We encourage parents and guardians to spend time online with their children and to participate and monitor the interactive activities of their children. Users may receive e-mail confirming their registration with redirect as well as promotional marketing of commercial products and services. redirect does not endorse, nor is redirect responsible for the accuracy of, the privacy policies and/or terms and conditions of each of the advertisers and/or third parties accessible through the redirect website. The entities which advertise and/or place banner ads on the redirect website are independent third parties and not affiliated with redirect. By using this site, including, without limitation, signing up for offers and/or continuing to receive information from redirect, you agree to the redirect Privacy Policy. We reserve the right, at our discretion, to change, modify, add, and/or remove portions of this Privacy Policy at any time. All Privacy Policy changes will take effect immediately upon their posting on the redirect website. Please check this page periodically for changes. Your continued use of the redirect website or acceptance of our emails following the posting of changes to these terms will mean that you accept these changes and agree to continue receiving emails from us. If you do not agree to the terms of this Privacy Policy, You may Unsubscribe By Clicking <a href="http://'.DOMAIN.'/unsub">Here</a>.</p>';
          break;
        case 'contact':
          $TITLE = 'Contact Us';
          $F = new FORMS('Send us an Email');
          $F->Text('name');
          $F->Text('email');
          $F->Textarea('message');
          $F->Button('send message');
          $CONTENT = $F->PrintForm();
          break;
        case 'signup':
          $TITLE = 'Sign Up';
          $F = new FORMS('signup','Sign up below for special offers');
          $F->Text('fname',false,'first name');
          $F->Text('lname',false,'last name');
          $F->Text('email');
          $F->Text('email2',false,'repeat email');
          $F->Button('send message');
          $CONTENT = $F->PrintForm();
          break;
        case 'unsub':
          $TITLE = 'Email Unsubscribe';
          if(!empty($_GET['LINK'])){
            $CONTENT = '<p>You have successfully been removed from our mailing list.</p>';
          }else{
            $CONTENT = '<p>To unsubscribe from future offers, please enter your email address below.</p>';
            $F = new FORMS('');
            $F->Text('email');
            $F->Button('unsubscribe now');
            $CONTENT .= $F->PrintForm();
          }
          break;
        default:
          $TITLE = 'Welcome to '.strtoupper( DOMAIN );
      }
      $HTML[] = "<h2>".$TITLE."</h2>";
      $HTML[] = "<p>".$CONTENT."</p>";
      return implode(LF,$HTML);
    }
}
?>