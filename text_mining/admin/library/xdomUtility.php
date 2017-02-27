<?php
/*** include the googleApiUtility class definition ***/
//include('googleApiUtility.php');

//class xdomUtility extends googleApiUtility
class xdomUtility 
{

/*$html = file_get_contents($url);
$data['dom'] = $data['simple_dom'] = array();

$timer_start = microtime(true);

$dom = new DOMDocument();
@$dom->loadHTML($html);
$x = new DOMXPath($dom);*/
    private $html;
    private $data = array();
    private $dom ;//= new DOMDocument();
   /* 
    var $html;
    var $data = array();
    var $dom ;//= new DOMDocument();
*/


    function getEntity($url)
    {
        $html = file_get_contents($url);
        $dom = new DOMDocument();
        @$dom->loadHTML($html);
        $x = new DOMXPath($dom);
        return $x;
    }

    //    to find word which strat with UPPER CASE
    function starts_with_upper($str) {
        $chr = mb_substr ($str, 0, 1, "UTF-8");
        return mb_strtolower($chr, "UTF-8") != $chr;
    }


    //    to find word which strat with UPPER CASE
    function get_starts_with_upper($str_arr)
    {
        $capitalize_arr = array();
        for($j = 0 ; $j < sizeof($str_arr) ; $j++ )
        {
            $array_word = str_word_count($str_arr[$j] , 1);
            for($i = 0 ; $i < sizeof($array_word) ; $i++ )
            {
                $ans = $this->starts_with_upper($array_word[$i]);  //starts_with_upper($array_word[$i]);
                if($ans == "1")
                {
                    //  echo "-----------------------------".$ans." = ".$array_word[$i].'</br>';
                   // $capitalize_arr[] = $array_word[$i].'</br>';
                    $capitalize_arr[] = $array_word[$i];
                }
            }
        }
        return $capitalize_arr;
    }

    //   count associative array value
    function countAssocArrayVal($arr)
    {
        $cnt = 0;
        foreach($arr as $val)
        {
            $cnt += $val;
        }
        return $cnt;
    }

    //   fillter value from array
    function filterArray($wordArray)
    {
        /* "stop words", filter them */
        $filteredArray = array_filter($wordArray, function($x){
            //return !preg_match("/^(.|a|an|and|the|this|at|in|or|of|is|for|to)$/",$x);
            
            return !preg_match("/^(
                .|a|an|and|the|this|at|in|or|of|is|for|to|
                a|about|above|after|again|against|all|am|an|and|any|are|aren't|as|at|be|because|been|before|being|below|between|both|but|by|can't|cannot|could|couldn't|did|didn't|do|does|doesn't|
                doing|don't|down|during|each|few|for|from|further|had|hadn't|has|hasn't|have|haven't|having|he|he'd|he'll|he's|her|here|here's|hers|herself|him|himself|his|how|
                how's|i|i'd|i'll|i'm|i've|if|in|into|is|isn't|it|it's|its|itself|let's|me|more|most|mustn't|my|myself|no|nor|not|of|off|on|once|only|or|other|ought|our|ours|
                ourselves|out|over|own|same|shan't|she|she'd|she'll|she's|should|shouldn't|so|some|such|than|that|that's|the|their|theirs|them|themselves|then|there|there's|
                these|they|they'd|they'll|they're|they've|this|those|through|to|too|under|until|up|very|was|wasn't|we|we'd|we'll|we're|we've|were|weren't|what|what's|when|when's|
                where|where's|which|while|who|who's|whom|why|why's|with|won't|would|wouldn't|you|you'd|you'll|you're|you've|your|yours|yourself|yourselves|null
                )$/",$x);
            
        });
        $filteredArray_f = array();
        foreach ($filteredArray as $value) {
                $filteredArray_f[] = $value;
        }
      //  $this->data['dom']['paragraph_filtered_arr'] = array();
       // $this->data['dom']['paragraph_filtered_arr'] = $filteredArray_f;
        return $filteredArray_f;
    }
     
    function clean($string) {
       // $string = str_replace('null', '', $string); // Replaces all spaces with hyphens.
        $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
        $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
        $string = str_replace('-', ' ', $string); // Replaces all spaces with hyphens.
       // return preg_replace('/-+/', '-', $string); // Replaces multiple hyphens with single one.
        return $string;
     }
    
     function getArrOfString($string)
     {
         $words = preg_split("/[\s,]*\\\"([^\\\"]+)\\\"[\s,]*|" . "[\s,]*'([^']+)'[\s,]*|" . "[\s,]+/", $string, 0, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);
         return $words;
     }
     
    //  to remove null value
    function removeNull($arr_with_null)
    {
        $newArr = array();
             foreach($arr_with_null as $key=>$value)
               {
                   if(is_null($key) || $key == '' || is_null($value)|| $value == '' || $key == null || $value == null)
                       unset($arr_with_null[$key]);
                      // echo   " removing car =   $key : $value <br>"; 
                   else $newArr[$key] = $value;  
               } 
             return $newArr;
    }
    
    //  to remove null value
    function removeNull_From_Arr($my)
    {
         $newMy = array(); 
            $i = 0; 
            foreach ($my as $key => $value) { 
              if (!is_null($value)) { 
                $newMy[$i] = $value; 
                $i++; 
              } 
            } 
             return $newMy;
    }
    
     function removeNull_From_Arr_1($arr_with_null)
    {
        $filteredarray = array_values( array_filter($arr_with_null) );
        return $filteredarray;
    }
    
    
    //   sort associative array
    function sortAssocArr($assc_arr)
    {
        $ans =  arsort($assc_arr);
        return $assc_arr;
    }
    
    function getStringFromAllArr($arr)
    {
        $str_arr = array();
        $str_arr[] = join(" ",$this->data['dom']['paragraph']);
        $str_arr[] = join(" ",$this->data['dom']['meta']);
        $str_arr[] = join(" ",$this->data['dom']['h1']);
        $str_arr[] = join(" ",$this->data['dom']['image_src']);
        $str_arr[] = join(" ",$this->data['dom']['href']);
       
        $total_str = '';
        for($i=0 ; $i < sizeof($str_arr) ; $i++)
        {
            $total_str .= " ".$str_arr[$i];
        }
        return $total_str;
    }

