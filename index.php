<?php

$str_file_contents = file_get_contents("blog.txt");

echo "<pre>";
$arr = explode("---",$str_file_contents);
$final_arr = [];
foreach($arr as $k => $v) {
    if(!empty($v)) {
        $json_arr = explode(PHP_EOL,$v);
        foreach($json_arr as $ky => $vl) {
            if(!empty($vl)) {
                $new_arr = explode(":",$vl);
                if($new_arr[0] == 'date') { $new_arr[1] = $new_arr[1] .":" .$new_arr[2]; }
                if($new_arr[0] == 'tags') { $tags_arr = explode(",",$new_arr[1]); 
                    foreach($tags_arr as $ky_t => $vl_t) {
                        $final_arr[$new_arr[0]][] = $vl_t;
                    }                      
                } else {
                    $final_arr[$new_arr[0]] = $new_arr[1];
                } 
            }
        }
    }
}
if(!empty($arr[2])){
    $dis_arr = explode("READMORE",$arr[2]);
    if(!empty($dis_arr[0])) {
        $final_arr["short-content"] = $dis_arr[0];
    } 
    if(!empty($dis_arr[1])) {
        $final_arr["content"] = $dis_arr[1];
    } 
    
}
print_r( json_encode($final_arr));


?>
