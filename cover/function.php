<?php


function bannedadsensecheck($domainname) {
	// cua phin
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
	
	
	$adscontent = file_get_contents($checkgoogleadsense_url);
	$isbanned = 0;
	if(!strlen($adscontent)) {
		$isbanned = 1;
	}
	return $isbanned;
	
}
			
function url_exist($url) {
	
	//se passar a URL existe
	$c=curl_init();
	curl_setopt($c,CURLOPT_URL,$url);
	curl_setopt($c,CURLOPT_HEADER,1);//get the header
	curl_setopt($c,CURLOPT_NOBODY,1);//and *only* get the header
	curl_setopt($c,CURLOPT_RETURNTRANSFER,1);//get the response as a string from curl_exec(), rather than echoing it
	curl_setopt($c,CURLOPT_FRESH_CONNECT,1);//don't use a cached version of the url
	if(!curl_exec($c)){
		//echo $url.' inexists';
		return false;
	}else{
		//echo $url.' exists';
		return true;
	}
	//$httpcode=curl_getinfo($c,CURLINFO_HTTP_CODE);
	//return ($httpcode<400);
}

	//$adscontent = file_get_contents($checkgoogleadsense_url);
	//echo "heo..".strlen($adscontent);



/********************************************

	For More Detail please Visit: 
	
	http://www.discussdesk.com/download-pagination-in-php-and-mysql-with-example.htm

	************************************************/
	// replace page=$counter with $counter
	// replace page= with null
	// add more params to $page_url varible
	function displayPaginationBelow($per_page,$page,$banned,$where,$link){
		$page_url="banned-adsense-list/$banned";
    	$query = "SELECT COUNT(*) as totalCount FROM domainlist $where";
    	$rec = mysqli_fetch_array(mysqli_query($link,$query),MYSQLI_ASSOC);
    	$total = $rec['totalCount'];
        $adjacents = "2";
		
    	$page = ($page == 0 ? 1 : $page);
    	$start = ($page - 1) * $per_page;
		
    	$prev = $page - 1;
    	$next = $page + 1;
        $setLastpage = ceil($total/$per_page);
    	$lpm1 = $setLastpage - 1;
    	
    	$setPaginate = "";
    	if($setLastpage > 1)
    	{
    		$setPaginate .= "<ul class='setPaginate'>";
            $setPaginate .= "<li class='setPage'>Page $page of $setLastpage</li>";
    		if ($setLastpage < 7 + ($adjacents * 2))
    		{	
    			for ($counter = 1; $counter <= $setLastpage; $counter++)
    			{
    				if ($counter == $page)
    					$setPaginate.= "<li><a class='current_page'>$counter</a></li>";
    				else
    					$setPaginate.= "<li><a href='{$page_url}$counter'>$counter</a></li>";					
    			}
    		}
    		elseif($setLastpage > 5 + ($adjacents * 2))
    		{
    			if($page < 1 + ($adjacents * 2))		
    			{
    				for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
    				{
    					if ($counter == $page)
    						$setPaginate.= "<li><a class='current_page'>$counter</a></li>";
    					else
    						$setPaginate.= "<li><a href='{$page_url}$counter'>$counter</a></li>";					
    				}
    				$setPaginate.= "<li class='dot'>...</li>";
    				$setPaginate.= "<li><a href='{$page_url}$lpm1'>$lpm1</a></li>";
    				$setPaginate.= "<li><a href='{$page_url}$setLastpage'>$setLastpage</a></li>";		
    			}
    			elseif($setLastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
    			{
    				$setPaginate.= "<li><a href='{$page_url}1'>1</a></li>";
    				$setPaginate.= "<li><a href='{$page_url}2'>2</a></li>";
    				$setPaginate.= "<li class='dot'>...</li>";
    				for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
    				{
    					if ($counter == $page)
    						$setPaginate.= "<li><a class='current_page'>$counter</a></li>";
    					else
    						$setPaginate.= "<li><a href='{$page_url}$counter'>$counter</a></li>";					
    				}
    				$setPaginate.= "<li class='dot'>..</li>";
    				$setPaginate.= "<li><a href='{$page_url}$lpm1'>$lpm1</a></li>";
    				$setPaginate.= "<li><a href='{$page_url}$setLastpage'>$setLastpage</a></li>";		
    			}
    			else
    			{
    				$setPaginate.= "<li><a href='{$page_url}1'>1</a></li>";
    				$setPaginate.= "<li><a href='{$page_url}2'>2</a></li>";
    				$setPaginate.= "<li class='dot'>..</li>";
    				for ($counter = $setLastpage - (2 + ($adjacents * 2)); $counter <= $setLastpage; $counter++)
    				{
    					if ($counter == $page)
    						$setPaginate.= "<li><a class='current_page'>$counter</a></li>";
    					else
    						$setPaginate.= "<li><a href='{$page_url}$counter'>$counter</a></li>";					
    				}
    			}
    		}
    		
    		if ($page < $counter - 1){
    			$setPaginate.= "<li><a href='{$page_url}$next'>Next</a></li>";
                $setPaginate.= "<li><a href='{$page_url}$setLastpage'>Last</a></li>";
    		}else{
    			$setPaginate.= "<li><a class='current_page'>Next</a></li>";
                $setPaginate.= "<li><a class='current_page'>Last</a></li>";
            }
			
    		$setPaginate.= "</ul>\n";		
    	}
		
		
        return $setPaginate;
    }
?>