    //   get word density
    function getWordDensity($arr_paragraph)
    {

        $total_str = join(" ",$arr_paragraph);
        
        // echo $total_str;
        // get content of String
        $content = strtolower($total_str);
        $content = $this->clean($content);
        
       // split $content into array of substrings of $content i.e wordwise
       // $wordArray = preg_split('/[^a-z]/', $content, -1, PREG_SPLIT_NO_EMPTY);
       // $word_arr = str_word_count($content, 1);
        $word_arr = preg_split("/[\s,]+/", $content);
       // return $word_arr;
       
       // $this->data['dom']['paragraph_non_filtered_arr'] = array();
      //  $this->data['dom']['paragraph_non_filtered_arr'] = $word_arr;
        //  for filter array
        $arr_filltered = $this->filterArray($word_arr);

         $this->data['dom']['paragraph_non_filtered_arr'] = array();
        $this->data['dom']['paragraph_non_filtered_arr'] = $arr_filltered;
        
        //  to count word density in array
        $arr_cnt_density = array_count_values($arr_filltered);

        //  to set array in DESC order
        $arr_w_d_temp = $this->sortAssocArr($arr_cnt_density);
       // $this->data['dom']['w_d_temp'] = $this->sortAssocArr($arr_cnt_density);

        //  to remove null call local function
       $arr_w_d_temp_1 = $this->removeNull($arr_w_d_temp);
        
       // return $this->data['dom']['w_d_temp'];
       return $arr_w_d_temp_1;
       // return $arr_w_d_temp;

    }

    function getCompleteSiteInfo($url)
    {
        $x = $this->getEntity($url);
        $this->data['dom']['meta'] = array();
        $this->data['dom']['meta_keyword'] = array();
        $this->data['dom']['meta_description'] = array();
        $this->data['dom']['meta_title'] = array();
        $this->data['dom']['paragraph'] = array();
        $this->data['dom']['capitalize'] = array();
        $this->data['dom']['bold'] = array();
        $this->data['dom']['italics'] = array();
        $this->data['dom']['h1'] = array();
        $this->data['dom']['image_src'] = array();
        $this->data['dom']['image_alt'] = array();
        $this->data['dom']['image_alt_missing'] = array();
        $this->data['dom']['href'] = array();
        
        $this->data['dom']['word_density'] = array();
       

            foreach($x->query("//meta") as $node)
            {
                $this->data['dom']['meta'][] = $node->getAttribute("name");
                if($node->getAttribute("name") == "keywords")
                {
                    $name = $node->getAttribute("name");
                    $content = $node->getAttribute("content");
                    $this->data['dom']['meta_keyword'][] =  $name.' = '.$content;
                }
                if($node->getAttribute("name") == "description")
                {
                    $name = $node->getAttribute("name");
                    $content = $node->getAttribute("content");
                    $this->data['dom']['meta_description'][] =  $name.' = '.$content;
                }
            }
            foreach($x->query("//title") as $node)
            {
                $this->data['dom']['meta_title'][] = $node->nodeValue;
            }

            foreach($x->query("//p") as $node)
            {
                $this->data['dom']['paragraph'][] = $node->nodeValue;
            }
            //  for capitalize
            $this->data['dom']['capitalize'] = $this->get_starts_with_upper($this->data['dom']['paragraph']);
               $this->data['dom']['word_density'] = $this->getWordDensity($this->data['dom']['paragraph']);
          
            foreach($x->query("//b") as $node)
            {
                $this->data['dom']['bold'][] = $node->nodeValue;
            }

            foreach($x->query("//i") as $node)
            {
                $this->data['dom']['italics'][] = $node->nodeValue;
            }

            foreach($x->query("//h1") as $node)
            {
                $this->data['dom']['h1'][] = $node->nodeValue;
            }

            foreach($x->query("//img") as $node)
            {
                $this->data['dom']['image_src'][] = $node->getAttribute("src");
                if($node->getAttribute("alt"))
                {
                    $this->data['dom']['image_alt'][] = $node->getAttribute("alt");
                }
                else{
                    $this->data['dom']['image_alt_missing'][] = $node->getAttribute("src");
                }
            }
            foreach($x->query("//a") as $node)
            {
               // $this->data['dom']['hrf'][] = $node->nodeValue;
                if($node->getAttribute("href"))
                {
                    $this->data['dom']['href'][] = $node->getAttribute("href");
                }
            }
      
            
           // $this->fillterAllArray();
           // $this->getElementIsExist();
           // $this->getStringUI_For_Word_Match();
       //  $str = $this->getStringFromAllArr();
        // return $str;
        return $this->data;
    }
    
    
    function fillterAllArray()
    {
        $this->data['dom']['meta'] = removeNull_From_Arr($this->data['dom']['meta']); 
        $this->data['dom']['meta_keyword'] = removeNull_From_Arr($this->data['dom']['meta_keyword']); 
        $this->data['dom']['meta_description'] = removeNull_From_Arr($this->data['dom']['meta_description']); 
        $this->data['dom']['meta_title'] = removeNull_From_Arr($this->data['dom']['meta_title']); 
        $this->data['dom']['paragraph'] = removeNull_From_Arr($this->data['dom']['paragraph']); 
        $this->data['dom']['capitalize'] = removeNull_From_Arr($this->data['dom']['capitalize']); 
        $this->data['dom']['bold'] = removeNull_From_Arr($this->data['dom']['bold']); 
        $this->data['dom']['italics'] = removeNull_From_Arr($this->data['dom']['italics']); 
        $this->data['dom']['h1'] = removeNull_From_Arr($this->data['dom']['h1']); 
        $this->data['dom']['image_src'] = removeNull_From_Arr($this->data['dom']['image_src']); 
        $this->data['dom']['image_alt'] = removeNull_From_Arr($this->data['dom']['image_alt']); 
        $this->data['dom']['image_alt_missing'] = removeNull_From_Arr($this->data['dom']['image_alt_missing']); 
        $this->data['dom']['href'] = removeNull_From_Arr($this->data['dom']['href']); 
       // $this->data['dom']['word_density'] = removeNull($this->data['dom']['word_density']); 
    }
        
