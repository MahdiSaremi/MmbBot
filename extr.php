<?php

// Settings
$output = 'extractMe.php';
$ignores = [
    // 'config.php',
    // 'load.php',
    // 'pay.php',
    // 'Mmb',
];


// Proccess on settings
$ignores[] = $output;
$ignores = array_map(function($ig) {
    return './' . strtolower($ig);
}, $ignores);

// Start proccess
echo ">> I'm ready! <<\n";
echo "Tip: You can exit via Ctrl+C\n";
while(true) {

    // Wait for answer
    echo "\n# Press enter...";
    readline();

    // Find all files
    echo "\r@ Please wait...\tN/A\t[ 0% ]";
    $files = [];
    $folders = [];
    findAllFiles('.', 'php', $files, $folders);
    $count = count($files);

    // Start file
    $out = fopen($output, 'w');
    fwrite($out, '<?php
    if(defined("IGNORE_EXTRACT_ME")) return;
    (function() {
        $me = fopen(__FILE__, "r");
        $point = strpos(fread($me, 1000), "__halt_"."compiler();?>") + 20;
        fseek($me, $point);
        while(true) {
            $len = unpack("N", base64_decode(fread($me, 8)))[1];
            if($len == 0) break;
            $name = fread($me, $len);
            @mkdir(__DIR__ . "/" . $name);
        }
        while(true) {
            $len = @unpack("N", base64_decode(fread($me, 8)))[1];
            if($len == 0) break;
            $name = fread($me, $len);
            $len = unpack("N", base64_decode(fread($me, 8)))[1];
            $file = fopen(__DIR__ . "/" . $name, "w");
            stream_copy_to_stream($me, $file, $len);
            fclose($file);
        }
        fclose($me);
        file_put_contents(__FILE__, "<?php /* Extracted :) */ ?>");
    })();
    __halt_compiler();?>');

    echo "\r@ Please wait...\t0/$count\t[ 0% ]";


    // Folders
    foreach($folders as $folder) {

        fwrite($out, base64_encode(pack("N", strlen($folder))));
        fwrite($out, $folder);

    }
    fwrite($out, base64_encode(pack("N", 0)));

    // Files
    foreach($files as $i => $file) {

        $progress = round($i / $count * 100);
        echo "\r@ Please wait...\t$i/$count\t[ $progress% ]";

        fwrite($out, base64_encode(pack("N", strlen($file))));
        fwrite($out, $file);

        fwrite($out, base64_encode(pack("N", filesize($file))));
        $f = fopen($file, "r");
        stream_copy_to_stream($f, $out);
        fclose($f);

    }

    echo "\r@ Please wait...\t$count/$count\t[ 100% ]";

    // Close file
    fclose($out);
    echo "\r~ Completed [ 100% ] ... Output file saved as $output";

}


// Functions

function findAllFiles($dir, $ext, &$files, &$folders) {
    global $ignores;
    if(!is_array($dir)) $dir = [$dir];
    
    foreach($dir as $folder) {
        if(in_array(strtolower($folder), $ignores)) continue;
        
        $folders[] = $folder;
        $list = glob("$folder/**.$ext");
        $list = array_filter($list, function($x) {
            global $ignores;
            return !(in_array(strtolower($x), $ignores));
        });
        array_push($files, ...$list);
        $intoDirs = glob("$folder/**", GLOB_ONLYDIR);
        if($intoDirs)
            findAllFiles($intoDirs, $ext, $files, $folders);
    }
}

