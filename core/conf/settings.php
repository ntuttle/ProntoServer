<? 
# Configuration Settings
#---------------------------------------------------
  define('METHOD',1); // 1 = js, 0 = php
  define('IMG',1);   // 1 = show, 0 = redirect
  
  $SVR = 'pronto1'; // force a hostname if running locally
  $HN = gethostname();
  $_ = stristr($HN,'pronto')?['host'=>$HN]:['host'=>$SVR];
  $_['debug']   =  true;
  $_['user']    = 'root';
  $_['pass']    = 'be8005b815568970254c43872a1f43bf';//'Media Universal \r\n Pronto Server'
  $_['domain']  = 'mu-portal.com';
  $_['fqdn']    =  $_['host'].'.'.$_['domain'];
  
# Php.ini - more in /core/conf/ini.php
#---------------------------------------------------
  $I['display_errors']  = 1;
  $I['date.timezone']   = 'America/Los_Angeles';

# Database Connections
#---------------------------------------------------
  $H['DB']      = [
      # IncomingEmail,PMTAlogs,metadata
      'public'  =>'localhost',
      'private' => false,
      'port'    => 3306
      ];

# DO NOT EDIT BELOW HERE
#---------------------------------------------------
  $_['hosts'] = $H;
  $_['ini']   = $I;
  Req('conf.php',CONF);
?>