   function getWordDensityUI($url)
   {
       $x = $this->getEntity($url);
       $this->data['dom']['word_density'] = array();
       $this->data['dom']['paragraph'] = array();
       
        foreach($x->query("//p") as $node)
        {
            $this->data['dom']['paragraph'][] = $node->nodeValue;
        }
        $this->data['dom']['word_density'] = $this->getWordDensity($this->data['dom']['paragraph']);
        $ui = "";
        $i = 0;
        foreach($this->data['dom']['word_density'] as $key=>$value)
        {
            $i += 1;
            $ui .= '<tr id="meta_deta_tr"><td>'.$i.'</td><td>'.$key.'</td><td class="center">'.$value.'</td></tr>';
        } 
        return $ui;
   }

   function getWordDensity_All($key_word)
   {
       $result = $this->getGoogleSearch($key_word);
       $this->getAllParagraph_Word_Density($result);
       
       //$result_word_density = $this->data['dom']['word_density'];
       unset($this->data['dom']['paragraph']);
       return $this->data;
      // return $result;
   }
   
   function getAllParagraph_Word_Density($arr_r)
   {
       $this->data['dom']['paragraph'] = array();
       $this->data['dom']['bold'] = array();
       $this->data['dom']['italics'] = array();
       $this->data['dom']['h1'] = array();
      
       $this->data['dom']['word_density'] = array();
       $this->data['dom']['url'] = array();
       $this->data['dom']['total_word'] = array();
       
       $arr = $arr_r["responseData"]["results"];
       
        for($i = 0 ; $i<sizeof($arr) ; $i++)
        {
            // echo '</br>'.$arr[$i]['url'].'</br>';
                $url = $arr[$i]['url'];
                
                $this->data['dom']['url'][$i] = $url;
                
                $x = $this->getEntity($url);
                foreach($x->query("//p") as $node)
                {
                    $this->data['dom']['paragraph'][] = $node->nodeValue;
                }
                
                foreach($x->query("//b") as $node)
                {
                    $this->data['dom']['bold'][] = $node->nodeValue;
                }

                foreach($x->query("//i") as $node)
                {
                    $this->data['dom']['italics'][] = $node->nodeValue;
                }

                foreach($x->query("//h1") as $node)
                {
                    $this->data['dom']['h1'][] = $node->nodeValue;
                }
                
        }
        $this->data['dom']['word_density'] = $this->getWordDensity($this->data['dom']['paragraph']);
        $this->data['dom']['total_word'] = $this->countAssocArrayVal($this->data['dom']['word_density']);
   }
   
   function getElementIsExist()
   {
       $arr_temp = $this->data['dom']['word_density'];
       
       $this->data['dom']['match_word_bold'] = array();
       $this->data['dom']['match_word_italics'] = array();
       $this->data['dom']['match_word_h1'] = array();
       
       $arr_temp_bold = join(" ",$this->data['dom']['bold']);
       $arr_temp_italics = join(" ",$this->data['dom']['italics']);
       $arr_temp_h1 = join(" ",$this->data['dom']['h1']);
       
       $str_bold = strtolower($arr_temp_bold);
       $str_italics = strtolower($arr_temp_italics);
       $str_h1 = strtolower($arr_temp_h1);      
              
        foreach($arr_temp as $key=>$value)
        {
            $val = '';
            if (strpos($str_bold, $key) !== false) 
            {       $this->data['dom']['match_word_bold'][] = "b";  }
            else{  $this->data['dom']['match_word_bold'][] = "";   }
            
             if (strpos($str_italics, $key) !== false) 
            {   $this->data['dom']['match_word_italics'][] = "i";   }
            else  {   $this->data['dom']['match_word_italics'][] = "";    }
            
            if (strpos($str_h1, $key) !== false) 
            {     $this->data['dom']['match_word_h1'][] = "h";    }
            else {     $this->data['dom']['match_word_h1'][] = "";    }
        }       
   }
   
   function getStringUI_For_Word_Match()
   {
       $this->data['dom']['match_word_array'] = array();
       for($i = 0 ; $i <sizeof($this->data['dom']['match_word_bold']) ; $i++)
       {
           $str = '';
           if($this->data['dom']['match_word_bold'][$i] !== '')
           {   $str .= '<a href="#" title="B : Occurs atleast once in BOLD TAG" data-rel="tooltip">b</a>&nbsp;,';       }
           if($this->data['dom']['match_word_italics'][$i] !== '')
           {   $str .= '<a href="#" title="I : Occurs atleast once in ITALICS TAG" data-rel="tooltip">i</a>&nbsp;,';       }
           if($this->data['dom']['match_word_h1'][$i] !== '')
           {   $str .= '<a href="#" title="H : Occurs atleast once in HEADER TAG" data-rel="tooltip">h</a>&nbsp;';       }
           if(substr($str, -1) == ",")
           {
               $str = substr($str, 0, -1);
           } 
           $this->data['dom']['match_word_array'][] = $str;
       }
   }
   
   

   function getUiStrings()
   {
       $UI_arr = array();
       $url = '';
       $ttl = '';
       $wd = '';
      
       for($i = 0 ; $i<sizeof($this->data['dom']['url']) ; $i++)
        {
           $url .= '<tr><td> '. ($i+1) .'</td><td>'.$this->data['dom']['url'][$i].' </td></tr>';
        }
        
        
        $ttl .= '<tr><td>'.$this->data['dom']['total_word'].' </td></tr>';
        
        $arr_temp = $this->data['dom']['word_density'];
        $ttl_val = $this->data['dom']['total_word'];
        
        $i = 0;
        $j=0;
        foreach($arr_temp as $key=>$value)
        {
            $per = $this->getWord_Density_Ratio($value, $ttl_val);
            $i += 1;
            $wd .= '<tr><td>'. $i .'</td>
                    <td>'.$key.'&nbsp;
                        '.$this->data['dom']['match_word_array'][$j].'
                    </td>
                    <td>'.$per.'%'.'</td>
                    <td><div class="container"><div class="progressbar" style="width: 75px;">50%&nbsp;</div></div></td>
                    <td class="center">'.$value.'</td></tr>';
            $j += 1;
        }
        $UI_arr["url"] = $url;
        $UI_arr["ttl"] = $ttl;
        $UI_arr["wd"] = $wd;
        return $UI_arr;
   }
   
   function getWord_Density_Ratio($val , $ttl)
   {
       $a = 100 * $val;
       $b = $a / $ttl;
       return round($b, 2);
   }

