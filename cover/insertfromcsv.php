<?php

// Turn off all error reporting
error_reporting(1);

//Make Database connectivity
include_once "dbConfig.php";

function bannedadsensecheck($domainname) {
	
	//$checkgoogleadsense_url = "https://googleads.g.doubleclick.net/pagead/ads?client=ca-pub-6522332961820161&format=300x250&output=html&h=250&slotname=6535622733&adk=328558134&adf=3643374295&w=300&lmt=1474162833&avail_w=360&flash=0&url=http%3A%2F%2F";
	//$checkgoogleadsense_url .= $domainname;
	//$checkgoogleadsense_url .= "%2F&wgl=1&dt=1474162839837&bpp=6&bdt=447&fdt=2207&idt=2405&shv=r20160915&cbv=r20160727&saldr=aa&prev_fmts=750x90&correlator=8660708283548&frm=20&ga_vid=1291970913.1474161382&ga_sid=1474162841&ga_hid=1953754617&ga_fc=0&pv=2&icsg=2&nhd=1&dssz=2&mdo=0&mso=0&u_tz=420&u_his=1&u_java=1&u_h=768&u_w=1366&u_ah=728&u_aw=1366&u_cd=24&u_nplug=8&u_nmime=50&dff=helvetica%20neue&dfs=14&adx=885&ady=92&biw=1349&bih=635&eid=575144605&oid=3&rx=0&eae=0&fc=80&pc=1&brdim=%2C%2C-8%2C-8%2C1366%2C0%2C1382%2C744%2C1366%2C635&vis=1&rsz=%7C%7CleE%7C&abl=CS&ppjl=u1&pfx=0&fu=16&bc=1&ifi=2&xpc=hTOTyTbldi&p=http%3A//";
	//$checkgoogleadsense_url .= $domainname;
	//$checkgoogleadsense_url .= "&dtd=2443";
	
	// cua xoso.me
	
	$checkgoogleadsense_url = "https://googleads.g.doubleclick.net/pagead/ads?client=ca-pub-3084353470359421&format=970x90&output=html&h=90&slotname=1255312999&adk=4002308866&adf=2824717477&w=970&lmt=1474560073&flash=23.0.0&url=http%3A%2F%2F";
	$checkgoogleadsense_url .= $domainname;
	$checkgoogleadsense_url .= "%2F&wgl=1&dt=1474560838276&bpp=16&bdt=650&fdt=357&idt=577&shv=r20160915&cbv=r20160919&saldr=aa&correlator=2606203985042&frm=20&ga_vid=835475736.1471927543&ga_sid=1474560839&ga_hid=1106797646&ga_fc=0&pv=2&iag=3&icsg=2&nhd=1&dssz=2&mdo=0&mso=0&u_tz=420&u_his=2&u_java=0&u_h=768&u_w=1366&u_ah=728&u_aw=1366&u_cd=24&u_nplug=5&u_nmime=7&dff=arial&dfs=13&adx=190&ady=98&biw=1349&bih=613&eid=575144605&oid=3&rx=0&eae=0&fc=336&pc=1&brdim=0%2C0%2C0%2C0%2C1366%2C0%2C1366%2C728%2C1366%2C613&vis=1&rsz=%7C%7CeE%7C&abl=CS&ppjl=t&pfx=0&fu=272&bc=1&ifi=1&xpc=JSVE8Vm4Mk&p=http%3A//";
	$checkgoogleadsense_url .= $domainname;
	$checkgoogleadsense_url .= "&dtd=649";
	
	// cua xoso minh ngoc .net.vn
	
	//$checkgoogleadsense_url = "https://googleads.g.doubleclick.net/pagead/ads?client=ca-pub-2540065514686456&format=300x600&output=html&h=600&slotname=8219296924&adk=1452319087&adf=4268352134&w=300&lmt=1474936710&flash=23.0.0&url=http%3A%2F%2Fwww.";
	//$checkgoogleadsense_url .= $domainname;
	//$checkgoogleadsense_url .= "%2F&wgl=1&dt=1474936709482&bpp=10&bdt=2340&fdt=663&idt=667&shv=r20160921&cbv=r20160727&saldr=aa&prev_fmts=336x280%2C300x250&correlator=8598829379093&frm=20&ga_vid=1572808487.1472032613&ga_sid=1474936710&ga_hid=1605086351&ga_fc=0&pv=1&iag=3&icsg=2&nhd=1&dssz=2&mdo=0&mso=0&u_tz=420&u_his=1&u_java=0&u_h=768&u_w=1366&u_ah=728&u_aw=1366&u_cd=24&u_nplug=5&u_nmime=7&dff=arial&dfs=12&adx=895&ady=789&biw=1349&bih=662&eid=575144605%2C27415001%2C20040040&oid=3&ref=https%3A%2F%2Fwww.google.com.vn%2F&rx=0&eae=0&fc=80&pc=1&brdim=0%2C0%2C0%2C0%2C1366%2C0%2C1366%2C728%2C1366%2C662&vis=1&rsz=%7C%7CeE%7C&abl=CS&ppjl=f&pfx=0&fu=16&bc=1&ifi=3&xpc=ViTBA5xT24&p=http%3A//www.";
	//$checkgoogleadsense_url .= $domainname;
	//$checkgoogleadsense_url .= "&dtd=683";
	
	
	
	$adscontent = file_get_contents($checkgoogleadsense_url);
	$isbanned = 0;
	if(!strlen($adscontent)) {
		$isbanned = 1;
	}
	return $isbanned;
	
}

define('CSV_PATH','E:/xampp/htdocs/adsbannedcheck/cover/');

// specify CSV file path

//$csv_file = CSV_PATH . "top500.domains.08.16.csv"; // Name of your CSV file
$csv_file = CSV_PATH . "top-1m.csv"; // Name of your CSV file

$csvfile = fopen($csv_file, 'r');
$theData = fgets($csvfile);
$i = 0;
while (!feof($csvfile))
{
   $csv_data[] = fgets($csvfile, 1024);
   $csv_array = explode(",", $csv_data[$i]);
   $insert_csv = array();
   $insert_csv['domain'] = $csv_array[1];
   $array_for_replace = array("http://","https://","//","www.","'","\""," ","/");
   $url = trim($insert_csv['domain']);
	// remove all string in array if existing
   $url = str_replace($array_for_replace,'',$url);
   
   $banned = bannedadsensecheck($url);
   
   $query = "INSERT INTO domainlist(domain,status) VALUES('".$url."','".$banned."')";
   
   $n = mysqli_query($link,$query);
   
   $i++;


}

fclose($csvfile);
echo "$i File data successfully imported to database!!";
mysql_close($link); // c