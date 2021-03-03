<!--
Vikas Dhiman
Student ID:1930791
March 2,2021
-->

<?php
//Constants 
//Constants
define("_FOLDER_CSS","CSS/");
define("_FILE_CSS_START",_FOLDER_CSS."start_stylesheet.css");
define("_FILE_CSS_PURCHASE",_FOLDER_CSS."purchase_stylesheet.css");
define("_FILE_CSS_FORMS",_FOLDER_CSS."forms_stylesheet.css");
define("_FILE_CSS_ABOUT",_FOLDER_CSS."about_stylesheet.css");
define("_FILE_CSS_NAVIGATIONBAR",_FOLDER_CSS."navigationbar_stylesheet.css");
define("_FILE_CSS_COMM",_FOLDER_CSS."comm_stylesheet.css");

//Constraint for website Pages
define("_HOME_PAGE","./homepage.php");
define("_ORDERS_PAGE","./orderspage.php");
define("_BUYING_PAGE","./buyingpage.php");
define("_ABOUTUS_PAGE","./aboutuspage.php");


//Creating page header 
function createHeaderPage($title)
{
    ?>
    <!DOCTYPE html>
    <?php
    header('Content-type: text/html; Charset="UTF-8"');
    //Setting a user defined error handling function
    set_error_handler("myErrorManager");
    //Setting a user defined exception handling function
    set_exception_handler("myExceptionHandler");
    
    ?>
    <html lang="en">
    <head>
    <meta charset='UTF-8'>
    <?php
    //Stylesheet file to start for index page
    $stylesheet = _FILE_CSS_START;
    if(isset($_GET["mode"]))
    {
      {
          if($_GET["mode"]=="purchase")
            //seteing the stylesheet file for stylesheet for the purchase page 
            if(isset($_GET["command"]))
            {
                //changing the background color
                if($_GET["command"]=="print")
                {
                    $stylesheet=_FILE_CSS_COMM;
                }
            }
        }
    }    
    if($_GET["mode"]=="form")
    {
        //Setting the stylesheet file to stylesheet for the form page
        $stylesheetFile = _FILE_CSS_FORMS;
    }
    if($_GET["mode"]=="about")
    {
        //Sets the $stylesheet file to the stylesheet for the about us page
        $stylesheet = _FILE_CSS_ABOUT;
    }
?>
    // NavigationBar has been used in every single page, So I deceided to make a common stylesheet for all the pages
    <link rel="stylesheet", type="text/css", href="<?php echo _FILE_CSS_NAVIGATIONBAR; ?>">
    // Setting the stylesheet for any page
    <link rel="stylesheet", type="text/css", href="<?php echo $stylesheetFile; ?>"
    //Setting the title of the page -->
    <title><?php echo $title ?></title>
    Setting the font of the page -->
    <link href="<?php echo _FONT_LINK; ?>" rel="stylesheet">
    <!-- //Setting the icon of the page -->
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo _LOGO; ?>"/>
    </head>
    <body>
<?php    
}

// Function to create the Navigation Bar
function createNavigationBar()
{
?>
    <nav id="page-nav">    
        <!-- Common menu -->
        <label for="commonMenu">&#9776;</label>
        <!-- &#9776 is the code for common menu -->
        <input type="checkbox" id="commonMenu"/>
        <ul id="navigationBar_ul">
            <li id="img_logo"><img width="55" src="<?php echo _LOGO; ?>"/></li>
            <li><a href="<?php echo _HOME_PAGE; ?>">HOME</a></li>
            <li><a href="<?php echo _ORDERS_PAGE; ?>">ORDERS</a></li>
            <li><a href="<?php echo _BUYING_PAGE; ?>">BUYING PAGE</a></li>
            <li><a href="<?php echo _ORDERS_PAGE; ?>">ABOUT US</a></li>
        </ul>
    </nav>
<?php    
}