   function getAllInfoUI($key_word)
   {
       $this->getWordDensity_All($key_word);
       $this->getElementIsExist();
       $this->getStringUI_For_Word_Match();
       $UI_arr = $this->getUiStrings();
       $ui = '';
       $ui .= '<div class="row-fluid sortable">
           
                    <div class="box span6" >
                                    <div class="box-content center" id="w3c_result_div">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th> No</th><th> URL</th>
                                                </tr>
                                            </thead>
                                            <tbody id="all_url_body">
                                                '.$UI_arr['url'].' 
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                     <div class="box span6" >
                         <div class="box-content center" id="w3c_result_div">
                             <table class="table table-bordered ">
                                 <thead>
                                         <tr>
                                             <th> Total No Of Word</th>
                                         </tr>
                                 </thead>
                                 <tbody id="all_total_word_body">
                                        '.$UI_arr["ttl"].'
                                 </tbody>
                             </table>
                         </div>
                     </div>
             </div>
                <div class="row-fluid sortable">
                        <div class="box span12" >
                            <div class="box-content center" id="w3c_result_div">
                                <table class="table table-bordered ">
                                    <thead>
                                            <tr>
                                                <th>No</th><th>Word</th><th>Density</th><th>Wizard</th><th>Repeats</th>
                                            </tr>
                                    </thead>
                                    <tbody id="all_word_density_body">
                                            '.$UI_arr["wd"].'
                                    </tbody>
                                </table>
                            </div>
                        </div>
                </div>';
       
       return $ui;
   }

    function getGoogleURL($key_word)
    {
        $result = $this->getGoogleSearch($key_word);
        
        $this->data['dom']['url'] = array();

        $arr = $result["responseData"]["results"];

         for($i = 0 ; $i<sizeof($arr) ; $i++)
         {            
                 $url = $arr[$i]['url'];                
                 $this->data['dom']['url'][$i] = $url;               
         } 
         return $this->data['dom']['url'];
    }
    
    function getAllParagraph_Word_Density_all($url)
   {
       $this->data['dom']['paragraph'] = array();
       $this->data['dom']['bold'] = array();
       $this->data['dom']['italics'] = array();
       $this->data['dom']['h1'] = array();
      
       $this->data['dom']['word_density'] = array();
       $this->data['dom']['url'] = array();
       $this->data['dom']['total_word'] = array();
                
                $this->data['dom']['url'][] = $url;
                
                $x = $this->getEntity($url);
                foreach($x->query("//p") as $node)
                {
                    $this->data['dom']['paragraph'][] = $node->nodeValue;
                }
                
                foreach($x->query("//b") as $node)
                {
                    $this->data['dom']['bold'][] = $node->nodeValue;
                }

                foreach($x->query("//i") as $node)
                {
                    $this->data['dom']['italics'][] = $node->nodeValue;
                }

                foreach($x->query("//h1") as $node)
                {
                    $this->data['dom']['h1'][] = $node->nodeValue;
                }
                
      
        $this->data['dom']['word_density'] = $this->getWordDensity($this->data['dom']['paragraph']);
        $this->data['dom']['total_word'] = $this->countAssocArrayVal($this->data['dom']['word_density']);
        
   }
    
    function createUIBaseONSingleURL($url , $ind)
    {
     //  $url_arr[] = $url;
       $this->getAllParagraph_Word_Density_all($url);
       $this->getElementIsExist();
       $this->getStringUI_For_Word_Match();
       $UI_arr = $this->getUiStrings();
       
       $div_arr = array(    '<div class="tab-pane active" id="page_info_all_1">' ,
                            '<div class="tab-pane" id="page_info_all_2">' ,
                            '<div class="tab-pane" id="page_info_all_3">' ,
                            '<div class="tab-pane" id="page_info_all_4">' ,
                            '<div class="tab-pane" id="page_info_all_5">' ,
                            '<div class="tab-pane" id="page_info_all_6">' ,
                            '<div class="tab-pane" id="page_info_all_7">' ,
                            '<div class="tab-pane" id="page_info_all_8">' 
                        );     
       
       $ui = '';
       $ui .= $div_arr[$ind];
       $ui .= '
                            <div class="row-fluid sortable">
                                <div class="box span6" >
                                    <div class="box-content center" id="w3c_result_div">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th> No</th><th> URL</th>
                                                </tr>
                                            </thead>
                                            <tbody id="all_url_body">
                                                '.$UI_arr['url'].' 
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                                <div class="box span6" >
                                    <div class="box-content center" id="w3c_result_div">
                                        <table class="table table-bordered ">
                                            <thead>
                                                    <tr>
                                                        <th> Total No Of Word</th>
                                                    </tr>
                                            </thead>
                                            <tbody id="all_total_word_body">
                                                     '.$UI_arr['ttl'].' 
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
        
                            <div class="row-fluid sortable">
                                    <div class="box span6" >
                                        <div class="box-content center" id="w3c_result_div">
                                            <table class="table table-bordered ">
                                                <thead>
                                                        <tr>
                                                            <th>No</th><th>Word</th><th>Density</th><th>Wizard</th><th>Repeats</th>
                                                        </tr>
                                                </thead>
                                                <tbody id="all_word_density_body">
                                                        '.$UI_arr['wd'].' 
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                     <div class="box span6" >
                                        <div class="box-content center" id="w3c_result_div">
                                            <table class="table table-bordered ">
                                                <thead>
                                                        <tr>
                                                            <th>No</th><th>Word</th><th>Density</th><th>Wizard</th><th>Repeats</th>
                                                        </tr>
                                                </thead>
                                                <tbody id="all_word_density_body">
                                                        '.$UI_arr['wd'].' 
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                            </div>
                            
                    </div>';
       
       return $ui;
    }

    
    function getWordPharseArr($arr_new , $len , $url)
    {
        
        $main_arr = array();
        $x = $this->getEntity($url);
        foreach($x->query("//p") as $node)
        {
            $this->data['dom']['paragraph'][] = $node->nodeValue;
        }
        $arr_paragraph = $this->data['dom']['paragraph'];
        
         $total_str = join(" ",$arr_paragraph);
        
        // get content of String
        $content = strtolower($total_str);
        $main_arr["paragraph"] = $content;

        //  split $content into array of substrings of $content i.e wordwise
         //$word_arr = preg_split('/[^a-z]/', $content, -1, PREG_SPLIT_NO_EMPTY);
        $word_arr = str_word_count($content, 1);
                
        //  for filter array
        $arr_filltered = $this->filterArray($word_arr);
         $arr = $arr_filltered;
        
       // $arr = $this->data['dom']['paragraph_filtered_arr'];
        $main_arr["single_arr"] = $arr;
        $len = 2 ;
        $arr_pharse = array();
        $lmt = sizeof($arr) - ($len - 1 );
        for( $i = 0 ; $i < $lmt ; $i++ )
        {
            $word = '';
            for($j = $i ; $j < $len+$i ; $j++)
            {
                $word .= $arr[$j]." ";
            }
          //  $word .= '</br>';
            $arr_pharse[] = $word;
        }
       // return $arr_pharse;
       $main_arr["arr_pharse"] = $arr_pharse;
        $search_data = array();
        foreach ($arr_new AS $key => $value) {
            $count = $this->get_paragraph_search_list($main_arr["paragraph"] , $value);
            $info["count"] = $count;
            $info["keyword"] = $value;
            $search_data[$key] = $info;

        }
        $main_arr["searching_data"] = $search_data;

        return $main_arr;
       // return $arr_pharse;
    }

