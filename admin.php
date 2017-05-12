<?php

/**
 * Created by PhpStorm.
 * User: Junaid Shakoor
 * Date: 08-Nov-16
 *  The holy grail of our cms back-end
 */
require "config.php";

$action = isset($_GET['action']) ? $_GET['action'] : "" ;
$username = isset($_SESSION['username']) ? $_SESSION['username'] : "";


// if no session exists, i.e no action was made that means login again to start a session
if ($action != "login" && $action != "logout" && !$username){
    login();
    exit;
}

//everything will flow based on what the action is, stay with me
switch($action){
    case "login":           login();            break;
    case "logout":          logout();           break;
    case "newArticle":      newArticle();       break;
    case "editArticle":     editArticle();      break;
    case "deleteArticle":   deleteArticle();    break;
    case "allArticle":      listAllArticles();  break;
    case "search":          search();           break;
    case "profile":         profile();          break;
    default:                dashboardMenu();    break;
}

// functions set created by Ruaridh for login methods, safe SQL injection and other stuff
function safePOST($name){
    if(isset($_POST[$name])){
        return strip_tags($_POST[$name]);
    } else {
        return "";
    }
}

function safePOSTSQL($conn,$name){
    if(isset($_POST[$name])){
        return $conn->real_escape_string(strip_tags($_POST[$name]));
    } else {
        return "";
    }
}

