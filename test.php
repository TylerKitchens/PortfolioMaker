
<!doctype html>
<html lang="en">
  <head>
    <title>Class Portfolio</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body style="background-color: #efefef;">
    <div class="container bg-white shadow mt-5">
        <h1 class="display-1 text-center"> 5110 Portfolio</h1>
    <?php
// Echo's each file in the directory that this file is placed in
function outputFiles($path, $isRecurse, $parent){

    //makes sure file is valid to avoid a crash
    if(file_exists($path) && is_dir($path)){
        // Scan the files in this directory
        $result = scandir($path);
        
        // we do not need to see PHP errors, or the . / .. directories
        $files = array_diff($result, array('.', '..', 'error_log'));

        //This is optional and can be deleted. If you want week 1 at the top delete.
        $files = array_reverse($files);
        if(count($files) > 0){

            foreach($files as $file){  
                //determine if the file is a directory or regular file
                if(is_file("$path/$file")){
                   
                    // Display filename as a link, all the NBSP is lazyness for making an <ul> <li>
                    echo "<a href='./" . $parent . $file . "'>&nbsp;&nbsp;&nbsp;&nbsp;" . $file . "</a><br>";

                } else if(is_dir("$path/$file")){
                  //isRecurse decides whether this is a sub directory or a top level directory; either a <b> tag or a <h2>
                    if($isRecurse){
                        echo "<a href='./" . $parent. $file . "'><b>" . $file . "</b></a><br>";
                    }else{
                        echo "<hr>";
                        echo "<a href='./" . $parent. $file . "'><h2>" . $file . "</h2></a>";
                    }
                    
                    // Recursively call the function if directories found. Also we update the parent directory to maintin links
                    outputFiles("$path/$file", true, ($parent . "/" . $file . "/"));
                }
            }
        } else{
            echo "ERROR: No files found in the directory.";
        }
    } else {
        echo "ERROR: The directory does not exist.";
    }
}
 
// Call the function
outputFiles(".", false, '');
?>
    </div>
  
    <span id="bottom"></span>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    
  </body>
</html>