    function get_paragraph_search_list($paragraph , $value)
    {
        $count = substr_count($paragraph,$value);
        return $count;
    }

    /*#######################################################################################################*/
    function getAll_Eliment_Arr($url)
    {
       $this->data['dom']['paragraph'] = array();
       $this->data['dom']['bold'] = array();
       $this->data['dom']['italics'] = array();
       $this->data['dom']['h1'] = array();
       $this->data['dom']['href'] = array();
       $this->data['dom']['meta_keyword'] = array();
       $this->data['dom']['meta_description'] = array();
       $this->data['dom']['title'] = array();
      
      // $this->data['dom']['word_density'] = array();
       $this->data['dom']['url'] = array();
   //    $this->data['dom']['total_word'] = array();
                
                $this->data['dom']['url'][] = $url;
                
                $x = $this->getEntity($url);
                foreach($x->query("//p") as $node)
                {
                    $this->data['dom']['paragraph'][] = $node->nodeValue;
                }
                
                foreach($x->query("//b") as $node)
                {
                    $this->data['dom']['bold'][] = $node->nodeValue;
                }

                foreach($x->query("//i") as $node)
                {
                    $this->data['dom']['italics'][] = $node->nodeValue;
                }

                foreach($x->query("//h1") as $node)
                {
                    $this->data['dom']['h1'][] = $node->nodeValue;
                }
                foreach($x->query("//a") as $node)
                {
                   // $this->data['dom']['hrf'][] = $node->nodeValue;
                    if($node->getAttribute("href"))
                    {
                        $this->data['dom']['href'][] = $node->getAttribute("href");
                    }
                }
                foreach($x->query("//meta") as $node)
                {
                    $this->data['dom']['meta'][] = $node->getAttribute("name");
                    if($node->getAttribute("name") == "keywords")
                    {
                        $name       =   $node->getAttribute("name");
                        $content    =   $node->getAttribute("content");
                        $this->data['dom']['meta_keyword'][] =  $name.' = '.$content;
                    }
                    if($node->getAttribute("name") == "description")
                    {
                        $name       =   $node->getAttribute("name");
                        $content    =   $node->getAttribute("content");
                        $this->data['dom']['meta_description'][] =  $name.' = '.$content;
                    }
                }
                foreach($x->query("//title") as $node)
                {
                    $this->data['dom']['title'][] = $node->nodeValue;
                }
    }
    
    function getWordDensityFromArr($arr)
    {
        $arr_word_density = $this->getWordDensity($arr);
        return $arr_word_density;
    }
    
    function getElementIsExist_Arr($arr)
   {
       $arr_main = array();
       
       $arr_main['match_word_bold'] = array();
       $arr_main['match_word_italics'] = array();
       $arr_main['match_word_h1'] = array();
       $arr_main['match_word_href'] = array();
       $arr_main['match_word_meta_keyword'] = array();
       $arr_main['match_word_meta_description'] = array();
       $arr_main['match_word_title'] = array();
       $arr_main['match_word_url'] = array();
       
       $arr_temp_bold = join(" " , $this->data['dom']['bold'] );
       $arr_temp_italics = join(" " , $this->data['dom']['italics'] );
       $arr_temp_h1 = join(" " , $this->data['dom']['h1'] );
       $arr_temp_href = join(" " , $this->data['dom']['href'] );
       $arr_temp_meta_keyword = join(" " , $this->data['dom']['meta_keyword'] );
       $arr_temp_meta_description = join(" " , $this->data['dom']['meta_description'] );
       $arr_temp_title = join(" " , $this->data['dom']['title'] );
       $arr_temp_url = join(" " , $this->data['dom']['url'] );
       
       $str_bold = strtolower($arr_temp_bold);
       $str_italics = strtolower($arr_temp_italics);
       $str_h1 = strtolower($arr_temp_h1);  
       $str_href = strtolower($arr_temp_href); 
       $str_meta_keyword = strtolower($arr_temp_meta_keyword); 
       $str_meta_description = strtolower($arr_temp_meta_description); 
       $str_title = strtolower($arr_temp_title); 
       $str_url = strtolower($arr_temp_url); 
       $arr_main['str'][0] = $str_meta_description;
      // $sub_str = '';
        foreach($arr as $key=>$value)
        {
            $key = trim($key);
           //$text = str_replace($key."", '_', $str_meta_description);
            if (strpos($str_bold, $key) !== false) 
            {       $arr_main['match_word_bold'][] = "b"."</br>";  }
            else {  $arr_main['match_word_bold'][] = "";   }
            
            if (strpos($str_italics, $key) !== false) 
            {   $arr_main['match_word_italics'][] = "i"."</br>";   }
            else  {   $arr_main['match_word_italics'][] = "";    }
            
            if (strpos($str_h1, $key) !== false) 
            {     $arr_main['match_word_h1'][] = "h"."</br>";    }
            else {     $arr_main['match_word_h1'][] = "";    }
            
            if (strpos($str_href, $key) !== false) 
            {     $arr_main['match_word_href'][] = "href"."</br>";    }
            else {     $arr_main['match_word_href'][] = "";    }
            
            if (strpos($str_meta_keyword, $key) !== false) 
            {     $arr_main['match_word_meta_keyword'][] = "keyword"."</br>";    }
            else {     $arr_main['match_word_meta_keyword'][] = "";    }
            
            if (strpos($str_meta_description, $key) !== false) 
            {     $arr_main['match_word_meta_description'][] = "description";    }
            else {     $arr_main['match_word_meta_description'][] ="";    }
           
            if (strpos($str_title, $key) !== false) 
            {     $arr_main['match_word_title'][] = "title"."</br>";    }
            else {     $arr_main['match_word_title'][] = "";    }
            
            if (strpos($str_url, $key) !== false) 
            {     $arr_main['match_word_url'][] = "url"."</br>";    }
            else {     $arr_main['match_word_url'][] = "";    }
            
        }   
        return$arr_main;
   }
    