function login()
{
    //$results['pageTitle'] = "Admin Login";
    $results = array();
    $results['pageTitle'] = "Admin Login";
    if (isset($_POST['login'])) {
        $options = [
            'cost' => 12,
        ];
        $connect = new mysqli(DB_SERVERNAME, DB_USERNAME, DB_PASSWORD, DB_NAME);
        $username = safePOSTSQL($connect, 'username');

        $password = safePOSTSQL($connect, 'password');
        if ($username != "" && $password != "") {
            $password = (safePOSTSQL($connect, 'password'));
            if ($username != "" && $password != "") {
                $sqlLogin = "SELECT * FROM userbase WHERE username='$username' AND password='$password'";
                $loginResult = mysqli_query($connect, $sqlLogin);
                if ($loginResult) {
                    $loginDetails = $loginResult->fetch_assoc();
                    if ($loginDetails['username'] == $username && $loginDetails['password'] == $password) {

                        $_SESSION['username'] = $username;
                        $_SESSION['name'] = $loginDetails['name'];
                        header("Location: admin.php");
                    } else {
                        $results['errorMessage'] = "Wrong details, please retry.";
                        require_once "loginForm.php";
                    }
                } else {
                    $results['errorMessage'] = "Unable to reach server.";
                    require_once "loginForm.php";
                }
            } else {
                $results['errorMessage'] = "Fields incomplete.";
                require_once "loginForm.php";
            }
        } else {
            require_once "loginForm.php";
        }
    }
    require_once "loginForm.php";
}

    function logout()
    {
        unset($_SESSION['username']);
        header("Location: admin.php");
        //    header("Location: logout.php");
    }

    function newArticle()
    {
        //this is the temp working array
        $results = array();
        $results['pageTitle'] = "New Article";
        $results['formAction'] = "newArticle";

        if (isset($_POST['saveChanges'])) {

            //users wants to save article that's in progress
            $article = new Article;
            $article->storeFromValues($_POST);
            $article->insert();
            header("Location: admin.php?status=changesSaved");
        } elseif (isset($_POST['cancel'])) {
            // user has cancelled changes, bail the fuck out
            header("Location: admin.php");
        } else {
            // user's not posted the article, so just display it for now
            $results['article'] = new Article;

            $results['authorList'] = Article::getAuthors();
            require "editArticle.php";
        }
    }

    function editArticle()
    {
        //working with temp array
        $results = array();
        $results['pageTitle'] = "Edit Article";
        $results['formAction'] = "editArticle";

        if (isset($_POST['saveChanges'])) {
            //user just initiated save article, create an Article subject and save it now.
            //fist check if article already exists in database
            if (!$article = Article::getById((int)$_POST['articleId'])) {
                header("Location: admin.php?error=articleNotFound");
                return;
            }

            //now, initiate Article store
            $article->storeFromValues($_POST);
            $article->update();
            header("Location: admin.php?status=changesSaved");
        } elseif (isset($_POST['cancel'])) {
            //user cancel chances, as usual, get the Fuck out from there
            header("Location: admin.php?");
        } else {
            //user's still working on it, don't mess with him
            // put in the results array, the article object that we get from the current article ID
            $results['article'] = Article::getById((int)$_GET['articleId']);
            $authorList = Article::getAuthors();
            $results['authorList'] = $authorList;
            require "editArticle.php";
        }
    }

    function deleteArticle()
    {
        if (!$article = Article::getById((int)$_GET['articleId'])) {
            //article doesnt exist, pour the fuck down on the user
            header("Location: admin.php?error=articleNotFound");
            return;
        }

        //else, go for the shot and deleting the article
        $article->delete();
        header("Location: admin.php?status=articleDeleted");
    }

    function dashboardMenu()
    {

        // I plan to show the following on the main dashboard menu,
        // -> The logout button
        // -> Recently made top five articles
        // -> status and error messages
        // -> other shit i havent thought about
        $results = array();
        $data = Article::getList();
        $results['articles'] = $data['result'];
        $results['pageTitle'] = "Dashboard";
        $results['pageHeading'] = "Dashboard";
        $results['totalRows'] = count($results['articles']);

        // checking for all sorts of errors & status here, since they'll be part of the notification
        // we give them, remember above all links have this ?status=something OR ?error=something
        if (isset($_GET['error'])) {
            if ($_GET['error'] == "articleNotFound")
                $results['errorMessage'] = "Error: Article was not found. Maybe retry?";

            if ($_GET['status'] == "changesSaved")
                $results['statusMessage'] = "Your changes have been saved";

            if ($_GET['status'] == "articleDeleted")
                $results['statusMessage'] = "Article deleted";
        }
        require("listArticles.php");
    }

    function listAllArticles()
    {
        $results = array();
        $data = Article::getList(100);
        $results['articles'] = $data['result'];
        $results['totalRows'] = count($results['articles']);
        $results['pageHeading'] = "All Articles";
        $results['pageTitle'] = $results['pageHeading'];

        //now we do the same thing as dashBoardMenu but distraction free, to only list artilces
        // pass in the allArticles.php to take care of shit for us

        require "ListAllArticles.php";
    }

    function search(){
        $results = array();
        $target = strip_tags($_POST['searchTarget']);
        $data = Article::searchTags($target);

        $results['articles'] = $data;
        $results['totalRows'] = count($data);
        $results['pageHeading'] = "Here are all the articles matching '<b>" . $_POST['searchTarget'] . "</b>'";
        $results['pageTitle'] = "Search";

        require "ListAllArticles.php";
    }

    function profile()
    {
        $results = array();
        $results['pageTitle'] = "Edit Profile";
        $results['formAction'] = "profile";
        $user = $_SESSION['username'];
        $connect = new mysqli(DB_SERVERNAME, DB_USERNAME, DB_PASSWORD, DB_NAME);

        if (isset($_POST['curPass'])) {
            $curPass = (safePOSTSQL($connect, 'curPass'));
            $newPass = (safePOSTSQL($connect, 'newPass'));
            $conNewPass = (safePOSTSQL($connect, 'conNewPass'));
            if ($curPass != "" && $newPass != "" && $conNewPass != "") {
                $sqlGetCurPass = "SELECT password FROM userbase WHERE password = '$curPass' AND username = '$user'";
                $getCurPassRes = mysqli_query($connect, $sqlGetCurPass);
                if ($getCurPassRes) {
                    $getcurPassDetails = $getCurPassRes->fetch_assoc();
                    if ($curPass == $getcurPassDetails['password']) {
                        if ($newPass == $conNewPass) {
                            $sqlChangePass = "UPDATE userbase SET password='$newPass' WHERE username = '$user'";
                            if (mysqli_query($connect, $sqlChangePass)) {
                                $results['successMessage'] = "Updated!";
                                require_once "profile.php";
                            } else {
                                $results['errorMessage'] = "Failed to reach Server";
                                require_once "profile.php";
                            }
                        } else {
                            $results['errorMessage'] = "New Passwords do not match.";
                            require_once "profile.php";
                        }
                    } else {
                        $results['errorMessage'] = "Current Password incorrect.";
                        require_once "profile.php";
                    }
                } else {
                    $results['errorMessage'] = "Failed to reach server";
                    require_once "profile.php";
                }
            } else {
                require_once "profile.php";
            }
        }
        if (isset($_POST['newName'])) {
            $newName = safePOSTSQL($connect, 'newName');
            if ($newName != "") {

                $sqlChangeName = "UPDATE userbase SET name='$newName' WHERE username = '$user'";
                if (mysqli_query($connect, $sqlChangeName)) {
                    $results['successMessage'] = "Updated!";
                    require_once "profile.php";
                }
            } else {
                require_once "profile.php";
            }
        } else {
            require_once "profile.php";
        }

    }
//end of document
?>
