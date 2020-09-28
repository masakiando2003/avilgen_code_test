<?php
$endpoint = explode('/', $_SERVER['PATH_INFO'])[1];
if($endpoint=="start"){
    include("index.html");
    exit;
}

if($endpoint=="api"){
    // ここに処理を記述してください。
    $output = array();
    $output_str = "";
    $loop_count = 30;
    $multiples = array();
    $postedData = $_POST["obj"];
    $tempData = str_replace("\\", "",$postedData);
    $cleanData = (array)json_decode($tempData);
    foreach($cleanData['obj'] as $index => $obj){
        foreach($obj as $key=>$value){
            if($key == 'num'){
                $multiples[$index]['num'] = $value;
            }
            else if($key == 'text'){
                $multiples[$index]['text'] = $value;
            }
        }
    }
    for($i = 1; $i <= $loop_count; $i++){
        $numeric_flag = true;
        for($j = 0; $j < count($multiples); $j++){
            if($i % $multiples[$j]['num'] == 0){
                $temp_output .= $multiples[$j]['text']." ";
                $numeric_flag = false;
            }
        }
        if($numeric_flag){
            array_push($output, $i);
        }
        else {
            array_push($output, $temp_output);
        }
        $temp_output = "";
    }
    $output_str = implode(", ",$output);
    echo $output_str;
}
?>