    function getStringUI_For_Word_Match_Arr($arr_main)
   {
       $arr_main['match_word_array'] = array();
       for( $i = 0 ; $i <sizeof($arr_main['match_word_bold']) ; $i++)
       {
           $str = '';
           if($arr_main['match_word_bold'][$i] != '')
           {   $str .= '<a href="#" title="B : Occurs atleast once in BOLD TAG" data-rel="tooltip">B</a>&nbsp;,';    }
           
           if($arr_main['match_word_italics'][$i] != '')
           {   $str .= '<a href="#" title="I : Occurs atleast once in ITALICS TAG" data-rel="tooltip">I</a>&nbsp;,';    }
           
           if($arr_main['match_word_h1'][$i] != '')
           {   $str .= '<a href="#" title="H : Occurs atleast once in HEADER TAG" data-rel="tooltip">H</a>&nbsp;,';    }
           
           if($arr_main['match_word_href'][$i] != '')
           {   $str .= '<a href="#" title="A : Occurs atleast once in ANCHOR TAG" data-rel="tooltip">A</a>&nbsp;,';    }
           
           if($arr_main['match_word_meta_keyword'][$i] != '')
           {   $str .= '<a href="#" title="K : Occurs atleast once in META KEYWORD TAG" data-rel="tooltip">K</a>&nbsp;,';    }
           
           if($arr_main['match_word_meta_description'][$i] != '')
           {   $str .= '<a href="#" title="D : Occurs atleast once in META DESCRIPTION TAG" data-rel="tooltip">D</a>&nbsp;,';    }
           
           if($arr_main['match_word_title'][$i] != '')
           {   $str .= '<a href="#" title="T : Occurs atleast once in TITLE TAG" data-rel="tooltip">T</a>&nbsp;,';    }
           
           if($arr_main['match_word_url'][$i] != '')
           {   $str .= '<a href="#" title="U : Occurs atleast once in URL TAG" data-rel="tooltip">U</a>&nbsp;,';    }
           
           if(substr($str, -1) == ",")
           {
               $str = substr($str, 0, -1);
           } 
           $arr_main['match_word_array'][] = $str;
       }
       return $arr_main;
   }
   
   function getUiStrings_Arr($arr_main , $arr_word_density)
   {
       $UI_arr = array();
       $url = '';
       $ttl = '';
       $wd = '';
      
        for($i = 0 ; $i<sizeof($this->data['dom']['url']) ; $i++)
        {
           $url .= '<tr><td> '. ($i+1) .'</td><td>'.$this->data['dom']['url'][$i].' </td></tr>';
        }
         
        $arr_temp = $arr_word_density;
        $ttl_val = $this->countAssocArrayVal($arr_temp);
        
         $ttl .= '<tr><td>'.$ttl_val.' </td></tr>';
        
        $i = 0;
        $j=0;
        foreach($arr_temp as $key=>$value)
        {
            $per = $this->getWord_Density_Ratio($value, $ttl_val);
            $i += 1;
            $wd .= '<tr><td>'. $i .'</td>
                    <td>'.$key.'&nbsp;
                        '.$arr_main['match_word_array'][$j].'
                    </td>
                    <td>'.$per.'%'.'</td>
                    <td><div class="container"><div class="progressbar" style="width: 75px;">50%&nbsp;</div></div></td>
                    <td class="center">'.$value.'</td></tr>';
            $j += 1;
        }
        $UI_arr["url"] = $url;
        $UI_arr["ttl"] = $ttl;
        $UI_arr["wd"] = $wd;
        return $UI_arr;
   }
   
   function getWordPharseArr_by_len($len)
    {
      // $word_arr = $this->data['dom']['paragraph_non_filtered_arr'];
       // $arr_filltered = $this->filterArray($word_arr);
      //  $arr = $arr_filltered;
         $arr = $this->data['dom']['paragraph_non_filtered_arr'];
        $arr_pharse = array();
        $lmt = sizeof($arr) - ($len - 1 );
        for( $i = 0 ; $i < $lmt ; $i++ )
        {
            $word = '';
            for($j = $i ; $j < $len+$i ; $j++)
            {
                if($j == $i){
                    $word .= $arr[$j];
                }
                else {
                    $word .= " ".$arr[$j];
                }   
            }
            //$word .= '</br>';
            $arr_pharse[] = $word;
        }
        return $arr_pharse;        
    }
    
     //   get word density
    function getWordDensity_With_Out_Filter($arr_pharsed)
    {

       // $arr_non_filltered = $this->data['dom']['paragraph_non_filtered_arr'];
        //  to count word density in array
        $arr_cnt_density = array_count_values($arr_pharsed);

        //  to set array in DESC order
        $arr_w_d_temp = $this->sortAssocArr($arr_cnt_density);
       // $this->data['dom']['w_d_temp'] = $this->sortAssocArr($arr_cnt_density);

        //  to remove null call local function
       $arr_w_d_temp_1 = $this->removeNull($arr_w_d_temp);
        
       // return $this->data['dom']['w_d_temp'];
       return $arr_w_d_temp_1;
       // return $arr_w_d_temp;

    }
    
    
   
