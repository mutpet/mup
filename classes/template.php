<?php
/*
ini_set('display_errors', 1);

function setVisitorsForTemplate($htmlFile = '', $visitors = "") 
{
$html = file_get_contents($htmlFile);
$html = str_replace('<(visitors)>', $visitors, $html);
echo $html;
}
*/

/*
 beolvasott file-t egy string kent ki lehessen olvasni
 valtozoi helyere pedig megadott ertekeket tegyen
 konstruktor megmondja nyithato e a file, ha igen megnyitja es beolvassa tartalmat temp be
 a valtozok a
				taglist['name'][id] = valtozo neve
				taglist['index'][id] = valtozo sorszama a string en belul
				temp[tg]	= egy string ertek a teljes template bol
				temp	= teljes template �rt�k

				$index_tmp = new template("temp/index.htm");
				$index_tmp->set("link",$linkek);
				echo $index_tmp->get();

*/

class template {
  var $taglist;
  var $taglist_count;
  var $temp;
  var $temp_count;
  var $opensuccess = FALSE;
  var $fdescriptor;
  var $eos = TRUE;

  function template($file){
    if ($file == '') {
		  $this->taglist_count = 0;
      $this->temp_count = 0;
      return;
    }
    $this->open($file);
    $this->read_template_file();
    $this->close();
    return 0;
	}
	function read_template_file()		{
	  $tg=0; $tglc=0;
		while ($s = $this->getline(4096))	{
		 	$leftset = 0;
			while ($leftset < strlen($s))	{
				$poz = strpos($s,'<(',$leftset);
				if (substr($s,$poz,2) == '<('  && ($poz >= $leftset))	{				// elso valtozo elotti szoveg ha nem 0 an volt akkor ennek a kivagasa temp[tg] be
						if ($poz > $leftset)	{
							$this->temp[$tg] = substr($s, $leftset, $poz - $leftset);
							$tg++;
						}
					$endpoz = strpos($s, ')>', $poz + 2);
					if ($endpoz == FALSE) {
						return 2;
					}
					$this->taglist['name'][$tglc] = trim(substr($s,$poz + 2 ,$endpoz -  ($poz + 2)));
					$this->taglist['index'][$tglc] = $tg;
					$this->temp[$tg] = '';
					$tglc++; $tg++;
					$leftset = $endpoz + 2;
				} else {
					$ss = substr($s,$leftset);
			    $this->temp[$tg] = $ss;
          $leftset += strlen($ss);
          $tg++;
				}
			}
		}
 		$this->taglist_count = $tglc;
		$this->temp_count = $tg;
	}
  function set($what,$data)	{
		$is_set = FALSE;
    for ($c = 0; $c < $this->taglist_count; $c++) {
      if ($this->taglist['name'][$c] == $what) {
        $this->temp[$this->taglist['index'][$c]] = $data;
        $is_set = TRUE;
      }
    }
    return $is_set;
	}
	function resettags() {
    for ($c = 0; $c < $this->taglist_count; $c++) {
      $this->temp[$this->taglist['index'][$c]] = '';
    }
    return $this->taglist_count;
  }
  function gettag($what) {
    for ($c = 0; $c < $this->taglist_count; $c++) {
      if ($this->taglist['name'][$c] == $what) {
        return $this->temp[$this->taglist['index'][$c]];
      }
    }
    return FALSE;
  }
  function get()	{
	 	$s = '';
    for ($c = 0; $c < $this->temp_count; $c++) {
      $s .= $this->temp[$c];
    }
    return $s;
	}

// --------------------filekezelo fugvenyek---------------------

  function open($file,	$mode = 'r') {
    $this->stream_source = $file;
    if (!file_exists($file)) {
      return FALSE;
    }
    $this->opensuccess = ($this->fdescriptor = fopen($file,$mode));
    $this->eos = feof($this->fdescriptor);
  }
  function close() {
    if ($this->opensuccess) {
      return fclose($this->fdescriptor);
    } else {
      return TRUE;
    }
  }
  function getline($maxlen = 0) {
    if ($this->eos) {
      return FALSE;
    }
    if ($this->opensuccess) {
      if ($maxlen) {
        $s = fgets($this->fdescriptor,$maxlen);
      } else {
        $s = fgets($this->fdescriptor,4096);
      }
    } else {
      return FALSE;
    }
    return $s;
  }

}


?>