//FUNCTION for common footer for every page
function createFooterPage()
{
    //setting the date and time to the current time
    $date = new datetime("now");
    ?>
    <br>
    <footer id="infoOfCopyright">
        <p>
            VIKAS DHIMAN &COPYRIGHT;
            <?php echo date("Y") ?>
        </p>
    </footer>
    </body>
    </html>
    <?php        
            
}

function loadImages($imagearray)
{
    //Randomly displaying the images on the home page 
    shuffle($imagearray);
    ?>

    <!-- Displaying the 100% bigger -->
    <div id="biggerImageDiv">
        <a href="<?php echo _IMAGE_REDIRECT ?>">
            <img id="biggerImage" src="<?php echo _Image1; ?>" alt="<?php echo _START_IMAGENOTLOADING_ERROR ?>">
        </a>
    </div>    
    <?php
    //Displaying the little images
    for($index=0;$index<count($imageArray);$index++)
    {
        ?>
        <div id="littleImageDiv">
            <div id="smallImages">
                <a href="<?php echo _IMAGE_REDIRECT ?>">
                    <img src="<?php echo $imageArray[$index] ?>" alt="<?php echo _DEFAULT_IMAGENOTLOAD_ERROR ?>" style="width:100%">
                </a>
            </div>
        </div>
    <?php                 
    }
}

//Fuction to override error handler in the webpage
function manageError($errorCode, $errorMessage, $errorFile, $errorLine)
{
    $browserName = $_SERVER['HTTP_USER_AGENT'];
    $currentTIme = new DateTime("now");
    $errorOccurance = "An error occured at " . $currentTIme->format("Y/M/D H:i:s")."\r\n";
    "Error Code: ".$errorCode."\r\n";
    "Error Message: ".errorMessage."\r\n";
    "Error File: ".$errorFile."\r\n";
    "Error Line: ".$errorLine."\r\n";
    "Browser: ".$browserName."\r\n";
    file_put_contents(_LOG_FILE, $errorOccurance, FILE_APPEND);
    error_log($errorOccurance);

    die("An Error Occured...");

}

//function to override the exception handler in webpage

function manageException($exception)
{
    $browserName = $_SERVER['HTTP_USER_AGENT'];
    $currentTIme = new DateTime("now");
    $exceptionOccurance = "An exception occured at " . $currentTIme->format("Y/M/D H:i:s")."\r\n";
    "Exception code: ".$exception->getcode()."\r\n";
    "Exception messge: ".$exception->getCode()."\r\n";
    "Exception Message: ".$exception->getMessage()."\r\n";
    "FileName: ".$exception->getFile(). "\r\n";
    "Line :" .$exception->getline()."\r\n";
    "FileName: ".$exception->getFile(). "\r\n";
    file_put_contents(_LOG_FILE, $exceptionOccurence, FILE_APPEND);
    error_log($exceptionOccurance);
    die("An exception had occured...");

}

//Function to show errors
function showError($errorMessage)
{
    ?>
    <label class="<?php echo _CLASS_OF_ERROR ?>">
        <?php echo $errorMessage; ?>
    </label>
    <?php    
}

//Validation of product key using a function 
function validation($filedName)
{
    if(isset($_POST[_POST_VAlUE]))
    {
        if($_POST[$filedName]==""))
        {
            showError($filedName." can not be empty.");
        }
        else{
            if(mb_substr(ucfirst($_POST[$filedName]),0,1)!=_PRODUCTION_FIRST_CHARACTER_UPPER )
            {
                showError($filedName. " can only start with p or P.");
            }
            elseif(is_numeric( $_POST[$filedName]))
            {
                showError("Please enter text values only.");
            }
            elseif(mb_strlen( $_POST[$filedName])>_KEY_MAX_LENGTH)
            {
                showError($filedName." Can't be longer than "._KEY_MAX_LENGTH" characters.");
            }
            else{
                //Increased the Validation Flag number for validation of Buying page
                $_GET["validationFlags"]++;
            }
        }
    }
}