   function getUI_Page_Info_All($url , $ind)
   {
       $this->getAll_Eliment_Arr($url);
       $single_pharse_arr = array();
       $single_pharse_arr = $this->getWordDensityFromArr($this->data['dom']['paragraph']);
       
       $arr_main_single = array();
       $arr_main_single = $this->getElementIsExist_Arr($single_pharse_arr);
       $arr_main_single_ui = $this->getStringUI_For_Word_Match_Arr($arr_main_single);
       $arr_UI_String_single = $this->getUiStrings_Arr($arr_main_single_ui, $single_pharse_arr);
       
       $UI_arr = $arr_UI_String_single;
       $div_arr = array(    '<div class="tab-pane active" id="page_info_all_1">' ,
                            '<div class="tab-pane" id="page_info_all_2">' ,
                            '<div class="tab-pane" id="page_info_all_3">' ,
                            '<div class="tab-pane" id="page_info_all_4">' ,
                            '<div class="tab-pane" id="page_info_all_5">' ,
                            '<div class="tab-pane" id="page_info_all_6">' ,
                            '<div class="tab-pane" id="page_info_all_7">' ,
                            '<div class="tab-pane" id="page_info_all_8">' 
                        );     
       
       $ui = '';
       $ui .= $div_arr[$ind];
       /* <div class="box span6" >
                                    <div class="box-content center" id="w3c_result_div">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th> No</th><th> URL</th>
                                                </tr>
                                            </thead>
                                            <tbody id="all_url_body">
                                                '.$UI_arr['url'].' 
                                            </tbody>
                                        </table>
                                    </div>

                                </div>*/
       $ui .= '
                            <div class="row-fluid sortable">
                               
                                <div class="box span12" >
                                    <div class="box-content center" id="w3c_result_div">
                                        <table class="table table-bordered ">
                                            <thead>
                                                    <tr>
                                                        <th> Total No Of Word</th>
                                                    </tr>
                                            </thead>
                                            <tbody id="all_total_word_body">
                                                     '.$UI_arr['ttl'].' 
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>';
                            
          $ui .=      ' <div class="row-fluid sortable">
                                    <div class="box span6" >
                                        <div class="box-content center" id="w3c_result_div">
                                        <h3>Single Words</h3>
                                            <table class="table table-bordered ">
                                                <thead>
                                                        <tr>
                                                            <th>No</th><th>Word</th><th>Density</th><th>Wizard</th><th>Repeats</th>
                                                        </tr>
                                                </thead>
                                                <tbody id="all_word_density_body">
                                                        '.$UI_arr['wd'].' 
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>';
          
       $pharse_arr_2 = $this->getWordPharseArr_by_len(2);
       $arr_word_density_2 = $this->getWordDensity_With_Out_Filter($pharse_arr_2);
     
       $arr_main_2 = array();
       $arr_main_2 = $this->getElementIsExist_Arr($arr_word_density_2);
     
       $arr_main_ui_2 = $this->getStringUI_For_Word_Match_Arr($arr_main_2);
       $arr_UI_String_2 = $this->getUiStrings_Arr($arr_main_ui_2, $arr_word_density_2);
       $UI_arr = $arr_UI_String_2;
       
           $ui .=      '        <div class="box span6" >
                                        <div class="box-content center" id="w3c_result_div">
                                        <h3>Pharses 2 / '.$UI_arr['ttl'].'</h3>
                                            <table class="table table-bordered ">
                                                <thead>
                                                        <tr>
                                                            <th>No</th><th>Word</th><th>Density</th><th>Wizard</th><th>Repeats</th>
                                                            
                                                        </tr>
                                                </thead>
                                                <tbody id="all_word_density_body">
                                                        '.$UI_arr['wd'].' 
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                            </div>
                 ';
           
       $pharse_arr_3 = $this->getWordPharseArr_by_len(3);
       $arr_word_density_3 = $this->getWordDensity_With_Out_Filter($pharse_arr_3);
       $arr_main_3 = array();
       $arr_main_3 = $this->getElementIsExist_Arr($arr_word_density_3);
       $arr_main_3 = $this->getStringUI_For_Word_Match_Arr($arr_main_3);
       $arr_UI_String_3 = $this->getUiStrings_Arr($arr_main_3, $arr_word_density_3);
       $UI_arr = $arr_UI_String_3;
             $ui .=      ' <div class="row-fluid sortable">
                                    <div class="box span6" >
                                        <div class="box-content center" id="w3c_result_div">
                                        <h3>Pharses 3 / '.$UI_arr['ttl'].'</h3>
                                            <table class="table table-bordered ">
                                                <thead>
                                                        <tr>
                                                            <th>No</th><th>Word</th><th>Density</th><th>Wizard</th><th>Repeats</th>
                                                          
                                                        </tr>
                                                </thead>
                                                <tbody id="all_word_density_body">
                                                        '.$UI_arr['wd'].' 
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>';
          
       $pharse_arr_4 = $this->getWordPharseArr_by_len(4);
       $arr_word_density_4 = $this->getWordDensity_With_Out_Filter($pharse_arr_4);
       $arr_main_4 = array();
       $arr_main_4 = $this->getElementIsExist_Arr($arr_word_density_4);
       $arr_main_4 = $this->getStringUI_For_Word_Match_Arr($arr_main_4);
       $arr_UI_String_4 = $this->getUiStrings_Arr($arr_main_4, $arr_word_density_4);
       $UI_arr = $arr_UI_String_4;
       
           $ui .=      '        <div class="box span6" >
                                        <div class="box-content center" id="w3c_result_div">
                                        <h3>Pharses 4 / '.$UI_arr['ttl'].'</h3>
                                            <table class="table table-bordered ">
                                                <thead>
                                                        <tr>
                                                            <th>No</th><th>Word</th><th>Density</th><th>Wizard</th><th>Repeats</th>
                                                           
                                                        </tr>
                                                </thead>
                                                <tbody id="all_word_density_body">
                                                        '.$UI_arr['wd'].' 
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                            </div> 
                    ';
           
          $pharse_arr_5 = $this->getWordPharseArr_by_len(5);
       $arr_word_density_5 = $this->getWordDensity_With_Out_Filter($pharse_arr_5);
       $arr_main_5 = array();
       $arr_main_5 = $this->getElementIsExist_Arr($arr_word_density_5);
       $arr_main_5 = $this->getStringUI_For_Word_Match_Arr($arr_main_5);
       $arr_UI_String_5 = $this->getUiStrings_Arr($arr_main_5, $arr_word_density_5);
       $UI_arr = $arr_UI_String_5;
             $ui .=      ' <div class="row-fluid sortable">
                                    <div class="box span6" >
                                        <div class="box-content center" id="w3c_result_div">
                                        <h3>Pharses 5 / '.$UI_arr['ttl'].'</h3>
                                            <table class="table table-bordered ">
                                                <thead>
                                                        <tr>
                                                            <th>No</th><th>Word</th><th>Density</th><th>Wizard</th><th>Repeats</th>
                                                           
                                                        </tr>
                                                </thead>
                                                <tbody id="all_word_density_body">
                                                        '.$UI_arr['wd'].' 
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>';
          
       $pharse_arr_6 = $this->getWordPharseArr_by_len(6);
       $arr_word_density_6 = $this->getWordDensity_With_Out_Filter($pharse_arr_6);
       $arr_main_6 = array();
       $arr_main_6 = $this->getElementIsExist_Arr($arr_word_density_6);
       $arr_main_6 = $this->getStringUI_For_Word_Match_Arr($arr_main_6);
       $arr_UI_String_6 = $this->getUiStrings_Arr($arr_main_6, $arr_word_density_6);
       $UI_arr = $arr_UI_String_6;
       
           $ui .=      '        <div class="box span6" >
                                        <div class="box-content center" id="w3c_result_div">
                                        <h3>Pharses 6 / '.$UI_arr['ttl'].'</h3>
                                            <table class="table table-bordered ">
                                                <thead>
                                                        <tr>
                                                            <th>No</th><th>Word</th><th>Density</th><th>Wizard</th><th>Repeats</th>
                                                            
                                                        </tr>
                                                </thead>
                                                <tbody id="all_word_density_body">
                                                        '.$UI_arr['wd'].' 
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                            </div>
                            
                    </div>';
       
       return $ui;
   }

     function getUiStrings_Arr_Limited($arr_main , $arr_word_density , $lmt)
    {
         $lmt_bool = false;
         if($lmt == 0 )
         {
             $lmt_bool = TRUE;
         }
         
        $UI_arr = array();
        $url = '';
        $ttl = '';
        $wd = '';

         for($i = 0 ; $i<sizeof($this->data['dom']['url']) ; $i++)
         {
            $url .= '<tr><td> '. ($i+1) .'</td><td>'.$this->data['dom']['url'][$i].' </td></tr>';
         }

         $arr_temp = $arr_word_density;
         $ttl_val = $this->countAssocArrayVal($arr_temp);

          $ttl .= '<tr><td>'.$ttl_val.' </td></tr>';

         $i = 0;
         $j=0;
         foreach($arr_temp as $key=>$value)
         {
             $per = $this->getWord_Density_Ratio($value, $ttl_val);
             $i += 1;
             if($i < 6 || $lmt_bool == TRUE)
             {
                 /*
                $wd .= '<tr><td>'. $i .'</td>
                        <td>'.$key.'&nbsp;
                            '.$arr_main['match_word_array'][$j].'
                        </td>
                        <td>'.$per.'%'.'</td>
                        <td><div class="container"><div class="progressbar" style="width: 75px;">50%&nbsp;</div></div></td>
                        <td class="center">'.$value.'</td></tr>';
                $j += 1;
                */
                $wd .= '<tr class="odd gradeX"><td>'. $i .'</td>
                            <td>'.$key.'&nbsp;'.$arr_main['match_word_array'][$j].'</td>
                                <td class="center">'.$value.'</td>
                            <td> <div class="progress">
                                    <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 40%;">60%</div>
                                </div>
                            </td><td class="center"> '.$per.'%'.'</td>
                              <td> -- </td>      
			</tr>';
            }
         }
         $UI_arr["url"] = $url;
         $UI_arr["ttl"] = $ttl;
         $UI_arr["wd"] = $wd;
         return $UI_arr;
    }
    
    function getUI_Page_Info_Limited($url , $ltd)
    {
       $this->getAll_Eliment_Arr($url);
       $single_pharse_arr = array();
       $single_pharse_arr = $this->getWordDensityFromArr($this->data['dom']['paragraph']);
       
       $arr_main_single = array();
       $arr_main_single = $this->getElementIsExist_Arr($single_pharse_arr);
       $arr_main_single_ui = $this->getStringUI_For_Word_Match_Arr($arr_main_single);
       $arr_UI_String_single = $this->getUiStrings_Arr_Limited($arr_main_single_ui, $single_pharse_arr , $ltd);
       
       $pharse_arr_2 = $this->getWordPharseArr_by_len(2);
       $arr_word_density_2 = $this->getWordDensity_With_Out_Filter($pharse_arr_2);
       $arr_main_2 = array();
       $arr_main_2 = $this->getElementIsExist_Arr($arr_word_density_2);
       $arr_main_ui_2 = $this->getStringUI_For_Word_Match_Arr($arr_main_2);
       $arr_UI_String_2 = $this->getUiStrings_Arr_Limited($arr_main_ui_2, $arr_word_density_2 , $ltd);
       
       $arr = array();
       $arr["ui_1"] = $arr_UI_String_single;
       $arr["ui_2"] = $arr_UI_String_2;
       return $arr;
    }
   





}



/*
   function getElementIsExist()
   {
       $arr_temp = $this->data['dom']['word_density'];
       
       $arr_temp_bold = array_map('strtolower', $this->data['dom']['bold']);
       $arr_temp_italics = array_map('strtolower', $this->data['dom']['italics']);
       $arr_temp_h1 = array_map('strtolower', $this->data['dom']['h1']);
              
       $this->data['dom']['match_word_bold'] = array();
       $this->data['dom']['match_word_italics'] = array();
       $this->data['dom']['match_word_h1'] = array();
       
        foreach($arr_temp as $key=>$value)
        {
            $val = '';
            if (in_array( $key , $arr_temp_bold) )
            {       $this->data['dom']['match_word_bold'][] = "b";  }
            else{  $this->data['dom']['match_word_bold'][] = "";   }
            
            if(in_array( $key , $arr_temp_italics) )
            {   $this->data['dom']['match_word_italics'][] = "i";   }
            else  {   $this->data['dom']['match_word_italics'][] = "";    }
            
            if(in_array( $key , $arr_temp_h1) )
            {     $this->data['dom']['match_word_h1'][] = "h";    }
            else {     $this->data['dom']['match_word_h1'][] = "";    }
        }       
   }*/


?>
